<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenjangCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'user_id',
    ];


    public function todo()
    {
        return $this->hasMany(Todo::class);
    }

    // Relasi dengan model lainnya, misalnya dengan LatihanSoal
    public function latihanSoals()
    {
        return $this->hasMany(LatihanSoal::class);
    }
}
