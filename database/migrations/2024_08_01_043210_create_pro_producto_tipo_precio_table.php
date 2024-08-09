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
        Schema::create('pro_producto_tipo_precio', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('producto_id')->nullable();
            $table->unsignedBigInteger('tipo_precio_id')->nullable();
            $table->tinyInteger('estado')->nullable();
            $table->float('precio')->nullable();
            $table->timestamps();

            $table->foreign('producto_id')->references('id')->on('pro_producto')->onDelete('cascade');
            $table->foreign('tipo_precio_id')->references('id')->on('pro_tipo_precio')->onDelete('cascade');
            
            $table->index('producto_id');
            $table->index('tipo_precio_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pro_producto_tipo_precio');
    }
};
