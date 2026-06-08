<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles', [ArticleController::class, 'index']); // Mengantisipasi format URL di soal poin 2
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('articles.show');

// Rute untuk aksi komentar (Poin 3 & 4)
Route::put('/comment/{id}', [ArticleController::class, 'updateComment'])->name('comments.update');
Route::delete('/comment/{id}', [ArticleController::class, 'destroyComment'])->name('comments.destroy');
