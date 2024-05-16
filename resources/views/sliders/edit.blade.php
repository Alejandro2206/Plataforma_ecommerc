@extends('adminlte::page')

@section('title', 'Modificar Slider')

@section('content_header')
    <h1>Modificar Slider</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <!-- Formulario para editar slider -->
            <form action="{{ route('sliders.update', ['slider' => $slider->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

                <!-- Sección 1 -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="top_title">Título superior</label>
                            <input type="text" name="top_title" id="top_title" class="form-control" value="{{ $slider->top_title }}" required placeholder="Ingrese el Top Title">
                        </div>
                        <div class="form-group">
                            <label for="title">Título</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ $slider->title }}" required placeholder="Ingrese el Title">
                        </div>
                        <div class="form-group">
                            <label for="sub_title">Subtítulo</label>
                            <input type="text" name="sub_title" id="sub_title" class="form-control" value="{{ $slider->sub_title }}" required placeholder="Ingrese el Sub Title">
                        </div>
                    </div>

                    <!-- Sección 2 -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="offer">Oferta</label>
                            <input type="text" name="offer" id="offer" class="form-control" value="{{ $slider->offer }}" required placeholder="Ingrese el Offer">
                        </div>
                        <div class="form-group">
                            <label for="link">Estatus</label>
                            <input type="text" name="link" id="link" class="form-control" value="{{ $slider->link }}" required placeholder="Ingrese el Link">
                        </div>
                        <div class="form-group">
                            <label for="image">Imagen</label>
                            <input type="file" name="image" id="image" class="form-control">
                            <img src="{{ asset('assets/imgs/slider') }}/{{ $slider->image }}" width="80" />
                        </div>
                    </div>
                </div>

                <!-- Común a ambas secciones -->
                <div class="form-group">
                    <label for="status">Estatus</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="0" {{ $slider->status == 0 ? 'selected' : '' }}>Inactivo</option>
                        <option value="1" {{ $slider->status == 1 ? 'selected' : '' }}>Activo</option>
                    </select>
                </div>

                <!-- Botones -->
                <div class="d-flex justify-content-end mt-3">
                    <button type="submit" class="btn btn-primary">Modificar</button>
                    <a href="{{ route('sliders.index') }}" class="btn btn-danger ml-2">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
