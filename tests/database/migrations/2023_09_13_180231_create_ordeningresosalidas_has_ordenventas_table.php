<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdeningresosalidasHasOrdenventasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordeningresosalidas_has_ordenventas', function (Blueprint $table) {
            $table->integer('id');
            $table->integer('ordeningresosalidas_id');
            $table->unsignedInteger('ordenventas_id');
            
            $table->primary(['id', 'ordeningresosalidas_id', 'ordenventas_id']);
            $table->foreign('ordeningresosalidas_id', 'fk_ordeningresosalidas_has_ordenventas_ordeningresosalidas1')->references('id')->on('ordeningresosalidas');
            $table->foreign('ordenventas_id', 'fk_ordeningresosalidas_has_ordenventas_ordenventas1')->references('id')->on('ordenventas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordeningresosalidas_has_ordenventas');
    }
}
