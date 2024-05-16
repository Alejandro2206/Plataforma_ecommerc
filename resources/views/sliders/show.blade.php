@extends('adminlte::page')

@section('title', 'Detalles de Slider')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Detalles de Slider</h1>
        <!-- Botón para regresar a la vista index -->
        <a href="{{ route('sliders.index') }}" class="btn btn-primary">
            <i class="fas fa-arrow-left"></i> Regresar a la Lista de Sliders
        </a>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <img src="{{ asset('assets/imgs/slider') . '/' . $slider->image }}" alt="{{ $slider->top_title }}" width="200">
                </div>
                <div class="col-md-8">
                    <dl class="row">

                        <dt class="col-sm-3">Título Superior:</dt>
                        <dd class="col-sm-9">{{ $slider->top_title }}</dd>

                        <dt class="col-sm-3">Título:</dt>
                        <dd class="col-sm-9">{{ $slider->title }}</dd>

                        <dt class="col-sm-3">Subtítulo:</dt>
                        <dd class="col-sm-9">{{ $slider->sub_title }}</dd>

                        <dt class="col-sm-3">Oferta:</dt>
                        <dd class="col-sm-9">{{ $slider->offer }}</dd>

                        <dt class="col-sm-3">Enlace:</dt>
                        <dd class="col-sm-9">{{ $slider->link }}</dd>

                        <dt class="col-sm-3">Estatus:</dt>
                        <dd class="col-sm-9">{{ $slider->status == 1 ? 'Activo' : 'Inactivo' }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
    <!-- Agrega scripts adicionales si es necesario -->
@stop
