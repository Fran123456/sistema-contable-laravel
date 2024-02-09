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
        Schema::create('socios_cargo', function (Blueprint $table) {
            $table->id();
            $table->string('cargo')->nullable();
            $table->unsignedBigInteger('empresa_id')->nullable();
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
        Schema::dropIfExists('socios_cargo');
    }
};
