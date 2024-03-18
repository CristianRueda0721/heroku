<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //roles
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
               'password' => bcrypt('admin')
            ]) ->assignRole('Admin');
            
       User::factory(20)->create();
    }
}
