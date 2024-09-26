<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa'; // Pastikan nama tabel sudah benar
    protected $fillable = ['nama', 'nim', 'email', 'jurusan']; // Pastikan field yang diizinkan ada di sini
}
