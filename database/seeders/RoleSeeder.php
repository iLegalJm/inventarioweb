<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::create(['name' => 'admin']);
        $role2 = Role::create(['name' => 'almacenero']);
        $role3 = Role::create(['name' => 'vendedor']);
        $role4 = Role::create(['name' => 'cliente']);
       
        Permission::create(['name' => 'admin.home', 'description' => 'Ver el dashboard'])->syncRoles([$role1, $role3]);

        Permission::create(['name' => 'admin.users.index', 'description' => 'Ver listado de usuarios'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.users.edit', 'description' => 'Asigar un rol'])->syncRoles([$role1]);

        Permission::create(['name' => 'admin.almacenes.index', 'description' => 'Ver listado de almacenes'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.almacenes.create', 'description' => 'Crear almacén'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.almacenes.edit', 'description' => 'Editar almacen'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.almacenes.destroy', 'description' => 'Eliminar almacén'])->syncRoles([$role1]);


        Permission::create(['name' => 'admin.ingresos.index', 'description' => 'Ver listado de ingresos'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.ingresos.create', 'description' => 'Registrar ingresos'])->syncRoles([$role1, $role2]);
        Permission::create(['name' => 'admin.ingresos.edit', 'description' => 'Editar ingresos'])->syncRoles([$role1]);
        Permission::create(['name' => 'admin.ingresos.destroy', 'description' => 'Eliminar ingresos'])->syncRoles([$role1]);

    }
}