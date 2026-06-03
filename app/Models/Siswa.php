<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';
    
    protected $fillable = [
        'nis',
        'nama',
        'kelas',
        'user_id',
    ];

    // Relasi OOP ke User (One to One balikan)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi OOP ke Nilai (One to Many)
    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'siswa_id');
    }

    // Method OOP: Mendapatkan rata-rata semua nilai
    public function getRataRataNilai()
    {
        $total = 0;
        $jumlah = $this->nilai->count();
        
        if ($jumlah === 0) {
            return 0;
        }
        
        foreach ($this->nilai as $nilai) {
            $total += $nilai->nilai_akhir;
        }
        
        return $total / $jumlah;
    }

    // Method OOP: Mendapatkan status kelulusan (panggil fungsi terstruktur nanti)
    public function getStatusKelulusan()
    {
        $rataRata = $this->getRataRataNilai();
        // Fungsi terstruktur akan dipanggil dari helper
        return tentukanKelulusan($rataRata);
    }

    // Method OOP: Mendapatkan nilai untuk mapel tertentu
    public function getNilaiByMapel($mapelId)
    {
        return $this->nilai()->where('mapel_id', $mapelId)->first();
    }
}