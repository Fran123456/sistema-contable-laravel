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
            'nivel' => '1',
            'digitos' => '1',
            'empresa_id' => 1,
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=>date("Y-m-d h:i:s"),
        ]);
        DB::table('conta_nivel_cuenta_contable')->insert([
            'nivel' => '2',
            'digitos' => '2',
            'empresa_id' => 1,
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=>date("Y-m-d h:i:s"),
        ]);
        DB::table('conta_nivel_cuenta_contable')->insert([
            'nivel' => '3',
            'digitos' => '4',
            'empresa_id' => 1,
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=>date("Y-m-d h:i:s"),
        ]);
        DB::table('conta_nivel_cuenta_contable')->insert([
            'nivel' => '4',
            'digitos' => '6',
            'empresa_id' => 1,
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=>date("Y-m-d h:i:s"),
        ]);
        DB::table('conta_nivel_cuenta_contable')->insert([
            'nivel' => '5',
            'digitos' => '8',
            'empresa_id' => 1,
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=>date("Y-m-d h:i:s"),
        ]);
        DB::table('conta_nivel_cuenta_contable')->insert([
            'nivel' => '6',
            'digitos' => '10',
            'empresa_id' => 1,
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=>date("Y-m-d h:i:s"),
        ]);


        DB::table('conta_nivel_cuenta_contable')->insert([
            'nivel' => '7',
            'digitos' => '12',
            'empresa_id' => 1,
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=>date("Y-m-d h:i:s"),
        ]);


        DB::table('conta_clasificacion_cuenta_contable')->insert([
            'clasificacion' => 'mayor',
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
