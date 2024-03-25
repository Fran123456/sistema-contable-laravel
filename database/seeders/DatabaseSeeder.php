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
        $this->call(ConfigSeeder::class);
        $this->call(RRHHSeeder::class);
        $this->call(ContabilidadSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PermisosSeeder::class);
        $this->call(TipoEmpleadoSeeder::class);
        $this->call(RRHHTipoPlanilla::class);
        $this->call(RRHHIncapacidadTipo::class);
        $this->call(RRHHTipoPermiso::class);
        $this->call(RRHHAfp::class);
        $this->call(RRHHTipoIngreso::class);


        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
