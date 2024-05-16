@extends('adminlte::page')

@section('title', 'Marcas')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1>Lista de Marcas</h1>
    <a href="{{ route('marcas.create') }}" class="btn btn-success">
        <i class="fas fa-plus"></i> Nueva Marca
    </a>
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
            <form action="{{ route('marcas.index') }}" method="get" class="input-group input-group-sm">
                <input type="text" name="search" class="form-control" placeholder="Buscar por nombre de marca">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                </div>
            </form>
        </div>
    </div>
    <!-- /.card-header -->

    <div class="card-body table-responsive">
        @if($marcas->isEmpty())
            <div class="alert alert-warning">
                <p>No se encontraron coincidencias.</p>
            </div>
        @else
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>No°</th>
                        <th>Logo</th>
                        <th>Nombre de la Marca</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $count = ($marcas->currentPage() - 1) * $marcas->perPage() + 1;
                    @endphp
                    @foreach($marcas as $marca)
                    <tr>
                        <td>{{ $count++ }}</td>
                        <td><img src="{{ asset('assets/imgs/marcas') }}/{{ $marca->image }}" width="80" /></td>
                        <td>{{ $marca->nombre_marca }}</td>
                        <td>{{ $marca->status == 1 ? 'Activa' : 'Inactiva' }}</td>
                        <td>
                            <a href="{{ route('marcas.edit', ['marca' => $marca->id]) }}"
                                class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>

                            <!-- Botón para activar el modal de confirmación -->
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                data-target="#confirmDelete{{ $marca->id }}">
                                <i class="fas fa-trash-alt"></i>
                            </button>

                            <!-- Modal de confirmación para eliminar -->
                            <div class="modal fade" id="confirmDelete{{ $marca->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="modalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalLabel">Confirmar eliminación</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            ¿Estás seguro de eliminar la marca "{{ $marca->nombre_marca }}"?
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('marcas.destroy', ['marca' => $marca->id]) }}"
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
        @endif
    </div>
    <!-- /.card-body -->
</div>

<!-- Agrega la paginación -->
<div class="pagination justify-content-end">
    {{ $marcas->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
</div>
@stop

@section('css')
@stop

@section('js')
<!-- Agrega scripts adicionales si es necesario -->
@stop
