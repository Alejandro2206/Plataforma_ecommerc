@extends('adminlte::page')

@section('title', 'Detalles')

@section('content_header')
    <center><h1>Detalles de Venta</h1></center><br>

   

    <a href="{{ route('sales.index') }}" class="btn btn-primary">
        <i class="fas fa-arrow-left"></i> Regresar a la Lista de Ventas
    </a>

    <button id="generarComprobante" class="btn btn-warning">
        <i class="fas fa-file-image"></i> Generar Comprobante
    </button>

   

    </a>
@stop

@section('content')


 
<div class="contanier w-100 border border-3  rounded p-4 mt-3">
<div class="container w-100 border border-3 rounded p-4 mt-3 bg-white">


<!---Numero de comprobante--->

<center><h2><strong>Liz Company</strong></h2></center><br>
<div class="row mb-2">
    <div class="col-sm-4">
           
            <div class="input-group mb-3">
            <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                <input disabled type="text" class="form-control" value="Número de Comprobante: ">
            </div>
        </div>
        <div class="col-sm-8">
            <input disabled type="text" class="form-control" value="{{ $sale->reference_number }}">
        </div>
    </div>


<!---Cliente--->
    <div class="row mb-2">
        <div class="col-sm-4">
            <div class="input-group mb-3">
            <span class="input-group-text"><i class="fas fa-user"></i></span>
                <input disabled type="text" class="form-control" value=" Nombre del Cliente: ">
            </div>
        </div>
        <div class="col-sm-8">
            <input disabled type="text" class="form-control" value="{{ $sale->client->nombre_completo }}">
        </div>
    </div>

    <!---Numero del Cliente--->
    <div class="row mb-2">
        <div class="col-sm-4">
            <div class="input-group mb-3">
            <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                <input disabled type="text" class="form-control" value=" Número del Cliente: ">
            </div>
        </div>
        <div class="col-sm-8">
            <input disabled type="text" class="form-control" value="{{ $sale->client->numero }}">
        </div>
    </div>

     <!---Fecha de venta--->
     <div class="row mb-2">
        <div class="col-sm-4">
            <div class="input-group mb-3">
            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                <input disabled type="text" class="form-control" value=" Fecha de Venta: ">
            </div>
        </div>
        <div class="col-sm-8">
            <input disabled type="text" class="form-control" value="{{ optional($sale->created_at)->format('d-m-Y') }}">
        </div>
    </div>

    <!---Status--->
    <div class="row mb-2">
        <div class="col-sm-4">
            <div class="input-group mb-3">
            <span class="input-group-text"><i class="fas fa-coins"></i></span>
                <input disabled type="text" class="form-control" value=" Estado de la venta: ">
            </div>
        </div>
        <div class="col-sm-8">
            <input disabled type="text" class="form-control" value="{{ $sale->status }}">
        </div>
    </div>

     <!---Tabla--->
     <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Tabla de detalle de la venta
        </div>
        <div class="card-body table-responsive">
            <table class="table table-striped">
                <thead class="bg-success text-white">
                    <tr>
                        <th>Código</th>
                        <th>Producto</th>
                        <th>Descuento</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($products as $saleProduct)
                            <tr>
                                <td>{{ $saleProduct->product->SKU }}</td>
                                <td>{{ $saleProduct->product->name }}</td>
                                <td>{{ $saleProduct->discount }}%</td>
                                <td>{{ $saleProduct->quantity }}</td>
                                <td>${{ $saleProduct->price }}</td>
                                <td>${{ $saleProduct->total_product }}</td>
                            </tr>
                @endforeach
                </tbody>
                <tr>
                     <th></th>
                     <th colspan="4">Total:</th>
                     <th colspan="2"> <input type="hidden" name="total" value="0" id="inputTotal"> <span id="total">${{ $sale->total_amount }}</span></th>
                    </tr>
            </table>
            
        </div>
        <div class="card mb-4">
        <div class="card-header">
            <div class="card-header bg-purple text-white">
                <h3 class="card-title">Registro de Abonos</h3>
            </div>
            <div class="card-body">
                <!-- Mostrar abonos existentes -->
                
                <h3>Abonos registrados:</h3>
                <ul>
                    @forelse ($abonos as $abono)
                    @php
    $montoFormateado = $abono->amount >= 1000 ? number_format($abono->amount, 2, ',', ',') :
        $abono->amount;
                    @endphp
                    <li>Monto: ${{ $montoFormateado }}, Fecha: {{ $abono->created_at->format('d-m-Y') }}</li>
                    @empty
                    <li>No hay abonos registrados.</li>
                    @endforelse

                    @if ($sale->status === 'Pagado')
                    <br>
                    <center>
                        <h2>¡Gracias por su pago oportuno!</h2>
                    </center>
                    @endif
                </ul>

                @if ($sale->status !== 'Pagado')
                <h2>Registrar Nuevo Abono</h2>
                <!-- Formulario para registrar nuevo abono -->
                <form action="{{ route('sales.abonar', ['sale' => $sale->id]) }}" method="POST">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group">
                        <label for="amount">Monto del Abono</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="number" name="amount" step="0.01" min="0.01" max="{{ $sale->total_amount }}" required>
                        </div>
                    </div>

                    @php
    $valorRestante = $sale->total_amount - $abonos->sum('amount');
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

        <!-- Sección de Abonos para ventas -->
        
    
     </div>

    



</div>

<div id="reference_number" style="display: none;">{{ $sale->reference_number }}</div>




@stop

@section('css')






@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('generarComprobante').addEventListener('click', function() {
            // Obtener el número de referencia
            var referencia = document.getElementById('reference_number').innerText;

            // Crear un div temporal con fondo blanco para superponer sobre la vista
            var backgroundDiv = document.createElement('div');
            backgroundDiv.style.backgroundColor = 'white';
            backgroundDiv.style.position = 'fixed';
            backgroundDiv.style.width = '100%';
            backgroundDiv.style.height = '100%';
            backgroundDiv.style.zIndex = '9999';
            document.body.appendChild(backgroundDiv);

            // Capturar el contenido de la vista
            html2canvas(document.querySelector('.container'), {
                onrendered: function(canvas) {
                    // Eliminar el div temporal con fondo blanco
                    document.body.removeChild(backgroundDiv);

                    // Crear un enlace de descarga para la imagen generada
                    var link = document.createElement('a');
                    link.download = 'VENTA_' + referencia + '.png'; // Nombre del archivo con el número de referencia
                    link.href = canvas.toDataURL();
                    link.click();
                }
            });
        });
    });
</script>


@stop