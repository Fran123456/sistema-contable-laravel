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
        Schema::create('socios_proveedores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('tipo_proveedor');
            $table->string('tipo_personalidad');
            $table->string('giro');
            $table->string('forma_pago');
            $table->string('numero_registro');
            $table->string('nit');
            $table->string('telefono');
            $table->string('direccion');
            $table->string('celular')->nullable();
            $table->string('correo')->nullable();
            $table->string('pais')->nullable();
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
        Schema::dropIfExists('socios_proveedores');
    }
};
