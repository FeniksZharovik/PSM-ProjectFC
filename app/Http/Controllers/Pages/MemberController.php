<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Pages\Member;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::orderBy('created_at', 'asc')->get();
        return view('pages.organisasi', compact('members'));
    }
}
