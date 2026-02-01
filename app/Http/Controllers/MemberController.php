<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class MemberController extends Controller
{
    public function index()
    {
        $members = User::where('role', 'student')->get();
        return view('teacher.members.index', compact('members'));
    }

    public function show($id)
    {
        $member = User::findOrFail($id);
        $loans = \App\Models\Loan::where('guest_email', $member->email)
            ->with('book')
            ->latest()
            ->get();
        return view('teacher.members.show', compact('member', 'loans'));
    }

    public function edit($id)
    {
        $member = User::findOrFail($id);
        return view('teacher.members.edit', compact('member'));
    }

    public function update(Request $request, $id)
    {
        $member = User::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ]);

        $member->update($validated);

        return redirect()->route('teacher.members.index')
            ->with('success', 'Data anggota berhasil diperbarui');
    }

    public function destroy($id)
    {
        $member = User::findOrFail($id);
        $member->delete();

        return redirect()->route('teacher.members.index')
            ->with('success', 'Anggota berhasil dihapus');
    }
}
