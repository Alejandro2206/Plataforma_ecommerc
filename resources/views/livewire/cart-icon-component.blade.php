<div class="header-action-icon-2">
    <a class="mini-cart-icon" href="{{route('shop.cart')}}">
        <img alt="cart" src="{{ asset('assets/imgs/theme/icons/carrito-de-compras.png') }}">
        @if(Cart::instance('cart')->count()>0)
        <span class="pro-count blue">{{Cart::instance('cart')->count()}}</span>
        @endif
    </a>
    <div class="cart-dropdown-wrap cart-dropdown-hm2">
        <ul>
            @foreach (Cart::instance('cart')->content() as $item)
                <li>
                    <div class="shopping-cart-img">
                        <a href="{{route('product.details',['slug'=>$item->model->slug])}}"><img alt="{{$item->model->name}}" src="{{ asset('assets/imgs/products')}}/{{$item->model->image}}"></a>
                    </div>
                    <div class="shopping-cart-title">
                        <h4><a href="{{route('product.details',['slug'=>$item->model->slug])}}">{{substr($item->model->name,0,20)}}...</a></h4>
                        <h4><span>{{$item->qty}} × </span>${{$item->model->regular_price}}</h4>
                    </div>
                </li>
            @endforeach
        </ul>
        <div class="shopping-cart-footer">
            <div class="shopping-cart-total">
            <h4  style="color: black !important;">Total <span style="color: black !important;">${{Cart::instance('cart')->subtotal()}}</span></h4>
            </div>
            <div class="shopping-cart-button">
            <a href="{{ route('shop.cart') }}" class="outline" style="color: black;">Ver carrito</a>
            </div>
        </div>
    </div>
</div>