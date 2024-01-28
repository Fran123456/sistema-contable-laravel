<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoEmpleadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rrhh_tipo_empleado')->insert([
            'tipo'=> 'Planilla',
        ]);

        DB::table('rrhh_tipo_empleado')->insert([
            'tipo'=> 'Servicio profesional',
        ]);

        DB::table('rrhh_tipo_empleado')->insert([
            'tipo'=> 'Jubilado',
        ]);
    }
}
