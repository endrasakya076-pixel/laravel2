<?php

namespace Database\Seeders;

use App\Models\Spesimen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpesimenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('spesimen')->insert([
            [
                'foto' => 'https://via.placeholder.com/150',
                'cif' => 'CIF001',
                'nama' => 'John Doe',
                'alamat' => 'Jl. Mawar No. 1, Jakarta',
                'nama_ibu' => 'Jane Doe',
                'alamat_ibu' => 'Jl. Melati No. 2, Jakarta',
            ],
            [
                'foto' => 'https://via.placeholder.com/150',
                'cif' => 'CIF002',
                'nama' => 'Alice Smith',
                'alamat' => 'Jl. Anggrek No. 3, Bandung',
                'nama_ibu' => 'Mary Smith',
                'alamat_ibu' => 'Jl. Kenanga No. 4, Bandung',
            ],
            [
                'foto' => 'https://via.placeholder.com/150',
                'cif' => 'CIF003',
                'nama' => 'Bob Johnson',
                'alamat' => 'Jl. Dahlia No. 5, Surabaya',
                'nama_ibu' => 'Anna Johnson',
                'alamat_ibu' => 'Jl. Mawar No. 6, Surabaya',
            ],
        ]);
    }
}
