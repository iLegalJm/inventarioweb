<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalledocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalledocumentos', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('iddocumentos');
            $table->integer('cantidad')->nullable();
            $table->double('preciounit', 11, 2)->nullable();
            $table->double('preciounitigv', 11, 2)->nullable();
            $table->unsignedBigInteger('idproductos');
            
            $table->foreign('iddocumentos', 'fk_detalledocumentos_documentos1')->references('id')->on('documentos');
            $table->foreign('idproductos', 'fk_detalledocumentos_productos1')->references('id')->on('productos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalledocumentos');
    }
}
