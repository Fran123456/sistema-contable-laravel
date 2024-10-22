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
        Schema::create('fe_forma_pago', function (Blueprint $table) {
            $table->id();
            $table->string('codigo')->unique();
            $table->string('valor')->unique();
            $table->timestamps();
            $table->boolean('activo')->default(true);
            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_id')->references('id')->on('rrhh_empresa')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fe_forma_pago', function (Blueprint $table) {
            Schema::dropIfExists('fe_forma_pago');
        });
    }
};
