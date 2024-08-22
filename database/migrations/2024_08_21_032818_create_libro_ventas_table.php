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
            $table->decimal('debito_fiscal', 8, 2)->default(0);
            $table->decimal('iva', 8, 2)->default(0);
            $table->decimal('ventas_terceros', 8, 2)->default(0);
            $table->decimal('debito_terceros', 8, 2)->default(0);
            $table->decimal('iva_percibido', 8, 2)->default(0);
            $table->decimal('iva_retenido', 8, 2)->default(0);
            $table->boolean('mostrar')->default(true);
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
        Schema::dropIfExists('libro_ventas');
    }
};
