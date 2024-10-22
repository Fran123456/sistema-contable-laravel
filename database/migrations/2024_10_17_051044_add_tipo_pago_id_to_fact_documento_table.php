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
        Schema::table('fact_documento', function (Blueprint $table) {
            $table->unsignedBigInteger('tipo_pago_id')->nullable();
            $table->foreign('tipo_pago_id')->references('id')->on('fe_forma_pago')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('fact_documento', function (Blueprint $table) {
            $table->dropForeign(['tipo_pago_id']);
            $table->dropColumn('tipo_pago_id');
        });
    }
};
