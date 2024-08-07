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
        Schema::create('rrhh_puesto', function (Blueprint $table) {
            $table->id();
            $table->string('cargo');
            $table->unsignedBigInteger('empresa_id');
            $table->unsignedBigInteger('area_id');
            $table->unsignedBigInteger('departamento_id');
            $table->boolean('activo');
            $table->timestamps();
            $table->foreign('empresa_id')->references('id')->on('rrhh_empresa')->onUpdate('cascade');
            $table->foreign('area_id')->references('id')->on('rrhh_area')->onUpdate('cascade');
            $table->foreign('departamento_id')->references('id')->on('rrhh_departamento')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rrhh_puesto');
    }
};
