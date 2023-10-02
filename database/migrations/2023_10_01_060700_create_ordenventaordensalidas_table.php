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
        Schema::create('ordenventaordensalidas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ordenventa_id');
            $table->unsignedBigInteger('ordeningresosalida_id');

            $table->foreign('ordenventa_id', 'fk_ordenventaordensalidas_ordenventas1')->references('id')->on('ordenventas');
            $table->foreign('ordeningresosalida_id')->references('id')->on('ordeningresosalidas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordenventaordensalidas');
    }
};