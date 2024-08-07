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
        Schema::create('fact_documento_detalle', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('documento_id')->nullable();
            $table->unsignedBigInteger('facturacion_id')->nullable();
            $table->unsignedBigInteger('cliente_id')->nullable();
            $table->dateTime('fecha_facturacion')->nullable();
            $table->unsignedBigInteger('producto_id')->nullable();
            $table->unsignedBigInteger('servicio_id')->nullable();
            $table->unsignedBigInteger('tipo_precio_id')->nullable();
            $table->string('tipo_descuento', 10)->nullable();
            $table->decimal('descuento', 12, 2)->nullable();
            $table->decimal('precio_sugerido', 10, 2)->nullable();
            $table->decimal('precio_unitario', 12, 2)->nullable();
            $table->integer('cantidad')->nullable();
            $table->decimal('iva', 12, 2)->nullable();
            $table->decimal('iva_percibido', 12, 2)->nullable();
            $table->decimal('iva_retenido', 12, 2)->nullable();
            $table->decimal('nosujeta', 12, 2)->nullable();
            $table->decimal('exenta', 12, 2)->nullable();
            $table->decimal('gravada', 12, 2)->nullable();
            $table->decimal('sub_total', 12, 2)->nullable();
            $table->decimal('total', 12, 2)->nullable();
            $table->unsignedBigInteger('empresa_id')->nullable();
            $table->unsignedBigInteger('creador_id')->nullable();
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
        Schema::dropIfExists('fact_documento_detalle');
    }
};
