@extends('adminlte::page')

@section('title', 'Gastos')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1>Lista de Gastos</h1>
    <a href="{{ route('gastos.create') }}" class="btn btn-success">
        <i class="fas fa-plus"></i> Nuevo Gasto
    </a>
</div>
@stop

@section('content')
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if($gastos->isEmpty())
<div class="alert alert-warning">
    <p>No se encontraron coincidencias.</p>
</div>
@else
<div class="card">
    <div class="card-header">
        <div class="card-tools">
            <form action="{{ route('gastos.index') }}" method="get" class="input-group input-group-sm">
                <input type="text" name="search" class="form-control" placeholder="Buscar">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                </div>
            </form>
        </div>
    </div>
    <!-- /.card-header -->

    <div class="card-body table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>No°</th>
                    <th>Concepto</th>
                    <th>Valor</th>
                    <th>Fecha del Gasto</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @php
                $count = ($gastos->currentPage() - 1) * $gastos->perPage() + 1;
                @endphp
                @foreach($gastos as $gasto)
                <tr>
                    <td>{{ $count++ }}</td>
                    <td>
                        <a href="{{ route('gastos.show', ['gasto' => $gasto->id]) }}">
                            {{ $gasto->concepto }}
                        </a>
                    </td>

                    <td>${{ number_format($gasto->valor, 2, '.', ',') }}</td>
                    <td>{{ $gasto->fecha_gasto }}</td>
                    <td
                        class="text-center font-weight-bold {{ $gasto->estado == 'Pagado' ? 'bg-success text-white' : ($gasto->estado == 'Deuda' ? 'bg-danger text-white' : '') }}">
                        {{ $gasto->estado }}
                    </td>
                    <td>
                        <a href="{{ route('gastos.edit', ['gasto' => $gasto->id]) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>

                        <!-- Botón para activar el modal de confirmación -->
                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                            data-target="#confirmDelete{{ $gasto->id }}">
                            <i class="fas fa-trash-alt"></i>
                        </button>

                        <!-- Modal de confirmación para eliminar -->
                        <div class="modal fade" id="confirmDelete{{ $gasto->id }}" tabindex="-1" role="dialog"
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
                                        ¿Estás seguro de eliminar el gasto "{{ $gasto->concepto }}"?
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('gastos.destroy', ['gasto' => $gasto->id]) }}"
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
    </div>
    <!-- /.card-body -->
</div>

<!-- Agrega la paginación -->
<div class="pagination justify-content-end">
    {{ $gastos->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
</div>
@endif
@stop

@section('css')
@stop

@section('js')
<!-- Agrega scripts adicionales si es necesario -->
@stop