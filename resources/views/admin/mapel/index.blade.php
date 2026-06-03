@extends('layouts.admin')

@section('title', 'Data Mata Pelajaran')
@section('header', 'Data Mata Pelajaran')

@section('content')
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="px-6 py-4 border-b flex justify-between items-center">
        <h3 class="font-semibold text-gray-700">📋 Daftar Mata Pelajaran</h3>
        <a href="{{ route('admin.mapel.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition flex items-center gap-2">
            <i class="fas fa-plus"></i> Tambah Mapel
        </a>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kode</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Mata Pelajaran</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Guru Pengampu</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($mapel as $index => $m)
                <tr>
                    <td class="px-6 py-4 text-sm">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 text-sm font-medium">{{ $m->kode }}</td>
                    <td class="px-6 py-4 text-sm">{{ $m->nama_mapel }}</td>
                    <td class="px-6 py-4 text-sm">{{ $m->guru->nama ?? '-' }}</td>
                    <td class="px-6 py-4 text-sm space-x-2">
                        <a href="{{ route('admin.mapel.edit', $m->id) }}" class="text-blue-600 hover:text-blue-800">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('admin.mapel.destroy', $m->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Yakin ingin menghapus?')">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">Belum ada data mata pelajaran</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection