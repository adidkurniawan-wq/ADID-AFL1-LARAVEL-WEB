<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Article;
use App\Models\Comment;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Membuat 3 Kategori Utama
        Category::factory(3)->create();

        // 2. Membuat 30 Artikel
        Article::factory(30)->create();

        // 3. Mengisi komentar acak pada setiap artikel
        Article::all()->each(function ($article) {
            $jumlahKomentar = rand(10, 20);
            Comment::factory($jumlahKomentar)->create([
                'article_id' => $article->id
            ]);
        });
    }
}
