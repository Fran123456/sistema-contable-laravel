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
        Schema::create('conta_rubro_cuentas_rpt', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cuenta_id')->constrained('conta_cuenta_contable');
            $table->string('numero_cuenta')->nullable();
            $table->foreignId('grupo_id')->constrained('conta_rubro_grupo_rpt');
            $table->foreignId('rubro_id')->constrained('conta_rubro_general_rpt');
            $table->string('signo')->nullable();
            $table->decimal('saldo', 12,2)->nullable();
            $table->foreignId('empresa_id')->constrained('rrhh_empresa');
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
        Schema::dropIfExists('conta_rubro_cuentas_rpt');
    }
};
