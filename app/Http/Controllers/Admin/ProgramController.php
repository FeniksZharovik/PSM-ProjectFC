<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pages\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProgramController extends Controller
{
    public function index()
    {
        $programs = Program::select('id', 'title', 'image', 'created_at')
            ->latest()
            ->paginate(10);

        return view('admin.programs.index', compact('programs'));
    }

    public function create()
    {
        return view('admin.programs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'required|image|max:2048',
        ]);

        $validated['image'] = $request->file('image')
            ->store('programs', 'public');

        Program::create($validated);

        return redirect()->route('admin.programs.index')
            ->with('success', 'Program berhasil ditambahkan.');
    }

    public function edit(Program $program)
    {
        return view('admin.programs.edit', compact('program'));
    }

    public function update(Request $request, Program $program)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($program->image);
            $validated['image'] = $request->file('image')
                ->store('programs', 'public');
        }

        $program->update($validated);

        return redirect()->route('admin.programs.index')
            ->with('success', 'Program berhasil diperbarui.');
    }

    public function destroy(Program $program)
    {
        Storage::disk('public')->delete($program->image);
        $program->delete();

        return redirect()->route('admin.programs.index')
            ->with('success', 'Program berhasil dihapus.');
    }
}
