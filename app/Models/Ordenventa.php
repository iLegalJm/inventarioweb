<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordenventa extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['codigo', 'fecha', 'fechapago', 'idtipopago', 'idestado', 'descripcion', 'subtotal', 'impuestovta', 'total', 'totaldscto', 'importepago', 'importevuelto', 'ordenpedido_id'];
    public function ordensalida()
    {
        return $this->hasOne(Ordensalida::class);
    }

    public function ordenpedido()
    {
        return $this->belongsTo(Ordenpedido::class);
    }

    //!RELACION DE MUCHOS A MUCHOS
    public function ordeningresosalida()
    {
        return $this->belongsToMany(Ordeningresosalida::class);
    }
}