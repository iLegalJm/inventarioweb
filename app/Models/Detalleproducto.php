<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalleproducto extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['producto_id', 'almacen_id', 'cantidad', 'precio_unit_sigv', 'precio_unit_igv', 'valor_vta_sigv', 'valor_vta_igv', 'dscto', 'status'];
    public function almacen()
    {
        return $this->belongsTo(Almacen::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}