<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::insert([
            [
                'group' => 'general',
                'key' => 'app_name',
                'display_name' => 'Nama Aplikasi',
                'value' => 'E - Library'
            ],
            [
                'group' => 'general',
                'key' => 'app_description',
                'display_name' => 'Deskripsi Aplikasi',
                'value' => 'Aplikasi yang digunakan untuk mengelola data perpustakaan dan untuk memudahkan dalam peminjaman buku'
            ],
            [
                'group' => 'general',
                'key' => 'app_author',
                'display_name' => 'Pemilik',
                'value' => 'Anonymous'
            ],
            [
                'group' => 'general',
                'key' => 'app_email',
                'display_name' => 'Email Aplikasi',
                'value' => 'contact@library-app.com'
            ],
            [
                'group' => 'general',
                'key' => 'app_phone',
                'display_name' => 'Telepon Aplikasi',
                'value' => '089XXXXXXXXXX'
            ],
            [
                'group' => 'general',
                'key' => 'app_address',
                'display_name' => 'Alamat Aplikasi',
                'value' => 'Jl. Raya Kota XXXX, Kota XXXX, Provinsi XXXX'
            ],
            [
                'group' => 'general',
                'key' => 'app_copyright',
                'display_name' => 'Copyright Aplikasi',
                'value' => 'Copyright © 2022. All rights reserved.'
            ],
            [
                'group' => 'image',
                'key' => 'app_logo',
                'display_name' => 'Logo Aplikasi',
                'value' => 'logo.png'
            ],
            [
                'group' => 'image',
                'key' => 'app_favicon',
                'display_name' => 'Favicon Aplikasi',
                'value' => 'favicon.png'
            ],
            [
                'group' => 'config',
                'key' => 'app_money_fine',
                'display_name' => 'Denda Aplikasi Perhari',
                'value' => 0
            ]
        ]);
    }
}
