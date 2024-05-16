<?php

use App\Http\Controllers\ComprobanteController;
use App\Http\Controllers\MovimientoController;
use App\Http\Controllers\ProfileController;
use App\Models\Movimiento;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\GastoController;
use App\Http\Controllers\HomeMarcaComponent;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\AboutComponent;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\DetailsComponent;
use App\Http\Livewire\EmprendeComponent;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\SearchComponent;
use App\Http\Livewire\ShopComponent;
use App\Http\Livewire\WishlistComponent;

Route::get('/', HomeComponent::class)->name('home.index');

Route::get('/shop', ShopComponent::class)->name('shop');

Route::get('/product/{slug}', DetailsComponent::class)->name('product.details');

Route::get('/cart', CartComponent::class)->name('shop.cart');

Route::get('/wishlist', WishlistComponent::class)->name(('shop.wishlist'));

Route::get('/checkout', CheckoutComponent::class)->name('shop.checkout');

Route::get('/product-category/{slug}', CategoryComponent::class)->name('product.category');

Route::get('/search', SearchComponent::class)->name('product.search');

Route::get('/about', AboutComponent::class)->name('about');

Route::get('/emprende', EmprendeComponent::class)->name('emprende');

Route::middleware(['auth', 'authadmin'])->group(function () {
    Route::get('products/pdf/pdf_existente', [ProductController::class, 'pdf_existente'])->name('products.pdf.pdfexistentes');
    Route::get('products/pdf/pdf_agotados', [ProductController::class, 'pdf_agotados'])->name('products.pdf.pdfagotados');
    Route::get('gastos/pdf', [GastoController::class, 'pdf'])->name('gastos.pdf');
    Route::get('sales/pdf', [SalesController::class, 'pdf'])->name('sales.pdf');
    Route::get('sales/deudas/pdf', [SalesController::class, 'pdfDeudas'])->name('sales.deudas.pdf');
    

    Route::get('users/pdf', [UserController::class, 'pdf'])->name('users.pdf');
    Route::resource('/sales', SalesController::class);
    Route::get('buscar-producto', [SalesController::class, 'buscarProducto'])->name('buscar.producto');
    Route::get('buscar-cliente', [SalesController::class, 'buscarCliente'])->name('buscar.cliente');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/categories', CategoryController::class);
    Route::resource('/products', ProductController::class);
    Route::resource('/clientes', ClientController::class);
    Route::resource('/marcas', MarcaController::class);
    Route::resource('/sliders', SliderController::class);
    Route::resource('/suppliers', SupplierController::class);
    Route::resource('/users', UserController::class);
    Route::resource('/gastos', GastoController::class);
    Route::resource('/movimientos', MovimientoController::class);

    Route::get('/sales/{sale}', 'App\Http\Controllers\SalesController@show')->name('sales.show');

    // web.php o api.php
    Route::match(['post', 'put'], '/gastos/{gasto}/abonar', 'App\Http\Controllers\GastoController@abonar')->name('gastos.abonar');
    Route::match(['post', 'put'], '/sales/{sale}/abonar', 'App\Http\Controllers\SalesController@abonar')->name('sales.abonar');
    
    
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



require __DIR__ . '/auth.php';

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
