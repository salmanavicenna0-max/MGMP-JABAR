<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function index(Request $r)
    {
        $q = Agenda::query();
        if ($r->filled('search')) {
            $q->where('title', 'like', '%' . $r->search . '%');
        }
        $data = $q->latest('date')->paginate(15);
        return view('admin.agenda.index', compact('data'));
    }

    public function create()
    {
        return view('admin.agenda.create');
    }

    public function store(Request $request)
    {
        $d = $request->validate([
            'title'       => 'required|max:255',
            'description' => 'nullable',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'date'        => 'required|date',
            'time'        => 'nullable',
            'location'    => 'nullable|max:255',
            'status'      => 'required|in:draft,published',
        ]);
        if ($request->hasFile('image')) $d['image'] = $request->file('image')->store('agenda','public');

        Agenda::create($d);
        return redirect()->route('admin.agenda.index')->with('success', 'Agenda berhasil ditambahkan.');
    }

    public function edit(Agenda $agenda)
    {
        return view('admin.agenda.edit', ['data' => $agenda]);
    }

    public function update(Request $request, Agenda $agenda)
    {
        $d = $request->validate([
            'title'       => 'required|max:255',
            'description' => 'nullable',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'date'        => 'required|date',
            'time'        => 'nullable',
            'location'    => 'nullable|max:255',
            'status'      => 'required|in:draft,published',
        ]);

        if ($request->hasFile('image')) {
            if ($agenda->image) \Illuminate\Support\Facades\Storage::disk('public')->delete($agenda->image);
            $d['image'] = $request->file('image')->store('agenda','public');
        }

        $agenda->update($d);
        return redirect()->route('admin.agenda.index')->with('success', 'Agenda berhasil diperbarui.');
    }

    public function destroy(Agenda $agenda)
    {
        $agenda->delete();
        return redirect()->route('admin.agenda.index')->with('success', 'Agenda berhasil dihapus.');
    }
}
