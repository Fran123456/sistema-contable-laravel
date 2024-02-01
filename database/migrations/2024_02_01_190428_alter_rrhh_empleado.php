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
        Schema::table("rrhh_empleado", function (Blueprint $table) {

            $table->unsignedBigInteger("empresa_id");
            $table->float("salario", 10, 2)->default(0);
            $table->float("salario_diario", 10, 2)->default(0);
            $table->foreign('empresa_id')->references('id')->on('rrhh_empresa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
