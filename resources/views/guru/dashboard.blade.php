@extends('layouts.guru')

@section('title', 'Dashboard Guru')
@section('header', 'Dashboard Guru')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center gap-4">
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center">
                <i class="fas fa-chalkboard-user text-green-600 text-3xl"></i>
            </div>
            <div>
                <h2 class="text-xl font-bold">{{ $guru->nama ?? Auth::user()->name }}</h2>
                <p class="text-gray-500">Mata Pelajaran: <strong>{{ $guru->mapel ?? 'Belum diatur' }}</strong></p>
                <p class="text-gray-500">NIP: {{ $guru->nip ?? '-' }}</p>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Total Siswa</p>
                <p class="text-3xl font-bold">{{ $totalSiswa ?? 0 }}</p>
                <p class="text-xs text-gray-400">Seluruh kelas</p>
            </div>
            <i class="fas fa-users text-green-500 text-4xl"></i>
        </div>
    </div>
</div>

<div class="bg-white rounded-lg shadow">
    <div class="px-6 py-4 border-b">
        <h3 class="font-semibold text-gray-800">📋 Petunjuk Penggunaan</h3>
    </div>
    <div class="p-6">
        <ul class="space-y-3">
            <li class="flex items-center gap-3 text-sm">
                <i class="fas fa-check-circle text-green-500"></i>
                <span>Gunakan menu <strong>Input Nilai</strong> untuk mengisi nilai tugas, UTS, dan UAS siswa</span>
            </li>
            <li class="flex items-center gap-3 text-sm">
                <i class="fas fa-check-circle text-green-500"></i>
                <span>Nilai akan otomatis dihitung dengan rumus: <strong>(30% Tugas) + (30% UTS) + (40% UAS)</strong></span>
            </li>
            <li class="flex items-center gap-3 text-sm">
                <i class="fas fa-check-circle text-green-500"></i>
                <span>Gunakan menu <strong>Rekap Nilai</strong> untuk melihat ringkasan nilai siswa per mata pelajaran</span>
            </li>
            <li class="flex items-center gap-3 text-sm">
                <i class="fas fa-exclamation-triangle text-yellow-500"></i>
                <span>Pastikan nilai yang diinput dalam rentang <strong>0-100</strong></span>
            </li>
        </ul>
    </div>
</div>
@endsection