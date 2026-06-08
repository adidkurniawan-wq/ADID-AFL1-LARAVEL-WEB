<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

Route::get('/', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles', [ArticleController::class, 'index']);
Route::get('/articles/{slug}', [ArticleController::class, 'show'])->name('articles.show');

Route::put('/comments/{id}', [ArticleController::class, 'updateComment'])->name('comments.update');
Route::delete('/comments/{id}', [ArticleController::class, 'destroyComment'])->name('comments.destroy');

Route::get('/products', [ArticleController::class, 'index'])->name('products');
