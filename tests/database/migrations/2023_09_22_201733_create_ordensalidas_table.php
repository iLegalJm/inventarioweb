<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdensalidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordensalidas', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('codigo', 16)->nullable();
            $table->date('fechaorden')->nullable();
            $table->integer('idestado')->nullable();
            $table->string('descripcion')->nullable();
            $table->unsignedInteger('ordenventas_id');
            
            $table->foreign('ordenventas_id', 'fk_ordeningresosalida_ordenventas1')->references('id')->on('ordenventas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordensalidas');
    }
}
