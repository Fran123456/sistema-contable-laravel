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
        Schema::create('config_empresas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_empresa');
            $table->string('nit');
            $table->string('nrc');
            $table->string('direccion');
            $table->string('email');
            $table->string('telefono_empresa', 100);
            $table->string('representante_legal');
            $table->string('telefono_repre_legal', 100);
            $table->string('responsable_contrato');
            $table->dateTime('fecha_contrato');
            $table->unsignedBigInteger('estado_id');
            $table->timestamps();

            //foranea
            $table->foreign('estado_id')->references('id')->on('config_estados_empresas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('config_empresas');
    }
};
