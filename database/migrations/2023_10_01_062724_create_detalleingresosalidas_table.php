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
        Schema::create('detalleingresosalidas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ordeningresosalida_id');
            $table->integer('cantidad');
            $table->double('costo', 11, 2);
            $table->unsignedBigInteger('producto_id');

            $table->foreign('ordeningresosalida_id')->references('id')->on('ordeningresosalidas');
            $table->foreign('producto_id')->references('id')->on('productos');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalleingresosalidas');
    }
};