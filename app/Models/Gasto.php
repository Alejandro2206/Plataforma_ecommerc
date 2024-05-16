<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gasto extends Model
{
    use HasFactory;

    protected $fillable = [
        'categoria',
        'valor',
        'concepto',
        'metodo_pago',
        'supplier_id',
        'fecha_gasto',
        'estado',
    ];

    public function abonos()
    {
        return $this->hasMany(Abono::class);
    }


    public function proveedor()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }


    public function deudaRestante()
    {
        // Suma los montos de todos los abonos
        $totalAbonos = $this->abonos()->sum('monto');

        // Calcula la deuda restante
        $deudaRestante = $this->valor - $totalAbonos;

        return $deudaRestante;
    }
}
