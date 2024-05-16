@extends('adminlte::page')

@section('title', 'Modificar Categoría')

@section('content_header')
<h1>Modificar Categoría</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('categories.update', ['category' => $category->id]) }}" method="POST">
            @csrf
            <input type="hidden" name="_method" value="PUT"> <!-- Agrega esta línea -->

            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" id="name" name="name" value="{{ $category->name }}" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="slug">Slug</label>
                <input type="text" id="slug" name="slug" value="{{ $category->slug }}" class="form-control" readonly>
            </div>

            <!-- Agrega más campos según tus necesidades -->

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary mr-2">
                    Modificar
                </button>
                <a href="{{ route('categories.index') }}" class="btn btn-danger">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@stop

@section('css')
@stop

@section('js')
<script>
    // Script para generar el slug en tiempo real
        document.addEventListener('DOMContentLoaded', function () {
            const nameInput = document.getElementById('name');
            const slugInput = document.getElementById('slug');

            nameInput.addEventListener('input', function () {
                const slug = this.value.trim()
                    .toLowerCase()
                    .replace(/[^a-z0-9-]/g, '-')
                    .replace(/-+/g, '-');

                slugInput.value = slug;
            });
        });
</script>
@stop