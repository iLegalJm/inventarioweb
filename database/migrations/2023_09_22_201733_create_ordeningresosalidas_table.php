<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdeningresosalidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordeningresosalidas', function (Blueprint $table) {
            $table->id();
            $table->integer('idmovimientoiventario');
            $table->string('codigo', 16)->nullable();
            $table->timestamp('fechaorden')->nullable()->useCurrent();
            $table->integer('idestado')->nullable();
            $table->string('descripcion')->nullable();
            // $table->unsignedInteger('ordenventa_id');

            // $table->foreign('ordenventa_id', 'fk_ordeningresosalida_ordenventas1')->references('id')->on('ordenventas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordeningresosalidas');
    }
}