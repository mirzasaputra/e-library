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
            'is_default' => true
        ]);

        $developer->givePermissionTo([
            'read-dashboard',
            'read-genres', 'create-genres', 'update-genres', 'delete-genres',
            'read-books', 'create-books', 'update-books', 'delete-books',
            'read-members', 'create-members', 'update-members', 'delete-members',
            'read-roles', 'create-roles', 'update-roles', 'delete-roles',
            'read-users', 'create-users', 'update-users', 'delete-users',
            'read-borrows',
            'read-bookings', 'update-bookings',
            'read-book-returns', 'update-book-returns',
            'read-settings', 'update-settings',
            'read-reports',
        ]);
        
        $member = Role::create([
            'name' => 'Member',
            'guard_name' => 'web',
            'is_default' => true
        ]);
        
        $administrator = Role::create([
            'name' => 'Administrator',
            'guard_name' => 'web',
            'is_default' => true
        ]);
        
        $administrator->givePermissionTo([
            'read-dashboard',
            'read-genres', 'create-genres', 'update-genres', 'delete-genres',
            'read-books', 'create-books', 'update-books', 'delete-books',
            'read-members', 'create-members', 'update-members', 'delete-members',
            'read-roles', 'create-roles', 'update-roles', 'delete-roles',
            'read-users', 'create-users', 'update-users', 'delete-users',
            'read-borrows',
            'read-bookings', 'update-bookings',
            'read-book-returns', 'update-book-returns',
            'read-settings', 'update-settings',
            'read-reports',
        ]);
    }
}
