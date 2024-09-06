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
        Schema::create('fact_serial_documento', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tipo_documento_id');
            $table->string('serial')->nullable();
            $table->integer('correlativo_inicial')->nullable();
            $table->string('correlativo_actual')->nullable();
            $table->integer('ultimo_correlativo')->nullable();
            $table->unsignedBigInteger('empresa_id');
            $table->boolean('activo');
            $table->timestamps();

            $table->foreign('tipo_documento_id')->references('id')->on('fact_tipo_documento')->onUpdate('cascade');
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
        Schema::dropIfExists('fact_serial_documento');
    }
};
