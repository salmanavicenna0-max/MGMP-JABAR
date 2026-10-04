<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Download;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    public function index() { $data = Download::latest()->paginate(15); return view('admin.download.index', compact('data')); }
    public function create() { return view('admin.download.create'); }
    public function store(Request $r) {
        $d = $r->validate(['title'=>'required|max:255','description'=>'nullable','file'=>'required|file|max:10240|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar,txt','category'=>'nullable|max:100','status'=>'required|in:draft,published']);
        $d['user_id'] = Auth::id();
        $d['is_public'] = $r->has('is_public');
        $f = $r->file('file'); $d['file_path'] = $f->store('download','public'); $d['file_size'] = $f->getSize();
        Download::create($d);
        return redirect()->route('admin.download.index')->with('success','Dokumen berhasil ditambahkan.');
    }
    public function edit(Download $download) { return view('admin.download.edit', ['data'=>$download]); }
    public function update(Request $r, Download $download) {
        $d = $r->validate(['title'=>'required|max:255','description'=>'nullable','file'=>'nullable|file|max:10240|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar,txt','category'=>'nullable|max:100','status'=>'required|in:draft,published']);
        $d['is_public'] = $r->has('is_public');
        if ($r->hasFile('file')) { if ($download->file_path) Storage::disk('public')->delete($download->file_path); $f = $r->file('file'); $d['file_path'] = $f->store('download','public'); $d['file_size'] = $f->getSize(); }
        $download->update($d);
        return redirect()->route('admin.download.index')->with('success','Dokumen berhasil diperbarui.');
    }
    public function destroy(Download $download) { if ($download->file_path) Storage::disk('public')->delete($download->file_path); $download->delete(); return redirect()->route('admin.download.index')->with('success','Dokumen berhasil dihapus.'); }
}