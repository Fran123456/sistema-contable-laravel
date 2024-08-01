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
        Schema::create('conta_utilidad_rpt', function (Blueprint $table) {
            $table->id();
            $table->string('utilidad',200);
            $table->decimal('saldo',12,2)->nullable();
            $table->unsignedBigInteger('empresa_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conta_utilidad_rpt');
    }
};
