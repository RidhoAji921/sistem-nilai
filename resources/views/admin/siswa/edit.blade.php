@extends('layouts.admin')

@section('title', 'Edit Siswa')
@section('header', 'Edit Data Siswa')

@section('content')
<div class="bg-white rounded-lg shadow max-w-2xl">
    <div class="px-6 py-4 border-b">
        <h3 class="font-semibold text-gray-700">
            <i class="fas fa-user-edit text-blue-600 mr-2"></i> Form Edit Siswa
        </h3>
    </div>
    
    <form action="{{ route('admin.siswa.update', $siswa->id) }}" method="POST" class="p-6">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">NIS <span class="text-red-500">*</span></label>
                <input type="text" name="nis" value="{{ old('nis', $siswa->nis) }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg @error('nis') border-red-500 @enderror" required>
                @error('nis') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                <input type="text" name="nama" value="{{ old('nama', $siswa->nama) }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg @error('nama') border-red-500 @enderror" required>
                @error('nama') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kelas <span class="text-red-500">*</span></label>
                <select name="kelas" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
                    <option value="VI-A" {{ $siswa->kelas == 'VI-A' ? 'selected' : '' }}>VI-A</option>
                    <option value="VI-B" {{ $siswa->kelas == 'VI-B' ? 'selected' : '' }}>VI-B</option>
                    <option value="VI-C" {{ $siswa->kelas == 'VI-C' ? 'selected' : '' }}>VI-C</option>
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" value="{{ $siswa->user->email ?? '-' }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-100" readonly disabled>
                <p class="text-xs text-gray-400 mt-1">Email tidak dapat diubah</p>
            </div>
        </div>
        
        <div class="flex justify-end gap-3 mt-6 pt-4 border-t">
            <a href="{{ route('admin.siswa.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                Batal
            </a>
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                Update
            </button>
        </div>
    </form>
</div>
@endsection