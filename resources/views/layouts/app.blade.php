<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <title>Liz Company</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/imgs/theme/lizcompanylogo.jpg') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">

    @livewireStyles

</head>


<body>
    <header class="header-area header-style-1 header-height-2">
        <div class="header-top header-top-ptb-1 d-none d-lg-block">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-3 col-lg-4">
                        <div class="header-info">

                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-4">
                        <div class="text-center">
                            <div id="news-flash" class="d-inline-block">

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4">
                        <div class="header-info header-info-right">
                            @auth
                            <ul>
                                <li><i class="fi-rs-user"></i> {{Auth::user()->name}} /
                                    <form method="POST" action="{{route('logout')}}">
                                        @csrf
                                        <a href="{{route('logout')}}"
                                            onclick="event.preventDefault(); this.closest('form').submit();">Logout</a>
                                    </form>
                                </li>
                            </ul>
                            @else
                            <ul>
                                <li><i class="fi-rs-key"></i><a href="{{ route('login') }}">Administrador </a> / <a
                                        href="{{route('register')}}">Registrarse</a></li>
                            </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-middle header-middle-ptb-1 d-none d-lg-block" style="background-color: #000000;">
            <div class="container">
                <div class="header-wrap">
                    <div class="logo logo-width-1">
                        <img src="{{ asset('assets/imgs/logo/lizcompanylogo.jpg') }}" alt="logo" style="width: 80px;">
                    </div>
                    <div class="header-right">
                        @livewire('header-search-component')
                        <div class="header-action-right">
                            <div class="header-action-2">
                                @livewire('wishlist-icon-component')
                                @livewire('cart-icon-component')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom header-bottom-bg-color sticky-bar" style="background-color:#000000">
            <div class="container">
                <div class="header-wrap header-space-between position-relative">
                    <div class="logo logo-width-2 d-block d-lg-none">
                        <img src="{{ asset('assets/imgs/logo/lizcompanylogo.jpg') }}" alt="logo"
                            style="max-width: 100px; max-height: 100px;">
                    </div>
                    <div class="header-nav d-none d-lg-flex">
                        <div class="main-categori-wrap d-none d-lg-block">
                            <a class="categori-button-active" href="#">
                                <span class="fi-rs-apps"></span> Categorias
                            </a>
                            <div class="categori-dropdown-wrap categori-dropdown-active-large">
                                <ul class="categories">
                                    @if(isset($categories) && !empty($categories))
                                        @foreach ($categories as $category)
                                            <li><a href="{{ route('product.category', ['slug' => $category->slug]) }}">{{ $category->name }}</a></li>
                                        @endforeach
                                    @else
                                        {{-- Manejo de la situación donde $categories no está definida o está vacía --}}
                                        <li><a href="#">Categoría predeterminada</a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                        <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block">
                            <nav>
                                <ul>
                                    <li><a class="active" href="/">Inicio </a></li>
                                    <li><a href="{{route('about')}}">¿Quienes somos?</a></li>
                                    <li><a href="{{route('shop')}}">Compra</a></li>
                                    <li><a href="{{route('emprende')}}">Emprende</a></li>

                                    @auth
                                    @if(Auth::user()->utype == 'ADM')
                                    <li><a href="{{route('dashboard')}}">Admimnistrador</i></a>
                                       
                                        @else

                                </ul>
                                @endif

                                </li>
                                @endif
                                </ul>
                            </nav>
                        </div>

                    </div>

                    <p class="mobile-promotion"> <span class="text-brand"></span>
                    </p>
                    <div class="header-action-right d-block d-lg-none">
                        <div class="header-action-2">


                            @livewire('wishlist-icon-component')
                            @livewire('cart-icon-component')

                            <div class="header-action-icon-2 d-block d-lg-none">
                                <div class="burger-icon burger-icon-white">
                                    <span class="burger-icon-top"></span>
                                    <span class="burger-icon-mid"></span>
                                    <span class="burger-icon-bottom"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="mobile-header-active mobile-header-wrapper-style" style="background-color: #000000;">
        <div class="mobile-header-wrapper-inner">
            <div class="mobile-header-top" style="background-color: #000000;">
                <div class="mobile-header-logo">
                    <img src="{{ asset('assets/imgs/logo/lizcompanylogo.jpg') }}" alt="logo" style="width: 80px;">

                </div>

                <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                    <button class="close-style search-close">
                        <i class="icon-top"></i>
                        <i class="icon-bottom"></i>
                    </button>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4">
                <div class="header-info header-info-right">
                    @auth
                    <ul>
                        <li><i class="fi-rs-user"></i> {{Auth::user()->name}} /
                            <form method="POST" action="{{route('logout')}}">
                                @csrf
                                <a href="{{route('logout')}}"
                                    onclick="event.preventDefault(); this.closest('form').submit();">Logout</a>
                            </form>
                        </li>
                    </ul>
                    @else
                    <ul>
                        <li><i class="fi-rs-key"></i><a href="{{ route('login') }}">Administrador </a> / <a
                                href="{{route('register')}}">Registrarse</a></li>
                    </ul>
                    @endif
                </div>
            </div>
            <div class="mobile-header-content-area">

                <div class="mobile-search search-style-3 mobile-header-border">
                    {{-- <form action="#">
                        <input type="text" placeholder="Buscar">
                        <button type="submit"><i class="fi-rs-search"></i></button>
                    </form> --}}
                    @livewire('header-search-component')
                </div>
                <div class="mobile-menu-wrap mobile-header-border">

                    <!-- mobile menu start -->
                    <nav>
                        <ul class="mobile-menu">
                            <li class="menu-item-has-children"><span class="menu-expand"></span><a
                                    href="#">Categorías</a>
                                    <ul class="categories">
                                        @if(isset($categories) && !empty($categories))
                                            @foreach ($categories as $category)
                                                <li><a href="{{ route('product.category', ['slug' => $category->slug]) }}">{{ $category->name }}</a></li>
                                            @endforeach
                                        @endif
                                    </ul>
                            </li>
                            <li class="menu-item-has-children"><span class="menu-expand"></span><a href="/">Inicio</a>
                            </li>
                            <li class="menu-item-has-children"><span class="menu-expand"></span><a
                                    href="{{route('about')}}">¿Quienes somos?</a></li>
                            <li class="menu-item-has-children"><span class="menu-expand"></span><a
                                    href="{{route('shop')}}">Compra</a></li>
                            <li class="menu-item-has-children"><span class="menu-expand"></span><a
                                    href="{{route('emprende')}}">Emprende</a></li>

                            @auth
                            @if(Auth::user()->utype == 'ADM')
                            <li class="menu-item-has-children"><span class="menu-expand"></span><a href="{{route('dashboard')}}">Administrador</a>
                                @endif
                                @endif
                        </ul>
                        </ul>
                    </nav>
                    <!-- mobile menu end -->
                </div>
                <div class="mobile-social-icon">
                    <h5 class="mb-15 text-grey-4">Redes Sociales</h5>
                    <a href="https://www.facebook.com/profile.php?id=100057587853930" target="_blank">
                        <img src="{{ asset('assets/imgs/theme/icons/logofacebook.ico')}}" alt="">
                    </a>
                    <a href="https://www.tiktok.com/@lizesquiveloficial?_t=8krleFY7KTe&_r=1" target="_blank">
                        <img src="{{ asset('assets/imgs/theme/icons/logotiktok.ico')}}" alt="">
                    </a>
                    <a href="https://wa.link/zmzf3n" target="_blank">
                        <img src="{{ asset('assets/imgs/theme/icons/logowhatsapp.ico')}}" alt="">
                    </a>

                </div>
            </div>
        </div>
    </div>

    {{$slot}}

    <footer class="main">
        <section class="section-padding footer-mid" style="background-color: #000000;">
            <div class="container pt-15 pb-20">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="widget-about font-md mb-md-5 mb-lg-0">
                            <div class="logo logo-width-1 wow fadeIn animated">
                                <img src="{{ asset('assets/imgs/logo/lizcompanylogo.jpg') }}" style="width: 80px;">
                            </div>
                            <h5 class="mt-20 mb-10 fw-600 text-white wow fadeIn animated">Contacto</h5>
                            <p class="wow fadeIn animated" style="color: white !important;">
                                <strong>Dirección:</strong>Salazar N°157 Colonia San Nicolas C.P. 61252 Maravatío, Michoacán.
                            </p>
                            {{-- <p class="wow fadeIn animated" style="color: white !important;">
                                <strong>Telefóno: </strong>447-125-6711
                            </p> --}}
                            <h5 class="mb-10 mt-30 fw-600 text-white wow fadeIn animated">Síganos</h5>
                            <div class="mobile-social-icon wow fadeIn animated mb-sm-5 mb-md-0">
                            <a href="https://www.facebook.com/profile.php?id=100057587853930" target="_blank">
                                <img src="{{ asset('assets/imgs/theme/icons/logofacebook.ico') }}" alt="">
                            </a>
                            <a href="https://www.tiktok.com/@lizesquiveloficial?_t=8krleFY7KTe&_r=1" target="_blank">
                                <img src="{{ asset('assets/imgs/theme/icons/logotiktok.ico') }}" alt="">
                            </a>
                            <a href="https://wa.link/zmzf3n" target="_blank">
                                <img src="{{ asset('assets/imgs/theme/icons/logowhatsapp.ico') }}" alt="">
                            </a>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3">
                        <h5 class="widget-title wow fadeIn animated"><a href="{{route('about')}}" style="color: inherit; text-decoration: none;">¿Quiénes somos?</a></h5>
                        <ul class="footer-list wow fadeIn animated mb-sm-5 mb-md-0">
                           {{--  <li><a href="{{route('about')}}">Delivery Information</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Terms &amp; Conditions</a></li>
                            <li><a href="#">Contact Us</a></li> --}}
                        </ul>
                    </div>
                    <div class="col-lg-2 col-md-3">
                        <h5 class="widget-title wow fadeIn animated">Categorías</h5>
                        <ul class="footer-list wow fadeIn animated">
                            @foreach ($categories as $category)
                            <li><a href="{{ route('product.category', ['slug' => $category->slug]) }}">{{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    
                </div>
            </div>
        </section>
    </footer>
    <!-- Vendor JS-->
    <script src="{{ asset('assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/slick.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery.syotimer.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/wow.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery-ui.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/magnific-popup.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/waypoints.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/counterup.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/images-loaded.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/isotope.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/scrollup.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery.vticker-min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery.theia.sticky.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery.elevatezoom.js') }}"></script>
    <!-- Template  JS -->
    <script src="{{ asset('assets/js/main.js?v=3.3') }}"></script>
    <script src="{{ asset('assets/js/shop.js?v=3.3') }}"></script>
    


    @livewireScripts

</body>

</html>