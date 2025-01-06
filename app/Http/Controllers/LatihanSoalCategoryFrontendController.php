<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\LatihanSoal;

class LatihanSoalCategoryFrontendController extends Controller
{
    /**
     * Menampilkan daftar latihan soal berdasarkan kategori.
     */
    public function index()
    {
        $categories = Category::all(); // Mengambil semua kategori
        return view('frontend.latihan_soals.index', compact('categories'));
    }

    /**
     * Menampilkan latihan soal berdasarkan kategori yang dipilih.
     */
    public function show(Category $category)
    {
        // Mengambil latihan soal berdasarkan kategori yang dipilih
        $latihanSoals = LatihanSoal::where('category_id', $category->id)->get();

        return view('frontend.latihan_soals.show', compact('category', 'latihanSoals'));
    }
}
