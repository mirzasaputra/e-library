<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = collect([
            # dahsboard
            'read-dashboard',

            # genres
            'read-genres', 'create-genres', 'update-genres', 'delete-genres',

            # books
            'read-books', 'create-books', 'update-books', 'delete-books',
            
            # members
            'read-members', 'create-members', 'update-members', 'delete-members',
            
            # roles
            'read-roles', 'create-roles', 'update-roles', 'delete-roles',

            # users
            'read-users', 'create-users', 'update-users', 'delete-users',
            
            # borrows
            'read-borrows',

            # bookings
            'read-bookings', 'update-bookings',

            # book-returns
            'read-book-returns', 'update-book-returns',

            # settings
            'read-settings', 'update-settings',

            # reports
            'read-reports',
        ]);
        
        $this->insertPermission($permission);
    }

    private function insertPermission(Collection $permissions, $guardName = 'web'){
        Permission::insert($permissions->map(function($permission) use ($guardName){
            return [
                'name' => $permission,
                'guard_name' => $guardName,
                'created_at' => Carbon::now()
            ];
        })->toArray());
    }
}
