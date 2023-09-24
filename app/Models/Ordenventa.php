<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordenventa extends Model
{
    use HasFactory;

    public function ordensalida()
    {
        return $this->hasOne(Ordensalida::class);
    }

    public function ordenpedido()
    {
        return $this->belongsTo(Ordenpedido::class);
    }
}