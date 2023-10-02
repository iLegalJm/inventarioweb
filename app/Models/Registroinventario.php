<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registroinventario extends Model
{
    use HasFactory;

    public function detalleingresosalida()
    {
        return $this->belongsTo(Detalleingresosalida::class);
    }
}