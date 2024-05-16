<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->get('search');

        // Aplica la lógica de búsqueda
        $users = User::where('name', 'like', '%' . $query . '%')
            ->orWhere('email', 'like', '%' . $query . '%')
            ->paginate(10); // O el número de elementos por página que desees

        return view('users.index', compact('users'));
    }
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            // Agrega más validaciones según tus necesidades
        ]);

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            // Agrega más campos según tus necesidades
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario creado exitosamente');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
            // Agrega más validaciones según tus necesidades
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->filled('password') ? bcrypt($request->input('password')) : $user->password,
            // Agrega más campos según tus necesidades
        ]);

        return redirect()->route('users.index')->with('success', 'Usuario actualizado exitosamente');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Usuario eliminado exitosamente');
    }


    public function pdf()
    {
        // Obtener el mes actual
        $mesActual = now()->month;

        // Obtener los usuarios registrados en el mes actual
        $usuarios = User::whereMonth('created_at', $mesActual)->get();

        // Contar los usuarios registrados en el mes actual
        $totalUsuarios = $usuarios->count();

        // Generar el PDF
        $pdf = PDF::loadView('users.pdf', compact('totalUsuarios', 'usuarios'));

        $filename = 'Reporte_Usuarios_Mes_Actual.pdf';

        // Devolver el PDF al navegador
        return $pdf->stream($filename);
    }
}
