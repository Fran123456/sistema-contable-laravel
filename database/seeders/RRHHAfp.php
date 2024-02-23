<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RRHHAfp extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rrhh_afp')->insert([
            'id_empresa' => 1,
            'afp' => 'AFP Crecer',
            'porciento_empleador' => 7.35,
            'porciento_empleado' => 7.25,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('rrhh_afp')->insert([
            'id_empresa' => 1,
            'afp' => 'AFP Confia',
            'porciento_empleador' => 7.25,
            'porciento_empleado' => 7.25,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
