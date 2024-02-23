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
        Schema::table('rrhh_empleado', function(Blueprint $table){
            $table->unsignedBigInteger('id_afp')->nullable();
            $table->foreign('id_afp')->references('id')->on('rrhh_afp')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rrhh_empleado', function(Blueprint $table){
            $table->dropColumn('id_afp');
        });
    }
};
