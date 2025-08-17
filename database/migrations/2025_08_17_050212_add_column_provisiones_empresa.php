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
        Schema::table('tbl_provisiones_empresa', function (Blueprint $table) {
            $table->unsignedBigInteger('tipo_empleado')->after('creado_por')->nullable();
            $table->foreign('tipo_empleado')->references('id')->on('rrhh_tipo_empleado')->onDelete('set null');
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
