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
        Schema::create('conta_cuenta_contable', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->nullable();
            $table->string('nombre_cuenta')->nullable();
            $table->string('padre_id')->nullable();
            $table->integer('hijos')->nullable();
            $table->unsignedBigInteger('nivel_id')->nullable();
            $table->unsignedBigInteger('clasificacion_id')->nullable();
            $table->decimal('saldo', 12, 2)->nullable();
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
        Schema::dropIfExists('conta_cuenta_contable');
    }
};
