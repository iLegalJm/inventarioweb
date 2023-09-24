<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosfotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productosfotos', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->unsignedBigInteger('productos_id');
            $table->longText('url')->nullable();
            
            $table->foreign('productos_id', 'fk_productosfotos_productos1')->references('id')->on('productos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productosfotos');
    }
}
