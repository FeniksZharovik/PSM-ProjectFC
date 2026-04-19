<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pages\Article;
use App\Models\Pages\Magazine;
use App\Models\Pages\Member;
use App\Models\Pages\Program;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'articles'  => Article::count(),
            'magazines' => Magazine::count(),
            'members'   => Member::count(),
            'programs'  => Program::count(),
        ];

        $latestArticles  = Article::select('id', 'title', 'thumbnail', 'created_at')
            ->latest()->take(5)->get();

        $latestMagazines = Magazine::select('id', 'title', 'cover', 'created_at')
            ->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'latestArticles', 'latestMagazines'));
    }
}
