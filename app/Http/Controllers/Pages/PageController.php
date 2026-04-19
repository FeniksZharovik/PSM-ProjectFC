<?php

namespace App\Http\Controllers;

use App\Models\Pages\Program;
use App\Models\Pages\Member;

class PageController extends Controller
{
    public function tentang()
    {
        return view('pages.tentang');
    }

    public function program()
    {
        $programs = Program::latest()->get();
        return view('pages.program', compact('programs'));
    }

    public function organisasi()
    {
        $members = Member::all();
        return view('pages.organisasi', compact('members'));
    }
}
