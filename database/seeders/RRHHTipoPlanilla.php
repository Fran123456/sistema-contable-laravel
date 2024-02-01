<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RRHHTipoPlanilla extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("rrhh_tipo_planilla")->insert([
            'tipo' => 'salario',
        ]);

        DB::table("rrhh_tipo_planilla")->insert([
            'tipo' => 'vacaciones',
        ]);

        DB::table("rrhh_tipo_planilla")->insert([
            'tipo' => 'aguinaldo',
        ]);

        DB::table("rrhh_tipo_planilla")->insert([
            'tipo' => 'indemnizaciones',
        ]);

        DB::table("rrhh_tipo_planilla")->insert([
            'tipo' => 'bonificaciones',
        ]);

        DB::table("rrhh_tipo_planilla")->insert([
            'tipo' => 'comisiones',
        ]);
    }
}
