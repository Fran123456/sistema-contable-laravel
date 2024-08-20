<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SociosCargoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cargos = [
            ['cargo' => 'Programador Junior', 'descripcion' => 'Responsable del desarrollo de software con supervisión.', 'empresa_id' =>1],
            ['cargo' => 'Programador Senior', 'descripcion' => 'Responsable del desarrollo de software con amplia experiencia.', 'empresa_id' =>1],
            ['cargo' => 'Desarrollador PHP', 'descripcion' => 'Encargado de desarrollar aplicaciones utilizando PHP.', 'empresa_id' =>1],
            ['cargo' => 'Desarrollador Laravel', 'descripcion' => 'Especialista en el desarrollo con el framework Laravel.', 'empresa_id' =>1],
            ['cargo' => 'Desarrollador Frontend', 'descripcion' => 'Encargado de la implementación del lado del cliente.', 'empresa_id' =>1],
            ['cargo' => 'Desarrollador Backend', 'descripcion' => 'Encargado de la implementación del lado del servidor.', 'empresa_id' =>1],
            ['cargo' => 'Desarrollador Full Stack', 'descripcion' => 'Encargado de la implementación tanto del frontend como del backend.', 'empresa_id' =>1],
            ['cargo' => 'Analista de Sistemas', 'descripcion' => 'Responsable del análisis y diseño de sistemas informáticos.', 'empresa_id' =>1],
            ['cargo' => 'Ingeniero de Software', 'descripcion' => 'Encargado del desarrollo y mantenimiento de software.', 'empresa_id' =>1],
            ['cargo' => 'Administrador de Bases de Datos', 'descripcion' => 'Responsable de la gestión de bases de datos.', 'empresa_id' =>1],
            ['cargo' => 'Ingeniero de Soporte', 'descripcion' => 'Encargado de brindar soporte técnico a los usuarios.', 'empresa_id' =>1],
            ['cargo' => 'QA Tester', 'descripcion' => 'Responsable de asegurar la calidad del software mediante pruebas.', 'empresa_id' =>1],
            ['cargo' => 'Arquitecto de Software', 'descripcion' => 'Responsable del diseño de la arquitectura del software.', 'empresa_id' =>1],
            ['cargo' => 'DevOps Engineer', 'descripcion' => 'Encargado de la integración y entrega continua.', 'empresa_id' =>1],
            ['cargo' => 'Administrador de Redes', 'descripcion' => 'Responsable de la gestión y mantenimiento de redes.', 'empresa_id' =>1],
        ];

        foreach ($cargos as $cargo) {
            DB::table('socios_cargo')->insert(array_merge($cargo, [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]));
        }


    }
}