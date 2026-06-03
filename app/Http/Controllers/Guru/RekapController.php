<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RekapController extends Controller
{
    public function index(Request $request)
    {
        $guru = Auth::user()->guru;
        $mapel = MataPelajaran::where('guru_id', $guru->id)->first();
        
        $query = Nilai::with(['siswa'])
            ->where('mapel_id', $mapel->id);
        
        if ($request->kelas) {
            $query->whereHas('siswa', function($q) use ($request) {
                $q->where('kelas', $request->kelas);
            });
        }
        
        $nilai = $query->get();
        
        // Hitung rata-rata menggunakan fungsi terstruktur
        $nilaiAkhirList = $nilai->pluck('nilai_akhir')->toArray();
        $rataKelas = hitungRataKelas($nilaiAkhirList);
        
        return view('guru.rekap.index', compact('nilai', 'rataKelas', 'mapel'));
    }
}