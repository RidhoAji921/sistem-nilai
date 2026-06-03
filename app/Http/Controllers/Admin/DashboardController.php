<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\MataPelajaran;
use App\Models\Nilai;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSiswa = Siswa::count();
        $totalGuru = Guru::count();
        $totalMapel = MataPelajaran::count();
        $totalLulus = Nilai::where('status', 'Lulus')
            ->distinct('siswa_id')
            ->count('siswa_id');

        return view('admin.dashboard', compact(
            'totalSiswa', 
            'totalGuru', 
            'totalMapel', 
            'totalLulus'
        ));
    }
}