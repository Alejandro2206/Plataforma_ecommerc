<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow" style="color: rgb(255, 255, 255);">Inicio</a>
                    <span style="color: rgb(255, 255, 255);"> Compra</span>
                    <span style="color: rgb(255, 255, 255);">Tu carrito</span>
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            @if(Session::has('success_message'))
                            <div class="alert alert-success">
                                <strong>Success | {{Session::get('success_message')}}</strong>
                            </div>
                            @endif
                            @if(Cart::instance('cart')->count() > 0)
                            <table class="table shopping-summery text-center clean">
                                <thead>
                                    <tr class="main-heading">
                                        <th scope="col">IMAGEN</th>
                                        <th scope="col">CODIGO</th>
                                        <th scope="col">NOMBRE</th>
                                        <th scope="col">PRECIO</th>
                                        <th scope="col">CANTIDAD</th>
                                        <th scope="col">SUBTOTAL</th>
                                        <th scope="col">ELIMINAR</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach (Cart::instance('cart')->content() as $item)
                                    <tr>
                                        
                                        <td class="image product-thumbnail"><img
                                                src="{{ asset('assets/imgs/products')}}/{{$item->model->image}}"
                                                alt="#"></td>
                                                <td class="SKU" data-title="SKU"><span>{{$item->model->SKU}}
                                                </span></td>
                                        <td class="product-des product-name">
                                            <span>{{$item->model->name}}
                                            </span>
                                            {{-- <h5 class="product-name" ><a>{{$item->model->name}}</a></h5> --}}
                                        </td>
                                        <td class="price" data-title="Price"><span>${{$item->model->regular_price}}
                                            </span></td>
                                        <td class="text-center" data-title="Stock">
                                            <div class="detail-qty border radius  m-auto">
                                                <a href="#" class="qty-down"
                                                    wire:click.prevent="decreaseQuantity('{{$item->rowId}}')"><i
                                                        class="fi-rs-angle-small-down"></i></a>
                                                <span class="qty-val">{{$item->qty}}</span>
                                                <a href="#" class="qty-up"
                                                    wire:click.prevent="increaseQuantity('{{$item->rowId}}')"><i
                                                        class="fi-rs-angle-small-up"></i></a>
                                            </div>
                                        </td>
                                        <td class="text-right" data-title="Cart">
                                            <span>${{$item->subtotal}} </span>
                                        </td>
                                        <td class="action" data-title="Remove"><a href="#" class="text-muted"
                                                wire:click.prevent="destroy('{{$item->rowId}}')"><i
                                                    class="fi-rs-trash"></i></a></td>
                                    </tr>
                                    @endforeach
                                   <!--  <tr>
                                        <td colspan="6" class="text-end">
                                            <a href="#" class="text-muted" wire:submit="clearCart()"> <i class="fi-rs-cross-small"></i>Vaciar Carrito</a>
                                        </td>
                                    </tr> -->
                                </tbody>
                            </table>
                            @else
                            <p style="color: black;">Ningún artículo en el carrito</p>

                            @endif
                        </div>
                        <div class="cart-action text-start">
                            <style>
                                /* Estilo para la clase btn y el texto dentro de los botones */
                                .btn {
                                    color: black !important;
                                    /* Cambiar el color del texto a negro */
                                }
                            </style>

                            {{-- <a class="btn" href="{{route('shop.cart')}}"><i class="fi-rs-shuffle mr-10"></i>Actualizar carrito</a> --}}
                            <a class="btn" href="{{ route('shop') }}">
                                <i class="fi-rs-shopping-bag mr-10"></i>Seguir comprando
                            </a>
                        </div>
                        
                        <div class="divider center_icon mt-50 mb-50"><i class="fi-rs-fingerprint"></i></div>
                        <div class="row mb-50">
                            <div class="col-lg-6 col-md-12">
                                <div class="border p-md-4 p-30 border-radius cart-totals">
                                    <div class="heading_s1 mb-3" style="color: rgb(0, 0, 0) !important;">
                                        <h2>Total del Carrito</h2>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td class="cart_total_label" style="color: rgb(0, 0, 0) !important;" class="w-25"><strong>Total del carrito</strong></td>
                                                    <td class="cart_total_amount"><span
                                                            class="font-lg fw-900 text-brand">${{Cart::subtotal()}}</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    @if(Cart::instance('cart')->count() > 0)
                                    <a href="{{ route('shop.checkout') }}" class="btn whatsapp-btn">
                                        <i class="fi-rs-box-alt mr-10"></i>Procesar Compra
                                    </a>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>