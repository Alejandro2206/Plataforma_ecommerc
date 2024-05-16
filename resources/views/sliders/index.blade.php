@extends('adminlte::page')

@section('title', 'Sliders')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1>Lista de Sliders</h1>
    <a href="{{ route('sliders.create') }}" class="btn btn-success">
        <i class="fas fa-plus"></i> Nuevo Slider
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
            <form action="{{ route('sliders.index') }}" method="get" class="input-group input-group-sm">
                <input type="text" name="search" class="form-control" placeholder="Buscar por título principal">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                </div>
            </form>
        </div>
    </div>
    <!-- /.card-header -->

    <div class="card-body table-responsive">
        @if($sliders->isEmpty())
            <div class="alert alert-warning">
                <p>No se encontraron coincidencias.</p>
            </div>
        @else
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>No°</th>
                        <th>Imagen</th>
                        <th>Título principal</th>
                        <th>Título</th>
                        <th>Estatus</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $count = ($sliders->currentPage() - 1) * $sliders->perPage() + 1;
                    @endphp
                    @foreach ($sliders as $slider)
                    <tr>
                        <td>{{ $count++ }}</td>
                        <td><img src="{{ asset('assets/imgs/slider/' . $slider->image) }}" width="80" /></td>

                        <td><a href="{{ route('sliders.show', ['slider' => $slider->id]) }}">
                            {{ $slider->top_title }}
                        </a></td>
                        
                        <td>{{ $slider->title }}</td>
                        <td>{{ $slider->status == 1 ? 'Activo' : 'Inactivo' }}</td>
                        <td>
                            <a href="{{ route('sliders.edit', ['slider' => $slider->id]) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>

                            <!-- Botón para activar el modal de confirmación -->
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                data-target="#confirmDelete{{ $slider->id }}">
                                <i class="fas fa-trash-alt"></i>
                            </button>

                            <!-- Modal de confirmación para eliminar -->
                            <div class="modal fade" id="confirmDelete{{ $slider->id }}" tabindex="-1" role="dialog"
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
                                            ¿Estás seguro de eliminar el slider "{{ $slider->top_title }}"?
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('sliders.destroy', ['slider' => $slider->id]) }}"
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
    {{ $sliders->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
</div>
@stop

@section('css')
@stop

@section('js')
<!-- Agrega scripts adicionales si es necesario -->
@stop
