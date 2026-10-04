<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Struktur;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class StrukturController extends Controller
{
    public function index()
    {
        $strukturs = Struktur::with('user')->orderBy('order_num')->get();
        return view('admin.struktur.index', compact('strukturs'));
    }

    public function create()
    {
        return view('admin.struktur.create');
    }

    /**
     * API: Live search anggota untuk pilih pengurus.
     * GET /admin/struktur/search-user?q=keyword
     */
    public function searchUser(Request $request)
    {
        $q = $request->get('q', '');

        $users = User::where(function ($query) use ($q) {
                $query->where('name', 'like', "%{$q}%")
                      ->orWhere('email', 'like', "%{$q}%")
                      ->orWhere('asal_sekolah', 'like', "%{$q}%");
            })
            ->select('id', 'name', 'email', 'asal_sekolah', 'npsn_sekolah', 'avatar', 'role')
            ->orderBy('name')
            ->limit(10)
            ->get()
            ->map(function ($user) {
                return [
                    'id'          => $user->id,
                    'name'        => $user->name,
                    'email'       => $user->email,
                    'asal_sekolah'=> $user->asal_sekolah,
                    'npsn_sekolah'=> $user->npsn_sekolah,
                    'role'        => $user->role,
                    'avatar_url'  => $user->avatar_url, // dari accessor di User model
                ];
            });

        return response()->json($users);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id'   => 'required|exists:users,id',
            'role'      => 'required|string|max:255',
            'order_num' => 'required|integer',
        ]);

        $user = User::findOrFail($request->user_id);

        Struktur::create([
            'user_id'   => $user->id,
            'name'      => $user->name,   // disimpan sbg fallback saja
            'role'      => $request->role,
            'unit'      => $user->asal_sekolah,  // fallback
            'order_num' => $request->order_num,
            // image & education TIDAK di-copy; selalu baca dari user->avatar_url
        ]);

        return redirect()->route('admin.struktur.index')->with('success', 'Pengurus berhasil ditambahkan!');
    }

    public function edit(Struktur $struktur)
    {
        // Cari user yang terhubung via user_id (relasi baru) atau fallback nama
        $selectedUser = $struktur->user
            ?? User::where('name', $struktur->name)->first();

        return view('admin.struktur.edit', compact('struktur', 'selectedUser'));
    }

    public function update(Request $request, Struktur $struktur)
    {
        $request->validate([
            'user_id'   => 'required|exists:users,id',
            'role'      => 'required|string|max:255',
            'order_num' => 'required|integer',
        ]);

        $user = User::findOrFail($request->user_id);

        $struktur->update([
            'user_id'   => $user->id,
            'name'      => $user->name,   // fallback
            'role'      => $request->role,
            'unit'      => $user->asal_sekolah,  // fallback
            'order_num' => $request->order_num,
            // image TIDAK di-copy; selalu baca dari user->avatar_url
        ]);

        return redirect()->route('admin.struktur.index')->with('success', 'Pengurus berhasil diperbarui!');
    }

    public function destroy(Struktur $struktur)
    {
        $struktur->delete();
        return redirect()->route('admin.struktur.index')->with('success', 'Pengurus berhasil dihapus!');
    }
}
