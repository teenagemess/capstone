<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\LatihanSoal;

class LatihanSoalFrontendController extends Controller
{
    /**
     * Menampilkan latihan soal berdasarkan kategori yang dipilih.
     */
    public function show(Category $category)
    {
        // Mengambil semua latihan soal yang terkait dengan kategori
        $latihanSoals = $category->latihanSoals()->with('category', 'jenjangCategory')->get();

        return view('frontend.categories.show', compact('category', 'latihanSoals'));
    }

    /**
     * Menampilkan detail latihan soal.
     */
    public function detail(LatihanSoal $latihanSoal)
    {
        return view('frontend.latihan_soals.detail', compact('latihanSoal'));
    }
}
