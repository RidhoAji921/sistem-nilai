@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('header', 'Dashboard Admin')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow p-6 flex items-center justify-between">
        <div>
            <p class="text-gray-500 text-sm">Total Siswa</p>
            <p class="text-3xl font-bold">{{ $totalSiswa }}</p>
        </div>
        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
            <i class="fas fa-user-graduate text-blue-600 text-xl"></i>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6 flex items-center justify-between">
        <div>
            <p class="text-gray-500 text-sm">Total Guru</p>
            <p class="text-3xl font-bold">{{ $totalGuru }}</p>
        </div>
        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
            <i class="fas fa-chalkboard-user text-green-600 text-xl"></i>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6 flex items-center justify-between">
        <div>
            <p class="text-gray-500 text-sm">Total Mapel</p>
            <p class="text-3xl font-bold">{{ $totalMapel }}</p>
        </div>
        <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
            <i class="fas fa-book text-purple-600 text-xl"></i>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6 flex items-center justify-between">
        <div>
            <p class="text-gray-500 text-sm">Siswa Lulus</p>
            <p class="text-3xl font-bold text-green-600">{{ $totalLulus }}</p>
        </div>
        <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
            <i class="fas fa-check-circle text-yellow-600 text-xl"></i>
        </div>
    </div>
</div>

<div class="bg-white rounded-lg shadow">
    <div class="px-6 py-4 border-b">
        <h3 class="font-semibold text-gray-800">📋 Selamat Datang, {{ Auth::user()->name }}</h3>
    </div>
    <div class="p-6">
        <p class="text-gray-600">Anda login sebagai <strong>Administrator</strong> dengan hak akses penuh.</p>
        <p class="text-gray-600 mt-2">Gunakan menu di samping untuk mengelola data siswa, guru, mata pelajaran, dan laporan nilai.</p>
    </div>
</div>
@endsection