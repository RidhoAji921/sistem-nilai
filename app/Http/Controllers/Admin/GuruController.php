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
            'nip' => 'required|unique:guru',
            'nama' => 'required',
            'mapel' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
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
            'nip' => 'required|unique:guru,nip,'.$id,
            'nama' => 'required',
            'mapel' => 'required',
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
        if ($guru->user) {
            $guru->user->delete();
        }
        $guru->delete();

        return redirect()->route('admin.guru.index')->with('success', 'Guru berhasil dihapus');
    }
}