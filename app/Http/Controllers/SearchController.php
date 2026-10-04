<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\Program;
use App\Models\Download;
use App\Models\Kegiatan;
use App\Models\Agenda;
use App\Models\Galeri;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');

        if (!$query) {
            return view('search', [
                'results' => collect(),
                'query' => $query
            ]);
        }
        $type = $request->input('type', 'all');
        $results = collect();

        if ($type === 'all' || $type === 'berita') {
            $berita = Berita::where('status', 'published')
                ->where(function ($q) use ($query) {
                    $q->where('title', 'like', "%{$query}%")
                        ->orWhere('content', 'like', "%{$query}%");
                })
                ->latest()
                ->get()
                ->map(function ($item) {
                    $item->search_type = 'Berita';
                    $item->search_icon = 'fa-newspaper';
                    $item->search_url = route('berita.show', $item->slug);
                    $item->search_date = $item->published_at ?? $item->created_at;
                    return $item;
                });
            $results = $results->merge($berita);
        }

        if ($type === 'all' || $type === 'program') {
            $program = Program::where('status', 'published')
                ->where(function ($q) use ($query) {
                    $q->where('title', 'like', "%{$query}%")
                        ->orWhere('description', 'like', "%{$query}%");
                })
                ->latest()
                ->get()
                ->map(function ($item) {
                    $item->search_type = 'Program & Kegiatan';
                    $item->search_icon = 'fa-tasks';
                    $item->search_url = route('program');
                    $item->search_date = $item->created_at;
                    return $item;
                });
            $results = $results->merge($program);
        }

        if ($type === 'all' || $type === 'dokumen') {
            $downloadQuery = Download::where('status', 'published');
            if (!auth()->check()) {
                $downloadQuery->where('is_public', true);
            }
            $download = $downloadQuery->where(function ($q) use ($query) {
                    $q->where('title', 'like', "%{$query}%")
                        ->orWhere('description', 'like', "%{$query}%");
                })
                ->latest()
                ->get()
                ->map(function ($item) {
                    $item->search_type = 'Dokumen';
                    $item->search_icon = 'fa-file-download';
                    $item->search_url = asset('storage/'.$item->file_path);
                    $item->search_date = $item->created_at;
                    return $item;
                });
            $results = $results->merge($download);
        }

        if ($type === 'all' || $type === 'kegiatan') {
            $kegiatan = Kegiatan::where('status', 'published')
                ->where(function ($q) use ($query) {
                    $q->where('title', 'like', "%{$query}%")
                        ->orWhere('description', 'like', "%{$query}%");
                })
                ->latest()
                ->get()
                ->map(function ($item) {
                    $item->search_type = 'Kegiatan';
                    $item->search_icon = 'fa-calendar-alt';
                    $item->search_url = route('kegiatan.show', $item->slug);
                    $item->search_date = $item->created_at;
                    return $item;
                });
            $results = $results->merge($kegiatan);
        }

        if ($type === 'all' || $type === 'agenda') {
            $agenda = Agenda::where('status', 'published')
                ->where(function ($q) use ($query) {
                    $q->where('title', 'like', "%{$query}%")
                        ->orWhere('description', 'like', "%{$query}%");
                })
                ->latest()
                ->get()
                ->map(function ($item) {
                    $item->search_type = 'Agenda';
                    $item->search_icon = 'fa-calendar-check';
                    $item->search_url = route('agenda');
                    $item->search_date = $item->created_at;
                    return $item;
                });
            $results = $results->merge($agenda);
        }

        if ($type === 'all' || $type === 'galeri') {
            $galeri = Galeri::where('status', 'published')
                ->where(function ($q) use ($query) {
                    $q->where('title', 'like', "%{$query}%")
                        ->orWhere('description', 'like', "%{$query}%");
                })
                ->latest()
                ->get()
                ->map(function ($item) {
                    $item->search_type = 'Galeri';
                    $item->search_icon = 'fa-images';
                    $item->search_url = route('galeri');
                    $item->search_date = $item->created_at;
                    return $item;
                });
            $results = $results->merge($galeri);
        }

        $results = $results->sortByDesc('search_date')->values();

        return view('search', compact('results', 'query'));
    }
}
