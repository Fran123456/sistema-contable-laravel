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
        Schema::create('pro_producto', function (Blueprint $table) {
            $table->id();
            $table->string('producto');
            $table->text('descripcion');
            $table->string('codigo');
            $table->string('imagen');
            $table->bigInteger('tipo_producto_id');
            $table->boolean('requiere_lote');
            $table->boolean('requiere_vencimiento');
            $table->integer('alerta_stock')->nullable();
            $table->boolean('activo')->default(true);

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
        Schema::dropIfExists('pro_producto');
    }
};
