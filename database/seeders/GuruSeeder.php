<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GuruSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('guru')->insert([
            [
                'nip' => '198001012005011001',
                'nama' => 'Dra. Ani Susanti, M.Pd',
                'mapel' => 'Matematika',
                'user_id' => 2, // sesuai id dari UserSeeder
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nip' => '198507152008012002',
                'nama' => 'Drs. Budi Santoso, M.Si',
                'mapel' => 'Bahasa Indonesia',
                'user_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}