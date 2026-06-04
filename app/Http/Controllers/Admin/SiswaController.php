<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::with('user')->get();
        return view('admin.siswa.index', compact('siswa'));
    }

    public function create()
    {
        return view('admin.siswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            // NIS: hanya angka, panjang 8-12 karakter, unik
            'nis' => 'required|string|regex:/^[0-9]+$/|min:8|max:12|unique:siswa,nis',
            
            // Nama: hanya huruf dan spasi, minimal 3 karakter, maksimal 100
            'nama' => 'required|string|regex:/^[a-zA-Z\s]+$/|min:3|max:100',
            
            // Kelas: format kelas yang valid (contoh: VI-A, 6A, 6-A)
            'kelas' => 'required|string|regex:/^[0-9IVX]+[-]?[A-Z]+$/|max:10',
            
            // Email: valid format, cek DNS (optional), unik
            'email' => 'required|email:rfc,dns|unique:users,email',
            
            // Password: minimal 6 karakter, harus mengandung huruf dan angka
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'siswa',
        ]);

        Siswa::create([
            'nis' => $request->nis,
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'user_id' => $user->id,
        ]);

        return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil ditambahkan');
    }

    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('admin.siswa.edit', compact('siswa'));
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);
        $request->validate([
            // NIS: hanya angka, panjang 8-12 karakter, unik (kecuali dirinya sendiri)
            'nis' => [
                'required',
                'string',
                'regex:/^[0-9]+$/',
                'min:8',
                'max:12',
                'unique:siswa,nis,' . $id
            ],
            
            // Nama: hanya huruf dan spasi, minimal 3 karakter, maksimal 100
            'nama' => [
                'required',
                'string',
                'regex:/^[a-zA-Z\s]+$/',
                'min:3',
                'max:100'
            ],
            
            // Kelas: format kelas yang valid
            'kelas' => [
                'required',
                'string',
                'regex:/^[0-9IVX]+[-]?[A-Z]+$/',
                'max:10'
            ],
        ], [
            // Pesan error kustom
            'nis.regex' => 'NIS hanya boleh berisi angka',
            'nis.min' => 'NIS minimal 8 digit',
            'nis.max' => 'NIS maksimal 12 digit',
            'nis.unique' => 'NIS sudah terdaftar',
            'nama.regex' => 'Nama hanya boleh berisi huruf dan spasi',
            'nama.min' => 'Nama minimal 3 karakter',
            'nama.max' => 'Nama maksimal 100 karakter',
            'kelas.regex' => 'Format kelas tidak valid (contoh: VI-A, 6A, 6-A)',
            'kelas.max' => 'Kelas maksimal 10 karakter',
        ]);

        $siswa->update([
            'nis' => $request->nis,
            'nama' => $request->nama,
            'kelas' => $request->kelas,
        ]);

        return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil diupdate');
    }

    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        
        // Hapus user terkait terlebih dahulu
        if ($siswa->user) {
            $siswa->user->delete();
        }
        
        $siswa->delete();

        return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil dihapus');
    }
}