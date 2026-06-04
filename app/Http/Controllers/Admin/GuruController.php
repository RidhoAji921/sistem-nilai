<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    public function index()
    {
        $guru = Guru::with('user')->get();
        return view('admin.guru.index', compact('guru'));
    }

    public function create()
    {
        return view('admin.guru.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            // NIP: hanya angka, panjang 18 karakter (format NIP PNS), unik
            'nip' => [
                'required',
                'string',
                'regex:/^[0-9]+$/',
                'min:18',
                'max:18',
                'unique:guru,nip'
            ],
            
            // Nama: hanya huruf dan spasi, minimal 3 karakter, maksimal 100
            'nama' => [
                'required',
                'string',
                'regex:/^[a-zA-Z\s\.\,\']+$/',
                'min:3',
                'max:100'
            ],
            
            // Mapel: huruf, angka, spasi, dan tanda baca tertentu
            'mapel' => [
                'required',
                'string',
                'regex:/^[a-zA-Z0-9\s\-\/]+$/',
                'min:3',
                'max:50'
            ],
            
            // Email: valid format, cek DNS (optional), unik
            'email' => [
                'required',
                'email:rfc,dns',
                'unique:users,email'
            ],
            
            // Password: minimal 6, harus huruf dan angka
            'password' => [
                'required',
                'string',
                'min:6'
            ],
            
        ], [
            // Pesan error kustom
            'nip.regex' => 'NIP hanya boleh berisi angka',
            'nip.min' => 'NIP harus 18 digit',
            'nip.max' => 'NIP harus 18 digit',
            'nip.unique' => 'NIP sudah terdaftar',
            'nama.regex' => 'Nama hanya boleh berisi huruf, spasi, dan titik',
            'nama.min' => 'Nama minimal 3 karakter',
            'nama.max' => 'Nama maksimal 100 karakter',
            'mapel.regex' => 'Format mata pelajaran tidak valid',
            'mapel.min' => 'Mata pelajaran minimal 3 karakter',
            'mapel.max' => 'Mata pelajaran maksimal 50 karakter',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.regex' => 'Password harus mengandung huruf dan angka',
            'password.min' => 'Password minimal 6 karakter',
            'password_confirmation.same' => 'Konfirmasi password tidak sama',
        ]);

        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'guru',
        ]);

        Guru::create([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'mapel' => $request->mapel,
            'user_id' => $user->id,
        ]);

        return redirect()->route('admin.guru.index')->with('success', 'Guru berhasil ditambahkan');
    }

    public function edit($id)
    {
        $guru = Guru::findOrFail($id);
        return view('admin.guru.edit', compact('guru'));
    }

    public function update(Request $request, $id)
    {
        $guru = Guru::findOrFail($id);    
        
        $request->validate([
            // NIP: hanya angka, 18 digit, unik (kecuali dirinya sendiri)
            'nip' => [
                'required',
                'string',
                'regex:/^[0-9]+$/',
                'min:18',
                'max:18',
                'unique:guru,nip,' . $id
            ],
            
            // Nama: hanya huruf dan spasi
            'nama' => [
                'required',
                'string',
                'regex:/^[a-zA-Z\s\.\,\']+$/',
                'min:3',
                'max:100'
            ],
            
            // Mapel: huruf, angka, spasi
            'mapel' => [
                'required',
                'string',
                'regex:/^[a-zA-Z0-9\s\-\/]+$/',
                'min:3',
                'max:50'
            ],
            
        ], [
            'nip.regex' => 'NIP hanya boleh berisi angka',
            'nip.min' => 'NIP harus 18 digit',
            'nip.max' => 'NIP harus 18 digit',
            'nip.unique' => 'NIP sudah terdaftar',
            'nama.regex' => 'Nama hanya boleh berisi huruf, spasi, dan titik',
            'nama.min' => 'Nama minimal 3 karakter',
            'nama.max' => 'Nama maksimal 100 karakter',
            'mapel.regex' => 'Format mata pelajaran tidak valid',
            'mapel.min' => 'Mata pelajaran minimal 3 karakter',
            'mapel.max' => 'Mata pelajaran maksimal 50 karakter',
        ]);

        $guru->update([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'mapel' => $request->mapel,
        ]);

        return redirect()->route('admin.guru.index')->with('success', 'Guru berhasil diupdate');
    }

    public function destroy($id)
    {
        $guru = Guru::findOrFail($id);
        
        // Hapus user terkait terlebih dahulu
        if ($guru->user) {
            $guru->user->delete();
        }
        
        $guru->delete();

        return redirect()->route('admin.guru.index')->with('success', 'Guru berhasil dihapus');
    }
}