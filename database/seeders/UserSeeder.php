<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin LibraNest',
            'nama_lengkap' => 'Administrator',
            'email' => 'AdminLibraNest10@gmail.com',
            'password' => Hash::make('LibraNest1Admin@libranest.co.id'),
            'level' => 'Admin',
            'alamat' => 'Gedung Perpustakaan Publik Terbuka LibraNest Indonesia',
        ]);
    }
}
