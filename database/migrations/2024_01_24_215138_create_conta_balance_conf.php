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
        Schema::create('conta_balance_conf', function (Blueprint $table) {
            $table->id();
            $table->string('categoria', 255);
            $table->string('titulo', 255)->default(null);
            $table->text('descripcion')->default(null)->nullable();
            $table->string('campo', 255)->default(null);
            $table->string('valor', 255)->default(null);
            $table->bigInteger('empresa_id');
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
        Schema::dropIfExists('conta_balance_conf');
    }
};
