@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Lista de Clientes</h1>
        <a href="{{ route('clientes.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> Nuevo Cliente
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
                <form action="{{ route('clientes.index') }}" method="get" class="input-group input-group-sm">
                    <input type="text" name="search" class="form-control" placeholder="Buscar por nombre"
                           value="{{ $search }}">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.card-header -->

        <div class="card-body table-responsive">
            @if($clientes->isEmpty())
                <div class="alert alert-warning">
                    <p>No se encontraron coincidencias.</p>
                </div>
            @else
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>No°</th>
                            <th>Nombre Completo</th>
                            <th>Número</th>
                            <th>Acciones</th>
                            <!-- Otros campos si es necesario -->
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = ($clientes->currentPage() - 1) * $clientes->perPage() + 1;
                        @endphp
                        @foreach($clientes as $cliente)
                            <tr>
                                <td>{{ str_pad($count++, 2, '0', STR_PAD_LEFT) }}</td>
                                <td>{{ $cliente->nombre_completo }}</td>
                                <td>{{ $cliente->numero }}</td>
                                <td>
                                    <a href="{{ route('clientes.edit', ['cliente' => $cliente->id]) }}"
                                       class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <!-- Botón para activar el modal de confirmación -->
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                            data-target="#confirmDelete{{ $cliente->id }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>

                                    <!-- Modal de confirmación para eliminar -->
                                    <div class="modal fade" id="confirmDelete{{ $cliente->id }}" tabindex="-1"
                                         role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
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
                                                    ¿Estás seguro de eliminar el cliente "{{ $cliente->nombre_completo }}"?
                                                </div>
                                                <div class="modal-footer">
                                                    <form
                                                        action="{{ route('clientes.destroy', ['cliente' => $cliente->id]) }}"
                                                        method="post">
                                                        @csrf
                                                        @method('delete')
                                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                                    </form>
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Cancelar
                                                    </button>
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

        <div class="pagination justify-content-end">
            {{ $clientes->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
<!-- Agrega scripts adicionales si es necesario -->
@stop
