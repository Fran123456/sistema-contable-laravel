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
            $table->foreignId('estado_id')->constrained('fact_estado_facturacion');
            $table->foreignId('creado_por')->constrained('users');
            $table->string('codigo');
            $table->decimal('monto_facturar', 10, 2);
            $table->decimal('monto_facturado', 10, 2);
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
