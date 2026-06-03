<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'guru';
    
    protected $fillable = [
        'nip',
        'nama',
        'mapel',
        'user_id',
    ];

    // Relasi OOP ke User (One to One balikan)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relasi OOP ke MataPelajaran (One to Many)
    public function mataPelajaran()
    {
        return $this->hasMany(MataPelajaran::class, 'guru_id');
    }
}