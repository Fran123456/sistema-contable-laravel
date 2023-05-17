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
        Schema::create('conta_clasificacion_cuenta_contable', function (Blueprint $table) {
            $table->id();
            $table->string('clasificacion')->nullable();
            $table->unsignedBigInteger('empresa_id')->nullable();
            $table->timestamps();

            $table->foreign('empresa_id')->references('id')->on('rrhh_empresa')
            ->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conta_clasificacion_cuenta_contable');
    }
};
