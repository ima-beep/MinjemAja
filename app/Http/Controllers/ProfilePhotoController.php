<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfilePhotoController extends Controller
{
    public function edit()
    {
        return view('student.profile_photo.edit');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'profile_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        /** @var User $user */
        $user = Auth::user();

        // Hapus foto lama jika ada
        if ($user->profile_photo_path && Storage::disk('public')->exists($user->profile_photo_path)) {
            Storage::disk('public')->delete($user->profile_photo_path);
        }

        // Upload foto baru
        $path = $request->file('profile_photo')->store('profile-photos', 'public');

        // Update user
        $user->update(['profile_photo_path' => $path]);

        return back()->with('success', 'Foto profil berhasil diperbarui');
    }

    public function destroy(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        if ($user->profile_photo_path && Storage::disk('public')->exists($user->profile_photo_path)) {
            Storage::disk('public')->delete($user->profile_photo_path);
        }

        $user->update(['profile_photo_path' => null]);

        return back()->with('success', 'Foto profil berhasil dihapus');
    }
}
