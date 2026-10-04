<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function index(Request $r) {
        $q = User::query();
        if ($r->filled('search')) $q->where('name','like','%'.$r->search.'%')->orWhere('email','like','%'.$r->search.'%');
        if ($r->filled('role')) $q->where('role', $r->role);
        $users = $q->latest()->paginate(20);
        return view('admin.anggota.index', compact('users'));
    }

    public function create() {
        return view('admin.anggota.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'asal_sekolah' => 'required|string|max:255',
            'npsn_sekolah' => 'required|numeric',
            'password' => 'required|string|min:6|confirmed',
            'role'     => 'required|in:admin,member',
            'avatar'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        User::create($validated);

        return redirect()->route('admin.anggota.index')->with('success', 'Anggota berhasil ditambahkan.');
    }

    public function edit(User $user) {
        return view('admin.anggota.edit', compact('user'));
    }

    public function update(Request $request, User $user) {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'asal_sekolah' => 'required|string|max:255',
            'npsn_sekolah' => 'required|numeric',
            'role'     => 'required|in:admin,member',
            'avatar'   => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('avatar')) {
            // Delete old avatar if exists
            if ($user->avatar) {
                \Storage::disk('public')->delete($user->avatar);
            }
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        $user->update($validated);

        return redirect()->route('admin.anggota.index')->with('success', 'Anggota berhasil diperbarui.');
    }

    public function verify(User $user) {
        $user->email_verified_at = now();
        $user->save();
        return back()->with('success', 'Anggota berhasil diverifikasi.');
    }

    public function destroy(User $user) {
        if ($user->isAdmin()) return back()->with('error', 'Admin tidak bisa dihapus.');

        // Delete avatar if exists
        if ($user->avatar) {
            \Storage::disk('public')->delete($user->avatar);
        }

        $user->delete();
        return redirect()->route('admin.anggota.index')->with('success', 'Anggota berhasil dihapus.');
    }
}
