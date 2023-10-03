<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventarioalmacen extends Model
{
    use HasFactory;
    protected $table = 'inventarioalmacenes';
    public $timestamps = false;
    protected $fillable = ['fechamovimiento', 'cantidadinicial', 'cantidadingreso', 'cantidadingreso', 'stock', 'producto_id', 'almacen_id'];

}