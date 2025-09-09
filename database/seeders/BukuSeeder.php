<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $buku = [
            [
                'judul' => 'Buku 1',
                'pengarang' => 'Penulis 1',
                'tahun_terbit' => 2020,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Buku 2',
                'pengarang' => 'Penulis 2',
                'tahun_terbit' => 2021,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'judul' => 'Buku 3',
                'pengarang' => 'Penulis 3',
                'tahun_terbit' => 2022,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        DB::table('buku')->insert($buku);
    }
}
