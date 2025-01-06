<?php

use App\Http\Controllers\LatihanSoalController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JenjangCategoryController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TodoFrontendController;
use App\Http\Controllers\LatihanSoalCategoryFrontendController;
use App\Http\Controllers\CategoryFrontendController;
use App\Http\Controllers\LatihanSoalFrontendController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/categories', [CategoryFrontendController::class, 'index'])->name('frontend.categories.index');
    Route::get('/categories/{category}', [CategoryFrontendController::class, 'show'])->name('frontend.categories.show');

        // Route untuk menampilkan todos berdasarkan kategori
    Route::get('/categories/{category}/todos', [TodoFrontendController::class, 'show'])->name('todo.frontend.category');

    // Route untuk menampilkan detail todo
    Route::get('/todos/{todo}', [TodoFrontendController::class, 'detail'])->name('todo.frontend.detail');


    Route::get('/todos', [TodoFrontendController::class, 'index'])->name('todo.index');
    Route::get('/todos/{id}', [TodoFrontendController::class, 'show'])->name('todo.show');

    Route::get('/latihan-categories', [LatihanSoalCategoryFrontendController::class, 'index'])->name('frontend.latihan_soals.index');
    Route::get('/latihan-categories/{category}', [LatihanSoalCategoryFrontendController::class, 'show'])->name('frontend.latihan_soals.show');
    Route::get('/latihan-soal/{latihanSoal}', [LatihanSoalFrontendController::class, 'detail'])->name('frontend.latihan_soals.detail');


    Route::middleware('admin')->group(function () {
        Route::get('/user', [UserController::class, 'index'])->name('user.index');
        Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');
        Route::patch('/user/{user}/makeadmin', [UserController::class, 'makeadmin'])->name('user.makeadmin');
        Route::patch('/user/{user}/removeadmin', [UserController::class, 'removeadmin'])->name('user.removeadmin');


        Route::get('/latihan_soal', [LatihanSoalController::class, 'index'])->name('latihan_soal.index');
        Route::post('/latihan_soal', [LatihanSoalController::class, 'store'])->name('latihan_soal.store');
        Route::get('/latihan_soal/create', [LatihanSoalController::class, 'create'])->name('latihan_soal.create');
        Route::get('/latihan_soal/{latihan_soal}/edit', [LatihanSoalController::class, 'edit'])->name('latihan_soal.edit');
        Route::delete('/latihan_soal/{latihan_soal}', [LatihanSoalController::class, 'destroy'])->name('latihan_soal.destroy');

        Route::resource('/jenjang_category', JenjangCategoryController::class);

        Route::get('/todo', [TodoController::class, 'index'])->name('todo.index');
        Route::post('/todo', [TodoController::class, 'store'])->name('todo.store');
        Route::get('/todo/create', [TodoController::class, 'create'])->name('todo.create');
        Route::get('/todo/{todo}/edit', [TodoController::class, 'edit'])->name('todo.edit');
        Route::patch('/todo/{todo}', [TodoController::class, 'update'])->name('todo.update');
        Route::patch('/todo/{todo}/complete', [TodoController::class, 'complete'])->name('todo.complete');
        Route::patch('/todo/{todo}/incomplete', [TodoController::class, 'uncomplete'])->name('todo.uncomplete');
        Route::delete('/todo/{todo}', [TodoController::class, 'destroy'])->name('todo.destroy');
        Route::delete('/todo', [TodoController::class, 'destroyCompleted'])->name('todo.deleteallcompleted');

        Route::resource('siswa', SiswaController::class);


        Route::resource('/category', CategoryController::class);
    });
});

require __DIR__ . '/auth.php';
