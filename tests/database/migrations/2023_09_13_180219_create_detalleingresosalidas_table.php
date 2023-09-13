<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleingresosalidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalleingresosalidas', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('idordeningresosalidas');
            $table->integer('cantidad')->nullable();
            $table->double('costo', 11, 2)->nullable();
            $table->unsignedBigInteger('idproductos');
            
            $table->foreign('idordeningresosalidas', 'fk_detalleingresosalidas_ordeningresosalida1')->references('id')->on('ordeningresosalidas');
            $table->foreign('idproductos', 'fk_detalleingresosalidas_productos1')->references('id')->on('productos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalleingresosalidas');
    }
}
