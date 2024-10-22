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
        Schema::create('cxc_transacciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('documento_id');
            $table->decimal('monto', 12, 2);
            $table->dateTime('fecha');
            $table->unsignedBigInteger('estado_id');
            $table->unsignedBigInteger('cliente_id');
            $table->text('referencia')->nullable();
            $table->boolean('anulada')->default(false);
            $table->timestamps();

            // Llaves foráneas
            $table->foreign('documento_id')->references('id')->on('fact_documento')->onDelete('cascade');
            $table->foreign('estado_id')->references('id')->on('cxc_estado')->onDelete('cascade');
            $table->foreign('cliente_id')->references('id')->on('socios_cliente')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cxc_transacciones');
    }
};