@extends('layouts.admin')

@section('title', 'Tambah Mata Pelajaran')
@section('header', 'Tambah Mata Pelajaran')

@section('content')
<div class="bg-white rounded-lg shadow max-w-2xl">
    <div class="px-6 py-4 border-b">
        <h3 class="font-semibold text-gray-700">
            <i class="fas fa-book text-blue-600 mr-2"></i> Form Tambah Mata Pelajaran
        </h3>
    </div>
    
    <form action="{{ route('admin.mapel.store') }}" method="POST" class="p-6">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kode <span class="text-red-500">*</span></label>
                <input type="text" name="kode" value="{{ old('kode') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('kode') border-red-500 @enderror" required>
                @error('kode') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Mata Pelajaran <span class="text-red-500">*</span></label>
                <input type="text" name="nama_mapel" value="{{ old('nama_mapel') }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 @error('nama_mapel') border-red-500 @enderror" required>
                @error('nama_mapel') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Guru Pengampu</label>
                <select name="guru_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                    <option value="">-- Pilih Guru (Opsional) --</option>
                    @foreach($gurus as $guru)
                        <option value="{{ $guru->id }}" {{ old('guru_id') == $guru->id ? 'selected' : '' }}>
                            {{ $guru->nama }} - {{ $guru->mapel }}
                        </option>
                    @endforeach
                </select>
                @error('guru_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>
        </div>
        
        <div class="flex justify-end gap-3 mt-6 pt-4 border-t">
            <a href="{{ route('admin.mapel.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                Batal
            </a>
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection