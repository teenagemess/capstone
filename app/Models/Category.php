<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'user_id',
    ];

    // Relasi dengan model Todo
    public function todo()
    {
        return $this->hasMany(Todo::class);
    }

    // Relasi dengan model LatihanSoal
// Relasi dengan model LatihanSoal
    public function latihanSoals()
    {
        return $this->hasMany(LatihanSoal::class);
    }
}
