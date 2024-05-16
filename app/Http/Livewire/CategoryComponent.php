<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;


class CategoryComponent extends Component
{

    use WithPagination;
    public $pageSize = 12;
    public $orderBy = "Clasificación por defecto";
    public $slug;

    public function store($product_id,$product_name,$product_price)
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

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    


    public function render()
    {
        $category = Category::where('slug',$this->slug)->first();
        $category_id = $category->id;
        $category_name = $category->name;
        if($this->orderBy == 'Precio: Bajo a Alto')
        {
            $products = Product::where('category_id',$category_id)->orderBy('regular_price','ASC')->paginate($this->pageSize);
        }
        else if($this->orderBy == 'Precio: Alto a Bajo')
        {
            $products = Product::where('category_id',$category_id)->orderBy('regular_price','DESC')->paginate($this->pageSize);
        }
        else if($this->orderBy == 'Ordenar por novedad')
        {
            $products = Product::where('category_id',$category_id)->orderBy('created_at','DESC')->paginate($this->pageSize);
        }
        else{
            $products = Product::where('category_id',$category_id)->paginate($this->pageSize);
        }
        $nproducts = Product::latest()->take(3)->get();
        $categories = Category::orderBy('name','DESC')->get();
        return view('livewire.category-component',['products'=>$products,'categories'=>$categories,'category_name'=>$category_name,'nproducts' => $nproducts]);
    }
}
