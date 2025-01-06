<?php

namespace App\Http\Controllers;

use App\Models\Category;

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
    public function show(Category $category)
    {
        $todos = $category->todo()->get(); // Mengambil todos berdasarkan kategori
        return view('frontend.categories.show', compact('category', 'todos'));
    }
}
