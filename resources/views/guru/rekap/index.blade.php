@extends('layouts.guru')

@section('title', 'Rekap Nilai Siswa')
@section('header', 'Rekap Nilai Siswa')

@section('content')
<div class="bg-white rounded-lg shadow p-4 mb-6">
    <div class="flex items-center gap-4">
        <div class="bg-green-100 p-3 rounded-full">
            <i class="fas fa-chart-line text-green-600 text-xl"></i>
        </div>
        <div>
            <p class="text-sm text-gray-600">
                Mata Pelajaran: <strong>{{ $mapel->nama_mapel ?? '-' }}</strong>
            </p>
            <p class="text-sm text-gray-600">
                Rata-rata Kelas: <strong class="text-blue-600">{{ number_format($rataKelas, 2) }}</strong>
            </p>
        </div>
    </div>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500">No</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500">NIS</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500">Nama Siswa</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500">Kelas</th>
                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500">Tugas</th>
                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500">UTS</th>
                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500">UAS</th>
                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500">Nilai Akhir</th>
                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($nilai as $index => $n)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 text-sm">{{ $loop->iteration }}</td>
                    <td class="px-4 py-3 text-sm">{{ $n->siswa->nis }}</td>
                    <td class="px-4 py-3 text-sm font-medium">{{ $n->siswa->nama }}</td>
                    <td class="px-4 py-3 text-sm">{{ $n->siswa->kelas }}</td>
                    <td class="px-4 py-3 text-sm text-center">{{ $n->tugas }}</td>
                    <td class="px-4 py-3 text-sm text-center">{{ $n->uts }}</td>
                    <td class="px-4 py-3 text-sm text-center">{{ $n->uas }}</td>
                    <td class="px-4 py-3 text-sm text-center font-bold {{ $n->nilai_akhir >= 70 ? 'text-green-600' : 'text-red-600' }}">
                        {{ number_format($n->nilai_akhir, 2) }}
                    </td>
                    <td class="px-4 py-3 text-center">
                        @if($n->status == 'Lulus')
                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">✅ Lulus</span>
                        @else
                            <span class="px-2 py-1 bg-red-100 text-red-800 rounded-full text-xs">❌ Tidak Lulus</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="px-4 py-8 text-center text-gray-500">
                        Belum ada data nilai
                    </td>
                </tr>
                @endforelse
            </tbody>
            <tfoot class="bg-gray-50">
                <tr>
                    <td colspan="4" class="px-4 py-3 text-sm font-bold">Rata-rata</td>
                    <td class="px-4 py-3 text-sm text-center">{{ number_format($nilai->avg('tugas'), 2) }}</td>
                    <td class="px-4 py-3 text-sm text-center">{{ number_format($nilai->avg('uts'), 2) }}</td>
                    <td class="px-4 py-3 text-sm text-center">{{ number_format($nilai->avg('uas'), 2) }}</td>
                    <td class="px-4 py-3 text-sm text-center font-bold">{{ number_format($rataKelas, 2) }}</td>
                    <td class="px-4 py-3 text-center"></td>
                </tr>
            </tfoot>
        </table>
    </div>
    
    <div class="px-6 py-4 border-t bg-gray-50">
        <div class="flex justify-between items-center">
            <div class="text-sm text-gray-500">
                <i class="fas fa-chart-line mr-2"></i>
                Total Siswa: {{ $nilai->count() }} | 
                Lulus: {{ $nilai->where('status', 'Lulus')->count() }} | 
                Tidak Lulus: {{ $nilai->where('status', 'Tidak Lulus')->count() }}
            </div>
            <button onclick="window.print()" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">
                <i class="fas fa-print mr-2"></i>Cetak
            </button>
        </div>
    </div>
</div>
@endsection