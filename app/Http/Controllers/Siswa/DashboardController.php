<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $siswa = Auth::user()->siswa;
        
        // Hitung rata-rata menggunakan method OOP
        $rataRata = $siswa->getRataRataNilai();
        $status = $siswa->getStatusKelulusan();
        
        return view('siswa.dashboard', compact('siswa', 'rataRata', 'status'));
    }
}