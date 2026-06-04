@extends('layouts.siswa')

@section('title', 'Nilai Saya')
@section('header', 'Nilai Saya')

@section('content')
<div class="bg-white rounded-lg shadow overflow-hidden mb-6">
    <div class="px-6 py-3 bg-gray-50 border-b">
        <h3 class="font-semibold text-gray-700">📊 Daftar Nilai Mata Pelajaran</h3>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Mata Pelajaran</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500">Tugas (30%)</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500">UTS (30%)</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500">UAS (40%)</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500">Nilai Akhir</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($nilai as $index => $n)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 text-sm">{{ $loop->iteration }}</td>
                    <td class="px-6 py-4 text-sm font-medium">{{ $n->mataPelajaran->nama_mapel }}</td>
                    <td class="px-6 py-4 text-sm text-center">{{ $n->tugas }}</td>
                    <td class="px-6 py-4 text-sm text-center">{{ $n->uts }}</td>
                    <td class="px-6 py-4 text-sm text-center">{{ $n->uas }}</td>
                    <td class="px-6 py-4 text-sm text-center font-bold {{ $n->nilai_akhir >= 70 ? 'text-green-600' : 'text-red-600' }}">
                        {{ number_format($n->nilai_akhir, 2) }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        @if($n->status == 'Lulus')
                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">✅ Lulus</span>
                        @else
                            <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs">❌ Tidak Lulus</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                        <i class="fas fa-database text-4xl mb-2 block"></i>
                        Belum ada data nilai
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Ringkasan -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div class="bg-green-50 rounded-lg p-4 border border-green-200">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-green-600">Rata-rata Nilai</p>
                <p class="text-2xl font-bold text-green-700">
                    {{ number_format($rataRata, 2) }}
                </p>
            </div>
            <i class="fas fa-chart-line text-green-500 text-3xl"></i>
        </div>
    </div>
    
    <div class="bg-blue-50 rounded-lg p-4 border border-blue-200">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-blue-600">Jumlah Mata Pelajaran</p>
                <p class="text-2xl font-bold text-blue-700">
                    {{ $nilai->count() }}
                </p>
            </div>
            <i class="fas fa-book text-blue-500 text-3xl"></i>
        </div>
    </div>
    
    <div class="{{ $status == 'Lulus' ? 'bg-green-50 border-green-200' : 'bg-red-50 border-red-200' }} rounded-lg p-4 border">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm {{ $status == 'Lulus' ? 'text-green-600' : 'text-red-600' }}">Status Kelulusan</p>
                <p class="text-2xl font-bold {{ $status == 'Lulus' ? 'text-green-700' : 'text-red-700' }}">
                    {{ $status }}
                </p>
            </div>
            <i class="fas {{ $status == 'Lulus' ? 'fa-check-circle text-green-500' : 'fa-times-circle text-red-500' }} text-3xl"></i>
        </div>
    </div>
</div>

<div class="mt-6 text-center text-xs text-gray-400">
    SD Negeri Kota Bekasi - Laporan Hasil Belajar Siswa - Tahun Ajaran 2024/2025
</div>
@endsection