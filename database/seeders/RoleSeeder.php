<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $developer = Role::create([
            'name' => 'Developer',
            'guard_name' => 'web',
        ]);

        $developer->givePermissionTo([
            'read-dashboard',
            'read-books', 'create-books', 'update-books', 'delete-books',
            'read-users', 'create-users', 'update-users', 'delete-users',
        ]);
        
        $administrator = Role::create([
            'name' => 'Administrator',
            'guard_name' => 'web',
        ]);
        
        $administrator->givePermissionTo([
            'read-dashboard',
            'read-books', 'create-books', 'update-books', 'delete-books',
            'read-users', 'create-users', 'update-users', 'delete-users',
        ]);
    }
}
