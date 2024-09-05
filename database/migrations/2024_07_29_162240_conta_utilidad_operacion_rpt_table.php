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
        Schema::create('conta_utilidad_operacion_rpt', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('utilidad_operar_id')->nullable();
            $table->string('signo',10);
            $table->unsignedBigInteger('utilidad_id')->nullable();
            $table->unsignedBigInteger('empresa_id')->nullable();
            $table->foreign('utilidad_id')->references('id')->on('conta_utilidad_rpt')->onUpdate('cascade');
            $table->foreign('utilidad_operar_id')->references('id')->on('conta_utilidad_rpt')->onUpdate('cascade');
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
        Schema::dropIfExists('conta_utilidad_operacion_rpt');
    }
};
