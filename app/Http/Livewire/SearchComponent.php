<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;


class SearchComponent extends Component
{

    use WithPagination;
    public $pageSize = 12;
    public $orderBy = "Clasificación por defecto";


    public $q;
    public $search_term;

    public function mount()
    {
        $this->fill(request()->only('q'));
        $this->search_term = '%'.$this->q . '%';
    }

    public function store($product_id,$product_name,$product_price)
    {
        Cart::instance('cart')->add($product_id,$product_name,1,$product_price)->associate('\App\Models\Product');
        session()->flash('success_message','Artículo añadido al carrito');
        $this->emitTo('cart-icon-component','refreshComponent');
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


    public function render()
    {
        if($this->orderBy == 'Precio: Bajo a Alto')
        {
            $products = Product::where('name','like',$this->search_term)->orderBy('regular_price','ASC')->paginate($this->pageSize);
        }
        else if($this->orderBy == 'Precio: Alto a Bajo')
        {
            $products = Product::where('name','like',$this->search_term)->orderBy('regular_price','DESC')->paginate($this->pageSize);
        }
        else if($this->orderBy == 'Ordenar por novedad')
        {
            $products = Product::where('name','like',$this->search_term)->orderBy('created_at','DESC')->paginate($this->pageSize);
        }
        else{
            $products = Product::where('name','like',$this->search_term)->paginate($this->pageSize);
        }
        $nproducts = Product::latest()->take(3)->get();
        $categories = Category::orderBy('name','DESC')->get();
        return view('livewire.search-component',['products'=>$products,'categories'=>$categories,'nproducts' => $nproducts]);
    }
}
