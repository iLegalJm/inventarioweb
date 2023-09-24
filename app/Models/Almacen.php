<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
    use HasFactory;
    protected $table = 'almacenes';
    public $timestamps = false;
    public function detalleproducto()
    {
        return $this->hasMany(Detalleproducto::class);
    }
}