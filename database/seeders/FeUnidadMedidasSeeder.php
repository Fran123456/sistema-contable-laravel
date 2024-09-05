<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FeUnidadMedidasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fe_unidad_medidas')->insert([
            ['codigo' => '01', 'valor' => 'Metro'],
            ['codigo' => '02', 'valor' => 'Yarda'],
            ['codigo' => '03', 'valor' => 'Vara'],
            ['codigo' => '04', 'valor' => 'Pie'],
            ['codigo' => '05', 'valor' => 'Pulgada'],
            ['codigo' => '06', 'valor' => 'Milímetro'],
            ['codigo' => '08', 'valor' => 'Milla cuadrada'],
            ['codigo' => '09', 'valor' => 'Kilómetro cuadrado'],
            ['codigo' => '10', 'valor' => 'Hectárea'],
            ['codigo' => '11', 'valor' => 'Manzana'],
            ['codigo' => '12', 'valor' => 'Acre'],
            ['codigo' => '13', 'valor' => 'Metro cuadrado'],
            ['codigo' => '14', 'valor' => 'Yarda cuadrada'],
            ['codigo' => '15', 'valor' => 'Vara cuadrada'],
            ['codigo' => '16', 'valor' => 'Pie cuadrado'],
            ['codigo' => '17', 'valor' => 'Pulgada cuadrada'],
            ['codigo' => '18', 'valor' => 'Metro cúbico'],
            ['codigo' => '19', 'valor' => 'Yarda cúbica'],
            ['codigo' => '20', 'valor' => 'Barril'],
            ['codigo' => '21', 'valor' => 'Pie cúbico'],
            ['codigo' => '22', 'valor' => 'Galón'],
            ['codigo' => '23', 'valor' => 'Litro'],
            ['codigo' => '24', 'valor' => 'Botella'],
            ['codigo' => '25', 'valor' => 'Pulgada cúbica'],
            ['codigo' => '26', 'valor' => 'Mililitro'],
            ['codigo' => '27', 'valor' => 'Onza fluida'],
            ['codigo' => '29', 'valor' => 'Tonelada métrica'],
            ['codigo' => '30', 'valor' => 'Tonelada'],
            ['codigo' => '31', 'valor' => 'Quintal métrico'],
            ['codigo' => '32', 'valor' => 'Quintal'],
            ['codigo' => '33', 'valor' => 'Arroba'],
            ['codigo' => '34', 'valor' => 'Kilogramo'],
            ['codigo' => '35', 'valor' => 'Libra troy'],
            ['codigo' => '36', 'valor' => 'Libra'],
            ['codigo' => '37', 'valor' => 'Onza troy'],
            ['codigo' => '38', 'valor' => 'Onza'],
            ['codigo' => '39', 'valor' => 'Gramo'],
            ['codigo' => '40', 'valor' => 'Miligramo'],
            ['codigo' => '42', 'valor' => 'Megawatt'],
            ['codigo' => '43', 'valor' => 'Kilowatt'],
            ['codigo' => '44', 'valor' => 'Watt'],
            ['codigo' => '45', 'valor' => 'Megavoltio-amperio'],
            ['codigo' => '46', 'valor' => 'Kilovoltio-amperio'],
            ['codigo' => '47', 'valor' => 'Voltio-amperio'],
            ['codigo' => '49', 'valor' => 'Gigawatt-hora'],
            ['codigo' => '50', 'valor' => 'Megawatt-hora'],
            ['codigo' => '51', 'valor' => 'Kilowatt-hora'],
            ['codigo' => '52', 'valor' => 'Watt-hora'],
            ['codigo' => '53', 'valor' => 'Kilovoltio'],
            ['codigo' => '54', 'valor' => 'Voltio'],
            ['codigo' => '55', 'valor' => 'Millar'],
            ['codigo' => '56', 'valor' => 'Medio millar'],
            ['codigo' => '57', 'valor' => 'Ciento'],
            ['codigo' => '58', 'valor' => 'Docena'],
            ['codigo' => '59', 'valor' => 'Unidad'],
            ['codigo' => '99', 'valor' => 'Otra'],
        ]);
    }
}
