<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistroinvetariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registroinvetarios', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('idmovimientoinventario')->nullable();
            $table->date('fechamovimiento')->nullable();
            $table->integer('cantidad')->nullable();
            $table->string('descripcion')->nullable();
            $table->integer('idalmacenes');
            $table->integer('iddetalleingresosalidas');
            
            $table->foreign('idalmacenes', 'fk_registroinvetarios_almacenes1')->references('id')->on('almacenes');
            $table->foreign('iddetalleingresosalidas', 'fk_registroinvetarios_detalleingresosalidas1')->references('id')->on('detalleingresosalidas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registroinvetarios');
    }
}
