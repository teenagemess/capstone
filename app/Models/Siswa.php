<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    // Menentukan nama tabel yang digunakan oleh model ini (optional jika tabel sesuai dengan nama model)
    protected $table = 'siswas';

    // Menentukan kolom-kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'nama_siswa',
        'tanggal_lahir',
        'alamat',
        'no_hp',
        'email',
        'tanggal_masuk',
        'tanggal_keluar',
    ];

    // Menentukan tipe data untuk kolom tertentu (misalnya tanggal)
    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_masuk' => 'date',
        'tanggal_keluar' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
