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
            $table->bigInteger('cuenta_id')->nullable();
            $table->string('codigo', 200)->nullable();
            $table->string('nombre_cuenta', 200)->nullable();
            $table->string('balance', 100)->nullable();
            $table->string('grupo', 100)->nullable();
            $table->integer('mayor')->nullable();
            $table->integer('orden')->nullable();
            $table->string('anexo', 70)->nullable();
            $table->decimal('cantidad', 18, 2)->nullable();
            $table->integer('underline')->nullable();
            $table->integer('espacio')->nullable();
            $table->integer('bold')->nullable();
            $table->bigInteger('empresa_id')->nullable();
            $table->boolean('editar');
            $table->timestamps();

            // $table->string('categoria', 255);
            // $table->string('titulo', 255)->default(null);
            // $table->text('descripcion')->default(null)->nullable();
            // $table->string('campo', 255)->default(null);
            // $table->string('valor', 255)->default(null);
            // $table->string('tipo', 255)->nullable();
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
