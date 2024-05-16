@extends('adminlte::page')

@section('title', 'Ventas')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1>Lista de Ventas</h1>
    <a href="{{ route('sales.create') }}" class="btn btn-success">
        <i class="fas fa-plus"></i> Nueva Venta
    </a>
</div>
@stop

@section('content')
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if($categories->isEmpty())
<div class="alert alert-warning">
    <p>No se encontraron coincidencias.</p>
</div>
@else
<div class="card">
    <div class="card-header">
        <div class="card-tools">
            <form action="{{ route('sales.index') }}" method="get" class="input-group input-group-sm">
                <input type="text" name="search" class="form-control" placeholder="Buscar">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                </div>
            </form>
        </div>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Referencia</th>
                    <th>Cliente</th>
                    <th>Total</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sales as $sale)
                <tr>
                    <td>{{ $sale->reference_number }}</td>
                    <td>{{ $sale->client->nombre_completo }}</a></td>
                    <td>${{ number_format($sale->total_amount, 2, '.', ',') }}</td>

                    <td>{{ $sale->created_at->format('d/m/Y') }}</td>
                    <td
                        class="text-center font-weight-bold {{ $sale->status == 'Pagado' ? 'bg-success text-white' : ($sale->status == 'Deuda' ? 'bg-danger text-white' : '') }}">
                        {{ $sale->status }}
                    </td>
                    
                   <td>
                       
                   <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                    data-target="#confirmDelete{{ $sale->id }}">
                                    <i class="fas fa-trash-alt"></i>
                </button>


                        <!-- Botón para activar el modal de confirmación -->
                        <a href="{{ route('sales.show', ['sale' => $sale->id]) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i>
                        </a>


                        <!-- Modal de confirmación para eliminar -->
                        <div class="modal fade" id="confirmDelete{{ $sale->id }}" tabindex="-1" role="dialog"
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
                                        ¿Estás seguro de eliminar la venta con referencia "{{ $sale->reference_number }}"?
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('sales.destroy', ['sale' => $sale->id]) }}"
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
</div>
<div class="pagination justify-content-end">
    {{ $sales->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
</div>
@endif
@stop

@section('css')
@stop

@section('js')
@stop