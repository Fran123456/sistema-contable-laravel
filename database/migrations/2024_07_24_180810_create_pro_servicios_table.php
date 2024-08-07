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
        Schema::create('pro_servicios', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->string('nombre');

            // Campos para cuentas contables
            $table->string('cuenta_contable_ingreso')->nullable();
            $table->string('cuenta_contable_costo')->nullable();
            $table->string('cuenta_contable_ingreso_exterior')->nullable();
            $table->string('cuenta_contable_costo_exterior')->nullable();

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
        Schema::dropIfExists('pro_servicios');
    }
};
