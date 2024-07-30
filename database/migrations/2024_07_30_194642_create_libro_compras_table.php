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
        Schema::create('libro_compras', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha_emision');
            $table->dateTime('fecha_emision_en_pdf');
            $table->string('documento');
            $table->string('nit')->nullable();
            $table->string('dui')->nullable();
            $table->string('nrc')->nullable();
            $table->unsignedBigInteger('proveedor_id')->nullable();
            $table->decimal('excentas_internas', 8, 2)->nullable();
            $table->decimal('excentas_importaciones', 8, 2)->nullable();
            $table->decimal('gravadas_internas', 8, 2)->nullable();
            $table->decimal('gravadas_importaciones', 8, 2)->nullable();
            $table->decimal('gravada_iva', 8, 2)->nullable();
            $table->decimal('contribucion_especial', 8, 2)->nullable();
            $table->decimal('anticipo_iva_retenido', 8, 2)->nullable();
            $table->decimal('anticipo_iva_recibido', 8, 2)->nullable();
            $table->decimal('total_compra', 8, 2)->nullable();
            $table->decimal('compras_excluidas', 8, 2)->nullable();
            $table->unsignedBigInteger('documento_id')->nullable();
            $table->boolean('mostrar');
            $table->unsignedBigInteger('detalle_partida_id')->nullable();
            $table->unsignedBigInteger('partida_id')->nullable();
            $table->unsignedBigInteger('empresa_id');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('proveedor_id')->references('id')->on('socios_proveedores')->onUpdate('set null');
            $table->foreign('detalle_partida_id')->references('id')->on('conta_detalle_partida_contable')->onUpdate('set null');
            $table->foreign('partida_id')->references('id')->on('conta_partida_contable')->onUpdate('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('libro_compras');
    }
};
