<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inventarioalmacenes', function (Blueprint $table) {
            $table->id();
            $table->timestamp('fechamovimiento')->nullable()->useCurrent();
            $table->integer('cantidadinicial')->nullable();
            $table->integer('cantidadingreso')->nullable();
            $table->integer('cantidadsalida')->nullable();
            $table->integer('stock')->nullable();
            $table->double('costo', 11, 4)->nullable();
            $table->unsignedBigInteger('producto_id');
            $table->unsignedBigInteger('almacen_id');

            $table->foreign('producto_id')->references('id')->on('productos');
            $table->foreign('almacen_id')->references('id')->on('almacenes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventarioalmacenes');
    }
};