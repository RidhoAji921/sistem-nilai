<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Nilai::with(['siswa', 'mataPelajaran', 'mataPelajaran.guru']);
        
        // Filter berdasarkan kelas
        if ($request->kelas) {
            $query->whereHas('siswa', function($q) use ($request) {
                $q->where('kelas', $request->kelas);
            });
        }
        
        // Filter berdasarkan mata pelajaran
        if ($request->mapel_id) {
            $query->where('mapel_id', $request->mapel_id);
        }
        
        $nilai = $query->get();
        
        // Data untuk filter
        $kelasList = Siswa::select('kelas')->distinct()->pluck('kelas');
        $mapelList = MataPelajaran::all();
        
        return view('admin.laporan.index', compact('nilai', 'kelasList', 'mapelList'));
    }

    public function cetakPDF(Request $request)
    {
        // Akan diimplementasikan setelah install DOMPDF
        // Untuk sementara redirect back dengan pesan
        return redirect()->back()->with('info', 'Fitur cetak PDF sedang dalam pengembangan');
    }
}