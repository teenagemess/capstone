<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryFrontendController extends Controller
{
    /**
     * Menampilkan daftar kategori.
     */
    public function index()
    {
        $categories = Category::all(); // Mengambil semua kategori
        return view('frontend.categories.index', compact('categories'));
    }

    /**
     * Menampilkan todo berdasarkan kategori yang dipilih.
     */
    public function show(Request $request, Category $category)
    {
        $query = $category->latihanSoals()->with('category', 'jenjangCategory');

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $todos = $query->get();
        // $todos = $query->get();

        return view('frontend.categories.show', compact('category', 'todos'));
    }

}
