<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow" style="color: rgb(255, 255, 255);">Inicio</a>
                    <span style="color: rgb(255, 255, 255);"> Moda</span>
                    <span style="color: rgb(255, 255, 255);">{{$product->name}}</span>
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="product-detail accordion-detail">
                            <div class="row mb-50">
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="detail-gallery">
                                        <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                        <!-- MAIN SLIDES -->
                                        <div class="product-image-slider">
                                            <figure class="border-radius-10">
                                                <img src="{{ asset('assets/imgs/products')}}/{{$product->image}}"
                                                    alt="product image">
                                            </figure>
                                        </div>
                                        <!-- THUMBNAILS -->

                                    </div>
                                    <!-- End Gallery -->
                                    <div class="social-icons single-share">
                                        <ul class="text-grey-5 d-inline-block">
                                            <li><strong class="mr-10" style="color: black;">Siguenos en:</strong></li>
                                                 <li class="social-facebook">
                                                <a href="https://www.facebook.com/profile.php?id=100057587853930" target="_blank">
                                                    <img src="{{ asset('assets/imgs/theme/icons/logofacebook.ico') }}" alt="">
                                                </a>
                                            </li>
                                            <li class="social-tiktok">
                                                <a href="https://www.tiktok.com/@lizesquiveloficial?_t=8krleFY7KTe&_r=1" target="_blank">
                                                    <img src="{{ asset('assets/imgs/theme/icons/logotiktok.ico') }}" alt="">
                                                </a>
                                            </li>
                                            <li class="social-whatsApp">
                                                <a href="https://wa.link/zmzf3n" target="_blank">
                                                    <img src="{{ asset('assets/imgs/theme/icons/logowhatsapp.ico') }}" alt="">
                                                </a>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="detail-info">
                                        <h2 class="title-detail">{{ $product->name }}</h2>
                                        @if($isProductSoldOut($product))
                                        <p style="color: red; font-weight: bold;">Agotado</p>
                                        @endif
                                        <div class="product-detail-rating">
                                            <div class="pro-details-brand">
                                                <span style="color: black;">Categoria: {{ $product->category->name
                                                    }}</span><br>
                                                <span style="color: black;">Código: {{ $product->SKU }}</span>
                                            </div>
                                        </div>
                                        <div class="clearfix product-price-cover">
                                            <div class="product-price primary-color float-left">
                                                <ins><span class="text-brand">${{ $product->regular_price
                                                        }}</span></ins>
                                            </div>
                                        </div>
                                        <div class="bt-1 border-color-1 mt-15 mb-15"></div>
                                        <div class="short-desc mb-30">
                                            <p style="color: black;">{{ $product->short_description }}</p>
                                        </div>
                                        <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                                        <div class="detail-extralink">
                                            <div class="product-extra-link2">
                                                @if($isProductSoldOut($product))
                                                <button type="button" class="button button-add-to-cart"
                                                    style="background-color: grey;" disabled>No disponible</button>
                                                @else
                                                <button type="button" class="button button-add-to-cart"
                                                    wire:click.prevent="store({{ $product->id }},'{{ $product->name }}','{{ $product->regular_price }}')">Añadir
                                                    a carrito</button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Detail Info -->
                                </div>

                            </div>
                            <div class="tab-style3">
                                <ul class="nav nav-tabs text-uppercase">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="Description-tab" data-bs-toggle="tab"
                                            href="#Description">Descripción</a>
                                    </li>
                                </ul>
                                <div class="tab-content shop_info_tab entry-main-content">
                                    <div class="tab-pane fade show active" id="Description">
                                        <div style="color: black;">
                                            {{$product->description}}
                                        </div>

                                    </div>

                                </div>
                            </div>
                            <div class="row mt-60">
                                <div class="col-12">
                                    <h3 class="section-title style-1 mb-30" style="color: black;">Productos relacionados
                                    </h3>
                                </div>
                                <div class="col-12">
                                    <div class="row related-products">
                                        @foreach ($rproducts as $rproduct)

                                        <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                                            <div class="product-cart-wrap small hover-up">
                                                <div class="product-img-action-wrap">
                                                    <div class="product-img product-img-zoom">
                                                        <a href="{{route('product.details', ['slug' => $rproduct->slug])}}"
                                                            tabindex="0">
                                                            <img class="default-img"
                                                                src="{{ asset('assets/imgs/products')}}/{{$rproduct->image}}"
                                                                alt="{{$rproduct->name}}">
                                                            <img class="hover-img"
                                                                src="{{ asset('assets/imgs/shop/product-2-2.jpg') }}"
                                                                alt="">
                                                        </a>
                                                    </div>
                                                    <div class="product-action-1">

                                                        {{-- <a aria-label="Add To Wishlist"
                                                            class="action-btn small hover-up" href="wishlist.php"
                                                            tabindex="0"><i class="fi-rs-heart"></i></a> --}}

                                                    </div>
                                                    <div
                                                        class="product-badges product-badges-position product-badges-mrg">
                                                        <span class="hot">Related</span>
                                                    </div>
                                                </div>
                                                <div class="product-content-wrap">
                                                    <h2><a href="{{route('product.details', ['slug' => $rproduct->slug])}}"
                                                            tabindex="0">{{$rproduct->name}}</a></h2>
                                                    <span><a>
                                                            <h5 style="color: rgb(0, 0, 0); font-size: 11px;">
                                                                {{$rproduct->category->name }}</h5>
                                                        </a></span>
                                                    <div class="product-price">
                                                        <span>${{$rproduct->regular_price}}</span>
                                                        {{-- <span class="old-price">$245.8</span> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 primary-sidebar sticky-sidebar">
                        <div class="widget-category mb-30">
                            <h5 class="section-title style-1 mb-30 wow fadeIn animated" style="color: black;">Categorias
                            </h5>
                            <ul class="categories">
                                @foreach ($categories as $category)
                                <li><a
                                        href="{{route('product.category', ['slug' => $category->slug])}}">{{$category->name}}</a>
                                </li>

                                @endforeach
                            </ul>
                        </div>

                        <!-- Product sidebar Widget -->
                        <div class="sidebar-widget product-sidebar  mb-30 p-30 bg-grey border-radius-10">
                            <div class="widget-header position-relative mb-20 pb-10">
                                <h5 class="widget-title mb-10" style="color: black;">Nuevos Productos</h5>
                                <div class="bt-1 border-color-1"></div>
                            </div>
                            @foreach ($nproducts as $nproduct)
                            <div class="single-post clearfix">
                                <div class="image">
                                    <img src="{{ asset('assets/imgs/products')}}/{{$nproduct->image}}"
                                        alt="{{$nproduct->name}}">
                                </div>

                                <div class="content pt-10">
                                    <h5><a
                                            href="{{route('product.details', ['slug' => $nproduct->slug])}}">{{$nproduct->name}}</a>
                                    </h5>
                                    <p class="price mb-0 mt-5" style="color: rgb(0, 0, 0)">${{$nproduct->regular_price}}
                                    </p>

                                </div>
                                <span><a>
                                        <h5 style="color: rgb(0, 0, 0); font-size: 11px;">{{
        $nproduct->category->name }}</h5>
                                    </a></span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>