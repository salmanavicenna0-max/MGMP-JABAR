<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit', ['user' => Auth::user()]);
    }

    public function update(Request $r)
    {
        $user = Auth::user();
        $rules = [
            'name' => 'required|string|max:255',
            'asal_sekolah' => 'required|string|max:255',
            'npsn_sekolah' => 'required|numeric',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ];
        if ($r->filled('password')) {
            $rules['password'] = 'required|string|min:8|confirmed';
        }
        $d = $r->validate($rules);

        $user->name = $d['name'];
        $user->asal_sekolah = $d['asal_sekolah'];
        $user->npsn_sekolah = $d['npsn_sekolah'];
        $user->email = $d['email'];

        if ($r->filled('password')) {
            $user->password = Hash::make($d['password']);
        }

        // Handle avatar upload
        if ($r->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($user->avatar && Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }

            $file = $r->file('avatar');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = 'avatars/' . $user->id . '/' . $filename;

            $file->storeAs('avatars/' . $user->id, $filename, 'public');
            $user->avatar = $path;
        }

        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui.');
    }
}