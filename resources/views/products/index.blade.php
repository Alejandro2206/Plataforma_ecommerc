@extends('adminlte::page')

@section('title', 'Productos')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1>Lista de Productos</h1>
    <div class="d-flex">
        <a href="{{ route('products.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Nuevo Producto
        </a>
    </div>
</div>
@stop

@section('content')
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="card">
    <div class="card-header">
        <div class="card-tools">
            <form action="{{ route('products.index') }}" method="get" class="input-group input-group-sm">
                <input type="text" name="search" class="form-control" placeholder="Buscar" value="{{ request('search') }}">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                </div>
            </form>
        </div>
    </div>
    <!-- /.card-header -->

    <div class="card-body table-responsive">
        @if ($products->count() > 0)
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>No°</th>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Código</th>
                        <th>Estatus</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $count = ($products->currentPage() - 1) * $products->perPage() + 1;
                    @endphp
                    @foreach($products as $product)
                        <tr>
                            <td>{{ str_pad($count++, 2, '0', STR_PAD_LEFT) }}</td>
                            <td><img src="{{ asset('assets/imgs/products')}}/{{$product->image}}" alt="{{$product->name}}"
                                    width="60" /></td>
                            <td><a href="{{ route('products.show', ['product' => $product->id]) }}">
                                    {{ $product->name }}
                                </a></td>
                            <td>{{ $product->SKU }}</td>
                            <td>{{ $product->stock_status }}</td>
                            <td>${{ number_format($product->regular_price, 2, '.', ',') }}</td>

                            <td>

                                <a href="{{ route('products.edit', ['product' => $product->id]) }}"
                                    class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- Botón para activar el modal de confirmación -->
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                    data-target="#confirmDelete{{ $product->id }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>

                                <!-- Modal de confirmación para eliminar -->
                                <div class="modal fade" id="confirmDelete{{ $product->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="modalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalLabel">Confirmar eliminación</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Cerrar">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                ¿Estás seguro de eliminar el producto "{{ $product->name }}"?
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('products.destroy', ['product' => $product->id]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                                </form>
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cancelar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Fin del modal -->

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-warning">
                No se encontraron coincidencias.
            </div>
        @endif
    </div>
    <!-- /.card-body -->

    <div class="pagination justify-content-end">
        {{ $products->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
    </div>
</div>

<!-- ... Tu contenido posterior ... -->

@stop

@section('css')
@stop

@section('js')
@stop
