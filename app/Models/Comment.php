<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'latihan_soal_id', 'content', 'todo_id'];

    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke model LatihanSoal
    public function latihanSoal()
    {
        return $this->belongsTo(LatihanSoal::class);
    }

    public function todo()
    {
        return $this->belongsTo(Todo::class);
    }
}
