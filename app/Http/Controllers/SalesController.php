<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Sale;
use App\Models\Product;
use App\Models\SaleProduct;
use Illuminate\Http\Request;
use App\Models\Clientes;
use App\Models\Payment;
use App\Models\Gasto;
use App\Models\Abono;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Barryvdh\DomPDF\Facade\Pdf;




class SalesController extends Controller
{
    public function index(Request $request)
    {
        $query = Sale::query();

        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->whereHas('client', function ($query) use ($searchTerm) {
                $query->where('nombre_completo', 'like', '%' . $searchTerm . '%');
            });
        }

        $sales = $query->paginate(5);

        return view('sales.index', compact('sales'));
    }

    public function create()
    {

        // Lógica para generar automáticamente el número de comprobante
        $numeroComprobante = $this->generarNumeroComprobante();


        $clients = Clientes::all();
        $products = Product::all();
        return view('sales.create', compact('products', 'clients', 'numeroComprobante'));
    }

    private function generarNumeroComprobante()
    {
        // Obtener el número actual de comprobantes y sumar 1
        $ultimoComprobante = Sale::latest('created_at')->value('reference_number');
        $numeroSiguiente = ($ultimoComprobante) ? intval(substr($ultimoComprobante, 7)) + 1 : 1;

        // Formatear el número con ceros a la izquierda
        $numeroComprobante = 'LIZCOMP' . str_pad($numeroSiguiente, 5, '0', STR_PAD_LEFT);

        return $numeroComprobante;
    }

    public function store(Request $request)
    {
        try {

            // Lógica para almacenar la compra en la base de datos, utilizando el número de comprobante generado
            $numeroComprobante = $request->input('numero_comprobante');
            // Añade reglas de validación según tus necesidades
            $request->validate([
                'reference_number' => 'required',
                'client_id' => 'required|numeric', // Ajusta según tus necesidades
                'status' => 'required',
                'arrayidProducto' => 'required|array',
                // Aquí puedes agregar más reglas según tus necesidades específicas
            ]);

            DB::beginTransaction();

            $date = now();

            // Crea la venta sin productos
            $sale = Sale::create([
                'reference_number' => $request->input('reference_number'),
                'client_id' => $request->input('client_id'),
                'status' => $request->input('status'),
                'total_amount' => 0,
                'discount' => 0,
                'quantity' => 0,
            ]);

            // Adjunta los productos a la venta
            foreach ($request->input('arrayidProducto') as $index => $product_id) {
                $product = Product::find($product_id);

                $quantity = $request->input('arraycantidad.' . $index);
                $price = $request->input('arrayprecioventa.' . $index);

                $discount = $request->input('arraydescuento.' . $index) ?? 0;

                $subtotal = $quantity * $price;

                // Calcula el descuento como porcentaje y resta al subtotal
                $subtotal -= ($subtotal * $discount / 100);

                /*  $saleProduct = new SaleProduct([
                     'sale_id' => $sale->id,
                     'product_id' => $product_id,
                     'quantity' => $quantity,
                     'price' => $price,
                     'discount' => $discount, 
                     'total_product' => $subtotal,
                 ]);

                 $saleProduct->save(); */

                $sale->products()->attach($product_id, [
                    'quantity' => $quantity,
                    'price' => $price,
                    'discount' => $discount,
                    'total_product' => $subtotal,
                ]);

                $sale->update([
                    'total_amount' => $sale->total_amount + $subtotal,
                    'quantity' => $sale->quantity + $subtotal,
                ]);


                // Calculate the new stock quantity
                $newStock = $product->quantity - $quantity;

                // Update the product's quantity and stock status
                $product->update([
                    'quantity' => max(0, $newStock),
                    'stock_status' => ($newStock <= 0) ? 'Agotado' : 'Existente',
                ]);

                // Call the function to update the product's stock status
                $this->updateStockStatus($product_id);

                // Actualiza la información en la tabla products
                $product->update([
                    'quantity' => max(0, $newStock),
                    'stock_status' => ($newStock <= 0) ? 'Agotado' . '' : 'Existente' . '',
                ]);
            }

            DB::commit();

            // Redirecciona a la vista sales.index con un mensaje de éxito
            return redirect()->route('sales.index')->with('success', 'Venta creada exitosamente');
        } catch (\Exception $e) {
            DB::rollBack();

            // Muestra el mensaje de error y la traza
            dd('Error al procesar la venta', $e->getMessage(), $e->getTraceAsString());
        }
    }

    // Agrega este método para actualizar el stock status de un producto
    private function updateStockStatus($product_id)
    {
        $product = Product::find($product_id);

        if ($product) {
            $newStock = $product->quantity;
            $product->update([
                'stock_status' => ($newStock <= 0) ? 'Agotado' : 'Existente',
            ]);
        }
    }

    public function show(Sale $sale)
    {
        try {
            // Obtener la URL de la imagen del comprobante
            $imagenComprobanteURL = $this->generateComprobanteURL($sale);

            // Puedes cargar los productos asociados a la venta
            $abonos = Payment::where('sale_id', $sale->id)->get();
            $products = SaleProduct::with('product')->where('sale_id', $sale->id)->get();
            $client = $sale->client;

            return view('sales.show', compact('sale', 'products', 'abonos', 'client', 'imagenComprobanteURL'));

        } catch (\Exception $e) {
            // Muestra el mensaje de error y la traza
            dd('Error al procesar la venta', $e->getMessage(), $e->getTraceAsString());
        }
    }

    private function generateComprobanteURL(Sale $sale)
    {
        // Aquí debes escribir el código para generar la URL de la imagen del comprobante
        // Por ejemplo, podrías obtener la URL de una ruta en tu aplicación que genera la imagen del comprobante
        // y pasar los parámetros necesarios, como el ID de la venta, para generar la imagen
        // Por favor, reemplaza este código con la lógica real para generar la URL de la imagen del comprobante
        return 'URL de la imagen del comprobante';
    }

    public function abonar(Request $request, Sale $sale)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
        ]);

        // Verificamos que el gasto esté en estado 'Deuda'
        if ($sale->status !== 'Deuda') {
            return back()->with('error', 'No se puede abonar a un gasto que no está en deuda.');
        }

        // Creamos un nuevo abono con la fecha actual
        Payment::create([
            'sale_id' => $sale->id,
            'amount' => $request->amount,
            'payment_date' => Carbon::now(), // Establecer la fecha actual
        ]);

        // Actualizamos el estado del gasto a 'Pagado' si la deuda ha sido saldada
        if ($sale->deudaRestante() <= 0) {
            $sale->update(['status' => 'Pagado']);
        }

        return back()->with('success', 'Abono registrado con éxito.');
    }

    public function destroy(Sale $sale)
    {
        // Método para eliminar una venta específica
        $sale->delete();
        return redirect()->route('sales.index')->with('success', 'Venta eliminada correctamente');
    }

    public function pdf()
    {
        // Obtener fecha del primer día del mes actual
        $startOfMonth = Carbon::now()->startOfMonth();

        // Obtener fecha del último día del mes actual
        $endOfMonth = Carbon::now()->endOfMonth();

        // Obtener todas las ventas del mes actual
        $sales = Sale::whereBetween('created_at', [$startOfMonth, $endOfMonth])->get();

        // Obtener todos los gastos del mes actual
        $gastos = Gasto::whereBetween('created_at', [$startOfMonth, $endOfMonth])->get();

        // Calcular el total de ventas pagadas del mes actual
        $totalVentasPagadas = $sales->where('status', 'Pagado')->sum('total_amount');

        // Calcular el total de gastos pagados del mes actual
        $totalGastosPagados = $gastos->where('estado')->sum('valor');

        // Calcular el balance
        $balance = $totalVentasPagadas - $totalGastosPagados;

        // Establecer el nombre del archivo PDF
        $filename = 'Reporte_Ingresos.pdf';

        // Generar el PDF y pasar los datos
        $pdf = PDF::loadView('sales.pdf', compact('sales', 'gastos', 'totalVentasPagadas', 'totalGastosPagados', 'balance'));

        // Devolver la vista del PDF
        return $pdf->stream($filename);
    }

    public function pdfDeudas()
    {

        // Calcular el total de productos existentes
        $totalDeuda = Sale::where('status', 'Deuda')->count();

        // Obtener las ventas en deuda
        $ventasDeuda = Sale::where('status', 'Deuda')->get();

        // Generar el PDF
        $pdf = PDF::loadView('sales.deudas.pdf', compact('ventasDeuda', 'totalDeuda'));

        $filename = 'Reporte_Ventas_Deudas.pdf';

        // Devolver el PDF al navegador
        return $pdf->stream($filename);
    }
}