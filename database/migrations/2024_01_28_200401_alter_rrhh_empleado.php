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
        Schema::table('rrhh_empleado', function (Blueprint $table) {
            $table->string('codigo', 255);
            $table->text('foto')->nullable();
            $table->unsignedBigInteger('tipo_empleado_id');
            $table->foreign('tipo_empleado_id')->references('id')->on('rrhh_tipo_empleado')->onUpdate('cascade');
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
            $table->dropColumn('codigo');
            $table->dropColumn('foto');
            $table->dropColumn('tipo_empleado_id');
        });
    }
};
