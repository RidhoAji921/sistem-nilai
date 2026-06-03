<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NilaiSeeder extends Seeder
{
    // Panggil fungsi terstruktur untuk hitung nilai akhir
    private function hitungNilaiAkhir($tugas, $uts, $uas)
    {
        return (0.3 * $tugas) + (0.3 * $uts) + (0.4 * $uas);
    }

    private function tentukanKelulusan($nilaiAkhir)
    {
        return $nilaiAkhir >= 70 ? 'Lulus' : 'Tidak Lulus';
    }

    public function run(): void
    {
        $dataNilai = [
            // Andi (siswa_id=1)
            ['siswa_id' => 1, 'mapel_id' => 1, 'tugas' => 80, 'uts' => 75, 'uas' => 85],
            ['siswa_id' => 1, 'mapel_id' => 2, 'tugas' => 85, 'uts' => 80, 'uas' => 90],
            ['siswa_id' => 1, 'mapel_id' => 3, 'tugas' => 75, 'uts' => 70, 'uas' => 80],
            // Budi (siswa_id=2)
            ['siswa_id' => 2, 'mapel_id' => 1, 'tugas' => 65, 'uts' => 70, 'uas' => 60],
            ['siswa_id' => 2, 'mapel_id' => 2, 'tugas' => 70, 'uts' => 75, 'uas' => 65],
            ['siswa_id' => 2, 'mapel_id' => 3, 'tugas' => 80, 'uts' => 75, 'uas' => 70],
            // Cici (siswa_id=3)
            ['siswa_id' => 3, 'mapel_id' => 1, 'tugas' => 90, 'uts' => 85, 'uas' => 88],
            ['siswa_id' => 3, 'mapel_id' => 2, 'tugas' => 85, 'uts' => 80, 'uas' => 85],
            ['siswa_id' => 3, 'mapel_id' => 3, 'tugas' => 88, 'uts' => 85, 'uas' => 90],
        ];

        foreach ($dataNilai as $item) {
            $nilaiAkhir = $this->hitungNilaiAkhir($item['tugas'], $item['uts'], $item['uas']);
            $status = $this->tentukanKelulusan($nilaiAkhir);

            DB::table('nilai')->insert([
                'siswa_id' => $item['siswa_id'],
                'mapel_id' => $item['mapel_id'],
                'tugas' => $item['tugas'],
                'uts' => $item['uts'],
                'uas' => $item['uas'],
                'nilai_akhir' => $nilaiAkhir,
                'status' => $status,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}