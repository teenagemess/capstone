<?php

namespace App\Http\Controllers;

use App\Models\JenjangCategory;
use Illuminate\Http\Request;

class JenjangCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil semua JenjangCategory yang terkait dengan user
        $jenjangCategories = JenjangCategory::where('user_id', auth()->user()->id)->get();
        return view('jenjang_category.index', compact('jenjangCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jenjang_category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|in:SD,SMP,SMA|max:255',
        ],
        [
            'title.in' => 'Jenjang harus salah satu dari SD, SMP, atau SMA.',
            'title.max' => 'Panjang Jenjang tidak boleh lebih dari 255 karakter.',
        ]
    );

        // Simpan JenjangCategory baru
        JenjangCategory::create([
            'user_id' => auth()->user()->id,
            'title' => $request->title
        ]);

        return redirect()->route('jenjang_category.index')->with('success', 'Jenjang Category created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(JenjangCategory $jenjangCategory)
    {
        // Menampilkan detail kategori jenjang tertentu (jika diperlukan)
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JenjangCategory $jenjangCategory)
    {
        if (auth()->user()->id == $jenjangCategory->user_id) {
            return view('jenjang_category.edit', compact('jenjangCategory'));
        } else {
            return redirect()->route('jenjang_category.index')->with('danger', 'You are not authorized to edit this jenjang category!');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JenjangCategory $jenjangCategory)
    {
        $request->validate([
            'title' => 'required|max:255',
        ]);

        // Update data JenjangCategory
        $jenjangCategory->update([
            'title' => ucfirst($request->title),
        ]);

        return redirect()->route('jenjang_category.index')->with('success', 'Jenjang Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JenjangCategory $jenjangCategory)
    {
        if (auth()->user()->id == $jenjangCategory->user_id) {
            $jenjangCategory->delete();
            return redirect()->route('jenjang_category.index')->with('success', 'Jenjang Category deleted successfully!');
        } else {
            return redirect()->route('jenjang_category.index')->with('danger', 'You are not authorized to delete this jenjang category!');
        }
    }
}
