<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index() { $data = Galeri::latest()->paginate(15); return view('admin.galeri.index', compact('data')); }
    public function create() { return view('admin.galeri.create'); }
    public function store(Request $r) {
        $d = $r->validate(['title'=>'required|max:255','description'=>'nullable','image'=>'required|image|mimes:jpeg,png,jpg|max:3072','status'=>'required|in:draft,published']);
        $d['user_id'] = Auth::id(); $d['image'] = $r->file('image')->store('galeri','public');
        Galeri::create($d);
        return redirect()->route('admin.galeri.index')->with('success','Foto berhasil ditambahkan.');
    }
    public function edit(Galeri $galeri) { return view('admin.galeri.edit', ['data'=>$galeri]); }
    public function update(Request $r, Galeri $galeri) {
        $d = $r->validate(['title'=>'required|max:255','description'=>'nullable','image'=>'nullable|image|mimes:jpeg,png,jpg|max:3072','status'=>'required|in:draft,published']);
        if ($r->hasFile('image')) { if ($galeri->image) Storage::disk('public')->delete($galeri->image); $d['image'] = $r->file('image')->store('galeri','public'); }
        $galeri->update($d);
        return redirect()->route('admin.galeri.index')->with('success','Foto berhasil diperbarui.');
    }
    public function destroy(Galeri $galeri) { if ($galeri->image) Storage::disk('public')->delete($galeri->image); $galeri->delete(); return redirect()->route('admin.galeri.index')->with('success','Foto berhasil dihapus.'); }
}