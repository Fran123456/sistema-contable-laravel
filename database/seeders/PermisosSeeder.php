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


        //PERMISOS MENU USUARIO
        DB::table('permissions')->insert([
            'name' => 'general.usuarios.listar',
            'guard_name' => 'web',
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'modulo' => 'general',
            'opcion' => 'usuarios'
        ]);

        DB::table('permissions')->insert([
            'name' => 'general.usuarios.crear',
            'guard_name' => 'web',
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'modulo' => 'general',
            'opcion' => 'usuarios'
        ]);

        DB::table('permissions')->insert([
            'name' => 'general.usuarios.editar',
            'guard_name' => 'web',
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'modulo' => 'general',
            'opcion' => 'usuarios'
        ]);

        DB::table('permissions')->insert([
            'name' => 'general.usuarios.habilitar',
            'guard_name' => 'web',
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'modulo' => 'general',
            'opcion' => 'usuarios'
        ]);
        //PERMISOS MENU USUARIO

        //DASHBOARD
        DB::table('permissions')->insert([
            'name' => 'general.dashboard',
            'guard_name' => 'web',
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'modulo' => 'general',
            'opcion' => 'dashboard'
        ]);
        //DASHBOARD

        //PERMISOS DE ROLES
        DB::table('permissions')->insert([
            'name' => 'general.roles.listar',
            'guard_name' => 'web',
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'modulo' => 'general',
            'opcion' => 'roles'
        ]);

        DB::table('permissions')->insert([
            'name' => 'general.roles.crear',
            'guard_name' => 'web',
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'modulo' => 'general',
            'opcion' => 'roles'
        ]);
        DB::table('permissions')->insert([
            'name' => 'general.roles.editar',
            'guard_name' => 'web',
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'modulo' => 'general',
            'opcion' => 'roles'
        ]);
        DB::table('permissions')->insert([
            'name' => 'general.roles.eliminar',
            'guard_name' => 'web',
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'modulo' => 'general',
            'opcion' => 'roles'
        ]);
        //PERMISOS DE ROLES

        //PERMISO DE LOG
        DB::table('permissions')->insert([
            'name' => 'general.log.listar',
            'guard_name' => 'web',
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'modulo' => 'general',
            'opcion' => 'logs'
        ]);
        DB::table('permissions')->insert([
            'name' => 'general.log.eliminar',
            'guard_name' => 'web',
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'modulo' => 'general',
            'opcion' => 'logs'
        ]);
        //PERMISO DE LOG

        //PERMISOS DE PERIDOS CONTABLES
        DB::table('permissions')->insert([
            'name' => 'contabilidad.periodo.contable.listar',
            'guard_name' => 'web',
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'modulo' => 'contabilidad',
            'opcion' => 'periodo contable'
        ]);
        DB::table('permissions')->insert([
            'name' => 'contabilidad.periodo.contable.activar',
            'guard_name' => 'web',
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'modulo' => 'contabilidad',
            'opcion' => 'periodo contable'
        ]);
        DB::table('permissions')->insert([
            'name' => 'contabilidad.periodo.contable.crear',
            'guard_name' => 'web',
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'modulo' => 'contabilidad',
            'opcion' => 'periodo contable'
        ]);
        //PERMISOS DE PERIDOS CONTABLES

        //PERMISOS DE TIPOS DE PARTIDA
        DB::table('permissions')->insert([
            'name' => 'contabilidad.tipos.partida.listar',
            'guard_name' => 'web',
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'modulo' => 'contabilidad',
            'opcion' => 'tipo de partidas'
        ]);
        DB::table('permissions')->insert([
            'name' => 'contabilidad.tipos.partida.crear',
            'guard_name' => 'web',
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'modulo' => 'contabilidad',
            'opcion' => 'tipo de partidas'
        ]);
        DB::table('permissions')->insert([
            'name' => 'contabilidad.tipos.partida.eliminar',
            'guard_name' => 'web',
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'modulo' => 'contabilidad',
            'opcion' => 'tipo de partidas'
        ]);
        DB::table('permissions')->insert([
            'name' => 'contabilidad.tipos.partida.activar',
            'guard_name' => 'web',
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'modulo' => 'contabilidad',
            'opcion' => 'tipo de partidas'
        ]);
        //PERMISOS DE TIPOS DE PARTIDA




        //PERMISOS DE COPIAR INFORMACION CONTABLE
        DB::table('permissions')->insert([
            'name' => 'contabilidad.informacion.contable.copiar',
            'guard_name' => 'web',
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'modulo' => 'contabilidad',
            'opcion' => 'copiar datos'
        ]);
        //PERMISOS DE COPIAR INFORMACION CONTABLE

        //PERMISOS PARTIDA CONTABLE
        DB::table('permissions')->insert([
            'name' => 'contabilidad.partidas.contables.listar',
            'guard_name' => 'web',
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'modulo' => 'contabilidad',
            'opcion' => 'partidas contables'
        ]);
        DB::table('permissions')->insert([
            'name' => 'contabilidad.partidas.contables.crear',
            'guard_name' => 'web',
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'modulo' => 'contabilidad',
            'opcion' => 'partidas contables'
        ]);
        DB::table('permissions')->insert([
            'name' => 'contabilidad.partidas.contables.editar',
            'guard_name' => 'web',
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'modulo' => 'contabilidad',
            'opcion' => 'partidas contables'
        ]);
        DB::table('permissions')->insert([
            'name' => 'contabilidad.partidas.contables.anular',
            'guard_name' => 'web',
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'modulo' => 'contabilidad',
            'opcion' => 'partidas contables'
        ]);
        DB::table('permissions')->insert([
            'name' => 'contabilidad.partidas.contables.cerrar',
            'guard_name' => 'web',
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'modulo' => 'contabilidad',
            'opcion' => 'partidas contables'
        ]);
        //PERMISOS PARTIDA CONTABLE



        //PERMISOS DE EMPRESA
        DB::table('permissions')->insert([
            'name' => 'rrhh.empresa.listar',
            'guard_name' => 'web',
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'modulo' => 'RRHH',
            'opcion' => 'empresas'
        ]);
        DB::table('permissions')->insert([
            'name' => 'rrhh.empresa.crear',
            'guard_name' => 'web',
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'modulo' => 'RRHH',
            'opcion' => 'empresas'
        ]);
        DB::table('permissions')->insert([
            'name' => 'rrhh.empresa.actualizar',
            'guard_name' => 'web',
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'modulo' => 'RRHH',
            'opcion' => 'empresas'
        ]);
        DB::table('permissions')->insert([
            'name' => 'rrhh.empresa.eliminar',
            'guard_name' => 'web',
            'created_at' => date("Y-m-d h:i:s"),
            'updated_at' => date("Y-m-d h:i:s"),
            'modulo' => 'RRHH',
            'opcion' => 'empresas'
        ]);
        //PERMISOS DE EMPRESA

        $permisos = DB::table('permissions')->get();
        foreach ($permisos as $key => $value) {
            DB::table('role_has_permissions')->insert([
                'permission_id' => $value->id,
                'role_id' => $admin,
            ]);

        }
    }
}
