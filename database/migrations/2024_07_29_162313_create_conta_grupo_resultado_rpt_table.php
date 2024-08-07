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
        Schema::create('conta_grupo_resultado_rpt', function (Blueprint $table) {
            $table->id();
            $table->string('grupo', 200)->nullable();
            $table->string('signo', 10)->nullable();
            $table->unsignedBigInteger('utilidad_id')->nullable();
            $table->foreign('utilidad_id')->references('id')->on("conta_utilidad_rpt")->OnUpdate('cascade');
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
        Schema::dropIfExists('conta_grupo_resultado_rpt');
    }
};
