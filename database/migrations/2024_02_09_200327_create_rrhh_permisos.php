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
        Schema::create('rrhh_permiso', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empresa_id');
            $table->unsignedBigInteger('empleado_id');
            $table->unsignedBigInteger('periodo_planilla_id');
            $table->unsignedBigInteger('tipo_permiso_id');
            $table->string('tipo_permiso');
            $table->string('periodo', 15);
            $table->integer('mes');
            $table->integer('year');
            $table->integer('cantidad');
            $table->date('fecha_inicio');
            $table->text('descripcion')->nullable();
            $table->timestamps();
            $table->foreign('empresa_id')->references('id')->on('rrhh_empresa');
            $table->foreign('empleado_id')->references('id')->on('rrhh_empleado');
            $table->foreign('periodo_planilla_id')->references('id')->on('rrhh_periodo_planilla');
            $table->foreign('tipo_permiso_id')->references('id')->on('rrhh_tipo_permiso');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rrhh_permiso');
    }
};
