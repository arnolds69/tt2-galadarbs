<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

Route::get('/', [PostController::class, 'index'])->name('posts.index');
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/trash', [PostController::class, 'trash'])->name('posts.trash');
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
Route::get('/my-posts', [PostController::class, 'mine'])->name('posts.mine');
Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::post('/posts/{id}/edit', [PostController::class, 'update'])->name('posts.update');
Route::post('/posts/{id}/delete', [PostController::class, 'destroy'])->name('posts.destroy');
Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show');
Route::post('/profile/{id}/password', [ProfileController::class, 'updatePassword']);
Route::post('/profile/{id}/follow', [ProfileController::class, 'follow'])->name('profile.follow');
Route::post('/profile/{id}/unfollow', [ProfileController::class, 'unfollow'])->name('profile.unfollow');
Route::get('/profile/{id}/followers', [ProfileController::class, 'followers'])->name('profile.followers');
Route::post('/profile/{id}/delete', [ProfileController::class, 'destroy'])->name('profile.destroy');
Route::put('/posts/{id}', [PostController::class, 'update']);
Route::post('/posts/{id}/restore', [PostController::class, 'restore']);
