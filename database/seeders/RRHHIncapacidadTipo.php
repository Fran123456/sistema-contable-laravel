<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RRHHIncapacidadTipo extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("rrhh_incapacidad_tipo")->insert([
            'tipo' => 'Por enfermedad común',
            'activo'=> '1',
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=>date("Y-m-d h:i:s"),
        ]);

        DB::table("rrhh_incapacidad_tipo")->insert([
            'tipo' => 'Por accidente de trabajo',
            'activo'=> '1',
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=>date("Y-m-d h:i:s"),
        ]);

        DB::table("rrhh_incapacidad_tipo")->insert([
            'tipo' => 'Por maternidad',
            'activo'=> '1',
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=>date("Y-m-d h:i:s"),
        ]);
    }
}
