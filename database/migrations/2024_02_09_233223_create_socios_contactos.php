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
            $table->unsignedBigInteger('cargo_contacto_id');
            $table->timestamps();

            $table->foreign('persona_encuentra_id')->references('id')->on('users')->onUpdate('cascade');
            $table->foreign('cargo_encuentra_id')->references('id')->on('socios_cargos')->onUpdate('cascade');
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