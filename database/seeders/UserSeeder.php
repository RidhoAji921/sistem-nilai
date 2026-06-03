<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin Sekolah',
                'email' => 'admin@sdnegeri-bekasi.sch.id',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Dra. Ani Susanti, M.Pd',
                'email' => 'ani.susanti@sdnegeri-bekasi.sch.id',
                'password' => Hash::make('password'),
                'role' => 'guru',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Drs. Budi Santoso, M.Si',
                'email' => 'budi.santoso@sdnegeri-bekasi.sch.id',
                'password' => Hash::make('password'),
                'role' => 'guru',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Andi',
                'email' => 'andi@siswa.sch.id',
                'password' => Hash::make('password'),
                'role' => 'siswa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Budi',
                'email' => 'budi@siswa.sch.id',
                'password' => Hash::make('password'),
                'role' => 'siswa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Cici',
                'email' => 'cici@siswa.sch.id',
                'password' => Hash::make('password'),
                'role' => 'siswa',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}