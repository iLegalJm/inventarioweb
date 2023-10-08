<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallepedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detallepedidos', function (Blueprint $table) {
            $table->id();
            $table->string('ordenpedido_id', 12);
            $table->unsignedBigInteger('producto_id');
            $table->integer('cantidad');
            $table->string('precio', 45);
            $table->double('valor_vta', 11, 2);
            $table->foreign('ordenpedido_id', 'fk_detallepedido_ordenpedido1')->references('codigo')->on('ordenpedidos');
            $table->foreign('producto_id', 'fk_detallepedido_productos1')->references('id')->on('productos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detallepedidos');
    }
}
