<?php

namespace App\Http\Livewire;

use App\Models\HomeSlider;
use App\Models\Product;
use Livewire\Component;
use App\Models\Marca;
use Cart;

class HomeComponent extends Component
{
    public function store($product_id, $product_name, $product_price)
    {
        Cart::instance('cart')->add($product_id, $product_name, 1, $product_price)->associate('\App\Models\Product');
        session()->flash('success_message', 'Artículo añadido al carrito');
        $this->emitTo('cart-icon-component', 'refreshComponent');
        return redirect()->route('shop.cart');
    }

    public function isProductSoldOut($product)
    {
        // Lógica para verificar si el producto está agotado
        return $product->stock_status === 'Agotado';
    }


    public function render()
    {
        $slides = HomeSlider::where('status',1)->get();
        $marca = Marca::where('status',1)->get();
        $lproducts = Product::orderBy('created_at','DESC')->get()->take(8);
        $fproducts = Product::where('featured',1)->inRandomOrder()->get()->take(8);
        return view('livewire.home-component',['slides'=>$slides,'lproducts'=>$lproducts,'fproducts'=>$fproducts,'marca' => $marca,
        'isProductSoldOut' => [$this, 'isProductSoldOut']]);
    }
}
