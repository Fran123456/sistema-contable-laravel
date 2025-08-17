<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('provisiones_mensuales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empresa_id');
            $table->unsignedBigInteger('empleado_id')->nullable();
            $table->string('tipo_provision');
            $table->decimal('monto', 15, 2);
            $table->date('mes');
            $table->timestamps();

            $table->foreign('empresa_id')->references('id')->on('rrhh_empresa');
            $table->foreign('empleado_id')->references('id')->on('rrhh_empleado');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('provisiones_mensuales');
    }
};
