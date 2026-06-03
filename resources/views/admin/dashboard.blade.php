<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - SD Negeri Kota Bekasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-blue-900 text-white flex flex-col">
            <div class="p-5 text-center border-b border-blue-800">
                <div class="text-3xl mb-2">🏫</div>
                <h2 class="text-lg font-bold">Sistem Pengolahan</h2>
                <h3 class="text-md font-semibold">Data Nilai Siswa</h3>
                <p class="text-xs text-blue-300 mt-1">SD Negeri Kota Bekasi</p>
            </div>
            <nav class="flex-1 mt-5">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-5 py-3 bg-blue-800 text-white">
                    <i class="fas fa-tachometer-alt w-5"></i>
                    <span class="ml-3">Dashboard</span>
                </a>
                <a href="#" class="flex items-center px-5 py-3 text-blue-300 hover:bg-blue-800 hover:text-white transition">
                    <i class="fas fa-user-graduate w-5"></i>
                    <span class="ml-3">Siswa</span>
                </a>
                <a href="#" class="flex items-center px-5 py-3 text-blue-300 hover:bg-blue-800 hover:text-white transition">
                    <i class="fas fa-chalkboard-user w-5"></i>
                    <span class="ml-3">Guru</span>
                </a>
                <a href="#" class="flex items-center px-5 py-3 text-blue-300 hover:bg-blue-800 hover:text-white transition">
                    <i class="fas fa-book w-5"></i>
                    <span class="ml-3">Mata Pelajaran</span>
                </a>
                <a href="#" class="flex items-center px-5 py-3 text-blue-300 hover:bg-blue-800 hover:text-white transition">
                    <i class="fas fa-chart-line w-5"></i>
                    <span class="ml-3">Laporan</span>
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
        
        <!-- Main Content -->
        <div class="flex-1 overflow-y-auto">
            <div class="bg-white shadow-sm px-6 py-4 flex justify-between items-center">
                <div>
                    <h1 class="text-xl font-semibold text-gray-800">Dashboard Admin</h1>
                    <p class="text-sm text-gray-500">Sistem Pengolahan Data Nilai Siswa - SD Negeri Kota Bekasi</p>
                </div>
                <div class="flex items-center gap-3">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center text-white font-bold">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <span class="text-sm font-medium">{{ Auth::user()->name }}</span>
                    </div>
                </div>
            </div>
            
            <div class="p-6">
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
            </div>
        </div>
    </div>
</body>
</html>