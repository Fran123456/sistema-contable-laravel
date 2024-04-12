<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FactTipoDocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fact_tipo_documento')->insert([
            'codigo' => '01',
            'valor'=> 'Factura',
            'empresa_id'=>'',
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=> date("Y-m-d h:i:s")
        ]);

        DB::table('fact_tipo_documento')->insert([
            'codigo' => '03',
            'valor' => 'Comprobante de crédito fiscal',
            'empresa_id' =>'',
            'created_at' =>date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s")
        ]);

        DB::table('fact_tipo_documento')->insert([
            'codigo' => '04',
            'valor' => 'Nota de remisión',
            'empresa_id' =>'',
            'created_at' =>date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s")
        ]);

        DB::table('fact_tipo_documento')->insert([
            'codigo' => '05',
            'valor' => 'Nota de crédito',
            'empresa_id' =>'',
            'created_at' =>date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s")
        ]);

        DB::table('fact_tipo_documento')->insert([
            'codigo' => '06',
            'valor' => 'Nota de débito',
            'empresa_id' =>'',
            'created_at' =>date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s")
        ]);

        DB::table('fact_tipo_documento')->insert([
            'codigo' => '07',
            'valor' => 'Comprobante de retención',
            'empresa_id' =>'',
            'created_at' =>date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s")
        ]);

        DB::table('fact_tipo_documento')->insert([
            'codigo' => '08',
            'valor' => 'Comprobante de liquidación',
            'empresa_id' =>'',
            'created_at' =>date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s")
        ]);

        DB::table('fact_tipo_documento')->insert([
            'codigo' => '09',
            'valor' => 'Documento contable de liquidación',
            'empresa_id' =>'',
            'created_at' =>date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s")
        ]);

        DB::table('fact_tipo_documento')->insert([
            'codigo' => '11',
            'valor' => 'Facturas de exportación',
            'empresa_id' =>'',
            'created_at' =>date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s")
        ]);
        
        DB::table('fact_tipo_documento')->insert([
            'codigo' => '14',
            'valor' => 'Factura de sujeto excluido',
            'empresa_id' =>'',
            'created_at' =>date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s")
        ]);

        DB::table('fact_tipo_documento')->insert([
            'codigo' => '15',
            'valor' => 'Comprobante de donación',
            'empresa_id' =>'',
            'created_at' =>date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s")
        ]);
        
    }
}
