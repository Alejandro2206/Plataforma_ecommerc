<?php

namespace App\Http\Livewire;

use App\Models\Product;
use GuzzleHttp\Handler\Proxy;
use Livewire\Component;
use Cart;

class DetailsComponent extends Component
{
    public $slug;

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function store($product_id,$product_name,$product_price)
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
        $product = Product::where('slug',$this->slug)->first();
        $rproducts = Product::where('category_id',$product->category_id)->inRandomOrder()->limit(4)->get();
        $nproducts = Product::latest()->take(3)->get();
        return view('livewire.details-component',['product'=>$product,'rproducts'=>$rproducts,'nproducts'=>$nproducts,'isProductSoldOut' => [$this, 'isProductSoldOut']]);
    }
}
