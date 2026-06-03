<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    protected $table = 'mata_pelajaran';
    
    protected $fillable = [
        'kode',
        'nama_mapel',
        'guru_id',
    ];

    // Relasi OOP ke Guru (Many to One)
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }

    // Relasi OOP ke Nilai (One to Many)
    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'mapel_id');
    }
}