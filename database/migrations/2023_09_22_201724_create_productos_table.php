<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 15);
            $table->double('precioventa', 11, 2);
            $table->string('nombre', 100);
            $table->string('descripcion');
            $table->string('marca', 80);
            $table->string('modelo', 80);
            $table->string('tamaño', 15);
            $table->string('color', 80);
            $table->integer('stock');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
