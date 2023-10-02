<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalleingresosalida extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['ordeningresosalida_id', 'cantidad', 'costo', 'producto_id'];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function ordeningresosalida()
    {
        return $this->belongsTo(Ordeningresosalida::class);
    }

    public function registroinventario()
    {
        return $this->hasMany(Registroinventario::class);
    }
}