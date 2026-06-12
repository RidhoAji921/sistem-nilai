### 1. LARAVEL COMMAND

#### Setup & Installation
```bash
# Buat project baru
composer create-project laravel/laravel nama-project

# Buat project dengan versi tertentu
composer create-project laravel/laravel:^10.0 nama-project

# Install Breeze (auth)
composer require laravel/breeze --dev
php artisan breeze:install blade
npm install && npm run build

# Install package umum
composer require barryvdh/laravel-dompdf  # PDF
composer require maatwebsite/excel        # Excel
```

#### Artisan Commands
```bash
# Make (Membuat file)
php artisan make:model NamaModel -m      # Model + migration
php artisan make:controller NamaController --resource  # Controller resource
php artisan make:middleware NamaMiddleware
php artisan make:seeder NamaSeeder
php artisan make:factory NamaFactory

# Migration
php artisan migrate                      # Jalankan migration
php artisan migrate:fresh                # Hapus semua & migrate ulang
php artisan migrate:fresh --seed         # + jalankan seeder
php artisan migrate:rollback             # Rollback terakhir
php artisan make:migration nama_migration

# Seeder
php artisan db:seed                      # Jalankan semua seeder
php artisan db:seed --class=NamaSeeder   # Jalankan specific seeder

# Cache & Clear
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan optimize:clear               # Clear semua sekaligus

# Route
php artisan route:list                   # Lihat semua route
php artisan route:list | grep siswa      # Filter route

# Tinker (REPL)
php artisan tinker                       # Masuk ke tinker
# Di tinker: App\Models\User::all(); exit;

# Lainnya
php artisan key:generate                 # Generate APP_KEY
php artisan storage:link                 # Link storage
php artisan down / up                    # Maintenance mode
```

---

### 2. STRUKTUR FOLDER

```
📁 sistem-nilai/
│
├── 📁 app/
│   ├── 📁 Http/
│   │   ├── 📁 Controllers/         # Controller (nama: PascalCase + Controller)
│   │   │   ├── 📁 Admin/           # Controller untuk role admin
│   │   │   ├── 📁 Guru/            # Controller untuk role guru
│   │   │   ├── 📁 Siswa/           # Controller untuk role siswa
│   │   │   └── 📁 Auth/            # Controller auth (bawaan Breeze)
│   │   ├── 📁 Middleware/          # Middleware custom
│   │   │   └── CheckRole.php       # Contoh: cek role user
│   │   └── 📁 Kernel.php           # Daftar middleware (Laravel 10 ke bawah)
│   │
│   ├── 📁 Models/                   # Model (Eloquent)
│   │   ├── User.php
│   │   ├── Siswa.php
│   │   ├── Guru.php
│   │   ├── MataPelajaran.php
│   │   └── Nilai.php
│   │
│   └── 📁 Helpers/                  # Folder custom untuk fungsi terstruktur
│       └── NilaiHelper.php
│
├── 📁 database/
│   ├── 📁 migrations/               # File migration (nama: create_nama_tabel_table)
│   │   ├── create_users_table.php
│   │   ├── create_siswa_table.php
│   │   └── ...
│   └── 📁 seeders/                  # File seeder (nama: NamaTableSeeder)
│       ├── DatabaseSeeder.php
│       ├── UserSeeder.php
│       └── ...
│
├── 📁 resources/
│   └── 📁 views/                    # Blade template
│       ├── 📁 layouts/              # Layout template
│       │   ├── admin.blade.php
│       │   ├── guru.blade.php
│       │   └── siswa.blade.php
│       ├── 📁 admin/                # View untuk admin
│       ├── 📁 guru/                 # View untuk guru
│       ├── 📁 siswa/                # View untuk siswa
│       ├── 📁 auth/                 # View login (bawaan Breeze)
│       └── welcome.blade.php        # Landing page
│
├── 📁 routes/
│   └── web.php                      # Semua route web
│
├── 📁 config/
│   └── database.php                 # Konfigurasi database (bisa dari .env)
│
├── .env                             # Environment variable (DB, APP_KEY, dll)
├── composer.json                    # Daftar package + autoload
└── artisan                          # CLI tool
```

---

### 3. POLA DASAR

#### Route Dasar (web.php)
```php
// Route basic
Route::get('/url', [Controller::class, 'method'])->name('route.name');

// Route dengan middleware
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('siswa', SiswaController::class);
});

// Route dengan prefix
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Route resource (otomatis index, create, store, show, edit, update, destroy)
Route::resource('siswa', SiswaController::class);
```

