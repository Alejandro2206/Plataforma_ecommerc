<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Muestra una lista de proveedores.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Supplier::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('company', 'like', "%$search%");
        }

        $suppliers = $query->latest()->paginate(4);

        return view('suppliers.index', compact('suppliers'));
    }

    /**
     * Muestra el formulario para crear un nuevo proveedor.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('suppliers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'company' => 'required|string|max:255',
            'number' => 'required|string|max:255',
            'description' => 'nullable',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // Otros campos de validación si es necesario
        ]);

        // Guardar la imagen en la carpeta "companys"
        $imageName = time() . '_' . $request->image->getClientOriginalName();
        $request->image->move(public_path('assets/imgs/companys'), $imageName);

        // Crear el proveedor con la ruta de la imagen
        Supplier::create([
            'company' => $request->input('company'),
            'number' => $request->input('number'),
            'description' => $request->input('description'),
            'image' => $imageName,
            // Otros campos si es necesario
        ]);

        return redirect()->route('suppliers.index')->with('success', 'Proveedor creado exitosamente.');
    }

    /**
     * Muestra la información de un proveedor específico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supplier = Supplier::findOrFail($id);
        return view('suppliers.show', compact('supplier'));
    }

    /**
     * Muestra el formulario para editar un proveedor.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function edit($id)
    {
        // Obtener el proveedor por ID
        $supplier = Supplier::findOrFail($id);

        // Retornar la vista de edición con el proveedor
        return view('suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        // Validación de los campos
        $request->validate([
            'company' => 'required',
            'number' => 'required',
            'description' => 'nullable',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            // Agrega más campos según tus necesidades
        ]);

        // Obtener el proveedor por ID
        $supplier = Supplier::findOrFail($id);

        // Actualizar los campos
        $supplier->company = $request->input('company');
        $supplier->number = $request->input('number');
        $supplier->description = $request->input('description');

        // Procesar y guardar la nueva imagen si se proporciona
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('companys', $imageName); // Ajusta la carpeta según tus necesidades
            $supplier->image = $imageName;
        }

        // Guardar los cambios en la base de datos
        $supplier->save();

        // Redireccionar con mensaje de éxito
        return redirect()->route('suppliers.index')->with('success', 'Proveedor actualizado exitosamente');
    }

    /**
     * Elimina un proveedor de la base de datos.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        return redirect()->route('suppliers.index')->with('success', 'Proveedor eliminado exitosamente.');
    }
}
