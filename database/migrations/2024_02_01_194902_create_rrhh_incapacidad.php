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
        Schema::create('rrhh_incapacidad', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empleado_id');
            $table->unsignedBigInteger('empresa_id');
            $table->unsignedBigInteger('periodo_planilla_id');
            $table->unsignedBigInteger('tipo_incapacidad_id');
            $table->integer('periodo');
            $table->integer('mes');
            $table->integer('year');
            $table->integer('cantidad');
            $table->timestamps();
            $table->foreign('empleado_id')->references('id')->on('rrhh_empleado');
            $table->foreign('empresa_id')->references('id')->on('rrhh_empresa');
            $table->foreign('periodo_planilla_id')->references('id')->on('rrhh_periodo_planilla');
            $table->foreign('tipo_incapacidad_id')->references('id')->on('rrhh_incapacidad_tipo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rrhh_incapacidad');
    }
};
