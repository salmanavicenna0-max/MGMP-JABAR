@extends('layouts.app')

@section('title', $kegiatan->title . ' - MGMP KIK Jawa Barat')

@section('content')
<div class="bg-slate-50 dark:bg-slate-950 py-12 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumb & Navigation -->
        <div class="mb-8 flex items-center justify-between text-sm">
            <a href="{{ route('kegiatan') }}" class="text-slate-500 hover:text-mgmp transition-colors flex items-center gap-2">
                <i class="fas fa-arrow-left"></i> Kembali ke Kegiatan
            </a>
            @if($kegiatan->date)
            <span class="text-slate-400">
                <i class="far fa-calendar-alt mr-1"></i> {{ \Carbon\Carbon::parse($kegiatan->date)->locale('id')->isoFormat('D MMMM YYYY') }}
            </span>
            @endif
        </div>

        <!-- Article Card -->
        <article class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden">
            <!-- Featured Image -->
            @if($kegiatan->image)
            <div class="w-full h-[400px] overflow-hidden bg-slate-100 dark:bg-slate-800">
                <img src="{{ asset('storage/'.$kegiatan->image) }}" alt="{{ $kegiatan->title }}" class="w-full h-full object-cover">
            </div>
            @endif

            <div class="p-8 md:p-12">
                <h1 class="text-3xl md:text-4xl font-bold text-slate-900 dark:text-white leading-tight mb-6">
                    {{ $kegiatan->title }}
                </h1>

                <div class="flex flex-wrap items-center gap-4 mb-8 text-sm text-slate-500 dark:text-slate-400 border-b border-slate-100 dark:border-slate-800 pb-6">
                    @if($kegiatan->location)
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-full bg-mgmp/10 text-mgmp flex items-center justify-center">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <span class="font-medium text-slate-700 dark:text-slate-300">
                            Lokasi: {{ $kegiatan->location }}
                        </span>
                    </div>
                    @endif
                    <div class="hidden sm:block w-1 h-1 rounded-full bg-slate-300 dark:bg-slate-700"></div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-user-edit"></i>
                        <span>Diunggah oleh: {{ $kegiatan->user->name ?? 'Admin' }}</span>
                    </div>
                </div>
                
                <div class="prose prose-slate dark:prose-invert max-w-none text-slate-600 dark:text-slate-300">
                    {!! $kegiatan->description ?: '<i>Tidak ada deskripsi rinci untuk kegiatan ini.</i>' !!}
                </div>
            </div>
        </article>

    </div>
</div>
@endsection
