<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeDepartamentosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fe_departamentos')->insert([
            ['codigo' => '00', 'valor' => 'otro país'],
            ['codigo' => '01', 'valor' => 'Ahuachapán'],
            ['codigo' => '02', 'valor' => 'Santa Ana'],
            ['codigo' => '03', 'valor' => 'Sonsonate'],
            ['codigo' => '04', 'valor' => 'Chalatenango'],
            ['codigo' => '05', 'valor' => 'La Libertad'],
            ['codigo' => '06', 'valor' => 'San Salvador'],
            ['codigo' => '07', 'valor' => 'Cuscatlán'],
            ['codigo' => '08', 'valor' => 'La Paz'],
            ['codigo' => '09', 'valor' => 'Cabañas'],
            ['codigo' => '10', 'valor' => 'San Vicente'],
            ['codigo' => '11', 'valor' => 'Usulután'],
            ['codigo' => '12', 'valor' => 'San Miguel'],
            ['codigo' => '13', 'valor' => 'Morazán'],
            ['codigo' => '14', 'valor' => 'La Unión'],
        ]);
    }
}
