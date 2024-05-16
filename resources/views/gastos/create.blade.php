@extends('adminlte::page')

@section('title', 'Nuevo Gasto')

@section('content_header')
<h1>Nuevo Gasto</h1>
@stop

@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="card">
    <div class="card-body">
        <form action="{{ route('gastos.store') }}" method="post">
            @csrf

            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="categoria">Categoría</label>
                        <select class="form-control" id="categoria_select" name="categoria_select" required>
                            @php
                            $categorias = ['Seleccione una Categoría', 'Servicios públicos', 'Compra de productos e insumos', 'Arriendo',
                            'Nómina', 'Gastos administrativos', 'Mercadeo y publicidad', 'Transporte,domicilios y logística',
                            'Mantenimiento y reparaciones', 'Muebles,equipos o maquinaria', 'Otros'];
                            @endphp
                            @foreach ($categorias as $categoria)
                            <option value="{{ $categoria }}" {{ old('categoria_select')==$categoria ? 'selected' : '' }}>
                                {{ $categoria }}
                            </option>
                            @endforeach
                        </select>
                        @error('categoria_select')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    


                    <div class="mb-3">
                        <label for="valor" class="form-label">Valor</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">$</span>
                            <input type="number" class="form-control" id="valor" name="valor"
                                placeholder="Ingrese el valor" required>
                        </div>
                    </div>


                    <div class="mb-3">
                        <label for="concepto" class="form-label">Concepto</label>
                        <textarea class="form-control" id="concepto" name="concepto" placeholder="Ingrese el concepto"
                            required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="metodo_pago">Método de Pago</label>
                        <div class="input-group">
                            @php
                            $metodosPago = ['Seleccione un metodo de pago', 'Efectivo', 'Tarjeta de crédito', 'Transferencia bancaria', 'Otro'];
                            @endphp
                            <select class="form-control" id="metodo_pago_select" name="metodo_pago_select" required>
                                @foreach ($metodosPago as $metodo)
                                <option value="{{ $metodo }}" {{ old('metodo_pago_select') == $metodo ? 'selected' : '' }}>
                                    {{ $metodo }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        @error('metodo_pago_select')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    

                </div>




                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="supplier_id" class="form-label">Proveedor</label>
                        <select name="supplier_id" id="supplier_id" class="form-control" {{ old('categoria_select') === 'Servicios públicos' || old('categoria_select') === 'Arriendo' || old('categoria_select') === 'Nómina' ? 'disabled' : '' }}>
                            <option value="">Selecciona un proveedor</option>
                            @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->company }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="fecha_gasto" class="form-label">Fecha del Gasto</label>
                        <input type="date" class="form-control" id="fecha_gasto" name="fecha_gasto" required>
                    </div>

                    <div class="mb-3">
                        <label for="estado" class="form-label">Estado</label>
                        <select class="form-control" id="estado" name="estado" required>
                            <option value="">Seleccione un estatus</option>
                            <option value="Deuda">Deuda</option>
                            <option value="Pagado">Pagado</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-success">
                    Agregar
                </button>
                <a href="{{ route('gastos.index') }}" class="btn btn-danger ml-2">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>

<!-- Agrega scripts adicionales si es necesario -->
<script>
    // Deshabilitar proveedor si la categoría es 'Servicios públicos', 'Arriendo' o 'Nómina'
    document.addEventListener('DOMContentLoaded', function () {
        const categoriaSelect = document.getElementById('categoria_select');
        const proveedorSelect = document.getElementById('supplier_id');

        categoriaSelect.addEventListener('change', function () {
            const selectedCategoria = categoriaSelect.value;
            proveedorSelect.disabled = selectedCategoria === 'Servicios públicos' || selectedCategoria === 'Arriendo' || selectedCategoria === 'Nómina';
        });

        // Deshabilitar proveedor si la categoría seleccionada al cargar la página es 'Servicios públicos', 'Arriendo' o 'Nómina'
        proveedorSelect.disabled = categoriaSelect.value === 'Servicios públicos' || categoriaSelect.value === 'Arriendo' || categoriaSelect.value === 'Nómina';
    });
</script>

@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop
