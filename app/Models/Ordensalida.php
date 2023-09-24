<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordensalida extends Model
{
    use HasFactory;

    public function ordenventa()
    {
        return $this->belongsTo(Ordenventa::class);
    }
}