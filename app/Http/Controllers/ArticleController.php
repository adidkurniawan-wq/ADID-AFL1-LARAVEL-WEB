<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // Poin 2 & 5: Menampilkan, Mencari, dan Mengurutkan Artikel
    public function index(Request $request)
    {
        $query = Article::with('category')->latest();

        // Fitur Pencarian (Poin 2)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('content', 'like', '%' . $search . '%');
            });
        }

        // Fitur Filter Kategori
        if ($request->filled('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        // Fitur Pengurutan A-Z dan Z-A (Poin 5)
        if ($request->sort == 'az') {
            $query = Article::with('category')->orderBy('title', 'asc');
        } elseif ($request->sort == 'za') {
            $query = Article::with('category')->orderBy('title', 'desc');
        }

        return view('articles.index', [
            'articles' => $query->get(),
            'categories' => Category::all()
        ]);
    }

    public function show($slug)
    {
        $article = Article::with(['category', 'comments' => function($q) {
            $q->latest();
        }])->where('slug', $slug)->firstOrFail();

        return view('articles.show', compact('article'));
    }

    // Poin 3: Menghapus Komentar
    public function destroyComment($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return back()->with('success', 'Komentar berhasil dihapus!');
    }

    // Poin 4: Mengubah Komentar
    public function updateComment(Request $request, $id)
    {
        $request->validate([
            'body' => 'required|string|max:500'
        ]);

        $comment = Comment::findOrFail($id);
        $comment->update([
            'body' => $request->body
        ]);

        return back()->with('success', 'Komentar berhasil diubah!');
    }
}
