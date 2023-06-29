<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigReporteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       //CONTABILIDAD
       //REPORTE DE BALANCE DE SALDOS
        DB::table('config_reporte')->insert([
            'reporte' => 'Reporte de balance de saldos',
            'icono' => '<i class="far fa-file"></i>',
            'modulo'=> 'contabilidad',
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=>date("Y-m-d h:i:s"),
        ]);

        DB::table('config_reporte_campo')->insert([
            'tipo' => 'date',
            'label'=>'Fecha de inicio',
            'requerido' => true,
            'valor'=> null,
            'reporte_id'=>1,
            'modulo'=>'contabilidad',
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=>date("Y-m-d h:i:s"),
            'name'=>'fechai'
        ]);

        DB::table('config_reporte_campo')->insert([
            'tipo' => 'date',
            'label'=>'Fecha de fin',
            'requerido' => true,
            'valor'=> null,
            'reporte_id'=>1,
            'modulo'=>'contabilidad',
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=>date("Y-m-d h:i:s"),
            'name'=>'fechaf'
        ]);

    }
}
