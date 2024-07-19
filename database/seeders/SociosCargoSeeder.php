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
            ['cargo' => 'Programador Junior', 'descripcion' => 'Responsable del desarrollo de software con supervisión.'],
            ['cargo' => 'Programador Senior', 'descripcion' => 'Responsable del desarrollo de software con amplia experiencia.'],
            ['cargo' => 'Desarrollador PHP', 'descripcion' => 'Encargado de desarrollar aplicaciones utilizando PHP.'],
            ['cargo' => 'Desarrollador Laravel', 'descripcion' => 'Especialista en el desarrollo con el framework Laravel.'],
            ['cargo' => 'Desarrollador Frontend', 'descripcion' => 'Encargado de la implementación del lado del cliente.'],
            ['cargo' => 'Desarrollador Backend', 'descripcion' => 'Encargado de la implementación del lado del servidor.'],
            ['cargo' => 'Desarrollador Full Stack', 'descripcion' => 'Encargado de la implementación tanto del frontend como del backend.'],
            ['cargo' => 'Analista de Sistemas', 'descripcion' => 'Responsable del análisis y diseño de sistemas informáticos.'],
            ['cargo' => 'Ingeniero de Software', 'descripcion' => 'Encargado del desarrollo y mantenimiento de software.'],
            ['cargo' => 'Administrador de Bases de Datos', 'descripcion' => 'Responsable de la gestión de bases de datos.'],
            ['cargo' => 'Ingeniero de Soporte', 'descripcion' => 'Encargado de brindar soporte técnico a los usuarios.'],
            ['cargo' => 'QA Tester', 'descripcion' => 'Responsable de asegurar la calidad del software mediante pruebas.'],
            ['cargo' => 'Arquitecto de Software', 'descripcion' => 'Responsable del diseño de la arquitectura del software.'],
            ['cargo' => 'DevOps Engineer', 'descripcion' => 'Encargado de la integración y entrega continua.'],
            ['cargo' => 'Administrador de Redes', 'descripcion' => 'Responsable de la gestión y mantenimiento de redes.'],
        ];

        foreach ($cargos as $cargo) {
            DB::table('socios_cargo')->insert(array_merge($cargo, [
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]));
        }
    }
}
