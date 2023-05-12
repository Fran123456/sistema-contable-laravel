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
        Schema::create('conta_periodo_tipo_partida', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('periodo_id')->nullable();
            $table->unsignedBigInteger('tipo_partida_id')->nullable();
            $table->string('correlativo')->nullable();
            $table->timestamps();

            $table->foreign('periodo_id')->references('id')
            ->on('conta_periodo_contables')->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('tipo_partida_id')->references('id')
            ->on('conta_tipo_partida')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conta_periodo_tipo_partida');
    }
};
