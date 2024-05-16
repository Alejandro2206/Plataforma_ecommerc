<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abono extends Model
{
    use HasFactory;

    protected $fillable = [
        'gasto_id', // Asegúrate de agregar 'gasto_id' aquí
        'monto',
        // Otras propiedades permitidas para asignación masiva, si las hay
    ];
}
