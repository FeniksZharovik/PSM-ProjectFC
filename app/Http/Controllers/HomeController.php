<?php

namespace App\Http\Controllers;

use App\Models\Pages\Article;
use App\Models\Pages\Program;

class HomeController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->take(3)->get();
        $programs = Program::take(3)->get();

        return view('home', compact('articles', 'programs'));
    }
}
