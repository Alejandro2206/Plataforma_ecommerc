@extends('adminlte::page')

@section('title', 'Modificar Cliente')

@section('content_header')
    <h1>Modificar Cliente</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <!-- Formulario para editar cliente -->
            <form action="{{ route('clientes.update', ['cliente' => $cliente->id]) }}" method="post">
                @csrf
                @method('put')

                <!-- Campos del formulario -->
                <div class="form-group">
                    <label for="nombre_completo">Nombre Completo</label>
                    <input type="text" name="nombre_completo" id="nombre_completo" class="form-control"
                           value="{{ $cliente->nombre_completo }}" required placeholder="Nombre completo del cliente">
                </div>

                <div class="form-group">
                    <label for="numero">Número de Teléfono</label>
                    <input type="text" name="numero" id="numero" class="form-control"
                           value="{{ preg_replace('/(\d{3})(\d{3})(\d{4})/', '$1-$2-$3', $cliente->numero) }}"
                           required pattern="\d{3}-\d{3}-\d{4}" placeholder="Formato: 123-456-7890">
                </div>

                <!-- Agregar otros campos si es necesario -->

                <!-- Botones -->
                <div class="d-flex justify-content-end mt-3">
                    <button type="submit" class="btn btn-primary">Modificar</button>
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
