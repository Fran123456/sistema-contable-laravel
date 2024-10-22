<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class FeFormaPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fe_forma_pago')->insert([
        ['codigo' => '01', 'valor' => 'Billetes y monedas', 'created_at' => now(), 'updated_at' => now(), 'activo' => true, 'empresa_id' => 1],
        ['codigo' => '02', 'valor' => 'Tarjeta Débito', 'created_at' => now(), 'updated_at' => now(), 'activo' => true, 'empresa_id' => 1],
        ['codigo' => '03', 'valor' => 'Tarjeta Crédito', 'created_at' => now(), 'updated_at' => now(), 'activo' => true, 'empresa_id' => 1],
        ['codigo' => '04', 'valor' => 'Cheque', 'created_at' => now(), 'updated_at' => now(), 'activo' => true, 'empresa_id' => 1],
        ['codigo' => '05', 'valor' => 'Transferencia_ Depósito Bancario', 'created_at' => now(), 'updated_at' => now(), 'activo' => true, 'empresa_id' => 1],
        ['codigo' => '06', 'valor' => 'Vales o Cupones', 'created_at' => now(), 'updated_at' => now(), 'activo' => true, 'empresa_id' => 1],
        ['codigo' => '08', 'valor' => 'Dinero electrónico', 'created_at' => now(), 'updated_at' => now(), 'activo' => true, 'empresa_id' => 1],
        ['codigo' => '09', 'valor' => 'Monedero electrónico', 'created_at' => now(), 'updated_at' => now(), 'activo' => true, 'empresa_id' => 1],
        ['codigo' => '10', 'valor' => 'Certificado o tarjeta de regalo', 'created_at' => now(), 'updated_at' => now(), 'activo' => true, 'empresa_id' => 1],
        ['codigo' => '11', 'valor' => 'Bitcoin', 'created_at' => now(), 'updated_at' => now(), 'activo' => true, 'empresa_id' => 1],
        ['codigo' => '12', 'valor' => 'Otras Criptomonedas', 'created_at' => now(), 'updated_at' => now(), 'activo' => true, 'empresa_id' => 1],
        ['codigo' => '13', 'valor' => 'Cuentas por pagar del receptor', 'created_at' => now(), 'updated_at' => now(), 'activo' => true, 'empresa_id' => 1],
        ['codigo' => '14', 'valor' => 'Giro bancario', 'created_at' => now(), 'updated_at' => now(), 'activo' => true, 'empresa_id' => 1],
        ['codigo' => '99', 'valor' => 'Otros (se debe indicar el medio de pago)', 'created_at' => now(), 'updated_at' => now(), 'activo' => true, 'empresa_id' => 1],
    ]);
    }
}
