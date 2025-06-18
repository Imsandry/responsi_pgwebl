<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SekolahSeeder extends Seeder
{
    public function run()
    {
        DB::table('sekolahs')->insert([
            [
                'nama' => 'SD Negeri 1 Sabang',
                'jenjang' => 'SD',
                'lat' => 5.889000,
                'lng' => 95.316000,
                'akreditasi' => 'A',
                'foto' => 'sdn1.jpg',
            ],
            [
                'nama' => 'SMP Negeri 2 Sabang',
                'jenjang' => 'SMP',
                'lat' => 5.891200,
                'lng' => 95.319800,
                'akreditasi' => 'B',
                'foto' => 'smpn2.jpg',
            ],
            [
                'nama' => 'SMA Negeri 1 Sabang',
                'jenjang' => 'SMA',
                'lat' => 5.887500,
                'lng' => 95.312700,
                'akreditasi' => 'A',
                'foto' => 'sman1.jpg',
            ],
        ]);
    }
}
