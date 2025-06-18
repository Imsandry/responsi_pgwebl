<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    use HasFactory;

    // Nama tabel yang terkait dengan model
    protected $table = 'sekolahs';

    // Kolom yang dapat diisi secara massal (mass assignable)
    protected $fillable = [
        'nama',
        'jenjang',
        'lat',
        'lng',
        'akreditasi',
        'foto',
    ];
}
