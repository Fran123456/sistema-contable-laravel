<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $admin = DB::table('roles')->insertGetId([
            'name' => 'Administrador',
            'guard_name' => 'web',
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
        ]);


        $permissions = [
            ['name' => 'general.usuarios', 'guard_name' => 'web', 'modulo' => 'general', 'opcion' => 'usuarios', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'general.dashboard', 'guard_name' => 'web', 'modulo' => 'general', 'opcion' => 'dashboard', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'general.roles', 'guard_name' => 'web', 'modulo' => 'general', 'opcion' => 'roles', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'general.log', 'guard_name' => 'web', 'modulo' => 'general', 'opcion' => 'logs', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'general.log.eliminar', 'guard_name' => 'web', 'modulo' => 'general', 'opcion' => 'logs', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'contabilidad.periodo.contable', 'guard_name' => 'web', 'modulo' => 'contabilidad', 'opcion' => 'contabilidad', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'contabilidad.periodo.contable.activar', 'guard_name' => 'web', 'modulo' => 'contabilidad', 'opcion' => 'contabilidad', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'contabilidad.tipos.partida.listar', 'guard_name' => 'web', 'modulo' => 'contabilidad', 'opcion' => 'contabilidad', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'contabilidad.tipos.partida.crear', 'guard_name' => 'web', 'modulo' => 'contabilidad', 'opcion' => 'contabilidad', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'contabilidad.tipos.partida.eliminar', 'guard_name' => 'web', 'modulo' => 'contabilidad', 'opcion' => 'contabilidad', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'contabilidad.tipos.partida.activar', 'guard_name' => 'web', 'modulo' => 'contabilidad', 'opcion' => 'contabilidad', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'contabilidad.informacion.contable.copiar', 'guard_name' => 'web', 'modulo' => 'contabilidad', 'opcion' => 'contabilidad', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'contabilidad.partidas.contables.listar', 'guard_name' => 'web', 'modulo' => 'contabilidad', 'opcion' => 'contabilidad', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'contabilidad.partidas.contables.crear', 'guard_name' => 'web', 'modulo' => 'contabilidad', 'opcion' => 'contabilidad', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'contabilidad.partidas.contables.editar', 'guard_name' => 'web', 'modulo' => 'contabilidad', 'opcion' => 'contabilidad', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'contabilidad.partidas.contables.anular', 'guard_name' => 'web', 'modulo' => 'contabilidad', 'opcion' => 'contabilidad', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'contabilidad.partidas.contables.cerrar', 'guard_name' => 'web', 'modulo' => 'contabilidad', 'opcion' => 'contabilidad', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'rrhh.empresa', 'guard_name' => 'web', 'modulo' => 'RRHH', 'opcion' => 'rrhh', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'rrhh.area', 'guard_name' => 'web', 'modulo' => 'RRHH', 'opcion' => 'rrhh', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'rrhh.departamento', 'guard_name' => 'web', 'modulo' => 'RRHH', 'opcion' => 'rrhh', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'rrhh.empleado', 'guard_name' => 'web', 'modulo' => 'RRHH', 'opcion' => 'rrhh', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'rrhh.periodoPlanilla', 'guard_name' => 'web', 'modulo' => 'RRHH', 'opcion' => 'rrhh', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'rrhh.incapacidades', 'guard_name' => 'web', 'modulo' => 'RRHH', 'opcion' => 'rrhh', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'rrhh.permisos', 'guard_name' => 'web', 'modulo' => 'RRHH', 'opcion' => 'rrhh', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'rrhh.cargos', 'guard_name' => 'web', 'modulo' => 'RRHH', 'opcion' => 'rrhh', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'rrhh.apf', 'guard_name' => 'web', 'modulo' => 'RRHH', 'opcion' => 'rrhh', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'rrhh.ingresos', 
            'guard_name' => 'web', 'modulo' => 'RRHH', 'opcion' => 'rrhh', 
            'created_at' => now(), 'updated_at' => now()],
            
        ];

        DB::table('permissions')->insert($permissions);

        $permisos = DB::table('permissions')->get();
        foreach ($permisos as $key => $value) {
            DB::table('role_has_permissions')->insert([
                'permission_id' => $value->id,
                'role_id' => $admin,
            ]);

        }
    }
}
