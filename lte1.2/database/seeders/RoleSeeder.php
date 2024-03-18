<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;



use App\Models\User;



class RoleSeeder extends Seeder
{
  
    public function run(): void
    {
               //roles
       $role1 = Role::create(['name' => 'Admin']);
        
       $role2 = Role::create(['name' => 'Mecanico']);


         //permission

       Permission::create(['name' => '/home'])->syncRoles([$role1]);
       Permission::create(['name' => 'mecanicos.index'])->syncRoles([$role1, $role2]);
       Permission::create(['name' => 'mecanicos.create'])->syncRoles([$role1]);
       Permission::create(['name' => 'mecanicos.edit'])->syncRoles([$role1]);
       Permission::create(['name' => 'mecanicos.destroy'])->syncRoles([$role1]);
       Permission::create(['name' => 'mecanicos.show'])->syncRoles([$role1, $role2]);
       Permission::create(['name' => 'mecanicos.pdf'])->syncRoles([$role1]);

       Permission::create(['name' => 'productos.index'])->syncRoles([$role1]);
       Permission::create(['name' => 'productos.create'])->syncRoles([$role1]);
       Permission::create(['name' => 'productos.edit'])->syncRoles([$role1]);
       Permission::create(['name' => 'productos.destroy'])->syncRoles([$role1]);
       Permission::create(['name' => 'productos.show'])->syncRoles([$role1]);

       Permission::create(['name' => 'servicios.index'])->syncRoles([$role1]);
       Permission::create(['name' => 'servicios.create'])->syncRoles([$role1]);
       Permission::create(['name' => 'servicios.edit'])->syncRoles([$role1]);
       Permission::create(['name' => 'servicios.destroy'])->syncRoles([$role1]);
       Permission::create(['name' => 'servicios.show'])->syncRoles([$role1]);

       Permission::create(['name' => 'vehiculos.index'])->syncRoles([$role1]);
       Permission::create(['name' => 'vehiculos.create'])->syncRoles([$role1]);
       Permission::create(['name' => 'vehiculos.edit'])->syncRoles([$role1]);
       Permission::create(['name' => 'vehiculos.destroy'])->syncRoles([$role1]);
       Permission::create(['name' => 'vehiculos.show'])->syncRoles([$role1]);

       Permission::create(['name' => 'clientes.index'])->syncRoles([$role1]);
       Permission::create(['name' => 'clientes.create'])->syncRoles([$role1]);
       Permission::create(['name' => 'clientes.edit'])->syncRoles([$role1]);
       Permission::create(['name' => 'clientes.destroy'])->syncRoles([$role1]);
       Permission::create(['name' => 'clientes.show'])->syncRoles([$role1]);

       Permission::create(['name' => 'tareas.index'])->syncRoles([$role1]);
       Permission::create(['name' => 'tareas.create'])->syncRoles([$role1]);
       Permission::create(['name' => 'tareas.edit'])->syncRoles([$role1]);
       Permission::create(['name' => 'tareas.destroy'])->syncRoles([$role1]);
       Permission::create(['name' => 'tareas.show'])->syncRoles([$role1]);

       Permission::create(['name' => 'ventas.index'])->syncRoles([$role1]);
       Permission::create(['name' => 'ventas.create'])->syncRoles([$role1]);
       Permission::create(['name' => 'ventas.edit'])->syncRoles([$role1]);
       Permission::create(['name' => 'ventas.destroy'])->syncRoles([$role1]);
       Permission::create(['name' => 'ventas.show'])->syncRoles([$role1]);
    }
}
