<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfPartidasAutomaticasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('conf_partidas_automaticas')->insert([
            'cuenta_id' => null,
            'tipo' => 'partida_venta',
            'empresa_id' => 1,
            'descripcion' => "Cuenta contable asignada a ingreso por ventas",
            'titulo'=>'cuenta de ventas',
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=>date("Y-m-d h:i:s"),
        ]);

        DB::table('conf_partidas_automaticas')->insert([
            'cuenta_id' => null,
            'tipo' => 'partida_venta',
            'empresa_id' => 1,
            'descripcion' => "Cuenta contable asignada a efectivo o caja chica (en el caso sea pago de contado)",
            'titulo'=>'cuenta de efectivo',
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=>date("Y-m-d h:i:s"),
        ]);

        DB::table('conf_partidas_automaticas')->insert([
            'cuenta_id' => null,
            'tipo' => 'partida_venta',
            'empresa_id' => 1,
            'descripcion' => "Cuenta contable asignada al IVA",
            'titulo'=>'cuenta de IVA',
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=>date("Y-m-d h:i:s"),
        ]);

        DB::table('conf_partidas_automaticas')->insert([
            'cuenta_id' => null,
            'tipo' => 'partida_venta',
            'empresa_id' => 1,
            'descripcion' => "Cuenta contable asignada a retención 1%",
            'titulo'=>'cuenta de retención 1%',
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=>date("Y-m-d h:i:s"),
        ]);

        DB::table('conf_partidas_automaticas')->insert([
            'cuenta_id' => null,
            'tipo' => 'partida_venta',
            'empresa_id' => 1,
            'descripcion' => "Cuenta contable asignada a Renta",
            'titulo'=>'cuenta de renta',
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=>date("Y-m-d h:i:s"),
        ]);
    }
}
