<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;

Route::get('/', [PostController::class, 'index'])->name('posts.index');
Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/posts/create', fn() => view('create'))->name('posts.create');
Route::get('/my-posts', fn() => view('mine'))->name('posts.mine');
Route::get('/profile/{id}', fn() => view('profile'))->name('profile.show');