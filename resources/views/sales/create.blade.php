@extends('adminlte::page')

@section('title', 'Nueva Venta')

@section('content_header')
@stop

@section('content')

<form action="{{ route('sales.store')}}" method="post">
    @csrf

    @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

    <div class="contanier mt-4">
        <div class="row gy-4">
            <div class="col-md-8">
                <div class="text-white bg-primary p-1 text-center">
                    Detalles de la venta
                </div>
                <div class="p-3 border border-3 border-primary">
    <div class="row">
        <!-- Producto -->
        <div class="col-md-12 mb-4">
            <select name="product_id" id="product_id" class="form-control selectpicker" data-live-search="true" title="Selecciona un producto" data-size='4'>
                @foreach ($products as $item)
                    <option value="{{$item->id}}--{{$item->quantity}}--{{$item->regular_price}}--{{$item->name}}">{{$item->SKU}}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-6 mb-4">
            <label for="sku" class="form-label">Producto:</label>
            <input readonly type="text" name="sku" id="sku" class="form-control border-sucess">
        </div>

        <div class="col-md-6 mb-4">
            <label for="stock" class="form-label">Stock Disponible:</label>
            <input readonly type="text" name="stock" id="stock" class="form-control border-sucess">
        </div>

        <!-- Precio de Venta -->
        <div class="col-md-4 mb-2">
            <label for="regular_price" class="form-label">Precio de venta:</label>
            <input type="number" name="regular_price" id="regular_price" class="form-control" step="0.1" disabled>
        </div>


        <!-- Descuento -->
        <div class="col-md-4 mb-2">
            <label for="discount" class="form-label">Descuento:</label>
            <input type="number" name="discount" id="discount" class="form-control">
        </div>

        <!-- Cantidad -->
        <div class="col-md-4 mb-2">
            <label for="quantity" class="form-label">Cantidad:</label>
            <input type="number" name="quantity" id="quantity" class="form-control">
        </div>

        <!-- Botón de agregar -->
        <div class="col-md-12 mb-4 mt-2 text-end">
            <button id="btn_agregar" class="btn btn-primary" type="button">Agregar</button>
        </div>



                        <!----Tabla para el detalle de la venta---->
                        <div class="col-md-12">
    <div class="table-responsive">
        <table id="tabla_detalle" class="table table-hover">
            <thead class="bg-primary text-white">
                <tr>
                    <th>Producto</th>
                    <th>#Código</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Descuento</th>
                    <th>Subtotal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th></th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th colspan="4">Total</th>
                    <th colspan="2">
                        <input type="hidden" name="total" value="0" id="inputTotal">
                        <span id="total">0</span>
                    </th>
                </tr>
                <tr>
                    <th colspan="7" class="text-end">
                        <div class="mb-3">
                            <label for="status" class="form-label">Estado</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="">Seleccione un estatus</option>
                                <option value="Deuda">Deuda</option>
                                <option value="Pagado">Pagado</option>
                            </select>
                        </div>
                    </th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

                        <td>

                        
      
                         <!----Boton para cancelar venta---->
                         <div class="col-md-12 mb">
                            <button id="cancelar" type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Cancelar venta
                            </button>
                         </div>

                    </div>
                </div>
            </div>
             <!----Venta---->
             <div class="col-md-4">
                <div class="text-white bg-success p-1 text-center">
                    Datos generales
                </div>
                <div class="p-3 border border-3 border-success">
                    <div class="row">
                        <!----Cliente---->
                        <div class="col-md-12 mb-2">
                            <label for="client_id" class="form-label">Cliente:</label>
                            <select name="client_id" id="client_id" class="form-control selectpicker show-tick" data-live-search="true" title="Selecciona un cliente" data-size='1'>
                                @foreach ($clients as $item)
                                <option value="{{$item->id}}">{{$item->nombre_completo}}</option>
                                @endforeach
                            </select>
                            @error('client_id')
                            <small class="text-danger">{{ '*' . $message }}</small>></small>
                            @enderror
                        </div>
                        <!----Numero de Comprobante---->
                        <div class="col-md-12 mb-2">
                            <label for="reference_number" class="form-label">Número de comprobante</label>
                            <input required type="text" name="reference_number" id="reference_number" class="form-control border-success" value="{{ $numeroComprobante }}" readonly>
                            @error('numero_comprobante')
                            <small class="text-danger">{{ '*' . $message }}</small>
                            @enderror
                        </div>
                         <!----Fecha---->
                         <div class="col-md-6 mb-4">
                            <label for="date" class="form-label">Fecha:</label>
                            <input readonly type="date" name="fecha" id="fecha" class="form-control border-sucess" value="<?php echo date("Y-m-d")?>">
                            <?php
use Carbon\Carbon;

$fecha_hora = Carbon::now()->toDateTimeString();
                            ?>
                            <input type="hidden" name="fecha_hora" value="{{$fecha_hora}}">
                         </div>
                          <!----Botones---->
                          <div class="col-md-12 mb-2 text-center">
                            <button type="submit" class="btn btn-success" id="guardar">Guardar</button>
                          </div>
                    </div>
                </div>
             </div>
        </div>
    </div>

     <!----Modal para cancelar venta---->
     <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title fs-5" id="exampleModalLabel">Advertencia</h4>
                </div>
                <div class="modal-body">
                    ¿Seguro que quieres cancelar la venta?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button id="btnCancelarVenta" type="button" class="btn btn-danger" data-bs-dismiss="modal">Confirmar</button>
                </div>
            </div>
        </div>
     </div>


</form>
@stop

@section('css')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/css/bootstrap-select.min.css">

@stop

@section('js')
<!-- Incluye jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Incluye Bootstrap JS desde node_modules -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>



