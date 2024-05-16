<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gasto;
use App\Models\Supplier;
use App\Models\Abono;
use Illuminate\Validation\Rule;
use Illuminate\Http\Response;
use Barryvdh\DomPDF\Facade\Pdf;


class GastoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Lógica para filtrar las categorías según el término de búsqueda y ordenarlas ASC por nombre
        $gastos = Gasto::when($search, function ($query) use ($search) {
            return $query->where('concepto', 'like', "%$search%");
        })
            ->with('proveedor') // Cargar la relación proveedor
            ->paginate(5);

        return view('gastos.index', compact('gastos'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        $gasto = new Gasto(); // Crear una nueva instancia de Gasto
        return view('gastos.create', compact('suppliers', 'gasto'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'categoria_select' => 'required',
            'valor' => 'required|numeric',
            'concepto' => 'required',
            'metodo_pago_select' => 'required',
            'proveedor_id' => 'exists:suppliers,id',
            'fecha_gasto' => 'required|date',
            'estado' => 'required|in:Deuda,Pagado',
        ]);

        // Mapea 'categoria_select' y 'metodo_pago_select' a sus respectivos campos en los datos antes de pasarlo al modelo
        $data = $request->all();
        $data['categoria'] = $request->input('categoria_select');
        $data['metodo_pago'] = $request->input('metodo_pago_select');

        Gasto::create($data);

        return redirect()->route('gastos.index')->with('success', 'Gasto registrado exitosamente.');
    }


    public function show($id)
    {
        $gasto = Gasto::findOrFail($id);
        $abonos = Abono::where('gasto_id', $id)->get();
        return view('gastos.show', compact('gasto', 'abonos'));
    }

    public function edit($id)
    {
        $gasto = Gasto::findOrFail($id);
        $suppliers = Supplier::all();

        return view('gastos.edit', compact('gasto', 'suppliers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'categoria_select' => 'required',
            'valor' => 'required|numeric',
            'concepto' => 'required',
            'metodo_pago_select' => 'required',
            'proveedor_id' => 'exists:suppliers,id',
            'fecha_gasto' => 'required|date',
            'estado' => 'required|in:Deuda,Pagado',
        ]);

        $gasto = Gasto::findOrFail($id);

        // Mapea 'categoria_select' y 'metodo_pago_select' a sus respectivos campos en los datos antes de actualizar el modelo
        $data = $request->all();
        $data['categoria'] = $request->input('categoria_select');
        $data['metodo_pago'] = $request->input('metodo_pago_select');

        $gasto->update($data);

        return redirect()->route('gastos.index')->with('success', 'Gasto actualizado exitosamente.');
    }


    public function destroy($id)
    {
        $gasto = Gasto::findOrFail($id);
        $gasto->delete();

        return redirect()->route('gastos.index')->with('success', 'Gasto eliminado exitosamente.');
    }

    public function abonar(Request $request, Gasto $gasto)
    {
        $request->validate([
            'monto' => 'required|numeric|min:0.01',
        ]);
        // Verificamos que el gasto esté en estado 'Deuda'
        if ($gasto->estado !== 'Deuda') {
            return back()->with('error', 'No se puede abonar a un gasto que no está en deuda.');
        }

        // Creamos un nuevo abono
        Abono::create([
            'gasto_id' => $gasto->id,
            'monto' => $request->monto,
        ]);

        // Actualizamos el estado del gasto a 'Pagado' si la deuda ha sido saldada
        if ($gasto->deudaRestante() <= 0) {
            $gasto->update(['estado' => 'Pagado']);
        }

        return back()->with('success', 'Abono registrado con éxito.');
    }

    public function pdf()
    {
        // Obtener todos los gastos
        $gastos = Gasto::all();

        // Generar el PDF
        $pdf = PDF::loadView('gastos.pdf', compact('gastos'));

        // Devolver una vista que abrirá el PDF en una nueva ventana

        return $pdf->stream();
    }
}
