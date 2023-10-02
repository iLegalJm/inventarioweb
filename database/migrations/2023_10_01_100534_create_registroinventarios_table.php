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
        Schema::create('registroinventarios', function (Blueprint $table) {
            $table->id();
            $table->timestamp('fechamovimiento');
            $table->integer('cantidad');
            $table->string('descripcion');
            $table->unsignedBigInteger('detalleingresosalida_id');
            $table->unsignedBigInteger('almacen_id');

            $table->foreign('detalleingresosalida_id')->references('id')->on('detalleingresosalidas');
            $table->foreign('almacen_id')->references('id')->on('almacenes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registroinventarios');
    }
};