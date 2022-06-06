<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'root',
            'member_id' => null,
            'email' => 'root@gmail.com',
            'username' => 'root',
            'password' => Hash::make('root'),
        ])->assignRole('Developer');

        User::create([
            'name' => 'Agus Sucipto',
            'member_id' => 1,
            'email' => 'agus@gmail.com',
            'username' => 'agus',
            'password' => Hash::make('1234'),
        ])->assignRole('Member');
    }
}
