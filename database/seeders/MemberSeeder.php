<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Member;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Member::create([
            'name' => 'Agus Sucipto',
            'phone' => '0898768758477',
            'email' => 'agus@gmail.com',
            'address' => 'Banyuwangi'
        ]);
    }
}
