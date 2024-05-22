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
        Schema::create('rrhh_afp', function (Blueprint $table) {

            $table->id();
            $table->string('afp', 90);
            $table->unsignedBigInteger('id_empresa');
            $table->foreign('id_empresa')->references('id')->on('rrhh_empresa');
            $table->decimal('porciento_empleador', 10, 2);
            $table->decimal('porciento_empleado', 10, 2);
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
        Schema::dropIfExists('rrhh_afp');
    }
};
