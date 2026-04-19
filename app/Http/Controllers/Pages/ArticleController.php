<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Pages\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::select('id', 'title', 'slug', 'thumbnail')
            ->latest()
            ->simplePaginate(9);

        return view('pages.articles.index', compact('articles'));
    }

    public function show($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        return view('pages.articles.show', compact('article'));
    }
}
