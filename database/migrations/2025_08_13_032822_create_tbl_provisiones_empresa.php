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
        Schema::create('tbl_provisiones_empresa', function (Blueprint $table) {
            $table->id(); // PK

            // FK a empresas
            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_id')->references('id')->on('rrhh_empresa')->onDelete('cascade');

            // Tipo de provisión
            $table->enum('tipo_provision', ['aguinaldo', 'vacaciones', 'indemnización']);

            // Porcentaje
            $table->decimal('porcentaje', 5, 2);

            // Fechas
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();

            // Descripción
            $table->text('descripcion')->nullable();

            // Usuario que creó el registro
            $table->unsignedBigInteger('creado_por')->nullable();
            $table->foreign('creado_por')->references('id')->on('users')->onDelete('set null');

            // Fecha de creación personalizada
            $table->timestamp('fecha_creacion')->useCurrent();

            // Estado (activo/inactivo)
            $table->boolean('estado')->default(true);

            // Si quieres timestamps de Laravel (created_at, updated_at)
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
        Schema::dropIfExists('tbl_provisiones_empresa');
    }
};
