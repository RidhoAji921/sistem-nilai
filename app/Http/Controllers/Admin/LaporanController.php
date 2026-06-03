<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use App\Models\Siswa;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Nilai::with(['siswa', 'mataPelajaran']);
        
        if ($request->kelas) {
            $query->whereHas('siswa', function($q) use ($request) {
                $q->where('kelas', $request->kelas);
            });
        }
        
        if ($request->mapel_id) {
            $query->where('mapel_id', $request->mapel_id);
        }
        
        $nilai = $query->get();
        
        return view('admin.laporan.index', compact('nilai'));
    }

    public function cetakPDF()
    {
        // Akan diimplementasikan nanti dengan DOMPDF
        return view('admin.laporan.pdf');
    }
}