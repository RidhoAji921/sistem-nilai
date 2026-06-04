@extends('layouts.guru')

@section('title', 'Input Nilai Siswa')
@section('header', 'Input Nilai Siswa')

@section('content')
<div class="bg-white rounded-lg shadow p-4 mb-6">
    <div class="flex items-center gap-4">
        <div class="bg-green-100 p-3 rounded-full">
            <i class="fas fa-info-circle text-green-600 text-xl"></i>
        </div>
        <div>
            <p class="text-sm text-gray-600">
                Mata Pelajaran: <strong>{{ $mapel->nama_mapel ?? 'Belum ada mapel' }}</strong>
            </p>
            <p class="text-xs text-gray-500">
                Rumus: (30% × Tugas) + (30% × UTS) + (40% × UAS)
            </p>
        </div>
    </div>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="overflow-x-auto">
        <form action="{{ route('guru.nilai.store') }}" method="POST">
            @csrf
            <input type="hidden" name="mapel_id" value="{{ $mapel->id ?? '' }}">
            
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500">No</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500">NIS</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500">Nama Siswa</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500">Kelas</th>
                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-500">Tugas (30%)</th>
                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-500">UTS (30%)</th>
                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-500">UAS (40%)</th>
                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-500">Nilai Akhir</th>
                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-500">Status</th>
                        <th class="px-4 py-3 text-center text-xs font-medium text-gray-500">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($siswa as $index => $s)
                        @php
                            $nilaiSiswa = $nilai->where('siswa_id', $s->id)->first();
                        @endphp
                        <tr>
                            <td class="px-4 py-3 text-sm">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3 text-sm">{{ $s->nis }}</td>
                            <td class="px-4 py-3 text-sm font-medium">{{ $s->nama }}</td>
                            <td class="px-4 py-3 text-sm">{{ $s->kelas }}</td>
                            <td class="px-4 py-3 text-center">
                                <input type="number" name="nilai[{{ $s->id }}][tugas]" 
                                       value="{{ old('nilai.'.$s->id.'.tugas', $nilaiSiswa->tugas ?? '') }}"
                                       class="w-20 px-2 py-1 border rounded text-center" min="0" max="100">
                            </td>
                            <td class="px-4 py-3 text-center">
                                <input type="number" name="nilai[{{ $s->id }}][uts]" 
                                       value="{{ old('nilai.'.$s->id.'.uts', $nilaiSiswa->uts ?? '') }}"
                                       class="w-20 px-2 py-1 border rounded text-center" min="0" max="100">
                            </td>
                            <td class="px-4 py-3 text-center">
                                <input type="number" name="nilai[{{ $s->id }}][uas]" 
                                       value="{{ old('nilai.'.$s->id.'.uas', $nilaiSiswa->uas ?? '') }}"
                                       class="w-20 px-2 py-1 border rounded text-center" min="0" max="100">
                            </td>
                            <td class="px-4 py-3 text-center font-semibold {{ ($nilaiSiswa->nilai_akhir ?? 0) >= 70 ? 'text-green-600' : 'text-red-600' }}">
                                {{ number_format($nilaiSiswa->nilai_akhir ?? 0, 2) }}
                            </td>
                            <td class="px-4 py-3 text-center">
                                @if(isset($nilaiSiswa) && $nilaiSiswa->status == 'Lulus')
                                    <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">Lulus</span>
                                @elseif(isset($nilaiSiswa) && $nilaiSiswa->status == 'Tidak Lulus')
                                    <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs">Tidak Lulus</span>
                                @else
                                    <span class="px-2 py-1 bg-gray-100 text-gray-800 rounded-full text-xs">Belum diisi</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-center">
                                <button type="submit" name="siswa_id" value="{{ $s->id }}" 
                                        class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700">
                                    <i class="fas fa-save"></i> Simpan
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="px-4 py-8 text-center text-gray-500">
                                Belum ada data siswa
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </form>
    </div>
    
    <div class="px-6 py-4 border-t bg-gray-50">
        <div class="text-sm text-yellow-600 flex items-center gap-2">
            <i class="fas fa-exclamation-triangle"></i>
            <span>Nilai harus dalam rentang 0-100</span>
        </div>
    </div>
</div>

<div class="mt-6 text-center text-xs text-gray-400">
    SD Negeri Kota Bekasi - Tahun Ajaran 2024/2025
</div>
@endsection