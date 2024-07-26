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
        Schema::create('fact_facturacion', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('estado_id');
            $table->foreign('estado_id')->references('id')->on('fact_estado_facturacion')->onUpdate('cascade');

            $table->unsignedBigInteger('creado_por');
            $table->foreign('creado_por')->references('id')->on('users')->onUpdate('cascade');
            $table->string('codigo');
            $table->decimal('monto_facturar', 10, 2);
            $table->decimal('monto_facturado', 10, 2);
            $table->dateTime('fecha_facturacion')->nullable();
            $table->unsignedBigInteger('empresa_id')->nullable();
            $table->foreign('empresa_id')->references('id')->on('rrhh_empresa')->onUpdate('cascade');
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
        Schema::dropIfExists('fact_facturacion');
    }
};
