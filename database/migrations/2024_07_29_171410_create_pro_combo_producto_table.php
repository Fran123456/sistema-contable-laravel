<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProComboProductoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pro_combo_producto', function (Blueprint $table) {
            $table->id();
            $table->foreignId('combo_id')->constrained('pro_combo');
            $table->foreignId('producto_id')->constrained('pro_producto');
            $table->decimal('precio', 10, 2); 
            $table->decimal('precio_venta', 10, 2); 
            $table->integer('cantidad'); 
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
        Schema::dropIfExists('pro_combo_producto');
    }
}