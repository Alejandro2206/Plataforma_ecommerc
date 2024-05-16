@extends('adminlte::page')

@section('title', 'Detalles')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1>Detalles de Gasto: {{ $gasto->concepto }}</h1>
    <!-- Botón para regresar a la vista index -->
    <a href="{{ route('gastos.index') }}" class="btn btn-primary">
        <i class="fas fa-arrow-left"></i> Regresar a la Lista de Gastos
    </a>
</div>
@stop

@section('content')
<div class="row">
    <!-- Sección de Detalles del Gasto -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-purple text-white">
                <h3 class="card-title">Detalles</h3>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-6">Categoría:</dt>
                    <dd class="col-sm-6">{{ $gasto->categoria }}</dd>

                    <dt class="col-sm-6">Pago:</dt>
                    
                    <dd class="col-sm-6">${{ number_format($gasto->valor, 2, '.', ',') }}</dd>


                    <dt class="col-sm-6">Concepto:</dt>
                    <dd class="col-sm-6">{{ $gasto->concepto }}</dd>

                    <dt class="col-sm-6">Método de Pago:</dt>
                    <dd class="col-sm-6">{{ $gasto->metodo_pago }}</dd>

                    <dt class="col-sm-6">Proveedor:</dt>
                    <dd class="col-sm-6">{{ $gasto->proveedor->company ?? 'N/A' }}</dd>

                    <dt class="col-sm-6">Fecha del Gasto:</dt>
                    <dd class="col-sm-6">{{ $gasto->fecha_gasto }}</dd>

                    <dt class="col-sm-6">Estado:</dt>
                    <dd class="col-sm-6">{{ $gasto->estado }}</dd>
                </dl>
            </div>
        </div>
    </div>

    <!-- Sección de Abonos -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-green text-white">
                <h3 class="card-title">Registro de Abonos</h3>
            </div>
            <div class="card-body">
                <!-- Mostrar abonos existentes -->
                <h3>Abonos registrados:</h3>
                <ul>
                    @forelse ($abonos as $abono)
                    @php
                    $montoFormateado = $abono->monto >= 1000 ? number_format($abono->monto, 2, ',', ',') :
                    $abono->monto;
                    @endphp
                    <li>Monto: ${{ $montoFormateado }}, Fecha: {{ $abono->created_at->format('d-m-Y') }}</li>
                    @empty
                    <li>No hay abonos registrados.</li>
                    @endforelse

                    @if ($gasto->estado === 'Pagado')
                    <br>
                    <center>
                        <h2>¡Gracias por su pago oportuno!</h2>
                    </center>
                    @endif
                </ul>

                @if ($gasto->estado !== 'Pagado')
                <h2>Registrar Nuevo Abono</h2>
                <!-- Formulario para registrar nuevo abono -->
                <form action="{{ route('gastos.abonar', ['gasto' => $gasto->id]) }}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group">
                        <label for="monto">Monto del Abono</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" name="monto" step="0.01" min="0.01" max="{{ $gasto->valor }}" required>
                        </div>
                    </div>

                    @php
                    $valorRestante = $gasto->valor - $abonos->sum('monto');
                    $valorRestanteFormateado = $valorRestante >= 1000 ? number_format($valorRestante, 2, ',', ',') :
                    $valorRestante;
                    @endphp
                    <p>Valor restante: ${{ $valorRestanteFormateado }}</p>
                    <button type="submit" class="btn btn-success">Registrar Abono</button>
                </form>
                @endif

            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<style>
    /* Agrega estilos personalizados aquí si es necesario */
</style>
@stop

@section('js')
<!-- Agrega scripts adicionales si es necesario -->
@stop