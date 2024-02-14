<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KategoriBukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kategori_bukus')->insert([
            ['kategori' => 'Antologi'],
            ['kategori' => 'Biografi'],
            ['kategori' => 'Cergam'],
            ['kategori' => 'Dongeng'],
            ['kategori' => 'Ensiklopedi'],
            ['kategori' => 'Kamus'],
            ['kategori' => 'Karya Ilmiah'],
            ['kategori' => 'Komik'],
            ['kategori' => 'Majalah'],
            ['kategori' => 'Manga'],
            ['kategori' => 'Naskah'],
            ['kategori' => 'Novel'],
            ['kategori' => 'Tafsir'],
        ]);
    }
}
