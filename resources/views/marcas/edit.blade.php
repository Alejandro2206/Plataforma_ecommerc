@extends('adminlte::page')

@section('title', 'Modificar Marca')

@section('content_header')
    <h1>Modificar Marca</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <!-- Formulario para editar marca -->
            <form action="{{ route('marcas.update', ['marca' => $marca->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

                <!-- Campos del formulario -->
                <div class="form-group">
                    <label for="nombre_marca">Nombre de la Marca</label>
                    <input type="text" name="nombre_marca" id="nombre_marca" class="form-control"
                           value="{{ $marca->nombre_marca }}" required>
                    @error('nombre_marca')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="imagen">Imagen</label>
                    <input type="file" name="imagen" id="imagen" class="form-control">
                    <img src="{{ asset('assets/imgs/marcas') }}/{{ $marca->image }}" width="80" />
                    @error('imagen')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="status">Estado</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="0" {{ $marca->status == 0 ? 'selected' : '' }}>Inactiva</option>
                        <option value="1" {{ $marca->status == 1 ? 'selected' : '' }}>Activa</option>
                    </select>
                    @error('status')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Botones -->
                <div class="d-flex justify-content-end mt-3">
                    <button type="submit" class="btn btn-primary">Modificar</button>
                    <a href="{{ route('marcas.index') }}" class="btn btn-danger ml-2">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
