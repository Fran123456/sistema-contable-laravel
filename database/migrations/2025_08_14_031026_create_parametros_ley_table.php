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
        Schema::create('parametros_ley', function (Blueprint $table) {
            $table->id('id_parametro');
            $table->enum('tipo', [
                'ISSS',
                'AFP',
                'ISPFA',
                'ISR',
                'HORAS_EXTRA',
                'INCAPACIDADES',
                'TOPE_INDEMIZACION'
            ]);
            $table->decimal('valor', 10, 4);
            $table->unsignedBigInteger('empresa_id');
            $table->date('fecha_inicio');
            $table->date('fecha_fin')->nullable();
            $table->enum('estado', ['vigente', 'vencido'])->default('vigente');
            $table->unsignedBigInteger('creado_por');
            $table->timestamps();

            //Llaves foraneas
            $table->foreign('empresa_id')->references('id')->on('config_empresas')->onDelete('cascade');
            $table->foreign('creado_por')->references('id')->on('users')->onDelete('cascade');
        });

        //Tabla del ISR
        Schema::create('isr', function (Blueprint $table) {
            $table->id();
            $table->decimal('desde', 10, 2);
            $table->decimal('hasta', 10, 2);
            $table->decimal('porcentaje', 5, 2);
            $table->decimal('cuota_fija', 10, 2)->default(0);
            $table->unsignedBigInteger('empresa_id');
            $table->timestamps();

            //Llave foranea
            $table->foreign('empresa_id')->references('id')->on('config_empresas')->onDelete('cascade');
        });

        //Tabla de horas extras
        Schema::create('horas_extra', function (Blueprint $table) {
            $table->id();
            $table->string('tipo', 50);
            $table->decimal('porcentaje', 5, 2);
            $table->unsignedBigInteger('empresa_id');
            $table->timestamps();

            //Llave foranea
            $table->foreign('empresa_id')->references('id')->on('config_empresas')->onDelete('cascade');
        });

        //Tabla de la bitacora
        Schema::create('bitacora_parametros_ley', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parametro_id');
            $table->enum('accion', ['crear', 'modificar', 'eliminar']);
            $table->unsignedBigInteger('usuario_id');
            $table->text('detalle')->nullable();
            $table->timestamps();

            //Llaves foraneas
            $table->foreign('parametro_id')->references('id_parametro')->on('parametros_ley')->onDelete('cascade');
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bitacora_parametros_ley');
        Schema::dropIfExists('horas_extra');
        Schema::dropIfExists('isr');
        Schema::dropIfExists('parametros_ley');
    }
};
