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
        Schema::create('conta_periodo_contables', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->nullable();
            $table->string('year')->nullable();
            $table->string('mes')->nullable();
            $table->string('activo')->nullable();
            $table->unsignedBigInteger('empresa_id')->nullable();
            $table->unsignedBigInteger('usuario_creador_id')->nullable();
            $table->unsignedBigInteger('usuario_actualizador_id')->nullable();
            $table->timestamps();

            $table->foreign('empresa_id')->references('id')->on('rrhh_empresa')
            ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('usuario_creador_id')->references('id')->on('users')->onUpdate('cascade');
            $table->foreign('usuario_actualizador_id')->references('id')->on('users')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conta_periodo_contables');
    }
};
