<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductosModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'Nombre',
        'Descripcion',
        'Codigo',
        'PVP',
        'Porciento',
        'PT',
        'Cantidad',
        'Proveedor',
    ];
}
