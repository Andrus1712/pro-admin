<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::create(['name' => 'Admin', 'readable_name' => 'Administrator', 'description' => 'Adminitrador del sistema, tendrá acceso a todo el sistema']);
        $role_user = Role::create(['name' => 'User', 'readable_name' => 'Usuario', 'description' => 'Usuario del sistema, tendrá acceso a la aplicacion']);

        //Permisos de las rutas
        $permission_admin = Permission::create(['name' => 'view.admin', 'readable_name' => 'Vistas administrador']);
        $permission_app = Permission::create(['name' => 'view.app', 'readable_name' => 'Ingresar a la aplicacion']);

        //Permisos del crud usuarios
        $permission_view_users = Permission::create(['name' => 'view.users', 'readable_name' => 'Listar usuarios']);
        $permission_create_users = Permission::create(['name' => 'create.users', 'readable_name' => 'Crear usuarios']);
        $permission_edit_users = Permission::create(['name' => 'edit.users', 'readable_name' => 'Editar usuarios']);
        $permission_delete_users = Permission::create(['name' => 'delete.users', 'readable_name' => 'Eliminar usuarios']);


        //Asignamos todos los permisos a el rol admin
        $role_admin->syncPermissions([
            $permission_admin,
            $permission_app,
            $permission_view_users,
            $permission_create_users,
            $permission_edit_users,
            $permission_delete_users
        ]);

        //Asignamos permisos al rol user
        $role_user->syncPermissions([
            $permission_admin,
            $permission_app
        ]);
    }
}
