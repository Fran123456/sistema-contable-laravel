<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
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
            $table->string('dui')->nullable()->nullable();
            $table->string('nit')->nullable()->nullable();
            $table->unsignedBigInteger('clasificacion_cliente_id')->nullable();
            $table->string('tipo_cliente')->nullable();
            $table->string('magnitud_cliente')->nullable();
            $table->unsignedBigInteger('usuario_creo_id');
            $table->string('correo')->nullable();
            $table->string('direccion')->nullable();
            $table->boolean('activo')->default(true);
            $table->string('giro_negocio')->nullable();
            $table->string('nrc')->nullable();
            $table->bigInteger('pais_id')->nullable();
            $table->bigInteger('departamento_id')->nullable();
            $table->bigInteger('distrito_id')->nullable();
            $table->string('telefono')->nullable();
            $table->string('celular')->nullable();
            $table->string('observaciones')->nullable();
            $table->unsignedBigInteger('empresa_id')->nullable();
            $table->foreign('empresa_Id')->references('id')->on('rrhh_empresa')->onUpdate('cascade');
            $table->string('actividad_economica')->nullable();
            // $table->foreign('actividad_economica')
            //     ->references('codigo')
            //     ->on('fe_actividad_economicas')
            //     ->onUpdate('cascade')
            //     ->onDelete('set null');
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
