@extends('layouts.admin')

@section('title', 'Laporan Nilai Siswa')
@section('header', 'Laporan Nilai Siswa')

@section('content')
<!-- Filter Form -->
<div class="bg-white rounded-lg shadow p-4 mb-6">
    <form method="GET" action="{{ route('admin.laporan') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Filter Kelas</label>
            <select name="kelas" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                <option value="">-- Semua Kelas --</option>
                @foreach($kelasList as $kelas)
                    <option value="{{ $kelas }}" {{ request('kelas') == $kelas ? 'selected' : '' }}>
                        {{ $kelas }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Filter Mata Pelajaran</label>
            <select name="mapel_id" class="w-full px-3 py-2 border border-gray-300 rounded-lg">
                <option value="">-- Semua Mapel --</option>
                @foreach($mapelList as $mapel)
                    <option value="{{ $mapel->id }}" {{ request('mapel_id') == $mapel->id ? 'selected' : '' }}>
                        {{ $mapel->nama_mapel }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div class="flex items-end">
            <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">
                <i class="fas fa-search mr-2"></i>Tampilkan
            </button>
        </div>
        
        <div class="flex items-end gap-2">
            <a href="{{ route('admin.laporan') }}" class="w-full bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition text-center">
                <i class="fas fa-sync-alt mr-2"></i>Reset
            </a>
            <button type="button" onclick="window.print()" class="w-full bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                <i class="fas fa-print mr-2"></i>Cetak
            </button>
        </div>
    </form>
</div>

<!-- Tabel Laporan -->
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="px-6 py-3 bg-gray-50 border-b">
        <h3 class="font-semibold text-gray-700">
            📋 Daftar Nilai Siswa SD Negeri Kota Bekasi
        </h3>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">NIS</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Siswa</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kelas</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Mata Pelajaran</th>
                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">Tugas<br>(30%)</th>
                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">UTS<br>(30%)</th>
                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">UAS<br>(40%)</th>
                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">Nilai Akhir</th>
                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($nilai as $index => $n)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 text-sm">{{ $loop->iteration }}</td>
                    <td class="px-4 py-3 text-sm">{{ $n->siswa->nis }}</td>
                    <td class="px-4 py-3 text-sm font-medium">{{ $n->siswa->nama }}</td>
                    <td class="px-4 py-3 text-sm">{{ $n->siswa->kelas }}</td>
                    <td class="px-4 py-3 text-sm">{{ $n->mataPelajaran->nama_mapel }}</td>
                    <td class="px-4 py-3 text-sm text-center">{{ $n->tugas }}</td>
                    <td class="px-4 py-3 text-sm text-center">{{ $n->uts }}</td>
                    <td class="px-4 py-3 text-sm text-center">{{ $n->uas }}</td>
                    <td class="px-4 py-3 text-sm text-center font-bold {{ $n->nilai_akhir >= 70 ? 'text-green-600' : 'text-red-600' }}">
                        {{ number_format($n->nilai_akhir, 2) }}
                    </td>
                    <td class="px-4 py-3 text-center">
                        @if($n->status == 'Lulus')
                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">
                                ✅ Lulus
                            </span>
                        @else
                            <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs">
                                ❌ Tidak Lulus
                            </span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="px-4 py-8 text-center text-gray-500">
                        <i class="fas fa-database text-4xl mb-2 block"></i>
                        Belum ada data nilai
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($nilai->count() > 0)
    <div class="px-6 py-4 border-t bg-gray-50">
        <div class="flex justify-between items-center">
            <div class="text-sm text-gray-500">
                <i class="fas fa-chart-line mr-2"></i>
                Total Data: {{ $nilai->count() }} nilai
            </div>
            <div class="text-sm text-gray-500">
                SD Negeri Kota Bekasi - Tahun Ajaran 2024/2025
            </div>
        </div>
    </div>
    @endif
</div>

<!-- Ringkasan Statistik -->
@if($nilai->count() > 0)
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
    <div class="bg-green-50 rounded-lg p-4 border border-green-200">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-green-600">Siswa Lulus</p>
                <p class="text-2xl font-bold text-green-700">
                    {{ $nilai->where('status', 'Lulus')->groupBy('siswa_id')->count() }}
                </p>
            </div>
            <i class="fas fa-check-circle text-green-500 text-3xl"></i>
        </div>
    </div>
    
    <div class="bg-red-50 rounded-lg p-4 border border-red-200">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-red-600">Siswa Tidak Lulus</p>
                <p class="text-2xl font-bold text-red-700">
                    {{ $nilai->where('status', 'Tidak Lulus')->groupBy('siswa_id')->count() }}
                </p>
            </div>
            <i class="fas fa-times-circle text-red-500 text-3xl"></i>
        </div>
    </div>
    
    <div class="bg-blue-50 rounded-lg p-4 border border-blue-200">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-blue-600">Rata-rata Nilai</p>
                <p class="text-2xl font-bold text-blue-700">
                    {{ number_format($nilai->avg('nilai_akhir'), 2) }}
                </p>
            </div>
            <i class="fas fa-chart-line text-blue-500 text-3xl"></i>
        </div>
    </div>
</div>
@endif
@endsection