@extends('adminlte::page')

@section('title', 'Nuevo Producto')

@section('content_header')
<h4>Nuevo Producto</h4>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <!-- Formulario para nuevo producto -->
        <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">

            {!! csrf_field() !!}
            <!-- Uso correcto de comentarios Blade -->
            <!-- Validación de errores -->
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="row">
                <!-- Columna izquierda -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" name="name" id="name" class="form-control" required
                            placeholder="Nombre del producto">
                    </div>

                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug" placeholder="Ingrese el slug" readonly>
                    </div>

                    <div class="form-group">
                        <label for="short_description">Descripción Corta</label>
                        <textarea name="short_description" id="short_description" class="form-control" rows="3"
                            placeholder="Descripción corta del producto"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="description">Descripción</label>
                        <textarea name="description" id="description" class="form-control" rows="5" required
                            placeholder="Descripción detallada del producto"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="sale_price">Costo</label>
                        <input type="number" name="sale_price" id="sale_price" class="form-control" step="0.01"
                            placeholder="Precio de costo">
                    </div>

                    <div class="form-group">
                        <label for="regular_price">Precio de venta</label>
                        <input type="number" name="regular_price" id="regular_price" class="form-control" step="0.01"
                            required placeholder="Precio de venta del producto">
                    </div>
                </div>

                <!-- Columna derecha -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="SKU">Código</label>
                        <input type="text" name="SKU" id="SKU" class="form-control" required
                            placeholder="Código del producto">
                    </div>

                    <div class="form-group">
                        <label for="stock_status">Estado de Stock</label>
                        <select name="stock_status" id="stock_status" class="form-control" required>
                            <option value="">Selecciona estatus</option>
                            <option value="Existente">Existente</option>
                            <option value="Agotado">Agotado</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="featured">Destacado</label>
                        <select name="featured" id="featured" class="form-control">
                            <option value="">Selecciona opción</option>
                            <option value="0">No</option>
                            <option value="1">Sí</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="quantity">Cantidad</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" required
                            placeholder="Cantidad disponible">
                    </div>

                    <div class="form-group">
                        <label for="image">Imagen Principal</label>
                        <input type="file" name="image" id="image" class="form-control-file" accept="image/*" required
                            placeholder="Selecciona una imagen principal">
                    </div>

                    <div class="form-group">
                        <label for="category_id">Categoría</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="">Selecciona una categoría</option>
                            <!-- Opciones de categorías -->
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-success">Agregar</button> <!-- Botón verde -->
                <a href="{{ route('products.index') }}" class="btn btn-danger ml-2">Cancelar</a> <!-- Botón rojo -->
            </div>
        </form>
    </div>
</div>
@stop

@section('css')
@stop

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
           // Obtenemos los elementos de nombre y slug
           var nameInput = document.getElementById('name');
           var slugInput = document.getElementById('slug');

           // Escuchamos el evento input en el campo de nombre
           nameInput.addEventListener('input', function () {
               // Convertimos el texto a minúsculas y reemplazamos caracteres especiales
               var slugValue = nameInput.value.toLowerCase().replace(/[^a-z0-9]+/g, '-');

               // Asignamos el valor al campo de slug
               slugInput.value = slugValue;
           });
       });
</script>
@stop