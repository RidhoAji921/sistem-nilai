<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use App\Models\MataPelajaran;
use Illuminate\Support\Facades\Auth;

class RekapController extends Controller
{
    public function index()
    {
        $guru = Auth::user()->guru;
        $mapel = MataPelajaran::where('guru_id', $guru->id)->first();
        
        if (!$mapel) {
            return view('guru.rekap.index', [
                'nilai' => collect(),
                'mapel' => null,
                'rataKelas' => 0
            ])->with('error', 'Anda belum diampu mata pelajaran apapun.');
        }
        
        $nilai = Nilai::with('siswa')
            ->where('mapel_id', $mapel->id)
            ->get();
        
        // Hitung rata-rata kelas menggunakan fungsi terstruktur
        $nilaiAkhirList = $nilai->pluck('nilai_akhir')->toArray();
        $rataKelas = hitungRataKelas($nilaiAkhirList);
        
        return view('guru.rekap.index', compact('nilai', 'mapel', 'rataKelas'));
    }
}