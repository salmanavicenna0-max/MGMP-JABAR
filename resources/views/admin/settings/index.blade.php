@extends('layouts.app')

@section('title', 'Pengaturan Web — Admin Dashboard')

@section('content')
<div class="min-h-screen bg-slate-50 dark:bg-slate-950 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('admin.dashboard') }}" class="w-10 h-10 rounded-full bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 flex items-center justify-center text-slate-500 hover:text-mgmp transition-colors">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Pengaturan Website</h1>
                <p class="text-sm text-slate-500 dark:text-slate-400">Atur konten dinamis seperti statistik halaman depan.</p>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm flex items-center gap-2">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-slate-100 dark:border-slate-800">
                <h2 class="text-lg font-bold text-slate-800 dark:text-white flex items-center gap-2">
                    <i class="fas fa-chart-line text-mgmp"></i> Statistik Beranda
                </h2>
            </div>
            
            <form action="{{ route('admin.settings.store') }}" method="POST" class="p-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <!-- Anggota -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Jumlah Anggota</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-users text-slate-400"></i>
                            </div>
                            <input type="text" name="stat_anggota" value="{{ $settings['stat_anggota'] ?? '1.200+' }}" 
                                class="w-full pl-10 pr-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white focus:ring-2 focus:ring-mgmp/50 focus:border-mgmp outline-none transition-all"
                                placeholder="Contoh: 1.200+">
                        </div>
                    </div>

                    <!-- Kabupaten / Kota -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Kabupaten / Kota</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-map-marker-alt text-slate-400"></i>
                            </div>
                            <input type="text" name="stat_kabupaten" value="{{ $settings['stat_kabupaten'] ?? '27' }}" 
                                class="w-full pl-10 pr-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white focus:ring-2 focus:ring-mgmp/50 focus:border-mgmp outline-none transition-all"
                                placeholder="Contoh: 27">
                        </div>
                    </div>

                    <!-- Kegiatan -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Kegiatan Per Tahun</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="far fa-calendar-check text-slate-400"></i>
                            </div>
                            <input type="text" name="stat_kegiatan" value="{{ $settings['stat_kegiatan'] ?? '48' }}" 
                                class="w-full pl-10 pr-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white focus:ring-2 focus:ring-mgmp/50 focus:border-mgmp outline-none transition-all"
                                placeholder="Contoh: 48">
                        </div>
                    </div>

                    <!-- Tahun Berdiri -->
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Tahun Berdiri</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-award text-slate-400"></i>
                            </div>
                            <input type="text" name="stat_tahun" value="{{ $settings['stat_tahun'] ?? '15+' }}" 
                                class="w-full pl-10 pr-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white focus:ring-2 focus:ring-mgmp/50 focus:border-mgmp outline-none transition-all"
                                placeholder="Contoh: 15+">
                        </div>
                    </div>

                </div>

                <div class="mt-8 flex justify-end">
                    <button type="submit" class="px-6 py-2.5 bg-mgmp hover:bg-mgmp-dark text-white font-bold rounded-xl shadow-md hover:shadow-lg transition-all flex items-center gap-2">
                        <i class="fas fa-save"></i> Simpan Pengaturan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
