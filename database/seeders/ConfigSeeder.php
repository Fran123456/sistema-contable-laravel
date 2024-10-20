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
        //Seeder para config categoria DATATABLE
        DB::table('config')->insert([
            'category' => 'datatable',
            'title' => 'Boton de copiar (Mostrar/No mostrar)',
            'description'=>'Boton que nos ayuda a copiar las filas de la tabla, podra modificarse 
            el estado, si se desea mostrar o no mostrarse',
            'field'=> 'copyTitleShow',
            'value'=>'1',
            'empresa_id' => 1,
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=> date("Y-m-d h:i:s")
        ]);

        DB::table('config')->insert([
            'category' => 'datatable',
            'title' => 'Boton de copiar (Mensaje de confirmación)',
            'description'=>'Boton que nos ayuda a copiar las filas de la tabla, podra modificarse el mensaje de confirmación',
            'field'=> 'copyTitle',
            'value'=>'Se ha copiado los registros correctamente',
            'empresa_id' => 1,
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
            'empresa_id' => 1,
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
            'empresa_id' => 1,
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
            'empresa_id' => 1,
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
            'empresa_id' => 1,
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
            'empresa_id' => 1,
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
            'empresa_id' => 1,
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=> date("Y-m-d h:i:s")
        ]);


        //Seeder para config categoria GENERAL
        DB::table('config')->insert([
            'category' => 'general',
            'title' => 'Logo de la aplicación',
            'description'=>'Acción que nos permite poder modificar el logo de la aplicación',
            'field'=> 'logo',
            'value'=>'assets/images/logo/logo.png',
            'empresa_id' => 1,
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=>date("Y-m-d h:i:s"),
        ]);

        

        //Seeder para config categoria PRODUCTO
        DB::table('config')->insert([
            'category' => 'producto',
            'title' => 'Identificador de producto',
            'description'=>'Acción que nos permite asignarle un identificador a cada producto, puede ser automatico o manual',
            'field'=> 'identificadorProducto',
            'value'=>'0',
            'empresa_id' => 1,
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=>date("Y-m-d h:i:s"),
        ]);
        

        //Seeder para config categoria CONTABILIDAD
        DB::table('config')->insert([
            'category' => 'contabilidad',
            'title' => 'Partida de venta/costo para facturación',
            'description'=>'Crear una partida de venta/costo por documento facturado.',
            'field'=> 'partidaVentaCosto',
            'value'=>'1',
            'empresa_id' => 1,
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=>date("Y-m-d h:i:s"),
        ]);

        DB::table('config')->insert([
            'category' => 'contabilidad',
            'title' => 'Cantidad de digitos del correlativo de partidas contables',
            'description'=>'Acción que nos permite poder modificar la cantidad de digitos que tendra el correlativo al crear partidads contables',
            'field'=> 'correlativo',
            'value'=>'5',
            'empresa_id' => 1,
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=>date("Y-m-d h:i:s"),
        ]);

        DB::table('config')->insert([
            'category' => 'contabilidad',
            'title' => 'Partida de venta/costo  se realizara via cuenta bolson?',
            'description'=>'Determina si la partida de venta/costo se hara para cuentas diferentes por cliente o una solo cuenta bozon por ejemplo: “cuentas por cobrar a clientes” donde SI = si ocuparemos cuenta bolson, NO = ocuparemos cuentas por cliente',
            'field'=> 'partidaVentaCostoCuentaClientes',
            'value'=>'1',
            'empresa_id' => 1,
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=>date("Y-m-d h:i:s"),
        ]);



        //Seeder para config categoria FACTURACION_ELECTRONICA
        DB::table('config')->insert([
            'category' => 'facturacion_electronica',
            'title' => 'Habilitar facturación electronica',
            'description'=>'Indica si se generara DTE para factura electronica',
            'field'=> 'fe_habilitar',
            'value'=>'0',
            'empresa_id' => 1,
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=>date("Y-m-d h:i:s"),
        ]);





        //CONFIGS PARA PARTIDAS AUTOMATICAS
        DB::table('conf_partidas_automaticas')->insert([
            'cuenta_id' => null,
            'codigo' => null,
            'descripcion'=>'INGRESO POR VENTA DEL DIA',
            'titulo'=>'INGRESO POR VENTA DEL DIA',
            'tipo'=> 'partida_venta',
            'empresa_id' => 1,
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=>date("Y-m-d h:i:s"),
        ]);
        DB::table('conf_partidas_automaticas')->insert([
            'cuenta_id' => null,
            'codigo' => null,
            'descripcion'=>'IVA-DEBITO FISCAL POR VENTAS DEL DIA',
            'titulo'=>'IVA-DEBITO FISCAL POR VENTAS DEL DIA',
            'tipo'=> 'partida_venta',
            'empresa_id' => 1,
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=>date("Y-m-d h:i:s"),
        ]);
        DB::table('conf_partidas_automaticas')->insert([
            'cuenta_id' => null,
            'codigo' => null,
            'descripcion'=>'CUENTA POR COBRAR A CLIENTES DEL EXTERIOR',
            'titulo'=>'CUENTA POR COBRAR A CLIENTES DEL EXTERIOR',
            'tipo'=> 'partida_venta',
            'empresa_id' => 1,
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=>date("Y-m-d h:i:s"),
        ]);
        DB::table('conf_partidas_automaticas')->insert([
            'cuenta_id' => null,
            'codigo' => null,
            'descripcion'=>'CUENTA POR COBRAR A CLIENTES LOCALES',
            'titulo'=>'CUENTA POR COBRAR A CLIENTES LOCALES',
            'tipo'=> 'partida_venta',
            'empresa_id' => 1,
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=>date("Y-m-d h:i:s"),
        ]);



    }
}
