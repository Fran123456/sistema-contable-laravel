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
        Schema::create('tbl_bitacora_accesos', function (Blueprint $table) {
    $table->id();
    $table->foreignId('usuario_id')->constrained('tbl_usuarios', 'id_usuario');
    $table->string('ip', 45);
    $table->string('modulo', 50);
    $table->string('accion', 50);
    $table->timestamp('fecha_acceso')->useCurrent();
});

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_bitacora_accesos');
    }
};
