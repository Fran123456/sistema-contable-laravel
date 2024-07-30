<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FactEstadoFacturacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fact_estado_facturacion')->insert([
            ['estado' => 'Sin facturar'],
            ['estado' => 'Facturado'],
        ]);
    }
}
