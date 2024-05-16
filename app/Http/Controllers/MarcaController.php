<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marca;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class MarcaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Marca::query();

        if ($search) {
            $query->where('nombre_marca', 'like', '%' . $search . '%');
        }

        // Ordenar por ID de forma descendente (los últimos registros primero)
        $marcas = $query->orderBy('id', 'desc')->paginate(5);

        return view('marcas.index', compact('marcas', 'search'));
    }

    public function create()
    {
        return view('marcas.create');
    }

    public function store(Request $request)
    {
        // Validación de los campos
        $request->validate([
            'nombre_marca' => 'required',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:0,1',
        ]);

        // Procesar y guardar la imagen
        $imageName = time() . '.' . $request->imagen->extension();
        $request->imagen->storeAs('marcas', $imageName);

        // Crear nueva instancia de Marca
        $marca = new Marca([
            'nombre_marca' => $request->input('nombre_marca'),
            'image' => $imageName,
            'status' => $request->input('status'),
            // Otros campos si es necesario
        ]);

        // Guardar la marca en la base de datos
        $marca->save();

        return redirect()->route('marcas.index')->with('success', 'Marca agregada exitosamente');
    }

    public function edit($id)
    {
        // Obtener la marca por su ID
        $marca = Marca::findOrFail($id);

        // Retornar la vista de edición con la marca
        return view('marcas.edit', compact('marca'));
    }

    public function update(Request $request, $id)
    {
        // Obtén la marca que deseas actualizar
        $marca = Marca::findOrFail($id);

        // Validación de los campos
        $request->validate([
            'nombre_marca' => 'required',
            'imagen' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Ahora es opcional
            'status' => 'required|in:0,1',
        ]);

        // Resto del código...

        // Actualiza la marca con los nuevos datos
        $marca->update([
            'nombre_marca' => $request->input('nombre_marca'),
            'status' => $request->input('status'),
            // Otros campos si es necesario
        ]);

        // Actualiza la imagen solo si se proporcionó un nuevo archivo
        if ($request->hasFile('imagen')) {
            // Procesa y guarda la nueva imagen
            $imageName = time() . '.' . $request->imagen->extension();
            $request->imagen->storeAs('marcas', $imageName);

            // Actualiza la ruta de la imagen en la base de datos
            $marca->update(['image' => $imageName]);
        }

        // Redirige a la lista de marcas con un mensaje de éxito
        return redirect()->route('marcas.index')->with('success', 'Marca modificada exitosamente');
    }

    public function destroy($id)
    {
        // Encuentra la marca que deseas eliminar
        $marca = Marca::findOrFail($id);

        // Elimina la imagen asociada a la marca
        File::delete(public_path('assets/imgs/marcas/' . $marca->image));

        // Elimina la marca de la base de datos
        $marca->delete();

        // Redirige a la lista de marcas con un mensaje de éxito
        return redirect()->route('marcas.index')->with('success', 'Marca eliminada exitosamente');
    }
}
