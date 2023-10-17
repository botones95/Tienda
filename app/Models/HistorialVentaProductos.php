<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialVentaProductos extends Model
{
    use HasFactory;
    protected $fillable = [
        'Fecha',
        'Nombre',
        'Codigo',
        'Cantidad',
];
}
