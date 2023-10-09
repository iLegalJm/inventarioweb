<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleproductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalleproductos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('producto_id');
            $table->unsignedBigInteger('almacen_id');
            $table->integer('cantidad')->nullable();
            $table->double('precio_unit_sigv', 11, 2)->nullable();
            $table->double('precio_unit_igv', 11, 2)->nullable();
            $table->double('valor_vta_sigv', 11, 2)->nullable();
            $table->double('valor_vta_igv', 11, 2)->nullable();
            $table->double('dscto', 11, 2)->nullable();
            $table->integer('status')->nullable()->default(1);

            $table->foreign('almacen_id', 'fk_detalleproductos_almacenes1')->references('id')->on('almacenes');
            $table->foreign('producto_id', 'fk_detalleproductos_productos1')->references('id')->on('productos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categorias');
        Schema::dropIfExists('detalleproductos');
    }
}