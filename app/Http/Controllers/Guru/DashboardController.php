<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $guru = Auth::user()->guru;
        $totalSiswa = Siswa::count();
        
        return view('guru.dashboard', compact('guru', 'totalSiswa'));
    }
}