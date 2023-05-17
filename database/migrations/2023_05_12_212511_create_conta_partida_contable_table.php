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
        Schema::create('conta_partida_contable', function (Blueprint $table) {
            $table->id();
            $table->text('concepto')->nullable();
            $table->unsignedBigInteger('periodo_id')->nullable();
            $table->unsignedBigInteger('tipo_partida_id')->nullable();
            $table->string('correlativo')->nullable();
            $table->decimal('debe', 12, 2)->nullable()->default(0);
            $table->decimal('haber', 12, 2)->nullable()->default(0);
            $table->dateTime('fecha_contable')->nullable();
            $table->boolean('cerrada')->nullable()->default(false);
            $table->boolean('anulada')->nullable()->default(false);
            $table->dateTime('fecha_cierre')->nullable();
            $table->unsignedBigInteger('empresa_id')->nullable();

            $table->timestamps();

            $table->foreign('empresa_id')->references('id')->on('rrhh_empresa')
            ->onUpdate('cascade')->onDelete('cascade');


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
        Schema::dropIfExists('conta_partida_contable');
    }
};
