<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class TodoController extends Controller
{
    public function index()
    {
        $search = request('search');
        $categoryFilter = request('category_id'); // Ambil kategori filter

        // Query awal untuk Todo
        $todosQuery = Todo::with('category')
            ->where('user_id', auth()->user()->id);

        // Pencarian berdasarkan title atau description
        if ($search) {
            $todosQuery->where(function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%')
                      ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        // Filter berdasarkan kategori
        if ($categoryFilter) {
            $todosQuery->where('category_id', $categoryFilter);
        }

        // Ambil todos dengan pagination
        $todos = $todosQuery->orderBy('is_complete', 'asc')
                            ->orderBy('created_at', 'desc')
                            ->paginate(10)
                            ->withQueryString(); // Menyimpan query string untuk pencarian dan filter di URL

        // Dapatkan daftar kategori untuk dropdown
        $categories = Category::where('user_id', auth()->user()->id)->get();

        $todosCompleted = Todo::where('user_id', auth()->user()->id)
            ->where('is_complete', true)
            ->count();

        return view('todo.index', compact('todos', 'todosCompleted', 'categories', 'categoryFilter'));
    }



    public function create()
    {
        $categories = Category::where('user_id', auth()->user()->id)->get();
        return view('todo.create', compact('categories'));
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
        ? $request->file('file_path')->store('todos', 'public')
        : null;

        $imagePath = $request->hasFile('image_path') && $request->file('image_path')->isValid()
        ? $request->file('image_path')->store('images', 'public')
        : null;

        // Membuat Todo baru dan menyimpannya
        Todo::create([
            'title' => ucfirst($request->title),
            'user_id' => auth()->user()->id,
            'category_id' => $request->category_id,
            'description' => $request->description, // Menyimpan deskripsi
            'file_path' => $filePath, // Menyimpan path file
            'image_path' => $imagePath, // Menyimpan path file
            'youtube_video_url' => $request->youtube_video_url, // Simpan URL YouTube
        ]);

        return redirect()->route('todo.index')->with('success', 'Modul created successfully!');
    }

    public function edit(Todo $todo)
    {
        $categories = Category::where('user_id', auth()->user()->id)->get();
        if (auth()->user()->id == $todo->user_id) {
            return view('todo.edit', compact('todo', 'categories'));
        } else {
            return redirect()->route('todo.index')->with('danger','You are not authorized to edit this todo!');
        }
    }

    public function update(Request $request, Todo $todo)
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
            if ($todo->file_path && Storage::exists('public/' . $todo->file_path)) {
                Storage::delete('public/' . $todo->file_path);
            }
            // Simpan file baru
            $filePath = $request->file('file_path')->store('todos', 'public');
        } else {
            $filePath = $todo->file_path; // Jika tidak ada file baru, gunakan file yang lama
        }

        // Update todo dengan data baru
        $todo->update([
            'title' => ucfirst($request->title),
            'category_id' => $request->category_id,
            'description' => $request->description,
            'file_path' => $filePath,
        ]);

        return redirect()->route('todo.index')->with('success', 'Modul updated successfully!');
    }

    public function complete(Todo $todo)
    {
        if (auth()->user()->id == $todo->user_id) {
            $todo->update([
                'is_complete' => true,
            ]);
            return redirect()->route('todo.index')->with('success', 'Modul completed successfully!');
        } else {
            return redirect()->route('todo.index')->with('danger','You are not authorized to complete this todo!');
        }
    }

    public function uncomplete(Todo $todo)
    {
        if (auth()->user()->id == $todo->user_id) {
            $todo->update([
                'is_complete' => false,
            ]);
            return redirect()->route('todo.index')->with('success', 'Todo uncompleted successfully!');
        } else {
            return redirect()->route('todo.index')->with('danger','You are not authorized to uncomplete this todo!');
        }
    }

    public function destroy(Todo $todo)
    {
        if (auth()->user()->id == $todo->user_id) {
            // Hapus file yang ter-upload jika ada
            if ($todo->file_path && Storage::exists('public/' . $todo->file_path)) {
                Storage::delete('public/' . $todo->file_path);
            }

            $todo->delete();
            return redirect()->route('todo.index')->with('success', 'Modul deleted successfully!');
        } else {
            return redirect()->route('todo.index')->with('danger','You are not authorized to delete this todo!');
        }
    }

    public function destroyCompleted()
    {
        // Get all todos for current user where is_complete is true
        $todosCompleted = Todo::where('user_id', auth()->user()->id)
            ->where('is_complete', true)
            ->get();
        foreach ($todosCompleted as $todo) {
            // Hapus file yang ter-upload jika ada
            if ($todo->file_path && Storage::exists('public/' . $todo->file_path)) {
                Storage::delete('public/' . $todo->file_path);
            }
            $todo->delete();
        }

        return redirect()->route('todo.index')->with('success', 'All completed todos deleted successfully!');
    }
}