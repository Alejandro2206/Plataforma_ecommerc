@extends('adminlte::page')

@section('title', 'Nuevo Cliente')

@section('content_header')
    <h1>Nuevo Cliente</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <!-- Formulario para crear nuevo cliente -->
            <form action="{{ route('clientes.store') }}" method="post">
                @csrf

                <div class="form-group">
                    <label for="nombre_completo">Nombre Completo</label>
                    <input type="text" name="nombre_completo" id="nombre_completo" class="form-control"
                           placeholder="Nombre Completo" required>
                </div>

                <div class="form-group">
                    <label for="numero">Número Telefónico</label>
                    <input type="text" name="numero" id="numero" class="form-control" placeholder="Número Telefónico"
                           required>
                </div>

                <!-- Otros campos del formulario si es necesario -->

                <!-- Botones -->
                <div class="d-flex justify-content-end mt-3">
                    <button type="submit" class="btn btn-success">Agregar</button>
                    <a href="{{ route('clientes.index') }}" class="btn btn-danger ml-2">Cancelar</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Función para agregar guiones al número telefónico
        document.getElementById('numero').addEventListener('input', function (e) {
            var value = e.target.value.replace(/\D/g, '');
            if (value.length > 3) {
                value = value.substring(0, 3) + '-' + value.substring(3);
            }
            if (value.length > 7) {
                value = value.substring(0, 7) + '-' + value.substring(7);
            }
            e.target.value = value;
        });
    </script>
@stop

@section('css')
@stop

@section('js')
@stop
