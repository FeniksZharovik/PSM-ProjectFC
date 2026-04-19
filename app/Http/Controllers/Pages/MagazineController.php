<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Models\Pages\Magazine;
use Illuminate\Support\Facades\Storage;

class MagazineController extends Controller
{
    public function index()
    {
        $magazines = Magazine::select('id', 'title', 'cover')
            ->latest()
            ->paginate(9);

        return view('pages.magazines.index', compact('magazines'));
    }

    public function show(Magazine $magazine)
    {
        return view('pages.magazines.show', compact('magazine'));
    }

    public function preview(Magazine $magazine)
    {
        $path = storage_path('app/public/' . $magazine->file);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline'
        ]);
    }
}
