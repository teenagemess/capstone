<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LatihanSoal extends Model
{
    use HasFactory;

    protected $casts = [
        'is_complete' => 'boolean',
    ];

    protected $fillable = [
        'title',
        'user_id',
        'category_id',
        'jenjang_category_id',
        'is_complete',
        'image_path',
        'file_path',
        'description',
        'youtube_video_url', // Menambahkan youtube_video_url ke daftar fillable
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function jenjangCategory()
    {
        return $this->belongsTo(JenjangCategory::class); // Relasi ke model JenjangCategory
    }
}
