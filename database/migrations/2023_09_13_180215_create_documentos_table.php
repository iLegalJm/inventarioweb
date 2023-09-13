<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentos', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('idtipodocumento')->nullable();
            $table->integer('idestado')->nullable();
            $table->integer('idmoneda')->nullable();
            $table->string('numero', 20)->nullable();
            $table->timestamp('fechaemision')->nullable()->useCurrent();
            $table->double('subtotal', 11, 2)->nullable();
            $table->double('impuesto', 11, 2)->nullable();
            $table->double('total', 11, 2)->nullable();
            $table->double('saldo', 11, 2)->nullable();
            $table->smallInteger('operador')->nullable();
            $table->smallInteger('indexentorno')->nullable();
            $table->string('descripcion', 500)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documentos');
    }
}
