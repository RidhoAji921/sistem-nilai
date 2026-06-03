<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('siswa')->insert([
            [
                'nis' => '2023001',
                'nama' => 'Andi',
                'kelas' => 'VI-A',
                'user_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nis' => '2023002',
                'nama' => 'Budi',
                'kelas' => 'VI-A',
                'user_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nis' => '2023003',
                'nama' => 'Cici',
                'kelas' => 'VI-B',
                'user_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}