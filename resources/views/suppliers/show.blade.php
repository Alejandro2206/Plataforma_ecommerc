@extends('adminlte::page')

@section('title', 'Detalles')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Detalles de Proveedor: {{ $supplier->company }}</h1>
        <!-- Botón para regresar a la vista index -->
        <a href="{{ route('suppliers.index') }}" class="btn btn-primary">
            <i class="fas fa-arrow-left"></i> Regresar a la Lista de Proveedores
        </a>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <img src="{{ asset('assets/imgs/companys') . '/' . $supplier->image }}" alt="{{ $supplier->company }}" class="img-fluid mb-3">
                </div>
                <div class="col-md-8">
                    <dl class="row">
                        <dt class="col-sm-3">Empresa:</dt>
                        <dd class="col-sm-9">{{ $supplier->company }}</dd>

                        <dt class="col-sm-3">Número :</dt>
                        <dd class="col-sm-9">{{ $supplier->number }}</dd>

                        <dt class="col-sm-3">Descripción:</dt>
                        <dd class="col-sm-9">{{ $supplier->description }}</dd>
                        <!-- Agrega más campos según tus necesidades -->
                    </dl>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        /* Agrega estilos personalizados aquí si es necesario */
        .img-fluid {
            max-width: 100%;
            height: auto;
        }
    </style>
@stop

@section('js')
    <!-- Agrega scripts adicionales si es necesario -->
@stop
