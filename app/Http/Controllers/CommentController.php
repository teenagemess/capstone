<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\LatihanSoal;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $latihanSoalId)
    {
        $request->validate([
            'content' => 'required|max:1000',
        ]);

        $latihanSoal = LatihanSoal::findOrFail($latihanSoalId);

        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->latihan_soal_id = $latihanSoal->id;
        $comment->content = $request->content;
        $comment->save();
        return back();
    }

    public function storeTodo(Request $request, $todoId)
    {
        $request->validate([
            'content' => 'required|max:1000',
        ]);

        $todo = Todo::findOrFail($todoId); // Cari Todo berdasarkan ID

        $comment = new Comment();
        $comment->user_id = Auth::id();
        $comment->todo_id = $todo->id; // Menyimpan komentar untuk Todo
        $comment->content = $request->content;
        $comment->save();

        return back();
    }

    // Menambahkan metode destroy untuk menghapus komentar
    public function destroy($commentId)
    {
        $comment = Comment::findOrFail($commentId);

        // Pastikan pengguna yang menghapus adalah pemilik komentar atau admin
        if ($comment->user_id === Auth::id() || Auth::user()->is_admin) {
            $comment->delete();
            return back()->with('success', 'Komentar berhasil dihapus.');
        }

        return back()->with('error', 'Anda tidak memiliki izin untuk menghapus komentar ini.');
    }
}
