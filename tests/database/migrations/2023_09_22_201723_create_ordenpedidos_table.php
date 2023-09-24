<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenpedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordenpedidos', function (Blueprint $table) {
            $table->integer('id')->nullable();
            $table->string('codigo', 12)->primary();
            $table->timestamp('fecha')->nullable()->useCurrent();
            $table->unsignedBigInteger('cliente_id');
            $table->integer('idestado');
            $table->decimal('total', 11, 2);
            $table->string('descripcion')->nullable();
            $table->integer('idtipodepago')->nullable();
            $table->unsignedBigInteger('user_id');
            
            $table->foreign('cliente_id', 'fk_ordenpedidos_clientes1')->references('id')->on('clientes');
            $table->foreign('user_id', 'fk_ordenpedidos_users1')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordenpedidos');
    }
}
