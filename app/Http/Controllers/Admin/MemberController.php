<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pages\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::select('id', 'name', 'position', 'division', 'photo', 'created_at')
            ->orderBy('created_at', 'asc')
            ->paginate(10);

        return view('admin.members.index', compact('members'));
    }

    public function create()
    {
        return view('admin.members.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'division' => 'required|string|max:255',
            'photo'    => 'required|image|max:2048',
        ]);

        $validated['photo'] = $request->file('photo')
            ->store('members', 'public');

        Member::create($validated);

        return redirect()->route('admin.members.index')
            ->with('success', 'Anggota berhasil ditambahkan.');
    }

    public function edit(Member $member)
    {
        return view('admin.members.edit', compact('member'));
    }

    public function update(Request $request, Member $member)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'division' => 'required|string|max:255',
            'photo'    => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            Storage::disk('public')->delete($member->photo);
            $validated['photo'] = $request->file('photo')
                ->store('members', 'public');
        }

        $member->update($validated);

        return redirect()->route('admin.members.index')
            ->with('success', 'Anggota berhasil diperbarui.');
    }

    public function destroy(Member $member)
    {
        Storage::disk('public')->delete($member->photo);
        $member->delete();

        return redirect()->route('admin.members.index')
            ->with('success', 'Anggota berhasil dihapus.');
    }
}
