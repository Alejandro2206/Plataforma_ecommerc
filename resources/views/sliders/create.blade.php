@extends('adminlte::page')

@section('title', 'Nuevo Slider')

@section('content_header')
    <h1>Nuevo Slider</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <!-- Formulario para crear slider -->
            <form action="{{ route('sliders.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <!-- Sección 1 - 4 Campos -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="top_title">Título superior</label>
                            <input type="text" name="top_title" id="top_title" class="form-control" placeholder="Ingrese el Título superior" required>
                        </div>

                        <div class="form-group">
                            <label for="title">Título</label>
                            <input type="text" name="title" id="title" class="form-control" placeholder="Ingrese el Título" required>
                        </div>

                        <div class="form-group">
                            <label for="sub_title">Subtítulo</label>
                            <input type="text" name="sub_title" id="sub_title" class="form-control" placeholder="Ingrese el Subtítulo" required>
                        </div>

                        <div class="form-group">
                            <label for="offer">Oferta</label>
                            <input type="text" name="offer" id="offer" class="form-control" placeholder="Ingrese la oferta" required>
                        </div>
                    </div>

                    <!-- Sección 2 - 3 Campos -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="link">Enlace</label>
                            <input type="text" name="link" id="link" class="form-control" placeholder="Ingrese el Enlace" required>
                        </div>

                        <div class="form-group">
                            <label for="image">Imagen</label>
                            <input type="file" name="image" id="image" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="status">Estatus</label>
                            <select name="status" id="status" class="form-control" required>
                                <option value="">Seleccione un estatus</option>
                                <option value="0">Inactivo</option>
                                <option value="1">Activo</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Botones -->
                <div class="d-flex justify-content-end mt-3">
                    <button type="submit" class="btn btn-success">Agregar</button>
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
