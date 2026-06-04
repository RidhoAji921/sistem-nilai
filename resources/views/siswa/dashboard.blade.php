@extends('layouts.siswa')

@section('title', 'Dashboard Siswa')
@section('header', 'Dashboard Siswa')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <div class="bg-gradient-to-r from-yellow-500 to-yellow-600 rounded-lg shadow p-6 text-white">
        <div class="flex items-center gap-4">
            <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                <i class="fas fa-user-graduate text-white text-3xl"></i>
            </div>
            <div>
                <h2 class="text-2xl font-bold">{{ $siswa->nama ?? Auth::user()->name }}</h2>
                <p>NIS: {{ $siswa->nis ?? '-' }} | Kelas: {{ $siswa->kelas ?? '-' }}</p>
                <p class="text-sm text-yellow-100">SD Negeri Kota Bekasi</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Rata-rata Nilai</p>
                <p class="text-3xl font-bold {{ $rataRata >= 70 ? 'text-green-600' : 'text-red-600' }}">
                    {{ number_format($rataRata, 2) }}
                </p>
            </div>
            <div class="text-right">
                <p class="text-gray-500 text-sm">Status Kelulusan</p>
                @if($status == 'Lulus')
                    <div class="mt-1 px-4 py-2 bg-green-100 text-green-800 rounded-full text-lg font-semibold">
                        ✅ LULUS
                    </div>
                @else
                    <div class="mt-1 px-4 py-2 bg-red-100 text-red-800 rounded-full text-lg font-semibold">
                        ❌ TIDAK LULUS
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="bg-white rounded-lg shadow">
    <div class="px-6 py-4 border-b">
        <h3 class="font-semibold text-gray-800">📋 Informasi Akademik</h3>
    </div>
    <div class="p-6">
        <ul class="space-y-3">
            <li class="flex items-center gap-3 text-sm p-3 bg-gray-50 rounded-lg">
                <i class="fas fa-calendar-alt text-yellow-500"></i>
                <span>Tahun Ajaran: <strong>2024/2025</strong></span>
            </li>
            <li class="flex items-center gap-3 text-sm p-3 bg-gray-50 rounded-lg">
                <i class="fas fa-file-alt text-yellow-500"></i>
                <span>Rapor dapat diakses pada menu <strong>"Nilai Saya"</strong></span>
            </li>
            <li class="flex items-center gap-3 text-sm p-3 bg-gray-50 rounded-lg">
                <i class="fas fa-chart-line text-yellow-500"></i>
                <span>Nilai dihitung dengan rumus: <strong>(30% Tugas) + (30% UTS) + (40% UAS)</strong></span>
            </li>
        </ul>
    </div>
</div>
@endsection