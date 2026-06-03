<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use Illuminate\Support\Facades\Auth;

class NilaiController extends Controller
{
    public function index()
    {
        $siswa = Auth::user()->siswa;
        $nilai = Nilai::with('mataPelajaran')
            ->where('siswa_id', $siswa->id)
            ->get();
        
        // Hitung rata-rata menggunakan method OOP
        $rataRata = $siswa->getRataRataNilai();
        $status = $siswa->getStatusKelulusan();
        
        return view('siswa.nilai.index', compact('nilai', 'siswa', 'rataRata', 'status'));
    }
}