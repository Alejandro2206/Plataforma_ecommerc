@extends('adminlte::page')

@section('title', 'Modificar Producto')

@section('content_header')
<h1>Modificar Producto</h1>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <!-- Mostrar mensajes de error -->
        @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <!-- Formulario para editar producto -->
        <form action="{{ route('products.update', ['product' => $product->id]) }}" method="post"
            enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" value="put">

            <!-- Campos del formulario -->
            <div class="row">
                <!-- Columna izquierda -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}"
                            required placeholder="Nombre del producto">
                    </div>

                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" id="slug" name="slug" value="{{ $product->slug }}" class="form-control" readonly>
                    </div>

                    <div class="form-group">
                        <label for="short_description">Descripción corta</label>
                        <textarea name="short_description" id="short_description" class="form-control"
                            placeholder="Descripción corta del producto">{{ $product->short_description }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="description">Descripción</label>
                        <textarea name="description" id="description" class="form-control" required
                            placeholder="Descripción detallada del producto">{{ $product->description }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="regular_price">Precio de Venta</label>
                        <input type="number" name="regular_price" id="regular_price" class="form-control"
                            value="{{ $product->regular_price }}" required placeholder="Precio Regular del producto">
                    </div>

                    <div class="form-group">
                        <label for="sale_price">Costo</label>
                        <input type="number" name="sale_price" id="sale_price" class="form-control"
                            value="{{ $product->sale_price }}" placeholder="Precio de Oferta del producto">
                    </div>
                </div>

                <!-- Columna derecha -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="SKU">Código SKU</label>
                        <input type="text" name="SKU" id="SKU" class="form-control" value="{{ $product->SKU }}" required
                            placeholder="Código SKU del producto">
                    </div>

                    <div class="form-group">
                        <label for="stock_status">Estado de Stock</label>
                        <select name="stock_status" id="stock_status" class="form-control" required>
                            <option value="Existente" {{ $product->stock_status === 'Existente' ? 'selected' : ''
                                }}>Existente</option>
                            <option value="Agotado" {{ $product->stock_status === 'Agotado' ? 'selected' : '' }}>Agotado
                            </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="featured">Destacado</label>
                        <select name="featured" id="featured" class="form-control">
                            <option value="1" {{ $product->featured == 1 ? 'selected' : '' }}>Sí</option>
                            <option value="0" {{ $product->featured == 0 ? 'selected' : '' }}>No</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="quantity">Cantidad</label>
                        <input type="number" name="quantity" id="quantity" class="form-control"
                            value="{{ $product->quantity }}" required placeholder="Cantidad disponible">
                    </div>

                    <div class="form-group">
                        <label for="image">Imagen</label>
                        <input type="file" name="image" id="image" class="form-control-file">
                        <img src="{{ asset('assets/imgs/products')}}/{{$product->image}}" alt="{{$product->name}}"
                            width="60" />
                    </div>

                    <div class="form-group">
                        <label for="category_id">Categoría</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="" {{ !$product->category_id ? 'selected' : '' }}>Sin Categoría</option>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $product->category_id === $category->id ? 'selected'
                                : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Otros campos adicionales... -->

                    <!-- Botones -->
                    <div class="d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-primary">Modificar</button>
                        <a href="{{ route('products.index') }}" class="btn btn-danger ml-2">Cancelar</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
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