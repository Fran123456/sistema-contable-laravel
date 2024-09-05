<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeTipoDocumentosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fe_tipo_documentos')->insert([
            ['codigo' => '01', 'valor' => 'Factura'],
            ['codigo' => '03', 'valor' => 'Comprobante de crédito fiscal'],
            ['codigo' => '04', 'valor' => 'Nota de remisión'],
            ['codigo' => '05', 'valor' => 'Nota de crédito'],
            ['codigo' => '06', 'valor' => 'Nota de débito'],
            ['codigo' => '07', 'valor' => 'Comprobante de retención'],
            ['codigo' => '08', 'valor' => 'Comprobante de liquidación'],
            ['codigo' => '09', 'valor' => 'Documento contable de liquidación'],
            ['codigo' => '11', 'valor' => 'Facturas de exportación'],
            ['codigo' => '14', 'valor' => 'Factura de sujeto excluido'],
            ['codigo' => '15', 'valor' => 'Comprobante de donación'],
        ]);
    }
}
