<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

// Route untuk Halaman Utama & Pencarian (Poin 2)
Route::get('/', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles', [ArticleController::class, 'index']);

// Route untuk Halaman Detail Artikel (Mengatasi eror articles.show)
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('articles.show');
