<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - SD Negeri Kota Bekasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar Guru -->
        <div class="w-64 bg-green-900 text-white flex flex-col">
            <div class="p-5 text-center border-b border-green-800">
                <div class="text-3xl mb-2">🏫</div>
                <h2 class="text-lg font-bold">Sistem Pengolahan</h2>
                <h3 class="text-md font-semibold">Data Nilai Siswa</h3>
                <p class="text-xs text-green-300 mt-1">SD Negeri Kota Bekasi</p>
                <p class="text-xs text-green-400 mt-2">Role: Guru</p>
            </div>
            <nav class="flex-1 mt-5">
                <a href="{{ route('guru.dashboard') }}" class="flex items-center px-5 py-3 {{ request()->routeIs('guru.dashboard') ? 'bg-green-800' : 'text-green-300 hover:bg-green-800 hover:text-white' }} transition">
                    <i class="fas fa-tachometer-alt w-5"></i>
                    <span class="ml-3">Dashboard</span>
                </a>
                <a href="{{ route('guru.nilai.index') }}" class="flex items-center px-5 py-3 {{ request()->routeIs('guru.nilai.*') ? 'bg-green-800' : 'text-green-300 hover:bg-green-800 hover:text-white' }} transition">
                    <i class="fas fa-pen w-5"></i>
                    <span class="ml-3">Input Nilai</span>
                </a>
                <a href="{{ route('guru.rekap') }}" class="flex items-center px-5 py-3 {{ request()->routeIs('guru.rekap') ? 'bg-green-800' : 'text-green-300 hover:bg-green-800 hover:text-white' }} transition">
                    <i class="fas fa-chart-bar w-5"></i>
                    <span class="ml-3">Rekap Nilai</span>
                </a>
            </nav>
            <div class="p-5 border-t border-green-800">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center text-green-300 hover:text-white transition w-full">
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
                    <h1 class="text-xl font-semibold text-gray-800">@yield('header')</h1>
                    <p class="text-sm text-gray-500">Sistem Pengolahan Data Nilai Siswa - SD Negeri Kota Bekasi</p>
                </div>
                <div class="flex items-center gap-3">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 bg-green-600 rounded-full flex items-center justify-center text-white font-bold">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <span class="text-sm font-medium">{{ Auth::user()->name }}</span>
                    </div>
                </div>
            </div>
            
            <div class="p-6">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif
                
                @if(session('info'))
                    <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded mb-4">
                        {{ session('info') }}
                    </div>
                @endif
                
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>