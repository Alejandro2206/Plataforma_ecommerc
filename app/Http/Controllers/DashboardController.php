<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Sale;
use App\Models\Gasto;


class DashboardController extends Controller
{
    public function index()
    {
        // Obtener la cantidad de nuevos usuarios registrados hoy
        $usersNew = User::whereDate('created_at', today())->count();

       

        // Retornar la vista con las variables necesarias
        return view('dashboard', compact('usersNew'));

    }
}
