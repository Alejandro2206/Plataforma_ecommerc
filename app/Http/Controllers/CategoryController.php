<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;

class CategoryController extends Controller
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
        $categories = Category::when($search, function ($query) use ($search) {
            return $query->where('name', 'like', "%$search%");
        })->orderBy('name', 'asc')->paginate(4);

        return view('categories.index', compact('categories'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validación de los datos del formulario
        $request->validate([
            'name' => 'required|unique:categories,name',
            'slug' => 'required|unique:categories,slug',
        ]);

        // Creación de la nueva categoría
        $category = Category::create([
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name')),
        ]);

        // Redirección a la vista de índice de categorías con mensaje de éxito
        return redirect()->route('categories.index')->with('success', 'Categoría creada correctamente');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Obtener la categoría por ID
        $category = Category::find($id);

        // Verificar si la categoría existe
        if (!$category) {
            // Puedes personalizar el manejo si la categoría no existe, como redirigir o mostrar un mensaje de error.
            return redirect()->route('categories.index')->with('error', 'Categoría no encontrada');
        }

        // Devolver la vista de edición con la categoría
        return View::make('categories.edit', compact('category'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validación de los datos del formulario
        $request->validate([
            'name' => 'required|unique:categories,name,' . $id,
            'slug' => 'required|unique:categories,slug,' . $id,
        ]);

        // Obtener la categoría por ID
        $category = Category::find($id);

        // Verificar si la categoría existe
        if (!$category) {
            return redirect()->route('categories.index')->with('error', 'Categoría no encontrada');
        }

        // Actualizar los campos de la categoría
        $category->name = $request->input('name');
        $category->slug = Str::slug($request->input('name'));

        // Guardar los cambios
        $category->save();

        // Redirección a la vista de índice de categorías con mensaje de éxito
        return redirect()->route('categories.index')->with('success', 'Categoría modificada correctamente');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        // Eliminar la categoría
        $category->delete();

        // Redirección a la vista de índice de categorías con mensaje de éxito
        return redirect()->route('categories.index')->with('success', 'Categoría eliminada correctamente');
    }
}
