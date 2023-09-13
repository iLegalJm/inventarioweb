<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdenventasHasDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordenventas_has_documentos', function (Blueprint $table) {
            $table->integer('id');
            $table->unsignedInteger('ordenventas_id');
            $table->integer('documento_id');
            
            $table->primary(['id', 'ordenventas_id', 'documento_id']);
            $table->foreign('documento_id', 'fk_ordenventas_has_documento_documento1')->references('id')->on('documentos');
            $table->foreign('ordenventas_id', 'fk_ordenventas_has_documento_ordenventas1')->references('id')->on('ordenventas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordenventas_has_documentos');
    }
}
