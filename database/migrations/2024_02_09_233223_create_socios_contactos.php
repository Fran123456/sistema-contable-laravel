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
        Schema::create('socios_contactos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('correo')->nullable();
            $table->string('telefono');
            $table->text('contactado_en')->nullable();
            $table->unsignedBigInteger('persona_encuentra_id');
            $table->string('tipo_contrato');
            $table->string('estado');
            $table->text('cv');
            $table->string('portafolio')->nullable();
            $table->unsignedBigInteger('cargo_id');
            $table->unsignedBigInteger('registro_id');
            $table->unsignedBigInteger('pais_id');
            $table->text('anexo')->nullable();
            
            $table->timestamps();
            $table->foreign('persona_encuentra_id')->references('id')->on('users')->onUpdate('cascade');
            $table->foreign('cargo_id')->references('id')->on('socios_cargo')->onUpdate('cascade');
            $table->foreign('pais_id')->references('id')->on('ent_pais')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('socios_contactos');
    }
};
