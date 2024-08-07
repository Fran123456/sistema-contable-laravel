<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PaisesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ent_pais')->insert([
            ['pais' => 'El Salvador'],
            ['pais' => 'México'],
            ['pais' => 'Guatemala'],
            ['pais' => 'Honduras'],
            ['pais' => 'Nicaragua'],
            ['pais' => 'Costa Rica'],
            ['pais' => 'Panamá'],
            ['pais' => 'Argentina'],
            ['pais' => 'Colombia'],
            ['pais' => 'Sin asignar'],
        ]);
    }
}
