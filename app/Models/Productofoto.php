<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productofoto extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['url'];
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}