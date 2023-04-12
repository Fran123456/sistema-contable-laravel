<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('config')->insert([
            'category' => 'datatable',
            'title' => 'Boton de copiar (Mensaje de confirmación)',
            'description'=>'Boton que nos ayuda a copiar las filas de la tabla, podra modificarse el mensaje de confirmación',
            'field'=> 'copyTitle',
            'value'=>'Se ha copiado los registros correctamente'
        ]);
    }
}
