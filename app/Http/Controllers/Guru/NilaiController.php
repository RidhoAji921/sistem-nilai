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
        $mapel = MataPelajaran::where('guru_id', $guru->id)->first();
        $siswa = Siswa::all();
        $nilai = Nilai::with(['siswa', 'mataPelajaran'])->get();
        
        return view('guru.nilai.index', compact('siswa', 'mapel', 'nilai'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required',
            'mapel_id' => 'required',
            'tugas' => 'required|numeric|min:0|max:100',
            'uts' => 'required|numeric|min:0|max:100',
            'uas' => 'required|numeric|min:0|max:100',
        ]);

        $nilai = Nilai::updateOrCreate(
            [
                'siswa_id' => $request->siswa_id,
                'mapel_id' => $request->mapel_id,
            ],
            [
                'tugas' => $request->tugas,
                'uts' => $request->uts,
                'uas' => $request->uas,
            ]
        );
        
        // Panggil method OOP untuk hitung nilai akhir
        $nilai->hitungUlangNilaiAkhir();
        $nilai->save();

        return redirect()->back()->with('success', 'Nilai berhasil disimpan');
    }

    public function update(Request $request, $id)
    {
        $nilai = Nilai::findOrFail($id);
        
        $request->validate([
            'tugas' => 'required|numeric|min:0|max:100',
            'uts' => 'required|numeric|min:0|max:100',
            'uas' => 'required|numeric|min:0|max:100',
        ]);

        $nilai->updateNilai($request->tugas, $request->uts, $request->uas);
        $nilai->save();

        return redirect()->back()->with('success', 'Nilai berhasil diupdate');
    }
}