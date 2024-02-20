<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RRHHTipoPermiso extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("rrhh_tipo_permiso")->insert([
            'tipo' => 'Permiso con goce de sueldo',
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at'=> date('Y-m-d h:i:s'),
        ]);

        DB::table("rrhh_tipo_permiso")->insert([
            'tipo' => 'Permiso sin goce de sueldo',
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s'),
        ]);

        DB::table("rrhh_tipo_permiso")->insert([
            'tipo' => 'Ausencia injustificada',
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s'),
        ]);

        DB::table("rrhh_tipo_permiso")->insert([
            'tipo' => 'Descuento del día 7',
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s'),
        ]);

        DB::table("rrhh_tipo_permiso")->insert([
            'tipo' => 'Otros',
            'created_at' => date('Y-m-d h:i:s'),
            'updated_at' => date('Y-m-d h:i:s'),
        ]);
    }
}
