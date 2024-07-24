<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pro_producto_proveedor', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('producto_id');
            $table->unsignedBigInteger('proveedor_id');
            $table->decimal('precio_unitario', 10, 2);
            $table->string('producto', 300)->nullable();
            $table->string('codigo', 300)->nullable();
            $table->integer('stock')->nullable()->default(0);
            $table->foreign('proveedor_id')->references('id')->on('socios_proveedores')->onDelete('cascade');
            $table->foreign('producto_id')->references('id')->on('pro_producto')->onDelete('cascade');
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
        Schema::dropIfExists('pro_producto_proveedor');
    }
};