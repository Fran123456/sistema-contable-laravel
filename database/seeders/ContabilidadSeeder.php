<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContabilidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        DB::table('conta_nivel_cuenta_contable')->insert([
            'nivel' => 'Nivel 1',
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=>date("Y-m-d h:i:s"),
        ]);
        DB::table('conta_nivel_cuenta_contable')->insert([
            'nivel' => 'Nivel 2',
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=>date("Y-m-d h:i:s"),
        ]);
        DB::table('conta_nivel_cuenta_contable')->insert([
            'nivel' => 'Nivel 3',
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=>date("Y-m-d h:i:s"),
        ]);
        DB::table('conta_nivel_cuenta_contable')->insert([
            'nivel' => 'Nivel 4',
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=>date("Y-m-d h:i:s"),
        ]);
        DB::table('conta_nivel_cuenta_contable')->insert([
            'nivel' => 'Nivel 5',
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=>date("Y-m-d h:i:s"),
        ]);
        DB::table('conta_nivel_cuenta_contable')->insert([
            'nivel' => 'Nivel 6',
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=>date("Y-m-d h:i:s"),
        ]);

        DB::table('conta_clasificacion_cuenta_contable')->insert([
            'clasificacion' => 'clasificacion',
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=>date("Y-m-d h:i:s"),
        ]);
        DB::table('conta_clasificacion_cuenta_contable')->insert([
            'clasificacion' => 'detalle',
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=>date("Y-m-d h:i:s"),
        ]);

        
    }
}
