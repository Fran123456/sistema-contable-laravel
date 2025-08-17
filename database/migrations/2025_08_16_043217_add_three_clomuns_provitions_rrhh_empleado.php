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
            $table->decimal('monto_aguinaldo', 10, 2);
            $table->decimal('monto_vacaciones', 10, 2);
            $table->decimal('monto_indemnización', 10, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        schema::table('rrhh_empleado', function (Blueprint $table) {
            $table->dropColumn(['monto_aguinaldo', 'monto_vacaciones', 'monto_indemnización']);
        });
    }
};
