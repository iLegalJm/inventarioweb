<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
    use HasFactory;
    protected $table = 'almacenes';
    protected $fillable = ['nombre'];
    public $timestamps = false;

    public function getRouteKeyName()
    {
        return "nombre";
    }

    public function detalleproducto()
    {
        return $this->hasMany(Detalleproducto::class);
    }
}