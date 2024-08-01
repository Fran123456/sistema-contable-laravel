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
        Schema::create('conta_grupo_cuenta_resultado_rpt', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cuenta_id')->nullable();
            $table->string('codigo', 200)->nullable();
            $table->unsignedBigInteger('sub_grupo_id')->nullable();
            $table->unsignedInteger('grupo_id')->nullable();
            $table->foreign('sub_grupo_id')->references('id')->on('conta_grupo_sub_resultado_rpt')->onUpdate('cascade');
            $table->foreign('grupo_id')->references('id')->on('conta_grupo_resultado_rpt')->onUpdate('cascade');
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
        Schema::dropIfExists('conta_grupo_cuenta_resultado_rpt');
    }
};
