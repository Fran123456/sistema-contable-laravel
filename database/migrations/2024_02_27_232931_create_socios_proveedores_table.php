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
            $table->string('numero_registro')->nullable();
            $table->string('nit');
            $table->string('dui');
            $table->string('telefono')->nullable();;
            $table->string('direccion')->nullable();;
            $table->string('celular')->nullable();
            $table->string('correo')->nullable();
            $table->bigInteger('pais_id')->nullable();
            $table->boolean('activo')->default(true);

            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_Id')->references('id')->on('rrhh_empresa')->onUpdate('cascade');
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
