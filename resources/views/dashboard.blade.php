@extends('layouts.app')

@section('title', 'Dashboard — MGMP KIK Jawa Barat')

@section('content')
<div class="min-h-screen bg-slate-50 dark:bg-slate-950">

    <!-- Welcome Banner -->
    <div class="bg-white dark:bg-slate-900 border-b border-slate-100 dark:border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            @if (session('success'))
                <div class="flash-message mb-4 p-3 flash-message rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm flex items-center gap-2">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="flash-message mb-4 p-3 rounded-xl bg-red-50 border border-red-200 text-red-700 text-sm flex items-center gap-2">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ session('error') }}
                </div>
            @endif


            <div class="flex items-center justify-between flex-wrap gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Dashboard Anggota</h1>
                    <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                        Selamat datang, <span class="font-semibold text-mgmp">{{ Auth::user()->name }}</span>
                        <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-mgmp/10 text-mgmp">Anggota</span>
                    </p>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('home') }}" class="px-4 py-2 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 text-sm font-semibold rounded-lg inline-flex items-center gap-2 transition-all hover:bg-slate-200 dark:hover:bg-slate-700">
                        <i class="fas fa-home"></i> Beranda
                    </a>
                    <a href="{{ route('profile.edit') }}" class="px-4 py-2 bg-mgmp hover:bg-mgmp-dark text-white text-sm font-semibold rounded-lg inline-flex items-center gap-2 transition-all">
                        <i class="fas fa-user-edit"></i> Edit Profil
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Dashboard Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Stat Cards -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-100 dark:border-slate-800 p-5 flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-blue-50 dark:bg-blue-900/20 text-mgmp flex items-center justify-center shrink-0">
                    <i class="far fa-newspaper text-xl"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ $stats['berita'] }}</p>
                    <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">Total Berita</p>
                </div>
            </div>

            <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-100 dark:border-slate-800 p-5 flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 flex items-center justify-center shrink-0">
                    <i class="fas fa-calendar-alt text-xl"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ $stats['kegiatan'] }}</p>
                    <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">Total Kegiatan</p>
                </div>
            </div>

            <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-100 dark:border-slate-800 p-5 flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-purple-50 dark:bg-purple-900/20 text-purple-600 flex items-center justify-center shrink-0">
                    <i class="fas fa-download text-xl"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ $stats['download'] }}</p>
                    <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">Total Download</p>
                </div>
            </div>

            <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-100 dark:border-slate-800 p-5 flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-amber-50 dark:bg-amber-900/20 text-amber-600 flex items-center justify-center shrink-0">
                    <i class="far fa-calendar-check text-xl"></i>
                </div>
                <div>
                    <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ $stats['agenda'] }}</p>
                    <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">Total Agenda</p>
                </div>
            </div>
        </div>

        <!-- Content Grid: Berita + Agenda -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">

            <!-- Berita Terbaru -->
            <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-100 dark:border-slate-800 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2">
                        <i class="far fa-newspaper text-mgmp"></i> Berita Terbaru
                    </h2>
                    <a href="{{ route('berita') }}" class="text-xs font-semibold text-mgmp hover:underline">Lihat Semua →</a>
                </div>
                @if($beritaTerbaru->count())
                    <div class="space-y-3">
                        @foreach($beritaTerbaru as $item)
                            <a href="{{ route('berita') }}" class="flex items-start gap-3 p-3 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors group">
                                @if($item->image)
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}" class="w-14 h-14 rounded-lg object-cover shrink-0">
                                @else
                                    <div class="w-14 h-14 rounded-lg bg-slate-100 dark:bg-slate-800 flex items-center justify-center shrink-0">
                                        <i class="far fa-newspaper text-slate-400"></i>
                                    </div>
                                @endif
                                <div class="min-w-0">
                                    <p class="text-sm font-semibold text-slate-800 dark:text-slate-200 group-hover:text-mgmp transition-colors line-clamp-2">{{ $item->title }}</p>
                                    <p class="text-xs text-slate-400 dark:text-slate-500 mt-1">{{ $item->published_at?->diffForHumans() ?? '-' }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-slate-400 dark:text-slate-500 text-center py-6">Belum ada berita terbaru.</p>
                @endif
            </div>

            <!-- Agenda Mendatang -->
            <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-100 dark:border-slate-800 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2">
                        <i class="far fa-calendar-check text-amber-500"></i> Agenda Mendatang
                    </h2>
                    <a href="{{ route('agenda') }}" class="text-xs font-semibold text-mgmp hover:underline">Lihat Semua →</a>
                </div>
                @if($agendaMendatang->count())
                    <div class="space-y-3">
                        @foreach($agendaMendatang as $item)
                            <div class="flex items-start gap-3 p-3 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                <div class="w-12 h-12 rounded-lg bg-amber-50 dark:bg-amber-900/20 flex flex-col items-center justify-center shrink-0">
                                    <span class="text-[10px] font-bold text-amber-600 uppercase">{{ $item->date?->format('M') ?? '-' }}</span>
                                    <span class="text-lg font-bold text-amber-700 dark:text-amber-500 leading-none">{{ $item->date?->format('d') ?? '0' }}</span>
                                </div>
                                <div class="min-w-0">
                                    <p class="text-sm font-semibold text-slate-800 dark:text-slate-200 line-clamp-1">{{ $item->title ?? $item->name ?? 'Agenda' }}</p>
                                    <p class="text-xs text-slate-400 dark:text-slate-500 mt-1">{{ $item->date?->format('d M Y') ?? '-' }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-slate-400 dark:text-slate-500 text-center py-6">Tidak ada agenda mendatang.</p>
                @endif
            </div>
        </div>

        <!-- Quick Links -->
        <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
            <i class="fas fa-bolt text-mgmp"></i> Kelola Konten
        </h2>
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
            <a href="{{ route('admin.berita.index') }}" class="bg-white dark:bg-slate-900 rounded-xl border border-slate-100 dark:border-slate-800 p-5 text-center hover:border-mgmp/30 hover:shadow-md transition-all group">
                <div class="w-12 h-12 rounded-xl bg-blue-50 dark:bg-blue-900/20 text-mgmp flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform">
                    <i class="far fa-newspaper text-xl"></i>
                </div>
                <p class="text-sm font-semibold text-slate-800 dark:text-slate-200">Berita</p>
            </a>

            <a href="{{ route('admin.program.index') }}" class="bg-white dark:bg-slate-900 rounded-xl border border-slate-100 dark:border-slate-800 p-5 text-center hover:border-mgmp/30 hover:shadow-md transition-all group">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform">
                    <i class="fas fa-tasks text-xl"></i>
                </div>
                <p class="text-sm font-semibold text-slate-800 dark:text-slate-200">Program</p>
            </a>

            <a href="{{ route('admin.galeri.index') }}" class="bg-white dark:bg-slate-900 rounded-xl border border-slate-100 dark:border-slate-800 p-5 text-center hover:border-mgmp/30 hover:shadow-md transition-all group">
                <div class="w-12 h-12 rounded-xl bg-purple-50 dark:bg-purple-900/20 text-purple-600 flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform">
                    <i class="fas fa-images text-xl"></i>
                </div>
                <p class="text-sm font-semibold text-slate-800 dark:text-slate-200">Produk KIK</p>
            </a>

            <a href="{{ route('admin.kegiatan.index') }}" class="bg-white dark:bg-slate-900 rounded-xl border border-slate-100 dark:border-slate-800 p-5 text-center hover:border-mgmp/30 hover:shadow-md transition-all group">
                <div class="w-12 h-12 rounded-xl bg-amber-50 dark:bg-amber-900/20 text-amber-600 flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform">
                    <i class="fas fa-calendar-alt text-xl"></i>
                </div>
                <p class="text-sm font-semibold text-slate-800 dark:text-slate-200">Kegiatan</p>
            </a>

            <a href="{{ route('admin.agenda.index') }}" class="bg-white dark:bg-slate-900 rounded-xl border border-slate-100 dark:border-slate-800 p-5 text-center hover:border-mgmp/30 hover:shadow-md transition-all group">
                <div class="w-12 h-12 rounded-xl bg-cyan-50 dark:bg-cyan-900/20 text-cyan-600 flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform">
                    <i class="far fa-calendar-check text-xl"></i>
                </div>
                <p class="text-sm font-semibold text-slate-800 dark:text-slate-200">Agenda</p>
            </a>

            <a href="{{ route('admin.download.index') }}" class="bg-white dark:bg-slate-900 rounded-xl border border-slate-100 dark:border-slate-800 p-5 text-center hover:border-mgmp/30 hover:shadow-md transition-all group">
                <div class="w-12 h-12 rounded-xl bg-rose-50 dark:bg-rose-900/20 text-rose-600 flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform">
                    <i class="fas fa-download text-xl"></i>
                </div>
                <p class="text-sm font-semibold text-slate-800 dark:text-slate-200">Download</p>
            </a>
        </div>
    </div>
</div>
@endsection
