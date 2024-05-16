<div>
    <style>
        nav svg {
            height: 40px;
        }

        nav .hidden {
            display: block;
        }

        .wishlisted {
            background-color: #F2B705 !important;
            border: 1px solid transparent !important;
        }

        .wishlisted i {
            color: #fff !important;
        }

        .product-cart-wrap .product-action-1 button::after,
        .product-cart-wrap .product-action-1 a.action-btn::after {
            left: -50%;
        }
    </style>

    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow" style="color: rgb(255, 255, 255);">Inicio</a>
                    <span style="color: rgb(255, 255, 255);">Lista de deseos</span>
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                @if(Cart::instance('wishlist')->count() > 0)
                <div class="row product-grid-4">
                    @foreach (Cart::instance('wishlist')->content() as $item)
                    <div class="col-lg-3 col-md-3 col-6 col-sm-6">
                        <div class="product-cart-wrap mb-30">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="{{route('product.details',['slug'=>$item->model->slug])}}">
                                        <img class="default-img"
                                            src="{{ asset('assets/imgs/products')}}/{{$item->model->image}}"
                                            alt="{{$item->model->name}}">
                                    </a>
                                </div>
                                <div class="product-badges product-badges-position product-badges-mrg">
                                    <span class="hot">Me gusta</span>
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <span style="color: rgb(0, 0, 0);">{{$item->model->SKU}} </span>
                                </div>
                                <h2><a
                                        href="{{route('product.details',['slug'=>$item->model->slug])}}">{{$item->model->name}}</a>
                                </h2>

                                <div class="product-price">
                                    <span>${{$item->model->regular_price}} </span>
                                </div>
                                <div class="product-action-1 show">
                                    <a aria-label="Eliminar de la lista de deseos"
                                        class="action-btn hover-up wishlisted" href="#"
                                        wire:click.prevent="removeFromWishlist({{$item->model->id}})"><i
                                            class="fi-rs-heart"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <p style="color: black; font-weight: bold;">Ningún artículo en tu lista de deseos</p>
                @endif
            </div>
        </section>
</div>
