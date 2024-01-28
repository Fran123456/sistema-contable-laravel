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
        Schema::table("rrhh_empresa", function (Blueprint $table) {
            $table->string("abreviatura", 10)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("rrhh_empresa", function (Blueprint $table) {
            $table->dropColumn("abreviatura");
        });
    }
};
