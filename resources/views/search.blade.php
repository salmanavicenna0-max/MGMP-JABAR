@extends('layouts.app')
@section('title', 'Hasil Pencarian — MGMP KIK Jawa Barat')
@section('content')
<div class="min-h-screen bg-slate-50 dark:bg-slate-900 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-10 text-center">
            <h1 class="text-3xl font-bold text-slate-900 dark:text-white mb-4">Hasil Pencarian</h1>
            <p class="text-slate-600 dark:text-slate-400">Menampilkan hasil untuk: <span class="font-bold text-mgmp">"{{ $query }}"</span></p>
        </div>

        @if($results->isEmpty())
            <div class="bg-white dark:bg-slate-800 rounded-2xl p-12 text-center border border-slate-200 dark:border-slate-700">
                <div class="w-20 h-20 bg-slate-100 dark:bg-slate-700 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-search text-3xl text-slate-400 dark:text-slate-500"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">Tidak Ditemukan</h3>
                <p class="text-slate-500 dark:text-slate-400">Maaf, tidak ada hasil yang cocok dengan kata kunci "{{ $query }}". Silakan coba kata kunci lain.</p>
                <a href="{{ route('search.index') }}" class="inline-block mt-6 px-6 py-2.5 bg-mgmp hover:bg-mgmp-dark text-white rounded-lg font-bold transition-all" onclick="event.preventDefault(); document.querySelector('.search-btn').click();">
                    Cari Lagi
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($results as $item)
                    <div class="group relative bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 hover:border-mgmp/30 dark:hover:border-mgmp/30 hover:shadow-lg transition-all duration-300 overflow-hidden flex flex-col h-full">
                        @if($item->search_type === 'Berita' && $item->image)
                        <div class="relative h-48 overflow-hidden">
                            <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        </div>
                        @elseif($item->search_type !== 'Berita')
                        <div class="px-5 pt-5">
                            <div class="w-12 h-12 bg-mgmp/10 dark:bg-mgmp/20 rounded-xl flex items-center justify-center text-mgmp">
                                <i class="fas {{ $item->search_icon }} text-xl"></i>
                            </div>
                        </div>
                        @endif
                        
                        <div class="p-5 flex-1 flex flex-col">
                            <div class="flex flex-wrap items-center justify-between gap-2 mb-3">
                                <span class="px-2.5 py-1 rounded text-[10px] font-bold tracking-wider uppercase bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300">
                                    <i class="fas {{ $item->search_icon }} mr-1"></i> {{ $item->search_type }}
                                </span>
                                @if($item->search_date)
                                <span class="text-xs text-slate-400 dark:text-slate-500"><i class="far fa-calendar-alt mr-1"></i> {{ \Carbon\Carbon::parse($item->search_date)->locale('id')->isoFormat('D MMM YYYY') }}</span>
                                @endif
                            </div>
                            
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2 group-hover:text-mgmp transition-colors line-clamp-2">
                                @if($item->search_type !== 'Dokumen')
                                    <a href="{{ $item->search_url }}" class="after:absolute after:inset-0 after:z-0">{{ $item->title }}</a>
                                @else
                                    {{ $item->title }}
                                @endif
                            </h3>
                            
                            <div class="text-slate-500 dark:text-slate-400 text-xs leading-relaxed flex-grow line-clamp-3">
                                {{ $item->excerpt ?? Str::limit(strip_tags($item->description ?? $item->content ?? ''), 120) }}
                            </div>
                        </div>
                        
                        @if($item->search_type === 'Dokumen')
                            <!-- Action Buttons for Dokumen -->
                            <div class="p-5 pt-0 mt-auto flex gap-2 relative z-10">
                                <a href="{{ $item->search_url }}" target="_blank" class="flex-1 text-center py-2 bg-slate-100 hover:bg-slate-200 dark:bg-slate-700 dark:hover:bg-slate-600 text-slate-700 dark:text-slate-200 rounded-lg text-xs font-semibold transition-colors flex items-center justify-center gap-1.5 shadow-sm">
                                    <i class="fas fa-eye text-slate-400"></i> Preview
                                </a>
                                @auth
                                <a href="{{ $item->search_url }}" download class="flex-1 text-center py-2 bg-mgmp hover:bg-mgmp-dark text-white rounded-lg text-xs font-semibold transition-colors flex items-center justify-center gap-1.5 shadow-sm">
                                    <i class="fas fa-download"></i> Unduh
                                </a>
                                @endauth
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
