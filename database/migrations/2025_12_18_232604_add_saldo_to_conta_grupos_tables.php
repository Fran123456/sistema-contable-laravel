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
        Schema::table('conta_grupo_resultado_rpt', function (Blueprint $table) {
            $table->decimal('saldo', 18, 4)->default(0);
        });

        Schema::table('conta_grupo_sub_resultado_rpt', function (Blueprint $table) {
            $table->decimal('saldo', 18, 4)->default(0);
        });

        Schema::table('conta_grupo_cuenta_resultado_rpt', function (Blueprint $table) {
            $table->decimal('saldo', 18, 4)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('conta_grupo_resultado_rpt', function (Blueprint $table) {
            $table->dropColumn('saldo');
        });

        Schema::table('conta_grupo_sub_resultado_rpt', function (Blueprint $table) {
            $table->dropColumn('saldo');
        });

        Schema::table('conta_grupo_cuenta_resultado_rpt', function (Blueprint $table) {
            $table->dropColumn('saldo');
        });
    }
};
