<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Kegiatan;
use App\Models\Download;
use App\Models\Agenda;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Redirect admin ke admin dashboard jika salah masuk ke /dashboard
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        // Stats
        $stats = [
            'berita'    => Berita::published()->count(),
            'kegiatan'  => Kegiatan::published()->count(),
            'download'  => Download::published()->count(),
            'agenda'    => Agenda::published()->count(),
        ];

        // Berita terbaru (3 item)
        $beritaTerbaru = Berita::published()
            ->latest('published_at')
            ->limit(3)
            ->get(['id', 'title', 'slug', 'excerpt', 'image', 'published_at']);

        // Agenda mendatang (3 item)
        $agendaMendatang = Agenda::published()
            ->where('date', '>=', now())
            ->orderBy('date', 'asc')
            ->limit(3)
            ->get();

        return view('dashboard', compact('stats', 'beritaTerbaru', 'agendaMendatang'));
    }
}
