<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleProduct extends Model
{
    use HasFactory;

    protected $table = 'sale_product';

    protected $fillable = [
        'sale_id',
        'product_id',
        'codigo',
        'quantity',
        'price',
        'total_product',
    ];

    public function product()
{
    return $this->belongsTo(Product::class);
}
}
