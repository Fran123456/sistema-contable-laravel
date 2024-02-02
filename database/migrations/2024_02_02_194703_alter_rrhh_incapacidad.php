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
        Schema::table("rrhh_incapacidad", function (Blueprint $table) {
            $table->date("fecha_inicio");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rrhh_empleado', function (Blueprint $table) {
            $table->dropColumn('fecha_inicio');
        });
    }
};
