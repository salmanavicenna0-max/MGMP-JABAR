<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProgramController extends Controller
{
    public function index() { $data = Program::latest()->paginate(15); return view('admin.program.index', compact('data')); }
    public function create() { return view('admin.program.create'); }
    public function store(Request $r) {
        $d = $r->validate(['title'=>'required|max:255','description'=>'nullable','icon'=>'nullable|max:100','image'=>'nullable|image|mimes:jpeg,png,jpg|max:2048','status'=>'required|in:draft,published']);
        $d['slug'] = Str::slug($d['title']); $d['user_id'] = Auth::id(); if (empty($d['icon'])) $d['icon']='fa-star';
        if ($r->hasFile('image')) $d['image'] = $r->file('image')->store('program','public');
        Program::create($d);
        return redirect()->route('admin.program.index')->with('success','Program berhasil ditambahkan.');
    }
    public function edit(Program $program) { return view('admin.program.edit', ['data'=>$program]); }
    public function update(Request $r, Program $program) {
        $d = $r->validate(['title'=>'required|max:255','description'=>'nullable','icon'=>'nullable|max:100','image'=>'nullable|image|mimes:jpeg,png,jpg|max:2048','status'=>'required|in:draft,published']);
        if ($r->hasFile('image')) { if ($program->image) \Illuminate\Support\Facades\Storage::disk('public')->delete($program->image); $d['image'] = $r->file('image')->store('program','public'); }
        $program->update($d);
        return redirect()->route('admin.program.index')->with('success','Program berhasil diperbarui.');
    }
    public function destroy(Program $program) { $program->delete(); return redirect()->route('admin.program.index')->with('success','Program berhasil dihapus.'); }
}