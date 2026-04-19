<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Pages\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::select('id', 'title', 'description', 'image')
            ->latest()
            ->simplePaginate(9); 

        return view('pages.program', compact('programs'));
    }
}
