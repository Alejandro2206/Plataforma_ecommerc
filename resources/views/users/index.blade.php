@extends('adminlte::page')

@section('title', 'Empleados')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Lista de Empleados</h1>
      
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
                <form action="{{ route('users.index') }}" method="get" class="input-group input-group-sm">
                    <input type="text" name="search" class="form-control" placeholder="Buscar por nombre ">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.card-header -->

        <div class="card-body table-responsive">
            @if($users->count() > 0)
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>No°</th>
                            <th>Nombre</th>
                            <th>Fecha de Creación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = ($users->currentPage() - 1) * $users->perPage(); @endphp
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ str_pad(++$i, 2, '0', STR_PAD_LEFT) }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->created_at->format('d-m-Y') }}</td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirmDelete{{ $user->id }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-left mt-3 alert alert-warning">No hay coincidencias.</p>
            @endif
        </div>
        <!-- /.card-body -->

        <div class="pagination justify-content-end">
            {{ $users->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
        </div>
    </div>

    <!-- Modal de confirmación para eliminar -->
    @foreach ($users as $user)
        <div class="modal fade" id="confirmDelete{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Confirmar eliminación</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ¿Estás seguro de eliminar el usuario "{{ $user->name }}"?
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('users.destroy', ['user' => $user->id]) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- Fin del modal -->
@stop

@section('css')
@stop

@section('js')
    <!-- Agrega scripts adicionales si es necesario -->
@stop
