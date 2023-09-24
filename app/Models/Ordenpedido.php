<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordenpedido extends Model
{
    use HasFactory;

    public function ordenventa()
    {
        return $this->hasOne(Ordenventa::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function detallepedido()
    {
        return $this->hasMany(Detallepedido::class);
    }
}