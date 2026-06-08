<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Article;
use App\Models\Comment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Membuat 3 Kategori Utama (Poin 1.a)
        Category::factory(3)->create();

        // 2. Membuat 30 Artikel Acak (Poin 1.b)
        Article::factory(30)->create();

        // 3. Mengisi setiap artikel dengan 10 sampai 20 komentar acak (Poin 1.c)
        Article::all()->each(function ($article) {
            $jumlahKomentar = rand(10, 20);
            Comment::factory($jumlahKomentar)->create([
                'article_id' => $article->id
            ]);
        });
    }
}
