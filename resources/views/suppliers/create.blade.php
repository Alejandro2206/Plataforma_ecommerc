@extends('adminlte::page')

@section('title', 'Crear Proveedor')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Crear Proveedor</h1>
    </div>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <!-- Formulario para crear proveedor -->
            <form action="{{ route('suppliers.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="company">Nombre de la Empresa:</label>
                            <input type="text" name="company" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="number">Número de Proveedor:</label>
                            <input type="text" name="number" class="form-control phone-number" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="description">Descripción:</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="image">Logo:</label>
                            <input type="file" name="image" class="form-control-file">
                        </div>
                    </div>
                </div>

                <!-- Agrega más campos según tus necesidades -->

                <div class="d-flex justify-content-end mt-3">
                    <button type="submit" class="btn btn-success">Guardar</button>
                    <a href="{{ route('suppliers.index') }}" class="btn btn-danger ml-2">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.phone-number').inputmask('(999) 999-9999');
        });
    </script>
@stop
