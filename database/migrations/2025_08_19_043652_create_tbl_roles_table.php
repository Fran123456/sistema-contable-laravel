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
       Schema::create('tbl_roles', function (Blueprint $table) {
    $table->id('id_rol');
    $table->string('nombre_rol', 50)->unique();
    $table->text('descripcion')->nullable();
    $table->string('creado_por',100)->nullable(); // referencia al usuario que creó, no obligatorio
    $table->timestamp('fecha_creacion')->useCurrent();
    $table->boolean('estado')->default(true);
});

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_roles');
    }
};
