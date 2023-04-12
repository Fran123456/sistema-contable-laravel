<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = DB::table('users')->insertGetId([
            'name' => "Francisco José Navas",
            'email' => "navasfran98@gmail.com",
            'password' => Hash::make("Paginaazul1") ,
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=> date("Y-m-d h:i:s")
        ]);

        $team = DB::table('teams')->insertGetId([
            'user_id'=> $user,
            'name' => explode(' ', 'Francisco José Navas', 2)[0]."'s Team",
            'personal_team' => true,
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=> date("Y-m-d h:i:s")
        ]);

        DB::table('team_user')->insert([
            'user_id'=> $user,
            'team_id'=> $team,
            'role'=> 'admin',
            'created_at'=>date("Y-m-d h:i:s"),
            'updated_at'=> date("Y-m-d h:i:s")
        ]);

        DB::table('users')->update([
            'current_team_id'=> $team,
        ]);

    }
}
