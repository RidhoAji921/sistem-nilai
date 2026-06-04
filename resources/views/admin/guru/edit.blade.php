@extends('layouts.admin')

@section('title', 'Edit Guru')
@section('header', 'Edit Data Guru')

@section('content')
<div class="bg-white rounded-lg shadow max-w-2xl">
    <div class="px-6 py-4 border-b">
        <h3 class="font-semibold text-gray-700">
            <i class="fas fa-user-edit text-blue-600 mr-2"></i> Form Edit Guru
        </h3>
    </div>
    
    <form action="{{ route('admin.guru.update', $guru->id) }}" method="POST" class="p-6">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">NIP <span class="text-red-500">*</span></label>
                <input type="text" name="nip" value="{{ old('nip', $guru->nip) }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg @error('nip') border-red-500 @enderror" required>
                @error('nip') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                <input type="text" name="nama" value="{{ old('nama', $guru->nama) }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg @error('nama') border-red-500 @enderror" required>
                @error('nama') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Mata Pelajaran <span class="text-red-500">*</span></label>
                <input type="text" name="mapel" value="{{ old('mapel', $guru->mapel) }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" value="{{ $guru->user->email ?? '-' }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg bg-gray-100" readonly disabled>
                <p class="text-xs text-gray-400 mt-1">Email tidak dapat diubah</p>
            </div>
        </div>
        
        <div class="flex justify-end gap-3 mt-6 pt-4 border-t">
            <a href="{{ route('admin.guru.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                Batal
            </a>
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                Update
            </button>
        </div>
    </form>
</div>
@endsection
