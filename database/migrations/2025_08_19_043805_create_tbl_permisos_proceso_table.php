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
        Schema::create('tbl_permisos_proceso', function (Blueprint $table) {
    $table->id('id_permiso');
    $table->foreignId('rol_id')->constrained('tbl_roles', 'id_rol');
    $table->string('modulo', 50);
    $table->string('proceso', 50);
    $table->string('subproceso', 50)->nullable();
    $table->boolean('permiso_lectura')->default(false);
    $table->boolean('permiso_escritura')->default(false);
    $table->boolean('permiso_eliminar')->default(false);
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
        Schema::dropIfExists('tbl_permisos_proceso');
    }
};
