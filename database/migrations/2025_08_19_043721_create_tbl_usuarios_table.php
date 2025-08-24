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
       Schema::create('tbl_usuarios', function (Blueprint $table) {
    $table->id('id_usuario');
    $table->string('nombre_completo', 100);
    $table->string('correo')->unique();
    $table->string('usuario_login', 50)->unique();
    $table->string('contrasena_hash');
    $table->foreignId('rol_id')->constrained('tbl_roles', 'id_rol');
    $table->boolean('estado')->default(true);
    $table->timestamp('fecha_creacion')->useCurrent();
    $table->string('creado_por', 100)->nullable(); // FK a otro usuario opcional
    $table->integer('intentos_fallidos')->default(0);
    $table->timestamp('bloqueado_hasta')->nullable();
});

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_usuarios');
    }
};
