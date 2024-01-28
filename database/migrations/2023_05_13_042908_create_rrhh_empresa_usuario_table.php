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
        Schema::create('rrhh_empresa_usuario', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_id')->nullable();
            $table->unsignedBigInteger('empresa_id')->nullable();
            $table->string("abreviatura", 10);
            $table->boolean('activo')->nullable()->default(false);
            $table->timestamps();

            $table->foreign('usuario_id')->references('id')->on('users')->onUpdate('cascade');
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
        Schema::dropIfExists('rrhh_empresa_usuario');
    }
};
