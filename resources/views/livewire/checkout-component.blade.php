<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow" style="color: rgb(255, 255, 255);">Inicio</a>
                    <span style="color: rgb(255, 255, 255);">Tu carrito</span>
                    <span style="color: rgb(255, 255, 255);">Tu compra</span>
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <!-- Instrucciones para realizar el pedido vía WhatsApp -->
                    <div class="col-md-6">
                        <div class="mb-25">
                        <h4>Instrucciones para realizar el pedido vía WhatsApp:</h4>
                        <p>1. Ingrese su nombre completo.</p>
                        <p>2. Haga clic en el botón "Realizar Pedido".</p>
                        <p>3. Se abrirá una ventana de WhatsApp. Haga clic en "Ir al chat".</p>
                        <p>4. Haga clic en <a style="font-weight: bold;">WhatsApp Web</a>.</p>
                        <p>5. Se abrirá WhatsApp en el navegador con el chat de la empresa.</p>
                        <p>6. Envíe su pedido.</p>
                        <p>7. Espera nuestra respuesta para confirmar tu pedido.</p>
                        <p>8. ¡Listo! Recibirás más detalles sobre el proceso de pago y entrega.</p><br>
                        <p>Nota: Para utilizar WhatsApp Web, asegúrese de tener WhatsApp Web abierto en su navegador haciendo clic en <a href="https://web.whatsapp.com/" target="_blank" style="font-weight: bold;">WhatsApp Web</a>.</p>


                        </div>
                    </div>
                    <!-- Tabla de productos -->
                    <div class="col-md-6">
                    <div class="col-md-12">
                        <div class="mb-25">
                            <h4>Datos del Comprador:</h4>
                            <form wire:submit.prevent="procesarCompra">
                                <div class="form-group">
                                    <input wire:model="name" type="text" required name="fname" placeholder="Nombre Completo">
                                </div>
                                <!-- Agregar más campos del formulario si es necesario -->
                            </form>
                        </div>
                    </div>
                        <div class="order_review">
                            <div class="mb-20">
                                <h4>Tu Orden</h4>
                            </div>
                            <div class="table-responsive order_table text-center">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Imagen</th>
                                            <th>Producto</th>
                                            <th>Cantidad</th>
                                            <th>Precio Unitario</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($cartItems)
                                        @foreach ($cartItems as $item)
                                        <tr>
                                            <!-- Mostrar la información del carrito -->
                                            <td class="image product-thumbnail"><img
                                                    src="{{ asset('assets/imgs/products')}}/{{$item->model->image}}"
                                                    alt=""></td>
                                            <td>{{$item->model->name}}</td>
                                            <td>{{$item->qty}}</td>
                                            <td>${{$item->price}}</td>
                                            <td>${{$item->subtotal}}</td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="4" class="text-right"><strong>Total:</strong></td>
                                            <td>${{ Cart::subtotal() }}</td>
                                        </tr>
                                        @else
                                        <tr>
                                            <td colspan="5">No hay productos en el carrito.</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <!-- Emitiendo evento JavaScript para abrir la URL en una nueva pestaña -->
                            <a href="#" wire:click.prevent="sendOrderByWhatsApp" class="btn whatsapp-btn" target="_blank">
                                <i class="fi-rs-box-alt mr-10"></i>Realizar Pedido vía WhatsApp
                            </a>
                        </div>
                    </div>
                   
                </div>
            </div>
        </section>
    </main>
</div>

@section('scripts')
    @parent
    <script>
        document.addEventListener('livewire:load', function () {
            Livewire.on('openWhatsApp', (parameters) => {
                var whatsAppLink = parameters.whatsAppLink;

                // Abre el enlace de WhatsApp en una nueva ventana
                window.open(whatsAppLink, '_blank');

                // Muestra un mensaje de éxito al usuario (puedes personalizar esto)
                alert('Tu pedido ha sido enviado con éxito!');
            });
        });
    </script>
@endsection
