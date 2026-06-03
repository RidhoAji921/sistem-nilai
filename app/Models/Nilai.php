<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $table = 'nilai';
    
    protected $fillable = [
        'siswa_id',
        'mapel_id',
        'tugas',
        'uts',
        'uas',
        'nilai_akhir',
        'status',
    ];

    protected $casts = [
        'tugas' => 'integer',
        'uts' => 'integer',
        'uas' => 'integer',
        'nilai_akhir' => 'float',
    ];

    // Relasi OOP ke Siswa (Many to One)
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    // Relasi OOP ke MataPelajaran (Many to One)
    public function mataPelajaran()
    {
        return $this->belongsTo(MataPelajaran::class, 'mapel_id');
    }

    // Method OOP: Menghitung ulang nilai akhir (panggil fungsi terstruktur)
    public function hitungUlangNilaiAkhir()
    {
        // Panggil fungsi terstruktur (akan dibuat di helper)
        $this->nilai_akhir = hitungNilaiAkhir(
            $this->tugas,
            $this->uts,
            $this->uas
        );
        $this->status = tentukanKelulusan($this->nilai_akhir);
        return $this;
    }

    // Method OOP: Validasi nilai (panggil fungsi terstruktur)
    public function isValid()
    {
        return validasiNilai($this->tugas) &&
               validasiNilai($this->uts) &&
               validasiNilai($this->uas);
    }

    // Method OOP: Update nilai dengan validasi otomatis
    public function updateNilai($tugas, $uts, $uas)
    {
        if (!validasiNilai($tugas) || !validasiNilai($uts) || !validasiNilai($uas)) {
            throw new \Exception("Nilai harus dalam rentang 0-100");
        }
        
        $this->tugas = $tugas;
        $this->uts = $uts;
        $this->uas = $uas;
        
        return $this->hitungUlangNilaiAkhir();
    }
}