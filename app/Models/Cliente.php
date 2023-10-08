<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['nombres', 'apellidos', 'numerodocumento', 'telefono'];
    public function ordenpedido()
    {
        return $this->hasMany(Ordenpedido::class);
    }
}