<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenventasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordenventas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo', 50)->nullable();
            $table->timestamp('fecha')->nullable()->useCurrent();
            $table->date('fechaentrega')->nullable();
            $table->date('fechapago')->nullable();
            $table->string('idtipopago', 45)->nullable();
            $table->integer('idestado')->nullable();
            $table->string('idmovimiento', 45)->nullable();
            $table->double('subtotal', 11, 2)->nullable();
            $table->double('impuestovta', 4, 2)->nullable();
            $table->double('total', 11, 2)->nullable();
            $table->double('totaldscto', 11, 2)->nullable();
            $table->string('descripcion')->nullable();
            $table->double('importepago', 11, 2)->nullable();
            $table->double('importevuelto', 11, 2)->nullable();
            $table->string('ordenventascol', 45)->nullable();
            $table->string('idordenpedidos', 12);
            
            $table->foreign('idordenpedidos', 'fk_ordenventas_ordenpedidos1')->references('codigo')->on('ordenpedidos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordenventas');
    }
}
