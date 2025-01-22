<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\JenjangCategory;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoFrontendController extends Controller
{
    public function show(Request $request, Category $category)
    {
        // Validasi parameter pencarian dan filter
        $request->validate([
            'search' => 'nullable|string|max:255',
            'jenjang_category' => 'nullable|exists:jenjang_categories,id',
        ]);

        // Query relasi todos
        $query = $category->todo()->with('category', 'jenjangCategory');

        // Tambahkan filter pencarian
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Tambahkan filter berdasarkan JenjangCategory
        if ($request->filled('jenjang_category')) {
            $query->where('jenjang_category_id', $request->jenjang_category);
        }

        // Eksekusi query
        $todos = $query->get();

        // Ambil daftar JenjangCategory untuk dropdown filter
        $jenjangCategories = JenjangCategory::all();

        return view('frontend.categories.show', compact('category', 'todos', 'jenjangCategories'));
    }

    public function detail(Todo $todo)
    {
        return view('frontend.todos.detail', compact('todo'));
    }
}
