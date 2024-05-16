<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;


class ShopComponent extends Component
{

    use WithPagination;
    public $pageSize = 12;
    public $orderBy = "Clasificación por defecto";

    public $min_value = 0;
    public $max_value = 1000;

    public function store($product_id, $product_name, $product_price)
    {
        Cart::instance('cart')->add($product_id, $product_name, 1, $product_price)->associate('\App\Models\Product');
        session()->flash('success_message', 'Artículo añadido al carrito');
        $this->emitTo('cart-icon-component', 'refreshComponent');
        return redirect()->route('shop.cart');
    }

    public function changePageSize($size)
    {
        $this->pageSize = $size;
    }

    public function changeOrderBy($order)
    {
        $this->orderBy = $order;
    }

    public function addToWishlist($product_id, $product_name, $product_price)
    {
        Cart::instance('wishlist')->add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        $this->emitTo('wishlist-icon-component', 'refreshComponent');
    }

    public function removeFromWishlist($product_id)
    {
        foreach (Cart::instance('wishlist')->content() as $witem) {
            if ($witem->id == $product_id) {
                Cart::instance('wishlist')->remove($witem->rowId);
                $this->emitTo('wishlist-icon-component', 'refreshComponent');
                return;
            }
        }
    }

    public function isProductSoldOut($product)
    {
        // Lógica para verificar si el producto está agotado
        return $product->stock_status === 'Agotado';
    }


    public function render()
    {
        if ($this->orderBy == 'Precio: Bajo a Alto') {
            $products = Product::with('category')->orderBy('regular_price', 'ASC')->paginate($this->pageSize);
        } else if ($this->orderBy == 'Precio: Alto a Bajo') {
            $products = Product::with('category')->orderBy('regular_price', 'DESC')->paginate($this->pageSize);
        } else if ($this->orderBy == 'Ordenar por novedad') {
            $products = Product::with('category')->orderBy('created_at', 'DESC')->paginate($this->pageSize);
        } else {
            $products = Product::with('category')->paginate($this->pageSize);
        }

        $nproducts = Product::latest()->take(3)->get();
        $categories = Category::orderBy('name', 'DESC')->get();
        return view('livewire.shop-component', [
            'products' => $products,
            'categories' => $categories,
            'nproducts' => $nproducts,
            'isProductSoldOut' => [$this, 'isProductSoldOut'],  // Agrega esta línea
        ]);
    }
}
