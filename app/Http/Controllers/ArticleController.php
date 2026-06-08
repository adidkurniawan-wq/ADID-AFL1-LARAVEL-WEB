<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::query();

        if ($request->has('search') && $request->search != '') {
            $keyword = $request->search;
            $query->where(function($q) use ($keyword) {
                $q->where('title', 'like', '%' . $keyword . '%')
                  ->orWhere('content', 'like', '%' . $keyword . '%');
            });
        }

        if ($request->has('sort')) {
            if ($request->sort == 'az') {
                $query->orderBy('title', 'asc');
            } elseif ($request->sort == 'za') {
                $query->orderBy('title', 'desc');
            }
        }

        $articles = $query->get();
        return view('articles.index', compact('articles'));
    }

    public function show($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        return view('articles.show', compact('article'));
    }

    public function updateComment(Request $request, $id)
    {
        $request->validate([
            'body' => 'required'
        ]);

        $comment = Comment::findOrFail($id);
        $comment->update([
            'body' => $request->body
        ]);

        return back()->with('success', 'Komentar berhasil diubah!');
    }

    public function destroyComment($id)
    {
        $comment = Comment::findOrFail($id);
        $articleSlug = $comment->article->slug;
        $comment->delete();

        return redirect()->route('articles.show', $articleSlug)->with('success', 'Komentar berhasil dihapus!');
    }
}
