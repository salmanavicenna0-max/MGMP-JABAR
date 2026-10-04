<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index() { $data = Berita::with('user')->latest()->paginate(15); return view('admin.berita.index', compact('data')); }
    public function create() { return view('admin.berita.create'); }
    public function store(Request $r) {
        $d = $r->validate(['title'=>'required|max:255','excerpt'=>'nullable','content'=>'nullable','image'=>'nullable|image|mimes:jpeg,png,jpg|max:2048','status'=>'required|in:draft,published']);
        $d['slug'] = Str::slug($d['title']); $d['user_id'] = Auth::id();
        if ($r->hasFile('image')) $d['image'] = $r->file('image')->store('berita','public');
        if ($d['status']==='published') $d['published_at'] = now();
        Berita::create($d);
        return redirect()->route('admin.berita.index')->with('success','Berita berhasil ditambahkan.');
    }
    public function edit(Berita $beritum) { return view('admin.berita.edit', ['data'=>$beritum]); }
    public function update(Request $r, Berita $beritum) {
        $d = $r->validate(['title'=>'required|max:255','excerpt'=>'nullable','content'=>'nullable','image'=>'nullable|image|mimes:jpeg,png,jpg|max:2048','status'=>'required|in:draft,published']);
        if ($r->hasFile('image')) { if ($beritum->image) Storage::disk('public')->delete($beritum->image); $d['image'] = $r->file('image')->store('berita','public'); }
        if ($d['status']==='published' && $beritum->status!=='published') $d['published_at'] = now();
        $beritum->update($d);
        return redirect()->route('admin.berita.index')->with('success','Berita berhasil diperbarui.');
    }
    public function destroy(Berita $beritum) { if ($beritum->image) Storage::disk('public')->delete($beritum->image); $beritum->delete(); return redirect()->route('admin.berita.index')->with('success','Berita berhasil dihapus.'); }
}