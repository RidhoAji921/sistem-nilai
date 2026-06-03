<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Guru - SD Negeri Kota Bekasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <div class="w-64 bg-blue-900 text-white flex flex-col">
            <div class="p-5 text-center border-b border-blue-800">
                <div class="text-3xl mb-2">🏫</div>
                <h2 class="text-lg font-bold">Sistem Pengolahan</h2>
                <h3 class="text-md font-semibold">Data Nilai Siswa</h3>
                <p class="text-xs text-blue-300 mt-1">SD Negeri Kota Bekasi</p>
            </div>
            <nav class="flex-1 mt-5">
                <a href="#" class="flex items-center px-5 py-3 bg-blue-800 text-white">
                    <i class="fas fa-tachometer-alt w-5"></i>
                    <span class="ml-3">Dashboard</span>
                </a>
                <a href="#" class="flex items-center px-5 py-3 text-blue-300 hover:bg-blue-800 hover:text-white transition">
                    <i class="fas fa-pen w-5"></i>
                    <span class="ml-3">Input Nilai</span>
                </a>
                <a href="#" class="flex items-center px-5 py-3 text-blue-300 hover:bg-blue-800 hover:text-white transition">
                    <i class="fas fa-chart-bar w-5"></i>
                    <span class="ml-3">Rekap Nilai</span>
                </a>
            </nav>
            <div class="p-5 border-t border-blue-800">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center text-blue-300 hover:text-white transition w-full">
                        <i class="fas fa-sign-out-alt w-5"></i>
                        <span class="ml-3">Logout</span>
                    </button>
                </form>
            </div>
        </div>
        
        <div class="flex-1 overflow-y-auto">
            <div class="bg-white shadow-sm px-6 py-4">
                <h1 class="text-xl font-semibold text-gray-800">Dashboard Guru</h1>
                <p class="text-sm text-gray-500">Selamat datang, {{ Auth::user()->name }}</p>
            </div>
            
            <div class="p-6">
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-chalkboard-user text-blue-600 text-3xl"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold">{{ $guru->nama ?? Auth::user()->name }}</h2>
                            <p class="text-gray-500">Mata Pelajaran: {{ $guru->mapel ?? 'Belum diatur' }}</p>
                            <p class="text-gray-500">NIP: {{ $guru->nip ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>