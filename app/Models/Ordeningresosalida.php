<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordeningresosalida extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['codigo', 'fechaorden', 'idestado', 'descripcion'];
    //!RELACION DE MUCHOS A MUCHOS
    public function ordenventa()
    {
        return $this->belongsToMany(Ordenventa::class);
    }

    public function detalleingresosalida()
    {
        return $this->hasMany(Detalleingresosalida::class);
    }
}