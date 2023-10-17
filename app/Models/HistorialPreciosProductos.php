<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialPreciosProductos extends Model
{
    use HasFactory;
    protected $fillable = [
            'Nombre',
            'Codigo',
            'Fecha',
            'PVP',
            'Porciento',
            'PT',
    ];
}
