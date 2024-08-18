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
        Schema::create('rrhh_empresa', function (Blueprint $table) {
            $table->id();
            $table->string('empresa')->nullable();
            $table->string("abreviatura", 10);
            $table->boolean('actualizada')->nullable()->default(false);
            $table->string('nrc')->nullable();
            $table->string('nit')->nullable();
            $table->string('razon_social')->nullable();
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
        Schema::dropIfExists('rrhh_empresa');
    }
};