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
        Schema::create('config_reporte_campo', function (Blueprint $table) {
            $table->id();
            $table->string('tipo')->nullable();
            $table->boolean('requerido')->default(false);
            $table->string('valor')->nullable();
            $table->unsignedBigInteger('reporte_id')->nullable();
            $table->string('modulo')->nullable();
            $table->string('label')->nullable();
            $table->timestamps();

            $table->foreign('reporte_id')->references('id')->on('config_reporte')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('config_reporte_campos');
    }
};
