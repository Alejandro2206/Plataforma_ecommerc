@extends('adminlte::page')

@section('title', 'Detalles')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Detalles de Producto: {{ $product->name }}</h1>
        <!-- Botón para regresar a la vista index -->
        <a href="{{ route('products.index') }}" class="btn btn-primary">
            <i class="fas fa-arrow-left"></i> Regresar a la Lista de Productos
        </a>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <img src="{{ asset('assets/imgs/products') . '/' . $product->image }}" alt="{{ $product->name }}" width="200">
                </div>
                <div class="col-md-8">
                    <p><strong>Nombre:</strong> {{ $product->name }}</p>
                    <p><strong>Descripción Corta:</strong> {{ $product->short_description }}</p>
                    <p><strong>Descripción:</strong> {{ $product->description }}</p>
                    <p><strong>Precio de Venta:</strong> ${{ $product->regular_price }}</p>
                    <p><strong>Costo:</strong> ${{ $product->sale_price }}</p>
                    <p><strong>Código:</strong> {{ $product->SKU }}</p>
                    <p><strong>Estado de Stock:</strong> {{ $product->stock_status }}</p>
                    <p><strong>Destacado:</strong> {{ $product->featured ? 'Sí' : 'No' }}</p>
                    <p><strong>Cantidad Disponible:</strong> {{ $product->quantity }}</p>
                    <p><strong>Categoría:</strong> {{ $product->category ? $product->category->name : 'N/A' }}</p>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
    <script>
        // Script para hacer scroll suave al hacer clic en "Regresar arriba"
        $(document).ready(function () {
            $(".back-to-top").click(function () {
                $("html, body").animate({ scrollTop: 0 }, "slow");
                return false;
            });
        });
    </script>
@stop
