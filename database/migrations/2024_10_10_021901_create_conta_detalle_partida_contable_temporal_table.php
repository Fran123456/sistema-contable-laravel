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
        Schema::create('conta_detalle_partida_contable_temporal', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('partida_id')->nullable();
            $table->unsignedBigInteger('periodo_id')->nullable();
            $table->unsignedBigInteger('tipo_partida_id')->nullable();
            $table->unsignedBigInteger('empresa_id')->nullable();
            $table->unsignedBigInteger('creador_id')->nullable();
            $table->unsignedBigInteger('actualizador_id')->nullable();
            $table->unsignedBigInteger('cuenta_contable_id')->nullable();
            $table->string('codigo_cuenta')->nullable();
            $table->decimal('debe', 12, 2)->nullable()->default(0);
            $table->decimal('haber', 12, 2)->nullable()->default(0);
            $table->dateTime('fecha_contable')->nullable();
            $table->text('concepto')->nullable();
            $table->timestamps();


            $table->foreign('creador_id')->references('id')
            ->on('users')->onUpdate('cascade')->onDelete('set null');

            $table->foreign('actualizador_id')->references('id')
            ->on('users')->onUpdate('cascade')->onDelete('set null');
            

         /*   $table->foreign('cuenta_contable_id')->references('id')
            ->on('conta_cuenta_contable')->onUpdate('cascade')->onDelete('cascade');*/
            
            $table->foreign('partida_id')->references('id')
            ->on('conta_partida_contable')->onUpdate('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('conta_detalle_partida_contable_temporal');
    }
};
