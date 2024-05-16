@extends('adminlte::page')

@section('title', 'Nueva Marca')

@section('content_header')
    <h1>Nueva Marca</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <!-- Formulario para crear nueva marca -->
            <form action="{{ route('marcas.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <!-- Campos del formulario -->
                <div class="form-group">
                    <label for="nombre_marca">Nombre de la Marca</label>
                    <input type="text" name="nombre_marca" id="nombre_marca" class="form-control"
                           placeholder="Nombre de la Marca" required>
                </div>

                <div class="form-group">
                    <label for="imagen">Imagen</label>
                    <input type="file" name="imagen" id="imagen" class="form-control-file" accept="image/*" required>
                </div>

                <div class="form-group">
                    <label for="status">Estado</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="">Selecciona un estatus</option>
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>

                <!-- Otros campos del formulario si es necesario -->

                <!-- Botones -->
                <div class="d-flex justify-content-end mt-3">
                    <button type="submit" class="btn btn-success">Agregar</button>
                    <a href="{{ route('marcas.index') }}" class="btn btn-danger ml-2">Cancelar</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Puedes agregar scripts adicionales si es necesario
    </script>
@stop

@section('css')
@stop

@section('js')
    <!-- Puedes agregar scripts adicionales si es necesario -->
@stop
