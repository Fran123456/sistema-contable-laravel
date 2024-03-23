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
        Schema::create('rrhh_ingreso', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_empresa');
            $table->foreign('id_empresa')->references('id')->on('rrhh_empresa')->onUpdate('cascade');
            $table->unsignedBigInteger('id_empleado');
            $table->foreign('id_empleado')->references('id')->on('rrhh_empleado')->onUpdate('cascade');
            $table->unsignedBigInteger('id_tipo_ingreso');
            $table->foreign('id_tipo_ingreso')->references('id')->on('rrhh_tipo_ingreso')->onUpdate('cascade');
            $table->unsignedBigInteger('id_periodo_planilla');
            $table->foreign('id_periodo_planilla')->references('id')->on('rrhh_periodo_planilla')->onUpdate('cascade');
            $table->double('cantidad', 10, 2);
            $table->date('fecha');
            $table->text('descripcion')->nullable();
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
        Schema::dropIfExists('rrhh_ingreso');
    }
};
