<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sale;

class Payment extends Model
{

    protected $fillable = ['sale_id', 'amount', 'payment_date'];

    /* public function sale()
    {
        return $this->belongsTo(Sale::class);
    } */

    use HasFactory;
}
