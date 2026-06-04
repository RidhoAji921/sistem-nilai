<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MataPelajaran;
use App\Models\Guru;
use Illuminate\Http\Request;

class MataPelajaranController extends Controller
{
    public function index()
    {
        $mapel = MataPelajaran::with('guru')->get();
        return view('admin.mapel.index', compact('mapel'));
    }

    public function create()
    {
        $gurus = Guru::all(); // Ambil semua data guru
        return view('admin.mapel.create', compact('gurus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:mata_pelajaran',
            'nama_mapel' => 'required',
            'guru_id' => 'nullable|exists:guru,id',
        ]);

        MataPelajaran::create($request->all());

        return redirect()->route('admin.mapel.index')->with('success', 'Mata pelajaran berhasil ditambahkan');
    }

    public function edit($id)
    {
        $mapel = MataPelajaran::findOrFail($id);
        $gurus = Guru::all(); // Ambil semua data guru
        return view('admin.mapel.edit', compact('mapel', 'gurus'));
    }

    public function update(Request $request, $id)
    {
        $mapel = MataPelajaran::findOrFail($id);
        
        $request->validate([
            'kode' => 'required|unique:mata_pelajaran,kode,'.$id,
            'nama_mapel' => 'required',
            'guru_id' => 'nullable|exists:guru,id',
        ]);

        $mapel->update($request->all());

        return redirect()->route('admin.mapel.index')->with('success', 'Mata pelajaran berhasil diupdate');
    }

    public function destroy($id)
    {
        $mapel = MataPelajaran::findOrFail($id);
        $mapel->delete();

        return redirect()->route('admin.mapel.index')->with('success', 'Mata pelajaran berhasil dihapus');
    }
}