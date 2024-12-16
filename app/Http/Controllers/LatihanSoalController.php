<?php

namespace App\Http\Controllers;

use App\Models\LatihanSoal;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class LatihanSoalController extends Controller
{
    public function index()
    {
        $search = request('search');
        $categoryFilter = request('category_id'); // Ambil kategori filter

        // Query awal untuk LatihanSoal
        $latihanSoalQuery = LatihanSoal::with('category')
            ->where('user_id', auth()->user()->id);

        // Pencarian berdasarkan title atau description
        if ($search) {
            $latihanSoalQuery->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                      ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        // Filter berdasarkan kategori
        if ($categoryFilter) {
            $latihanSoalQuery->where('category_id', $categoryFilter);
        }

        // Ambil latihan soal dengan pagination
        $latihanSoals = $latihanSoalQuery->orderBy('is_complete', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString(); // Menyimpan query string untuk pencarian dan filter di URL

        // Dapatkan daftar kategori untuk dropdown
        $categories = Category::where('user_id', auth()->user()->id)->get();

        $latihanSoalCompleted = LatihanSoal::where('user_id', auth()->user()->id)
            ->where('is_complete', true)
            ->count();

        return view('latihan_soal.index', compact('latihanSoals', 'latihanSoalCompleted', 'categories', 'categoryFilter'));
    }

    public function create()
    {
        $categories = Category::where('user_id', auth()->user()->id)->get();
        return view('latihan_soal.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|max:255',
            'category_id' => [
                'nullable',
                Rule::exists('categories', 'id')->where(function ($query) {
                    $query->where('user_id', auth()->user()->id);
                })
            ],
            'description' => 'nullable|string', // Validasi deskripsi
            'file_path' => 'nullable|file|mimes:pdf|max:10240', // Validasi file PDF
            'image_path' => 'nullable|file|mimes:jpg,png|max:10240', // Validasi file PDF
            'youtube_video_url' => 'nullable|url',
        ]);

        $filePath = $request->hasFile('file_path') && $request->file('file_path')->isValid()
        ? $request->file('file_path')->store('latihan_soals', 'public')
        : null;

        $imagePath = $request->hasFile('image_path') && $request->file('image_path')->isValid()
        ? $request->file('image_path')->store('images', 'public')
        : null;

        // Membuat LatihanSoal baru dan menyimpannya
        LatihanSoal::create([
            'title' => ucfirst($request->title),
            'user_id' => auth()->user()->id,
            'category_id' => $request->category_id,
            'description' => $request->description, // Menyimpan deskripsi
            'file_path' => $filePath, // Menyimpan path file
            'image_path' => $imagePath, // Menyimpan path file
            'youtube_video_url' => $request->youtube_video_url, // Simpan URL YouTube
        ]);

        return redirect()->route('latihan_soal.index')->with('success', 'Latihan Soal created successfully!');
    }

    public function edit(LatihanSoal $latihanSoal)
    {
        $categories = Category::where('user_id', auth()->user()->id)->get();
        if (auth()->user()->id == $latihanSoal->user_id) {
            return view('latihan_soal.edit', compact('latihanSoal', 'categories'));
        } else {
            return redirect()->route('latihan_soal.index')->with('danger','You are not authorized to edit this latihan soal!');
        }
    }

    public function update(Request $request, LatihanSoal $latihanSoal)
    {
        $request->validate([
            'title' => 'required|max:255',
            'category_id' => [
                'nullable',
                Rule::exists('categories', 'id')->where(function ($query) {
                    $query->where('user_id', auth()->user()->id);
                })
            ],
            'description' => 'nullable|string', // Validasi deskripsi
            'file_path' => 'nullable|file|mimes:pdf|max:10240', // Validasi file PDF
        ]);

        // Handle file upload on update
        if ($request->hasFile('file_path')) {
            // Hapus file lama jika ada
            if ($latihanSoal->file_path && Storage::exists('public/' . $latihanSoal->file_path)) {
                Storage::delete('public/' . $latihanSoal->file_path);
            }
            // Simpan file baru
            $filePath = $request->file('file_path')->store('latihan_soals', 'public');
        } else {
            $filePath = $latihanSoal->file_path; // Jika tidak ada file baru, gunakan file yang lama
        }

        // Update latihan soal dengan data baru
        $latihanSoal->update([
            'title' => ucfirst($request->title),
            'category_id' => $request->category_id,
            'description' => $request->description,
            'file_path' => $filePath,
        ]);

        return redirect()->route('latihan_soal.index')->with('success', 'Latihan Soal updated successfully!');
    }

    public function complete(LatihanSoal $latihanSoal)
    {
        if (auth()->user()->id == $latihanSoal->user_id) {
            $latihanSoal->update([
                'is_complete' => true,
            ]);
            return redirect()->route('latihan_soal.index')->with('success', 'Latihan Soal completed successfully!');
        } else {
            return redirect()->route('latihan_soal.index')->with('danger','You are not authorized to complete this latihan soal!');
        }
    }

    public function uncomplete(LatihanSoal $latihanSoal)
    {
        if (auth()->user()->id == $latihanSoal->user_id) {
            $latihanSoal->update([
                'is_complete' => false,
            ]);
            return redirect()->route('latihan_soal.index')->with('success', 'Latihan Soal uncompleted successfully!');
        } else {
            return redirect()->route('latihan_soal.index')->with('danger','You are not authorized to uncomplete this latihan soal!');
        }
    }

    public function destroy(LatihanSoal $latihanSoal)
    {
        if (auth()->user()->id == $latihanSoal->user_id) {
            // Hapus file yang ter-upload jika ada
            if ($latihanSoal->file_path && Storage::exists('public/' . $latihanSoal->file_path)) {
                Storage::delete('public/' . $latihanSoal->file_path);
            }

            $latihanSoal->delete();
            return redirect()->route('latihan_soal.index')->with('success', 'Latihan Soal deleted successfully!');
        } else {
            return redirect()->route('latihan_soal.index')->with('danger','You are not authorized to delete this latihan soal!');
        }
    }

    public function destroyCompleted()
    {
        // Get all latihan soals for current user where is_complete is true
        $latihanSoalsCompleted = LatihanSoal::where('user_id', auth()->user()->id)
            ->where('is_complete', true)
            ->get();
        foreach ($latihanSoalsCompleted as $latihanSoal) {
            // Hapus file yang ter-upload jika ada
            if ($latihanSoal->file_path && Storage::exists('public/' . $latihanSoal->file_path)) {
                Storage::delete('public/' . $latihanSoal->file_path);
            }
            $latihanSoal->delete();
        }

        return redirect()->route('latihan_soal.index')->with('success', 'All completed latihan soals deleted successfully!');
    }
}
