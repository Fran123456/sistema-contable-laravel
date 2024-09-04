<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fe_documento_electronico', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_generacion', 191);
            $table->string('numero_control', 191);
            $table->text('json');
            $table->string('sello_recibido', 191)->nullable();
            $table->date('fecha');
            $table->text('mh_response')->nullable();
            $table->boolean('procesado')->default(false);
            $table->string('tipo_documento', 2);
            $table->timestamps();
            $table->string('folio', 15);
            $table->unsignedBigInteger('documento_id');
            $table->foreign('tipo_documento')->references('codigo')->on('fe_tipo_documentos');
            $table->index('tipo_documento');
            $table->index('documento_id');
            $table->unsignedBigInteger('empresa_id')->nullable();
            $table->foreign('empresa_id')->references('id')->on('rrhh_empresa')->onUpdate('cascade');
            // $table->timestamps();
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fe_documento_electronico');
    }
};
