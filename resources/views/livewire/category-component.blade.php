<div>
    <style>
        nav svg {
            height: 40px;
        }

        nav .hidden {
            display: block;
        }
    </style>

    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow" style="color: rgb(255, 255, 255);">Inicio</a>
                    <span style="color: rgb(255, 255, 255);">Compras</span>
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="shop-product-fillter">
                            <div class="totall-product">
                                <p style="color: black;"> Encontramos <strong
                                        class="text-brand">{{$products->total()}}</strong> productos para ti de
                                    <b>{{$category_name}}</b>!
                                </p>
                            </div>
                            <div class="sort-by-product-area">
                                <div class="sort-by-cover mr-10">
                                    <div class="sort-by-product-wrap">
                                        <div class="sort-by">
                                            <span><i class="fi-rs-apps"></i>Mostrar:</span>
                                        </div>
                                        <div class="sort-by-dropdown-wrap">
                                            <span> {{$pageSize}}<i class="fi-rs-angle-small-down"></i></span>
                                        </div>
                                    </div>
                                    <div class="sort-by-dropdown">
                                        <ul>
                                            <li><a class="{{ $pageSize==12 ? 'active': ''}}" href="#"
                                                    wire:click.prevent="changePageSize(12)">12</a></li>
                                            <li><a class="{{ $pageSize==15 ? 'active': ''}}" href="#"
                                                    wire:click.prevent="changePageSize(15)">15</a></li>
                                            <li><a class="{{ $pageSize==25 ? 'active': ''}}" href="#"
                                                    wire:click.prevent="changePageSize(25)">25</a></li>
                                            <li><a class="{{ $pageSize==32 ? 'active': ''}}" href="#"
                                                    wire:click.prevent="changePageSize(32)">32</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="sort-by-cover">
                                    <div class="sort-by-product-wrap">
                                        <div class="sort-by">
                                            <span><i class="fi-rs-apps-sort"></i>Ordenar por:</span>
                                        </div>
                                        <div class="sort-by-dropdown-wrap">
                                            <span> Clasificación por defecto <i
                                                    class="fi-rs-angle-small-down"></i></span>
                                        </div>
                                    </div>
                                    <div class="sort-by-dropdown">
                                        <ul>
                                            <li><a class="{{ $orderBy=='Clasificación por defecto' ? 'active': ''}}"
                                                    href="#"
                                                    wire:click.prevent="changeOrderBy('Clasificación por defecto')">Clasificación
                                                    por defecto</a></li>
                                            <li><a class="{{ $orderBy=='Precio: Bajo a Alto' ? 'active': ''}}" href="#"
                                                    wire:click.prevent="changeOrderBy('Precio: Bajo a Alto')">Precio:
                                                    Bajo a Alto</a></li>
                                            <li><a class="{{ $orderBy=='Precio: Alto a Bajo' ? 'active': ''}}" href="#"
                                                    wire:click.prevent="changeOrderBy('Precio: Alto a Bajo')">Precio:
                                                    Alto a Bajo</a></li>
                                            <li><a class="{{ $orderBy=='Ordenar por novedad' ? 'active': ''}}" href="#"
                                                    wire:click.prevent="changeOrderBy('Ordenar por novedad')">Ordenar
                                                    por novedad</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row product-grid-3">
                            @foreach ($products as $product)
                            <div class="col-lg-4 col-md-4 col-6 col-sm-6">
                                <div class="product-cart-wrap mb-30">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="{{route('product.details',['slug'=>$product->slug])}}">
                                                <img src="{{ asset('assets/imgs/products')}}/{{$product->image}}"
                                                    alt="{{$product->name}}">

                                        </div>
                                        <div class="product-action-1">
                                        </div>

                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <span><a>
                                                    <h5 style="color: rgb(0, 0, 0); font-size: 11px;">{{
                                                        $product->category->name }}</h5>
                                                </a></span>
                                        </div>
                                        <h2><a
                                                href="{{route('product.details',['slug'=>$product->slug])}}">{{$product->name}}</a>
                                                <h5 style="color: rgb(0, 0, 0); font-size: 11px;">{{ $product->SKU }}</h5>
                                        </h2>

                                        <div class="product-price">
                                            <span>${{$product->regular_price}} </span>
                                            {{-- <span class="old-price">$245.8</span> --}}
                                        </div>
                                        <div class="product-action-1 show">
                                                <a aria-label="Añadir a carrito" class="action-btn hover-up" href="#"
                                                    wire:click.prevent="store({{ $product->id }},'{{ $product->name }}','{{ $product->regular_price }}')"><i
                                                        class="fi-rs-shopping-bag-add"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <!--pagination-->
                        <div class="pagination-area mt-15 mb-sm-5 mb-lg-0">
                            {{$products->links()}}
                        </div>
                    </div>
                    <div class="col-lg-3 primary-sidebar sticky-sidebar">
                        <div class="row">
                            <div class="col-lg-12 col-mg-6"></div>
                            <div class="col-lg-12 col-mg-6"></div>
                        </div>
                        <div class="widget-category mb-30">
                            <h5 class="section-title style-1 mb-30 wow fadeIn animated" style="color: black;">Categorias
                            </h5>
                            <ul class="categories">
                                @foreach ($categories as $category)
                                <li><a
                                        href="{{route('product.category',['slug'=>$category->slug])}}">{{$category->name}}</a>
                                </li>

                                @endforeach
                            </ul>
                        </div>
                        <!-- Product sidebar Widget -->
                        <div class="sidebar-widget product-sidebar mb-30 p-30 bg-grey border-radius-10">
                            <div class="widget-header position-relative mb-20 pb-10">
                                <h5 class="widget-title mb-10" style="color: black;">Nuevos productos</h5>
                                <div class="bt-1 border-color-1"></div>
                            </div>

                            @foreach($nproducts as $nproduct)
                            <div class="single-post clearfix">
                                <div class="image">
                                    <img src="{{ asset('assets/imgs/products')}}/{{$nproduct->image}}"
                                        alt="{{$nproduct->name}}">
                                </div>
                                <div class="content pt-10">
                                    <h5><a href="{{ route('product.details', ['slug' => $nproduct->slug]) }}">{{
                                            $nproduct->name }}</a></h5>
                                    <span><a>
                                            <h5 style="color: rgb(0, 0, 0); font-size: 11px;">{{
                                                $nproduct->category->name }}</h5>
                                        </a></span>
                                    <p class="price mb-0 mt-5" style="color: black;">${{ $nproduct->regular_price }}
                                    </p>
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>