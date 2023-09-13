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
            $table->integer('id')->primary();
            $table->string('codigo', 16)->nullable();
            $table->date('fechaorden')->nullable();
            $table->integer('idtipo')->nullable();
            $table->integer('idestado')->nullable();
            $table->integer('idmovimientoinventario')->nullable();
            $table->string('descripcion')->nullable();
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
