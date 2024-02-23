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
            $table->unsignedBigInteger('tipo_empleado_id');
            $table->foreign('tipo_empleado_id')->references('id')->on('rrhh_tipo_empleado')->onUpdate('cascade');
            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_id')->references('id')->on('rrhh_empresa')->onUpdate('cascade');
            $table->unsignedBigInteger('id_afp');
            $table->foreign('id_afp')->references('id')->on('rrhh_afp')->onUpdate('cascade');
            $table->string('nombres', 300);
            $table->string('apellidos', 200);
            $table->string('nombre_completo', 300);
            $table->integer('edad');
            $table->boolean('activo')->default(true);
            $table->string('correo', 200)->nullable()->nullable();
            $table->string('telefono', 100);
            $table->string('correo_empresarial', 200)->nullable();
            $table->text('direccion')->nullable();
            $table->string('sexo', 20)->enum('Femenino', 'Masculino');
            $table->string('codigo', 255);
            $table->text('foto')->nullable();
            $table->float("salario", 10, 2)->default(0);
            $table->float("salario_diario", 10, 2)->default(0);
            $table->date('fecha_nacimiento');
            $table->date('fecha_ingreso')->nullable();
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
