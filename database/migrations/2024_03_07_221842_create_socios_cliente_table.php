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
        Schema::create('socios_cliente', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('dui');
            $table->string('nit');
            $table->unsignedBigInteger('clasificacion_cliente_id');
            $table->string('tipo_cliente');
            $table->string('magnitud_cliente');
            $table->unsignedBigInteger('usuario_creo_id');
            $table->string('correo');
            $table->string('direccion');
            $table->boolean('activo')->default(true);
            $table->string('giro_negocio');
            $table->string('nrc');
            $table->bigInteger('pais_id');
            $table->bigInteger('departamento_id');
            $table->bigInteger('distrito_id');
            $table->string('telefono');
            $table->string('celular');
            $table->string('observaciones');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('socios_cliente');
    }
};
