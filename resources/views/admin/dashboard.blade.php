@extends('layouts.app')

@section('title', 'Admin Dashboard — MGMP KIK Jawa Barat')

@section('content')
<div class="min-h-screen bg-slate-50 dark:bg-slate-950">

    <!-- Header -->
    <div class="bg-white dark:bg-slate-900 border-b border-slate-100 dark:border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            @if (session('success'))
                <div class="flash-message mb-4 p-3 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm flex items-center gap-2">
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
                    <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Admin Dashboard</h1>
                    <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                        Selamat datang, <span class="font-semibold text-mgmp">{{ Auth::user()->name }}</span>
                        <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-700">Admin</span>
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

    <!-- Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Stat Cards -->
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-4 mb-8">
            <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-100 dark:border-slate-800 p-4 text-center">
                <div class="w-10 h-10 rounded-lg bg-blue-50 dark:bg-blue-900/20 text-mgmp flex items-center justify-center mx-auto mb-2">
                    <i class="far fa-newspaper"></i>
                </div>
                <p class="text-xl font-bold text-slate-900 dark:text-white">{{ \App\Models\Berita::count() }}</p>
                <p class="text-[11px] text-slate-500 dark:text-slate-400 font-medium">Berita</p>
            </div>
            <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-100 dark:border-slate-800 p-4 text-center">
                <div class="w-10 h-10 rounded-lg bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 flex items-center justify-center mx-auto mb-2">
                    <i class="fas fa-tasks"></i>
                </div>
                <p class="text-xl font-bold text-slate-900 dark:text-white">{{ \App\Models\Program::count() }}</p>
                <p class="text-[11px] text-slate-500 dark:text-slate-400 font-medium">Program</p>
            </div>
            <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-100 dark:border-slate-800 p-4 text-center">
                <div class="w-10 h-10 rounded-lg bg-purple-50 dark:bg-purple-900/20 text-purple-600 flex items-center justify-center mx-auto mb-2">
                    <i class="fas fa-images"></i>
                </div>
                <p class="text-xl font-bold text-slate-900 dark:text-white">{{ \App\Models\Galeri::count() }}</p>
                <p class="text-[11px] text-slate-500 dark:text-slate-400 font-medium">Produk KIK</p>
            </div>
            <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-100 dark:border-slate-800 p-4 text-center">
                <div class="w-10 h-10 rounded-lg bg-amber-50 dark:bg-amber-900/20 text-amber-600 flex items-center justify-center mx-auto mb-2">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <p class="text-xl font-bold text-slate-900 dark:text-white">{{ \App\Models\Kegiatan::count() }}</p>
                <p class="text-[11px] text-slate-500 dark:text-slate-400 font-medium">Kegiatan</p>
            </div>
            <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-100 dark:border-slate-800 p-4 text-center">
                <div class="w-10 h-10 rounded-lg bg-cyan-50 dark:bg-cyan-900/20 text-cyan-600 flex items-center justify-center mx-auto mb-2">
                    <i class="far fa-calendar-check"></i>
                </div>
                <p class="text-xl font-bold text-slate-900 dark:text-white">{{ \App\Models\Agenda::count() }}</p>
                <p class="text-[11px] text-slate-500 dark:text-slate-400 font-medium">Agenda</p>
            </div>
            <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-100 dark:border-slate-800 p-4 text-center">
                <div class="w-10 h-10 rounded-lg bg-rose-50 dark:bg-rose-900/20 text-rose-600 flex items-center justify-center mx-auto mb-2">
                    <i class="fas fa-download"></i>
                </div>
                <p class="text-xl font-bold text-slate-900 dark:text-white">{{ \App\Models\Download::count() }}</p>
                <p class="text-[11px] text-slate-500 dark:text-slate-400 font-medium">Download</p>
            </div>
            <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-100 dark:border-slate-800 p-4 text-center">
                <div class="w-10 h-10 rounded-lg bg-indigo-50 dark:bg-indigo-900/20 text-indigo-600 flex items-center justify-center mx-auto mb-2">
                    <i class="fas fa-users"></i>
                </div>
                <p class="text-xl font-bold text-slate-900 dark:text-white">{{ \App\Models\User::where('role', 'member')->count() }}</p>
                <p class="text-[11px] text-slate-500 dark:text-slate-400 font-medium">Anggota</p>
            </div>
        </div>

        <!-- Pending Verification Alert -->
        @php $pendingVerifikasi = \App\Models\User::whereNull('email_verified_at')->where('role', 'member')->count(); @endphp
        @if($pendingVerifikasi > 0)
        <div class="mb-6 p-4 rounded-xl bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 flex items-center justify-between flex-wrap gap-3">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-amber-100 dark:bg-amber-800 text-amber-600 dark:text-amber-400 flex items-center justify-center">
                    <i class="fas fa-clock"></i>
                </div>
                <div>
                    <p class="text-sm font-semibold text-amber-700 dark:text-amber-400">{{ $pendingVerifikasi }} anggota menunggu verifikasi</p>
                    <p class="text-xs text-amber-600/80 dark:text-amber-400/60">Segera verifikasi anggota baru agar dapat mengakses fitur penuh.</p>
                </div>
            </div>
            <a href="{{ route('admin.anggota.index') }}" class="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white text-sm font-semibold rounded-lg inline-flex items-center gap-2 transition-all">
                <i class="fas fa-check-double"></i> Verifikasi Sekarang
            </a>
        </div>
        @endif

        <!-- Quick Links -->
        <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
            <i class="fas fa-th-large text-mgmp"></i> Kelola Konten
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
            <a href="{{ route('admin.chat.index') }}" class="bg-white dark:bg-slate-900 rounded-xl border border-slate-100 dark:border-slate-800 p-5 text-center hover:border-mgmp/30 hover:shadow-md transition-all group relative">
                @php $unreadChat = \App\Models\ChatMessage::where('sender', 'visitor')->where('is_read', false)->count(); @endphp
                @if($unreadChat > 0)
                <span class="absolute top-3 right-3 flex h-3 w-3">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
                </span>
                @endif
                <div class="w-12 h-12 rounded-xl bg-pink-50 dark:bg-pink-900/20 text-pink-600 flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform">
                    <i class="fas fa-headset text-xl"></i>
                </div>
                <p class="text-sm font-semibold text-slate-800 dark:text-slate-200">Live Chat CS</p>
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
            <a href="{{ route('admin.anggota.index') }}" class="bg-white dark:bg-slate-900 rounded-xl border border-slate-100 dark:border-slate-800 p-5 text-center hover:border-mgmp/30 hover:shadow-md transition-all group">
                <div class="w-12 h-12 rounded-xl bg-indigo-50 dark:bg-indigo-900/20 text-indigo-600 flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform">
                    <i class="fas fa-users text-xl"></i>
                </div>
                <p class="text-sm font-semibold text-slate-800 dark:text-slate-200">Anggota</p>
            </a>
            <a href="{{ route('admin.settings.index') }}" class="bg-white dark:bg-slate-900 rounded-xl border border-slate-100 dark:border-slate-800 p-5 text-center hover:border-mgmp/30 hover:shadow-md transition-all group">
                <div class="w-12 h-12 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform">
                    <i class="fas fa-cog text-xl"></i>
                </div>
                <p class="text-sm font-semibold text-slate-800 dark:text-slate-200">Pengaturan</p>
            </a>
            <a href="{{ route('admin.struktur.index') }}" class="bg-white dark:bg-slate-900 rounded-xl border border-slate-100 dark:border-slate-800 p-5 text-center hover:border-mgmp/30 hover:shadow-md transition-all group">
                <div class="w-12 h-12 rounded-xl bg-teal-50 dark:bg-teal-900/20 text-teal-600 flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform">
                    <i class="fas fa-sitemap text-xl"></i>
                </div>
                <p class="text-sm font-semibold text-slate-800 dark:text-slate-200">Struktur</p>
            </a>
        </div>
    </div>
</div>
@endsection
