<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NilaiController extends Controller
{
    public function index()
    {
        $guru = Auth::user()->guru;
        
        // Ambil mapel yang diampu oleh guru yang login
        $mapel = MataPelajaran::where('guru_id', $guru->id)->first();
        
        if (!$mapel) {
            return view('guru.nilai.index', [
                'siswa' => collect(),
                'mapel' => null,
                'nilai' => collect()
            ])->with('error', 'Anda belum diampu mata pelajaran apapun.');
        }
        
        $siswa = Siswa::orderBy('kelas')->orderBy('nama')->get();
        $nilai = Nilai::where('mapel_id', $mapel->id)->get()->keyBy('siswa_id');
        
        return view('guru.nilai.index', compact('siswa', 'mapel', 'nilai'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'mapel_id' => 'required|exists:mata_pelajaran,id',
            'nilai' => 'required|array',
            'nilai.*.tugas' => 'nullable|numeric|min:0|max:100',
            'nilai.*.uts' => 'nullable|numeric|min:0|max:100',
            'nilai.*.uas' => 'nullable|numeric|min:0|max:100',
        ]);
        
        $siswaId = $request->siswa_id;
        $nilaiData = $request->nilai[$siswaId];
        
        // Validasi menggunakan fungsi terstruktur
        if (!validasiNilai($nilaiData['tugas'] ?? 0) || 
            !validasiNilai($nilaiData['uts'] ?? 0) || 
            !validasiNilai($nilaiData['uas'] ?? 0)) {
            return redirect()->back()->with('error', 'Nilai harus dalam rentang 0-100');
        }
        
        // Simpan atau update menggunakan OOP
        $nilai = Nilai::updateOrCreate(
            [
                'siswa_id' => $siswaId,
                'mapel_id' => $request->mapel_id,
            ],
            [
                'tugas' => $nilaiData['tugas'] ?? 0,
                'uts' => $nilaiData['uts'] ?? 0,
                'uas' => $nilaiData['uas'] ?? 0,
            ]
        );
        
        // Hitung ulang nilai akhir menggunakan method OOP
        $nilai->hitungUlangNilaiAkhir();
        $nilai->save();
        
        return redirect()->back()->with('success', 'Nilai berhasil disimpan');
    }
}