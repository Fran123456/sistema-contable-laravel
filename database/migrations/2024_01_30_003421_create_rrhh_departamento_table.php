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
        Schema::create('rrhh_departamento', function (Blueprint $table) {
            $table->id();
            $table->string('departamento');
            $table->bigInteger('area_id');
            $table->unsignedBigInteger('empresa_id');
            $table->boolean('activo');
            $table->timestamps();    
            $table->foreign('area_id')->references('id')->on('rrhh_area')->onUpdate('cascade');
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
        Schema::dropIfExists('rrhh_departamento');
    }
};
