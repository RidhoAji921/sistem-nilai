<?php

/**
 * File Helper untuk Fungsi Terstruktur
 * 
 * Berisi fungsi-fungsi procedural untuk:
 * 1. hitungNilaiAkhir() - Menghitung nilai akhir berdasarkan bobot
 * 2. validasiNilai() - Memvalidasi rentang nilai 0-100
 * 3. tentukanKelulusan() - Menentukan status lulus/tidak lulus
 */

if (!function_exists('hitungNilaiAkhir')) {
    /**
     * Menghitung nilai akhir berdasarkan bobot
     * Rumus: (30% x Tugas) + (30% x UTS) + (40% x UAS)
     * 
     * @param float|int $tugas Nilai tugas (0-100)
     * @param float|int $uts   Nilai UTS (0-100)
     * @param float|int $uas   Nilai UAS (0-100)
     * @return float Nilai akhir dengan 2 desimal
     */
    function hitungNilaiAkhir($tugas, $uts, $uas)
    {
        $nilaiAkhir = (0.3 * $tugas) + (0.3 * $uts) + (0.4 * $uas);
        return round($nilaiAkhir, 2);
    }
}

if (!function_exists('validasiNilai')) {
    /**
     * Memvalidasi apakah nilai berada dalam rentang 0-100
     * 
     * @param mixed $nilai Nilai yang akan divalidasi
     * @return bool True jika nilai valid (0-100), false jika tidak
     */
    function validasiNilai($nilai)
    {
        return is_numeric($nilai) && $nilai >= 0 && $nilai <= 100;
    }
}

if (!function_exists('tentukanKelulusan')) {
    /**
     * Menentukan status kelulusan berdasarkan nilai akhir
     * Kriteria: Lulus jika nilai akhir >= 70
     * 
     * @param float $nilaiAkhir Nilai akhir yang telah dihitung
     * @return string "Lulus" atau "Tidak Lulus"
     */
    function tentukanKelulusan($nilaiAkhir)
    {
        return $nilaiAkhir >= 70 ? 'Lulus' : 'Tidak Lulus';
    }
}

if (!function_exists('formatNilai')) {
    /**
     * Memformat nilai agar tampil dengan 2 desimal dan pemisah ribuan
     * 
     * @param float $nilai Nilai yang akan diformat
     * @return string Nilai yang sudah diformat (contoh: 85,50)
     */
    function formatNilai($nilai)
    {
        return number_format($nilai, 2, ',', '.');
    }
}

if (!function_exists('hitungRataKelas')) {
    /**
     * Menghitung rata-rata kelas untuk suatu mata pelajaran
     * 
     * @param array $kumpulanNilaiAkhir Array berisi nilai akhir siswa
     * @return float Rata-rata kelas
     */
    function hitungRataKelas($kumpulanNilaiAkhir)
    {
        if (empty($kumpulanNilaiAkhir)) {
            return 0;
        }
        return array_sum($kumpulanNilaiAkhir) / count($kumpulanNilaiAkhir);
    }
}