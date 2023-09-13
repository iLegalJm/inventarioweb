<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventarioalmacenesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventarioalmacenes', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->timestamp('fechainventario')->nullable()->useCurrent();
            $table->integer('cantidadinicial')->nullable();
            $table->integer('cantidadingreso')->nullable();
            $table->integer('cantidadsalida')->nullable();
            $table->integer('stock')->nullable();
            $table->double('costo', 11, 2)->nullable();
            $table->integer('idalmacenes');
            $table->unsignedBigInteger('idproductos');
            
            $table->foreign('idalmacenes', 'fk_inventarioalmacenes_almacenes1')->references('id')->on('almacenes');
            $table->foreign('idproductos', 'fk_inventarioalmacenes_productos1')->references('id')->on('productos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventarioalmacenes');
    }
}
