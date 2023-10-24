<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    use HasFactory;

    protected $table = 'absensis'; // Nama tabel dalam database

    protected $fillable = [
        'id_karyawan',
        'latitude',
        'longitude',
    ];

    public function user()
        {
            return $this->belongsTo(User::class, 'id_karyawan', 'id');
        }
}
