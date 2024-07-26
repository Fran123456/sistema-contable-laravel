<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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
            ['tipo' => 'Comprobante de Credito Fiscal'],
            ['tipo' => 'Factura de exportación'],
            ['tipo' => 'Factura'],
            ['tipo' => 'Nota de credito'],
            ['tipo' => 'Factura de sujeto excluido'],
            ['tipo' => 'Nota de debito'],
        ]);
    }
}
