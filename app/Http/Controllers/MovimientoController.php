<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movimiento;
use App\Models\Sale;
use App\Models\Gasto;
use Illuminate\Support\Facades\DB;

class MovimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Consulta SQL para seleccionar el total de ventas agrupado por mes con estado "Pagado"
        $salesData = DB::table('sales')
            ->select(DB::raw('SUM(total_amount) AS total_amount, MONTH(created_at) AS month'))
            ->where('status', 'Pagado')
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->get()
            ->pluck('total_amount', 'month')
            ->toArray();

        // Consulta SQL para seleccionar el total de gastos agrupado por mes con estado "Pagado"
        $expensesData = DB::table('gastos')
            ->select(DB::raw('SUM(valor) AS valor, MONTH(fecha_gasto) AS month'))
            ->where('estado', 'Pagado')
            ->groupBy(DB::raw('MONTH(fecha_gasto)'))
            ->get()
            ->pluck('valor', 'month')
            ->toArray();

        // Mapear los números de mes a los nombres de mes en español
        $meses = [
            1 => 'Enero',
            2 => 'Febrero',
            3 => 'Marzo',
            4 => 'Abril',
            5 => 'Mayo',
            6 => 'Junio',
            7 => 'Julio',
            8 => 'Agosto',
            9 => 'Septiembre',
            10 => 'Octubre',
            11 => 'Noviembre',
            12 => 'Diciembre'
        ];

        // Obtener los nombres de los meses para los gastos en español
        $expensesLabels = [];
        foreach ($expensesData as $month => $total) {
            $expensesLabels[] = $meses[$month];
        }

        // Obtener los nombres de los meses para las ventas en español
        $salesLabels = [];
        foreach ($salesData as $month => $total) {
            $salesLabels[] = $meses[$month];
        }

        // Pasar los datos a la vista
        return view('movimientos.index', compact('salesData', 'expensesData', 'salesLabels', 'expensesLabels'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
