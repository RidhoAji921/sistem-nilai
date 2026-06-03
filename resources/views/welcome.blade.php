<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SD Negeri Kota Bekasi - Sistem Pengolahan Nilai Siswa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-blue-900 text-white shadow-lg">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="text-3xl">🏫</div>
                <div>
                    <h1 class="text-xl font-bold">Sistem Pengolahan Data Nilai Siswa</h1>
                    <p class="text-sm text-blue-300">SD Negeri Kota Bekasi</p>
                </div>
            </div>
            <div class="space-x-4">
                <a href="{{ route('login') }}" class="px-4 py-2 bg-blue-600 rounded-lg hover:bg-blue-700 transition">
                    <i class="fas fa-sign-in-alt mr-2"></i>Login
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-20">
        <div class="container mx-auto px-6 text-center">
            <div class="text-6xl mb-4">📚</div>
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Sistem Pengolahan Nilai Siswa</h1>
            <p class="text-xl mb-8">Solusi digital untuk pengelolaan nilai yang cepat, rapi, dan terstruktur</p>
            <a href="{{ route('login') }}" class="px-8 py-3 bg-yellow-500 text-blue-900 font-semibold rounded-lg hover:bg-yellow-400 transition text-lg">
                <i class="fas fa-arrow-right mr-2"></i>Masuk ke Sistem
            </a>
        </div>
    </section>

    <!-- Fitur -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Fitur Unggulan</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center p-6 rounded-lg hover:shadow-lg transition">
                    <div class="text-5xl mb-4">👨‍🎓</div>
                    <h3 class="text-xl font-semibold mb-2">Kelola Data Siswa</h3>
                    <p class="text-gray-600">Tambah, edit, dan hapus data siswa dengan mudah</p>
                </div>
                <div class="text-center p-6 rounded-lg hover:shadow-lg transition">
                    <div class="text-5xl mb-4">📝</div>
                    <h3 class="text-xl font-semibold mb-2">Input Nilai</h3>
                    <p class="text-gray-600">Input nilai tugas, UTS, dan UAS dengan cepat</p>
                </div>
                <div class="text-center p-6 rounded-lg hover:shadow-lg transition">
                    <div class="text-5xl mb-4">📊</div>
                    <h3 class="text-xl font-semibold mb-2">Laporan Nilai</h3>
                    <p class="text-gray-600">Lihat laporan nilai dan cetak PDF/Excel</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Cara Kerja -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Cara Kerja Sistem</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl font-bold text-blue-600">1</span>
                    </div>
                    <h3 class="font-semibold mb-2">Login</h3>
                    <p class="text-gray-600 text-sm">Login sesuai role (Admin/Guru/Siswa)</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl font-bold text-blue-600">2</span>
                    </div>
                    <h3 class="font-semibold mb-2">Input Nilai</h3>
                    <p class="text-gray-600 text-sm">Guru menginput nilai siswa</p>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl font-bold text-blue-600">3</span>
                    </div>
                    <h3 class="font-semibold mb-2">Lihat Hasil</h3>
                    <p class="text-gray-600 text-sm">Siswa melihat nilai dan status kelulusan</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-blue-900 text-white py-8">
        <div class="container mx-auto px-6 text-center">
            <div class="text-3xl mb-2">🏫</div>
            <p class="mb-2">Sistem Pengolahan Data Nilai Siswa</p>
            <p class="text-sm text-blue-300">SD Negeri Kota Bekasi</p>
            <p class="text-xs text-blue-400 mt-4">© 2024 - All Rights Reserved</p>
        </div>
    </footer>
</body>
</html>