<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('genres')->insert([
            ['genre' => 'Drama'],
            ['genre' => 'Fantasi'],
            ['genre' => 'Horor'],
            ['genre' => 'Komedi'],
            ['genre' => 'Misteri'],
            ['genre' => 'Pengetahuan'],
            ['genre' => 'Petualangan'],
            ['genre' => 'Romansa'],
            ['genre' => 'Sejarah'],
        ]);
    }
}
