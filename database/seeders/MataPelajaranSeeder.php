<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MataPelajaranSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('mata_pelajaran')->insert([
            [
                'kode' => 'MTK',
                'nama_mapel' => 'Matematika',
                'guru_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'BIN',
                'nama_mapel' => 'Bahasa Indonesia',
                'guru_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'BIG',
                'nama_mapel' => 'Bahasa Inggris',
                'guru_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'IPA',
                'nama_mapel' => 'Ilmu Pengetahuan Alam',
                'guru_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'IPS',
                'nama_mapel' => 'Ilmu Pengetahuan Sosial',
                'guru_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}