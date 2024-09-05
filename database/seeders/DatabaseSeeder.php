<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Help\Help;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RRHHSeeder::class);
        $this->call(ConfigSeeder::class);
        $this->call(ContabilidadSeeder::class);
        $this->call(PermisosSeeder::class);
        $this->call(TipoEmpleadoSeeder::class);
        $this->call(RRHHTipoPlanilla::class);
        $this->call(RRHHIncapacidadTipo::class);
        $this->call(RRHHTipoPermiso::class);
        $this->call(RRHHAfp::class);
        $this->call(RRHHTipoIngreso::class);
        $this->call(FactEstadoFacturacionSeeder::class);
        $this->call(FactTipoDocumentoSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(SociosCargoSeeder::class);
        $this->call(ProTipoProductoSeeder::class);
        $this->call(PaisesSeeder::class);
        $this->call(FeTipoDocumentosSeeder::class);
        $this->call(FeUnidadMedidasSeeder::class);
        $this->call(FeDepartamentosSeeder::class);
        $this->call(FeMunicipiosSeeder::class);
        $this->call(FeActividadEconomicasSeeder::class);



        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
