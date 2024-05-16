<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clientes;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        // Obtener el término de búsqueda del formulario
        $search = $request->input('search');

        // Consultar clientes con filtrado por nombre si hay un término de búsqueda
        $query = Clientes::query();
        if ($search) {
            $query->where('nombre_completo', 'like', '%' . $search . '%');
        }
        // Obtener los clientes paginados
        $clientes = $query->paginate(5);

        // Retornar la vista con los clientes y el término de búsqueda
        return view('clientes.index', compact('clientes', 'search'));
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_completo' => 'required',
            'numero' => 'required|regex:/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/',
            // Agrega validaciones para otros campos si es necesario
        ]);

        // Crear un nuevo cliente con los datos del formulario
        $cliente = new Clientes([
            'nombre_completo' => $request->input('nombre_completo'),
            'numero' => $request->input('numero'),
            // Agrega otros campos si es necesario
        ]);

        // Guardar el cliente en la base de datos
        $cliente->save();

        return redirect()->route('clientes.index')->with('success', 'Cliente agregado exitosamente');
    }

    public function edit($id)
    {
        $cliente = Clientes::findOrFail($id);
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_completo' => 'required',
            'numero' => ['required', 'regex:/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/'],
            // Agrega validaciones para otros campos si es necesario
        ]);

        $cliente = Clientes::findOrFail($id);

        // Actualizar los campos del cliente
        $cliente->nombre_completo = $request->input('nombre_completo');
        $cliente->numero = $request->input('numero');
        // Actualiza otros campos si es necesario

        $cliente->save();

        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado exitosamente');
    }

    public function destroy($id)
    {
        $cliente = Clientes::findOrFail($id);
        $cliente->delete();

        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado exitosamente');
    }
}