<!-- Incluye Bootstrap Selectpicker desde CDN (si lo estás utilizando) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


<!-- FontAwesome CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.1/css/all.min.css" />



<script>

function round(num, decimales = 2) {
            var signo = (num >= 0 ? 1 : -1);
            num = num * signo;
            if (decimales === 0)
                return signo * Math.round(num);

            num = num.toString().split('e');
            num = Math.round(+(num[0] + 'e' + (num[1] ? (+num[1] + decimales) : decimales)));

            num = num.toString().split('e');
            return signo * (num[0] + 'e' + (num[1] ? (+num[1] - decimales) : -decimales));
        }

        function eliminarProducto(indice) {
    // Calcular valores
    sumas -= Subtotal[indice];
    total = round(sumas);
    
    // Mostrar los campos calculados
    $('#total').html(total);
    $('#inputTotal').val(total);
    
    // Eliminar la fila de la tabla
    $('#fila' + indice).remove();

    disableButtons();
}

function disableButtons() {
            if (total === 0) {
                $('#guardar').hide();
                $('#cancelar').hide();
            } else {
                 $('#guardar').show();
                 $('#cancelar').show();
            }
        }
    // Variables
    let cont = 0;
    let Subtotal = [];
    let sumas = 0;
    let total = 0;

    $(document).ready(function() {
        $('#product_id').change(mostrarValores);

        $('#btn_agregar').click(function(){
            agregarProducto();
        });

        $('#btnCancelarVenta').click(function(){
            cancelarVenta();
        });

        disableButtons(); 

        function mostrarValores() {
            let dataProducto = $('#product_id').val().split('-');
            $('#stock').val(dataProducto[2]);
            $('#regular_price').val(dataProducto[4]);
            $('#sku').val(dataProducto[6]);
        }

        function agregarProducto() {
            let dataProducto = $('#product_id').val().split('-');
            // Obtener Campos de Valores
            let idProducto = dataProducto[0];
            let nameProducto = $('#product_id option:selected').text();
            let codigo = $('#sku').val();
            let cantidad = $('#quantity').val();
            let precioVenta = $('#regular_price').val();
            let descuento = $('#discount').val();
            let stock = $('#stock').val();

            

            if (descuento === '') {
        descuento = 0;
    }

    // Validaciones
    // 1. Para que los campos no estén vacíos
    if (idProducto !== '' && cantidad !== '') {
        // 2. Para que los valores ingresados sean los correctos
        if (parseInt(cantidad) > 0 && (cantidad % 1 === 0) && parseFloat(descuento) >= 0) {
            // 3. Para que la cantidad no supere el stock
            if (parseInt(cantidad) <= parseInt(stock)) {
                let precioConDescuento = precioVenta - (precioVenta * parseFloat(descuento) / 100);
                Subtotal[cont] = round(cantidad * precioConDescuento);
                sumas += Subtotal[cont];
                total = round(sumas);

                        // Crear fila
                        let fila = '<tr id="fila' + cont + '">' + 
                            '<td><input type="hidden" name="arraycodigo[]" value="' + codigo + '">' + codigo + '</td>' +
                            '<td><input type="hidden" name="arrayidProducto[]" value="' + idProducto + '">' + nameProducto + '</td>' +
                            '<td><input type="hidden" name="arraycantidad[]" value="' + cantidad + '">' + cantidad + '</td>' +
                            '<td><input type="hidden" name="arrayprecioventa[]" value="' + precioVenta + '">' + precioVenta + '</td>' +
                            '<td><input type="hidden" name="arraydescuento[]" value="' + descuento + '">' + descuento + '</td>' +
                            '<td>' + Subtotal[cont] + '</td>' +
                            '<td><button class="btn btn-danger" type="button" onclick="eliminarProducto(' + cont +')"><i class="fa-solid fa-trash"></i></button></td>' +
                            '</tr>';

                        // Acciones después de añadir la fila
                        $('#tabla_detalle').append(fila);
                        limpiarCampos();
                        cont++;
                        disableButtons();


                       

                        // Mostrar los campos calculados
                        $('#sumas').html(sumas);
                        $('#total').html('$' + total);
                        $('#inputTotal').html(total);
                    } else {
                        showModal('Cantidad no disponible');
                    }
                } else {
                    showModal('Valores incorrectos');
                }
            } else {
                showModal('Le faltan campos por llenar');
            }



        } 

       /*  function eliminarProducto(indice) {
            //Calcular valores
            sumas -= round(Subtotal[indice]);

            //Mostrar los campos calculados
            $('#total').html(total);
            $('#inputTotal').val(total);

            //Eliminar la fila de la tabla
            $('#fila' + indice).remove();

            disableButtons();
        }
 */
        function cancelarVenta(){
            //Eliminar una nueva fila a la tabla
            $('#tabla_detalle tbody').empty();
        let fila = '<tr>' +
            '<th></th>' +
            '<th></th>' +
            '<th></th>' +
            '<th></th>' +
            '<th></th>' +
            '<th></th>' +
            '<th></th>' +
            '</tr>';
        $('#tabla_detalle').append(fila);

        //Reinciar valores de las variables
        cont = 0;
        subtotal = [];
        total = 0;

        //Mostrar los campos calculados
        $('#total').html(total);
        $('inputTotal').val(total);

        limpiarCampos();
        disableButtons();
        

        }

         

       

        function limpiarCampos(){
            let select = $('#product_id');
            select.selectpicker('val', '');
            $('#sku').val('');
            $('#stock').val('');
            $('#regular_price').val('');
            $('#discount').val(''); 
            $('#quantity').val('');
        }

        function showModal(message, icon = 'error') {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer);
                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                }
            });

            Toast.fire({
                icon: icon,
                title: message
            });
        }

    });

       
</script>


@stop