<?php

// app/Http/Controllers/ProductController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use Barryvdh\DomPDF\Facade\Pdf;


class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function (Builder $builder) use ($search) {
                $builder->where('name', 'like', "%$search%")
                    ->orWhere('SKU', 'like', "%$search%");
            });
        }

        $products = $query->latest()->paginate(4);

        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:products',
            'slug' => 'required|unique:products',
            'short_description' => 'nullable',
            'description' => 'required',
            'regular_price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'SKU' => 'required',
            'stock_status' => 'required|in:Existente,Agotado',
            'featured' => 'boolean',
            'quantity' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $originalName = $request->image->getClientOriginalName();
        $imageName = time() . '_' . $originalName;
        $request->image->move(public_path('assets/imgs/products'), $imageName);

        $product = new Product([
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'short_description' => $request->input('short_description'),
            'description' => $request->input('description'),
            'regular_price' => $request->input('regular_price'),
            'sale_price' => $request->input('sale_price'),
            'SKU' => $request->input('SKU'),
            'stock_status' => $request->input('stock_status'),
            'featured' => $request->input('featured') == 1,
            'quantity' => $request->input('quantity'),
            'image' => $imageName,
            'category_id' => $request->input('category_id'),
        ]);

        $product->save();

        return redirect()->route('products.index')->with('success', 'Producto agregado exitosamente');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:products,name,' . $id,
            'slug' => 'required|unique:products,slug,' . $id,
            'short_description' => 'nullable',
            'description' => 'required',
            'regular_price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'SKU' => 'required',
            'stock_status' => 'required|in:Existente,Agotado',
            'featured' => 'boolean',
            'quantity' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        if ($request->hasFile('image')) {
            // Procesa la nueva imagen si se proporciona
            $originalName = $request->image->getClientOriginalName();
            $imageName = time() . '_' . $originalName;
            $request->image->move(public_path('assets/imgs/products'), $imageName);

            // Elimina la imagen anterior si existe
            if ($product->image) {
                $imagePath = public_path('assets/imgs/products') . '/' . $product->image;
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            // Actualiza la información de la nueva imagen
            $product->image = $imageName;
        }

        // Actualiza el resto de los campos del producto
        $product->name = $request->input('name');
        $product->slug = $request->input('slug');
        $product->short_description = $request->input('short_description');
        $product->description = $request->input('description');
        $product->regular_price = $request->input('regular_price');
        $product->sale_price = $request->input('sale_price');
        $product->SKU = $request->input('SKU');
        $product->stock_status = $request->input('stock_status');
        $product->featured = $request->input('featured') == 1;
        $product->quantity = $request->input('quantity');
        $product->category_id = $request->input('category_id');

        $product->save();

        return redirect()->route('products.index')->with('success', 'Producto actualizado exitosamente');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Elimina la imagen asociada si existe
        if ($product->image) {
            $imagePath = public_path('assets/imgs/products') . '/' . $product->image;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Producto eliminado exitosamente');
    }


    public function pdf_existente()
    {
        // Obtener todos los productos
        $products = Product::all();

        // Calcular el total de productos existentes
        $totalExistente = Product::where('stock_status', 'Existente')->count();

       
        // Cargar la vista PDF y pasar los datos
        $pdf = PDF::loadView('products.pdf.pdfexistentes', compact('products', 'totalExistente', ));

        // Establecer el nombre del archivo PDF
        $filename = 'Reporte_productos_existentes.pdf';

        // Devolver el PDF para abrir en otra ventana del navegador
        return $pdf->stream($filename);
    }

    public function pdf_agotados()
    {
        // Obtener todos los productos
        $products = Product::all();

        // Calcular el total de productos agotados
        $totalAgotado = Product::where('stock_status', 'Agotado')->count();

        // Cargar la vista PDF y pasar los datos
        $pdf = PDF::loadView('products.pdf.pdfagotados', compact('products', 'totalAgotado'));

        // Establecer el nombre del archivo PDF
        $filename = 'Reporte_productos_agotados.pdf';

        // Devolver el PDF para abrir en otra ventana del navegador
        return $pdf->stream($filename);
    }
}
