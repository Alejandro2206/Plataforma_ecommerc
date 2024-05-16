@extends('adminlte::page')

@section('title', 'Panel de Administrador')

@section('content_header')
<center><h1 class="m-0 text-dark" style="color: black; font-weight: bold;">Bienvenido al Panel de Administración, {{ auth()->user()->name }} </h1></center> <br>

@stop

@section('content')
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- Información o métrica personalizada 1 -->
        <div class="small-box bg-info">
            <div class="inner">
            <center>
    <h3 style="color: black;">{{ \App\Models\User::whereMonth('created_at', now())->count() }}</h3>
    <p style="color: black;">Nuevos Usuarios</p>
</center>

            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ route('users.pdf') }}" class="small-box-footer" target="_blank">Más información <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
    <!-- Información o métrica personalizada 3 -->
    <div class="small-box bg-success">
        <div class="inner">
            @php
$totalVentasPagadas = \App\Models\Sale::where('status', 'Pagado')->whereMonth('created_at', now())->sum('total_amount');
            @endphp
          <center>
    <h3 style="color: black;">${{ number_format($totalVentasPagadas, 2, '.', ',') }}</h3>
    <p style="color: black;">Ingresos del Mes</p>
</center>

        </div>
        <div class="icon">
            <i class="ion ion-clock"></i>
        </div>
        <a href="{{ route('sales.pdf') }}" class="small-box-footer" target="_blank">Más información <i class="fas fa-arrow-circle-right"></i></a>
    </div>
</div>


<div class="col-lg-3 col-6">
    <!-- Información o métrica personalizada 3 -->
    <div class="small-box bg-warning">
    <div class="inner">
    <center>
    <h3 style="color: black;">{{ \App\Models\Sale::where('status', 'Deuda')->count() }}</h3>
    <p style="color: black;">Ventas en deuda</p>
</center>

            </div>
        <div class="icon">
            <i class="ion ion-clock"></i>
        </div>
        <a href="{{route('sales.deudas.pdf')}}" class="small-box-footer" target="_blank" style="color: white !important;">Más información <i class="fas fa-arrow-circle-right"></i></a>

    </div>
</div>

    <div class="col-lg-3 col-6">
        <!-- Información o métrica personalizada 4 -->
        <div class="small-box bg-orange">
            <!-- Cambiado el color a verde (success) -->
            <div class="inner">
            <center>
    <h3 style="color: black;">{{ \App\Models\Product::where('stock_status', 'Existente')->count() }}</h3>
    <p style="color: black;">Productos en Existencia</p>
</center>

            </div>
            <div class="icon">
                <i class="ion ion-checkmark-circled"></i> <!-- Cambiado el ícono a checkmark -->
            </div>
            <a href="{{ route('products.pdf.pdfexistentes') }}" class="small-box-footer" target="_blank" style="color: white !important;">Más información <i class="fas fa-arrow-circle-right"></i></a>

        </div>
    </div>

    <div class="col-lg-3 col-6">
        <!-- Información o métrica personalizada 4 -->
        <div class="small-box bg-red">
            <!-- Cambiado el color a verde (success) -->
            <div class="inner">
            <center>
    <h3 style="color: black;">{{ \App\Models\Product::where('stock_status', 'Agotado')->count() }}</h3>
    <p style="color: black;">Productos Agotados</p>
</center>

            </div>
            <div class="icon">
                <i class="ion ion-checkmark-circled"></i> <!-- Cambiado el ícono a checkmark -->
            </div>
            <a href="{{ route('products.pdf.pdfagotados') }}" class="small-box-footer" target="_blank" style="color: white !important;">Más información <i class="fas fa-arrow-circle-right"></i></a>
        
        </div>
    </div>

</div>
@stop

@section('css')
@stop

@section('js')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@stop