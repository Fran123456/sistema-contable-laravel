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
        Schema::create('rrhh_empleado', function (Blueprint $table) {
            $table->id();
            $table->foreign('tipo_empleado_id')->references('id')->on('rrhh_tipo_empleado')->onUpdate('cascade');
            $table->integer('tipo_empleado_id');
            $table->string('nombres', 300);
            $table->string('apellidos', 200);
            $table->string('nombre_completo', 300);
            $table->integer('edad');
            $table->boolean('activo')->default(true);
            $table->string('correo', 200)->nullable();
            $table->string('telefono', 100);
            $table->string('correo_empresarial', 200)->nullable();
            $table->text('direccion');
            $table->string('sexo', 20)->enum('Femenino', 'Masculino');
            $table->dropColumn('codigo');
            $table->dropColumn('foto');
            $table->date('fecha_nacimiento');
            $table->date('fecha_ingreso');
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
        Schema::dropIfExists('rrhh_empleado');
    }
};
