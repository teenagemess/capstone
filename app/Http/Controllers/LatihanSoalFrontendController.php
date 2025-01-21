<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\jenjangCategory;
use App\Models\LatihanSoal;
use Illuminate\Http\Request;

class LatihanSoalFrontendController extends Controller
{
    /**
     * Menampilkan latihan soal berdasarkan kategori yang dipilih.
     */
    public function show(Category $category, Request $request)
    {
        // Ambil semua data JenjangCategory
        $jenjangCategories = JenjangCategory::all();

        // Query latihan soal berdasarkan kategori
        $query = $category->latihanSoals()->with('category', 'jenjangCategory');

        if ($request->has('search') && $request->search != '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->has('jenjang_category_id') && $request->jenjang_category_id) {
            $query->where('jenjang_category_id', $request->jenjang_category_id);
        }

        $latihanSoals = $query->get();

        return view('frontend.categories.show', compact('category', 'latihanSoals', 'jenjangCategories'));
    }




    /**
     * Menampilkan detail latihan soal.
     */
    public function detail(LatihanSoal $latihanSoal)
    {
        return view('frontend.latihan_soals.detail', compact('latihanSoal'));
    }
}
