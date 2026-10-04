<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class KegiatanController extends Controller
{
    public function index(Request $r) { 
        $q = Kegiatan::query();
        if ($r->filled('search')) {
            $q->where('title', 'like', '%' . $r->search . '%');
        }
        $data = $q->latest()->paginate(15); 
        return view('admin.kegiatan.index', compact('data')); 
    }
    public function create() { return view('admin.kegiatan.create'); }
    public function store(Request $r) {
        $d = $r->validate(['title'=>'required|max:255','description'=>'nullable','image'=>'nullable|image|mimes:jpeg,png,jpg|max:2048','date'=>'required|date','location'=>'nullable|max:255','status'=>'required|in:draft,published']);
        $d['slug'] = Str::slug($d['title']); $d['user_id'] = Auth::id();
        if ($r->hasFile('image')) $d['image'] = $r->file('image')->store('kegiatan','public');
        Kegiatan::create($d);
        return redirect()->route('admin.kegiatan.index')->with('success','Kegiatan berhasil ditambahkan.');
    }
    public function edit(Kegiatan $kegiatan) { return view('admin.kegiatan.edit', ['data'=>$kegiatan]); }
    public function update(Request $r, Kegiatan $kegiatan) {
        $d = $r->validate(['title'=>'required|max:255','description'=>'nullable','image'=>'nullable|image|mimes:jpeg,png,jpg|max:2048','date'=>'required|date','location'=>'nullable|max:255','status'=>'required|in:draft,published']);
        if ($r->hasFile('image')) { if ($kegiatan->image) Storage::disk('public')->delete($kegiatan->image); $d['image'] = $r->file('image')->store('kegiatan','public'); }
        $kegiatan->update($d);
        return redirect()->route('admin.kegiatan.index')->with('success','Kegiatan berhasil diperbarui.');
    }
    public function destroy(Kegiatan $kegiatan) { if ($kegiatan->image) Storage::disk('public')->delete($kegiatan->image); $kegiatan->delete(); return redirect()->route('admin.kegiatan.index')->with('success','Kegiatan berhasil dihapus.'); }
}