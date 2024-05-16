@extends('adminlte::page')

@section('title', 'Nueva Categoría')

@section('content_header')
    <h1>Nueva Categoría</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('categories.store') }}" method="post">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Ingrese el nombre" required>
                </div>

                <div class="mb-3">
                    <label for="slug" class="form-label">Slug</label>
                    <input type="text" class="form-control" id="slug" name="slug" placeholder="Ingrese el slug" readonly>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">
                        Agregar
                    </button>
                    <a href="{{ route('categories.index') }}" class="btn btn-danger ml-2">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Escuchar cambios en el campo de nombre y actualizar dinámicamente el campo de slug
        document.getElementById('name').addEventListener('input', function () {
            const name = this.value;
            const slugField = document.getElementById('slug');

            // Lógica para generar el slug (puedes personalizar según tus necesidades)
            const slug = name.toLowerCase().replace(/\s+/g, '-');

            slugField.value = slug;
        });
    </script>
@stop

@section('css')
@stop

@section('js')
@stop
