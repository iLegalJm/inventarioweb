<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detallepedido extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['ordenpedido_id', 'producto_id', 'cantidad', 'precio', 'valor_vta'];
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function ordenpedido()
    {
        return $this->belongsTo(Ordenpedido::class);
    }
}