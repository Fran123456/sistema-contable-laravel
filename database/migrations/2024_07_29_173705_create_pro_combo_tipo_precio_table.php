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
            $table->bigIncrements('id');
            $table->bigInteger('combo_id')->nullable()->unsigned();
            $table->integer('tipo_precio_id')->nullable()->unsigned();
            $table->decimal('precio', 10, 2)->nullable();
            $table->decimal('precio_venta', 10, 2)->nullable();
            $table->tinyInteger('estado')->nullable();
            $table->timestamps(0); // Con precision 0 como en el SQL original

            // Agregar índices
            $table->index('combo_id');
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
        Schema::dropIfExists('pro_combo_tipo_precio');
    }
}

