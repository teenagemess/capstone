<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\Category;
use Illuminate\Http\Request;


class TodoFrontendController extends Controller
{
    public function show(Category $category)
    {
        $todos = $category->todos()->with('category', 'jenjangCategory')->get();
        return view('frontend.categories.show', compact('category', 'todos'));
    }

    public function detail(Todo $todo)
    {
        return view('frontend.todos.detail', compact('todo'));
    }
}
