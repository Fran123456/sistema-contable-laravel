<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RRHHTipoIngreso extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rrhh_tipo_ingreso')->insert([
            'tipo' => 'Comisiones',
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s'),
        ]);

        DB::table('rrhh_tipo_ingreso')->insert([
            'tipo' => 'Hora extra diurna',
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s'),
        ]);

        DB::table('rrhh_tipo_ingreso')->insert([
            'tipo' => 'Hora extra nocturna',
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s'),
        ]);

        DB::table('rrhh_tipo_ingreso')->insert([
            'tipo' => 'Bonificaciones',
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s'),
        ]);

        DB::table('rrhh_tipo_ingreso')->insert([
            'tipo' => 'Combustibles',
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s'),
        ]);

        DB::table('rrhh_tipo_ingreso')->insert([
            'tipo' => 'Depreciaciones',
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s'),
        ]);

        DB::table('rrhh_tipo_ingreso')->insert([
            'tipo' => 'Otros',
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s'),
        ]);
    }
}
