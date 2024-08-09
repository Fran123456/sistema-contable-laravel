<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProComboTipoPrecioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pro_combo_tipo_precio', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('combo_id');
            $table->unsignedBigInteger('tipo_precio_id');
            $table->decimal('precio', 10, 2);
            $table->decimal('precio_venta', 10, 2);
            $table->boolean('estado')->default(true);
            $table->timestamps();

            // Define foreign keys
            $table->foreign('combo_id')->references('id')->on('pro_combo');
            $table->foreign('tipo_precio_id')->references('id')->on('pro_tipo_precio');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pro_combo_tipo_precio');
    }
}
