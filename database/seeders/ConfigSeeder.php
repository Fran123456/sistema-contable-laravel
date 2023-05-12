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
            'title' => 'Boton de copiar (Mostrar/No mostrar)',
            'description'=>'Boton que nos ayuda a copiar las filas de la tabla, podra modificarse 
            el estado, si se desea mostrar o no mostrarse',
            'field'=> 'copyTitleShow',
            'value'=>'1',
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=> date("Y-m-d h:i:s")
        ]);

        DB::table('config')->insert([
            'category' => 'datatable',
            'title' => 'Boton de copiar (Mensaje de confirmación)',
            'description'=>'Boton que nos ayuda a copiar las filas de la tabla, podra modificarse el mensaje de confirmación',
            'field'=> 'copyTitle',
            'value'=>'Se ha copiado los registros correctamente',
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=> date("Y-m-d h:i:s")
        ]);

        DB::table('config')->insert([
            'category' => 'datatable',
            'title' => 'Boton de CSV (Mostrar/No mostrar)',
            'description'=>'Boton de CSV nos ayuda exportar en un archivo CSV, podra modificarse 
             el estado, si se desea mostrar o no mostrarse',
            'field'=> 'csvShow',
            'value'=>'1',
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=> date("Y-m-d h:i:s")
        ]);

        DB::table('config')->insert([
            'category' => 'datatable',
            'title' => 'Boton de Excel (Mostrar/No mostrar)',
            'description'=>'Boton de Excel nos ayuda exportar en un archivo Excel, podra modificarse 
             el estado, si se desea mostrar o no mostrarse',
            'field'=> 'excelShow',
            'value'=>'1',
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=> date("Y-m-d h:i:s")
        ]);

        DB::table('config')->insert([
            'category' => 'datatable',
            'title' => 'Boton de PDF (Mostrar/No mostrar)',
            'description'=>'Boton de PDF nos ayuda exportar en un archivo PDF, podra modificarse 
             el estado, si se desea mostrar o no mostrarse',
            'field'=> 'pdfShow',
            'value'=>'1',
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=> date("Y-m-d h:i:s")
        ]);

        DB::table('config')->insert([
            'category' => 'datatable',
            'title' => 'Boton de imprimir (Mostrar/No mostrar)',
            'description'=>'Boton de imprimir nos ayuda imprimir la tabla, podra modificarse 
             el estado, si se desea mostrar o no mostrarse',
            'field'=> 'printShow',
            'value'=>'1',
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=> date("Y-m-d h:i:s")
        ]);

        DB::table('config')->insert([
            'category' => 'datatable',
            'title' => 'Boton para visibilidad de columnas (Mostrar/No mostrar)',
            'description'=>'Boton que nos ayuda seleccionar que columnas queremos ver, podra modificarse 
             el estado, si se desea mostrar o no mostrarse',
            'field'=> 'visibilityShow',
            'value'=>'1',
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=> date("Y-m-d h:i:s")
        ]);

        DB::table('config')->insert([
            'category' => 'datatable',
            'title' => 'Habilidad para seleccionar filas o no (Mostrar/No mostrar)',
            'description'=>'Acción que nos permite poder seleccionar una fila o varias, 
             el estado, si se desea mostrar o no mostrarse',
            'field'=> 'select',
            'value'=>'1',
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=> date("Y-m-d h:i:s")
        ]);

        DB::table('config')->insert([
            'category' => 'general',
            'title' => 'Logo de la aplicación',
            'description'=>'Acción que nos permite poder modificar el logo de la aplicación',
            'field'=> 'logo',
            'value'=>'assets/images/logo/logo.png',
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=>date("Y-m-d h:i:s"),
        ]);

        DB::table('config')->insert([
            'category' => 'contabilidad',
            'title' => 'Cantidad de digitos del correlativo de partidas contables',
            'description'=>'Acción que nos permite poder modificar la cantidad de digitos que tendra el correlativo al crear partidads contables',
            'field'=> 'correlativo',
            'value'=>'5',
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=>date("Y-m-d h:i:s"),
        ]);
    }
}
