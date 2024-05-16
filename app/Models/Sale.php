<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Clientes;
use App\Models\Product;
use App\Models\Payment;

class Sale extends Model
{

    protected $fillable = [
        'quantity',
        'reference_number',
        'total_amount',
        'client_id',
        'status'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'sale_product')
            ->withPivot('codigo', 'quantity', 'price', 'discount');
    }

    public function client()
    {
        return $this->belongsTo(Clientes::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function deudaRestante()
    {
        // Suma los montos de todos los abonos
        $totalAbonos = $this->payments()->sum('amount');

        // Calcula la deuda restante
        $deudaRestante = $this->total_amount - $totalAbonos;

        return $deudaRestante;
    }

    

    use HasFactory;
}
