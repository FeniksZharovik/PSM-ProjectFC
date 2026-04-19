<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pages\Magazine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MagazineController extends Controller
{
    public function index()
    {
        $magazines = Magazine::select('id', 'title', 'cover', 'created_at')
            ->latest()
            ->paginate(10);

        return view('admin.magazines.index', compact('magazines'));
    }

    public function create()
    {
        return view('admin.magazines.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'cover'       => 'required|image|max:2048',
            'file'        => 'required|mimes:pdf|max:20480',
        ]);

        $validated['cover'] = $request->file('cover')
            ->store('magazines/covers', 'public');

        $validated['file'] = $request->file('file')
            ->store('magazines/files', 'public');

        Magazine::create($validated);

        return redirect()->route('admin.magazines.index')
            ->with('success', 'Majalah berhasil ditambahkan.');
    }

    public function edit(Magazine $magazine)
    {
        return view('admin.magazines.edit', compact('magazine'));
    }

    public function update(Request $request, Magazine $magazine)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'cover'       => 'nullable|image|max:2048',
            'file'        => 'nullable|mimes:pdf|max:20480',
        ]);

        if ($request->hasFile('cover')) {
            Storage::disk('public')->delete($magazine->cover);
            $validated['cover'] = $request->file('cover')
                ->store('magazines/covers', 'public');
        }

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($magazine->file);
            $validated['file'] = $request->file('file')
                ->store('magazines/files', 'public');
        }

        $magazine->update($validated);

        return redirect()->route('admin.magazines.index')
            ->with('success', 'Majalah berhasil diperbarui.');
    }

    public function destroy(Magazine $magazine)
    {
        Storage::disk('public')->delete($magazine->cover);
        Storage::disk('public')->delete($magazine->file);
        $magazine->delete();

        return redirect()->route('admin.magazines.index')
            ->with('success', 'Majalah berhasil dihapus.');
    }
}
