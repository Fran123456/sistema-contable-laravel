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
        Schema::create('fact_documento', function (Blueprint $table) {
            $table->id();
            $table->string('documento')->nullable();
            $table->foreignId('facturacion_id')->constrained('fact_facturacion');
            $table->string('serial')->nullable();
            $table->string('tipo_documento_id')->constrained('fact_tipo_documento');
            $table->unsignedBigInteger('cliente_id')->nullable();
            $table->unsignedBigInteger('proveedor_id')->nullable();
            $table->decimal('monto', 10, 2)->nullable();
            $table->foreignId('estado_facturacion_id')->constrainded('fact_estado_facturacion');
            $table->boolean('posteado');
            $table->dateTime('fecha_emision')->nullable();
            $table->foreignId('creado_por')->constrained('users');
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
        Schema::dropIfExists('fact_documento');
    }
};