#### Controller Dasar (Resource)
```php
class SiswaController extends Controller
{
    public function index() { $data = Siswa::all(); return view('index', compact('data')); }
    public function create() { return view('create'); }
    public function store(Request $request) { Model::create($request->validated()); return redirect()->route('index'); }
    public function edit($id) { $data = Model::findOrFail($id); return view('edit', compact('data')); }
    public function update(Request $request, $id) { Model::findOrFail($id)->update($request->validated()); return redirect()->route('index'); }
    public function destroy($id) { Model::findOrFail($id)->delete(); return redirect()->route('index'); }
}
```

#### Model Dasar
```php
class Siswa extends Model
{
    protected $table = 'siswa';           // Nama tabel (jika beda konvensi)
    protected $fillable = ['nis', 'nama', 'kelas'];  // Yang boleh diisi massal
    protected $guarded = [];              // Kebalikan fillable
    
    // Relasi
    public function user() { return $this->belongsTo(User::class); }
    public function nilai() { return $this->hasMany(Nilai::class); }
}
```

#### Migration Dasar
```php
public function up() {
    Schema::create('nama_tabel', function (Blueprint $table) {
        $table->id();
        $table->string('field1')->unique();
        $table->string('field2');
        $table->foreignId('foreign_id')->constrained()->onDelete('cascade');
        $table->timestamps();
    });
}
```

---

### 4. COMMAND

| Yang Ingin Dilakukan | Command / Code |
|---------------------|----------------|
| Lihat semua route | `php artisan route:list` |
| Buat Model + Migration + Controller sekaligus | `php artisan make:model Nama -mcr` |
| Cek koneksi database | `php artisan db:show` atau cek di `.env` |
| Reset database + seeder | `php artisan migrate:fresh --seed` |
| Debug query SQL | `DB::enableQueryLog(); Model::all(); dd(DB::getQueryLog());` |
| Cek versi Laravel | `php artisan --version` |
| Membuat helper custom | Buat folder `app/Helpers`, register di `composer.json` -> `"files": ["app/Helpers/NilaiHelper.php"]`, lalu `composer dump-autoload` |

---

### 5. COMMON ERROR

| Error | Penyebab | Solusi |
|-------|----------|--------|
| `Class not found` | Lupa `use` namespace | `use App\Models\NamaModel;` |
| `Table not found` | Migration belum dijalankan | `php artisan migrate` |
| `Route not defined` | Nama route salah atau belum dibuat | `php artisan route:list` cek nama |
| `MassAssignmentException` | Lupa `$fillable` di Model | Tambah `protected $fillable = [...]` |
| `Foreign key constraint` | Urutan migration salah atau data tidak konsisten | Pastikan tabel induk dibuat lebih dulu |
| `Middleware not found` | Lupa register di kernel | Laravel 10 ke bawah: `$routeMiddleware`; Laravel 11/12: `bootstrap/app.php` |

---

### 6. LARAVEL 11/12 DIFFERENCE

| Aspek | Laravel 10 ke bawah | Laravel 11/12 |
|-------|--------------------|----------------|
| **Middleware** | Di `Kernel.php` | Di `bootstrap/app.php` |
| **Console** | Di `Console/Kernel.php` | Di `bootstrap/app.php` |
| **Exception** | Di `Exceptions/Handler.php` | Di `bootstrap/app.php` |
| **Config** | Banyak file di `config/` | Masih sama |
| **Routes** | `web.php`, `api.php`, dll | Sama |

**Contoh register middleware di Laravel 11/12:**
```php
// bootstrap/app.php
->withMiddleware(function (Middleware $middleware) {
    $middleware->alias([
        'role' => CheckRole::class,
    ]);
})
```

---

### 7. LARAVEL FLOW

```bash
# 1. Buat project
composer create-project laravel/laravel .

# 2. Setup .env (database)
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=

# 3. Buat migration
php artisan make:model Siswa -m
# isi migration, lalu:
php artisan migrate

# 4. Buat controller
php artisan make:controller SiswaController --resource

# 5. Buat helper (fungsi terstruktur)
mkdir app/Helpers
# buat file NilaiHelper.php, lalu:
composer dump-autoload

# 6. Buat route di web.php

# 7. Buat view
mkdir resources/views/admin
# buat file index.blade.php, create.blade.php, edit.blade.php

# 8. Jalankan
php artisan serve
```