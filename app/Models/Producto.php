<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = ['codigo', 'precioventa', 'nombre', 'descripcion', 'marca', 'modelo', 'tamaño', 'color', 'stock'];

    /* La línea `public  = false;` deshabilita la funcionalidad de marca de tiempo
    automática en el modelo Eloquent. De forma predeterminada, Eloquent espera que las columnas
    `created_at` y `updated_at` estén presentes en la tabla de la base de datos y establece
    automáticamente sus valores al crear o actualizar un registro. */
    public $timestamps = false;

    public function detallepedido()
    {
        return $this->hasMany(Detallepedido::class);
    }

    public function detalleproducto()
    {
        return $this->hasMany(Detalleproducto::class);
    }

    public function productofoto()
    {
        return $this->hasMany(Productofoto::class);
    }
}