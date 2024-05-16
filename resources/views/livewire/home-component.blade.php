<div>
    <main class="main">
        <style>
            .custom-slider-content {
            font-family: 'Montserrat', sans-serif; /* Aplicar la fuente personalizada */
        }
            .custom-slider-content {
                margin-bottom: 10px;
                font-family: 'Montserrat', sans-serif;
            }

            @media (min-width: 768px) and (max-width: 991px) {

                /* Estilos para iPads y dispositivos similares */
                .custom-slider-content {
                    margin-top: -30px;
                    /* Ajusta este valor según sea necesario */
                }

                .custom-slider-img {
                    margin-top: -30px;
                    /* Ajusta este valor según sea necesario */
                    max-width: 100%;
                    /* Ajusta el ancho máximo de la imagen en iPads */
                }
            }

            @media (min-width: 992px) {

                /* Estilos para pantallas más grandes, como laptops y escritorios */
                .custom-slider-content {
                    margin-top: -50px;
                    /* Ajusta este valor según sea necesario */
                }

                .custom-slider-img {
                    margin-top: -50px;
                    /* Ajusta este valor según sea necesario */
                }
            }

            @media (max-width: 767px) {

                /* Estilos para pantallas más pequeñas, como dispositivos móviles */
                .custom-slider-content {
                    margin-top: -20px;
                    /* Ajusta este valor según sea necesario */
                }
            }
        </style>

        <section class="home-slider position-relative mt-5">
            <div class="hero-slider-1 dot-style-1 dot-style-1-position-1">
                @foreach ($slides as $slide)
                <div class="single-hero-slider single-animation-wrap">
                    <div class="container">
                        <div class="row align-items-center slider-animated-1">
                            <div class="col-lg-5 col-md-6">
                                <div class="hero-slider-content-2 custom-slider-content">
                                    <h2 class="animated custom-slider-text custom-slider-description">
                                        {{$slide->top_title}}</h2>
                                    <h4 class="animated fw-900 custom-slider-text custom-slider-title">{{$slide->title}}
                                    </h4>
                                    <h3 class="animated fw-900 text-brand custom-slider-text custom-slider-subtitle">
                                        {{$slide->sub_title}}</h3>
                                    <p class="animated custom-slider-text custom-slider-description">{{$slide->offer}}
                                    </p>
                                    <a class="animated btn btn-brush btn-brush-3" style="color: rgb(0, 0, 0);"
                                        href="{{$slide->link}}">Compra
                                        ahora</a>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-6">
                                <div class="single-slider-img single-slider-img-1 custom-slider-img">
                                    <img class="animated slider-1-1"
                                        src="{{asset('assets/imgs/slider')}}/{{$slide->image}}" alt="{{$slide->title}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="slider-arrow hero-slider-1-arrow"></div>
        </section>
        <section class="product-tabs section-padding position-relative wow fadeIn animated">
            <div class="bg-square"></div>
            <div class="container">
                <div class="tab-header">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="nav-tab-one" data-bs-toggle="tab"
                                data-bs-target="#tab-one" type="button" role="tab" aria-controls="tab-one"
                                aria-selected="true" style="color: rgb(0, 0, 0);">Destacado</button>
                        </li>

                    </ul>
                    <a href="{{route('shop')}}" class="view-more d-none d-md-flex">Ver más<i
                            class="fi-rs-angle-double-small-right"></i></a>
                </div>
                <!--End nav-tabs-->
                <div class="tab-content wow fadeIn animated" id="myTabContent">
                    <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                        <div class="row product-grid-4">
                            @foreach ($fproducts as $fproduct)
                            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 col-6">
                                <div class="product-cart-wrap mb-30">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="{{route('product.details',['slug'=>$fproduct->slug])}}">
                                                <img class="default-img"
                                                    src="{{ asset('assets/imgs/products')}}/{{$fproduct->image}}"
                                                    alt="">
                                            </a>
                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            <span class="hot">Destacado</span>
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="pro-details-brand">
                                            <span><a>
                                                    <h5 style="color: rgb(0, 0, 0); font-size: 11px;">{{
                                                        $fproduct->category->name }}</h5>
                                                </a></span>
                                        </div>

                                        <h2><a href="{{ route('product.details', ['slug' => $fproduct->slug]) }}">{{
                                                $fproduct->name }}</a></h2>

                                        <div class="product-price">
                                            <span>${{ $fproduct->regular_price }}</span>
                                        </div>

                                        @if($isProductSoldOut($fproduct))
                                        <center><p style="color: red; font-weight: bold;">Agotado</p></center>
                                        @else
                                        <div class="product-action-1 show">
                                            <a aria-label="Añadir a carrito" class="action-btn hover-up" href="#"
                                                wire:click.prevent="store({{ $fproduct->id }}, '{{ $fproduct->name }}', {{ $fproduct->regular_price }})">
                                                <i class="fi-rs-shopping-bag-add"></i>
                                            </a>
                                        </div>
                                        @endif
                                    </div>

                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-padding">
            <div class="container wow fadeIn animated">
                <h3 class="section-title mb-20"><span style="color: rgb(0, 0, 0);">Los recién llegados</span></h3>
                <div class="carausel-6-columns-cover position-relative">
                    <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-2-arrows">
                    </div>
                    <div class="carausel-6-columns carausel-arrow-center" id="carausel-6-columns-2">
                        @foreach ($lproducts as $lproduct)
                        <div class="product-cart-wrap small hover-up">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="{{route('product.details',['slug'=>$lproduct->slug])}}">
                                        <img class="default-img"
                                            src="{{ asset('assets/imgs/products')}}/{{$lproduct->image}}" alt="">
                                    </a>
                                </div>
                                <div class="product-badges product-badges-position product-badges-mrg">
                                    <span class="new">Nuevos</span>
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <h2><a
                                        href="{{route('product.details',['slug'=>$lproduct->slug])}}">{{$lproduct->name}}</a>
                                </h2>
                                <div class="product-price">
                                    <span style="color: rgb(0, 0, 0);">${{$lproduct->regular_price}}</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <section class="section-padding">
            <div class="container">
                <h3 class="section-title mb-20 wow fadeIn animated"><span style="color: rgb(0, 0, 0);">Marcas</span>
                </h3>
                <div class="carausel-6-columns-cover position-relative wow fadeIn animated">
                    <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-3-arrows">
                    </div>
                    <div class="carausel-6-columns text-center" id="carausel-6-columns-3">
                        @foreach ($marca as $marcas)
                        <div class="brand-logo">
                            <img src="{{ asset('assets/imgs/marcas/' . $marcas->image) }}"
                                alt="{{ $marcas->nombre_marca }}">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>