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
        Schema::create('libro_ventas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_emision')->nullable();
            $table->string('documento')->nullable();
            $table->string('nit')->nullable();
            $table->string('dui')->nullable();
            $table->string('nrc')->nullable();
            $table->string('cliente')->nullable();
            $table->decimal('excenta', 8, 2)->default(0);
            $table->decimal('no_sujeta', 8, 2)->default(0);
            $table->decimal('gravadas_locales', 8, 2)->default(0);
            $table->decimal('debito_fiscal', 8, 2)->default(0);
            $table->decimal('iva', 8, 2)->default(0);
            $table->decimal('ventas_terceros', 8, 2)->default(0);
            $table->decimal('debito_terceros', 8, 2)->default(0);
            $table->decimal('iva_percibido', 8, 2)->default(0);
            $table->decimal('iva_retenido', 8, 2)->default(0);
            $table->unsignedBigInteger('empresa_id')->nullable();
            $table->unsignedBigInteger('cliente_id')->nullable();
            $table->unsignedBigInteger('documento_id')->nullable();


            $table->boolean('mostrar')->default(true);
            $table->boolean('anulado')->default(false);

            $table->timestamps();

            $table->foreign('empresa_id')->references('id')->on('rrhh_empresa');
            $table->foreign('cliente_id')->references('id')->on('socios_cliente');
            $table->foreign('documento_id')->references('id')->on('fact_documento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('libro_ventas');
    }
};
