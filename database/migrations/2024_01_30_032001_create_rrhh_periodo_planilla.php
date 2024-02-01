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
        Schema::create('rrhh_periodo_planilla', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empresa_id');
            $table->integer('year');
            $table->integer('mes');
            $table->string('periodo_dias')->enum('01-15','16-30');
            $table->string('mes_string')->enum('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Noviembre', 'Diciembre');;
            $table->string('tipo_periodo')->enum('mensual', 'quincenal');
            $table->boolean('activo');
            $table->timestamps();
            $table->foreign('empresa_id')->references('id')->on('rrhh_empresa')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rrhh_periodo_planilla');
    }
};
