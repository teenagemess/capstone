<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\LatihanSoal;
use App\Models\JenjangCategory;
use Illuminate\Http\Request;

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
     * Menampilkan latihan soal berdasarkan kategori yang dipilih dengan pencarian dan filter.
     */
    public function show(Request $request, Category $category)
    {
        // Ambil filter jenjang jika ada
        $jenjangCategory = $request->input('jenjang_category');

        // Ambil pencarian judul jika ada
        $searchTitle = $request->input('search_title');

        $latihanSoalsQuery = LatihanSoal::where('category_id', $category->id);

        // Filter berdasarkan jenjang category jika ada
        if ($jenjangCategory) {
            $latihanSoalsQuery->whereHas('jenjangCategory', function ($query) use ($jenjangCategory) {
                $query->where('title', $jenjangCategory);
            });
        }

        // Filter berdasarkan judul jika ada
        if ($searchTitle) {
            $latihanSoalsQuery->where('title', 'like', '%' . $searchTitle . '%');
        }

        // Ambil latihan soal berdasarkan query yang sudah difilter
        $latihanSoals = $latihanSoalsQuery->get();

        // Ambil jenjang categories untuk filter dropdown
        $jenjangCategories = JenjangCategory::all();

        return view('frontend.latihan_soals.show', compact('category', 'latihanSoals', 'jenjangCategories', 'searchTitle', 'jenjangCategory'));
    }
}

