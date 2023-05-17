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
            'empresa_id' => 1,
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=>date("Y-m-d h:i:s"),
        ]);
        DB::table('conta_nivel_cuenta_contable')->insert([
            'nivel' => 'Nivel 2',
            'empresa_id' => 1,
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=>date("Y-m-d h:i:s"),
        ]);
        DB::table('conta_nivel_cuenta_contable')->insert([
            'nivel' => 'Nivel 3',
            'empresa_id' => 1,
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=>date("Y-m-d h:i:s"),
        ]);
        DB::table('conta_nivel_cuenta_contable')->insert([
            'nivel' => 'Nivel 4',
            'empresa_id' => 1,
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=>date("Y-m-d h:i:s"),
        ]);
        DB::table('conta_nivel_cuenta_contable')->insert([
            'nivel' => 'Nivel 5',
            'empresa_id' => 1,
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=>date("Y-m-d h:i:s"),
        ]);
        DB::table('conta_nivel_cuenta_contable')->insert([
            'nivel' => 'Nivel 6',
            'empresa_id' => 1,
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=>date("Y-m-d h:i:s"),
        ]);

        DB::table('conta_clasificacion_cuenta_contable')->insert([
            'clasificacion' => 'Mayor',
            'empresa_id' => 1,
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=>date("Y-m-d h:i:s"),
        ]);
        DB::table('conta_clasificacion_cuenta_contable')->insert([
            'clasificacion' => 'detalle',
            'empresa_id' => 1,
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=>date("Y-m-d h:i:s"),
        ]);

        
    }
}
