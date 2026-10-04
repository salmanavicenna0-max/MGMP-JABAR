@extends('layouts.app')

@section('content')
<!-- KEGIATAN SECTION -->
<section id="kegiatan"
    class="section-content bg-slate-50 dark:bg-slate-800/30 pt-10 pb-24 bg-pattern-grid relative overflow-hidden z-0">
    <div class="blob-shape bg-teal-400/15 w-[700px] h-[700px] top-[10%] -left-[20%]"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="mb-12">
            <p class="text-xs font-bold tracking-wider text-mgmp uppercase mb-1">AGENDA KEGIATAN</p>
            <h2 class="text-3xl font-bold text-slate-900 dark:text-white">Kegiatan MGMP KIK Jabar</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($kegiatans as $item)
            <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-md border border-slate-200 dark:border-slate-700 overflow-hidden hover:shadow-xl hover:border-mgmp/40 hover:-translate-y-1 transition-all duration-300 flex flex-col group">
                <div class="relative h-48 overflow-hidden">
                    @if($item->image)
                    <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    @else
                    <div class="w-full h-full bg-mgmp/10 flex items-center justify-center">
                        <i class="fas fa-calendar-alt text-4xl text-mgmp/40"></i>
                    </div>
                    @endif
                </div>
                <div class="p-6 flex-grow flex flex-col">
                    <div class="flex flex-wrap gap-2 mb-3">
                        @if($item->date)
                        <span class="text-xs text-slate-400 dark:text-slate-500 font-medium"><i class="far fa-calendar-alt mr-1"></i>{{ \Carbon\Carbon::parse($item->date)->locale('id')->isoFormat('D MMMM YYYY') }}</span>
                        @endif
                        @if($item->location)
                        <span class="text-xs text-slate-400 dark:text-slate-500 font-medium"><i class="fas fa-map-marker-alt mr-1"></i>{{ $item->location }}</span>
                        @endif
                    </div>
                    <h3 class="text-base font-bold text-slate-900 dark:text-white mb-2 group-hover:text-mgmp transition-colors leading-tight">{{ $item->title }}</h3>
                    <div class="text-slate-500 dark:text-slate-400 text-xs leading-relaxed mb-4 flex-grow line-clamp-3 prose prose-sm dark:prose-invert">{!! $item->description ?: 'Tidak ada deskripsi.' !!}</div>
                    <a href="{{ route('kegiatan.show', $item->slug) }}" class="text-mgmp font-semibold text-xs flex items-center mt-auto hover:text-mgmp-dark transition-colors">
                        Detail Kegiatan <i class="fas fa-arrow-right ml-1 text-[10px]"></i>
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-16">
                <div class="w-20 h-20 mx-auto bg-mgmp/10 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-calendar-alt text-3xl text-mgmp/40"></i>
                </div>
                <p class="text-slate-500 dark:text-slate-400 text-lg font-medium">Belum ada kegiatan</p>
                <p class="text-slate-400 dark:text-slate-500 text-sm mt-1">Kegiatan terbaru akan muncul di sini.</p>
            </div>
            @endforelse
        </div>

        @if(method_exists($kegiatans, 'links'))
        <div class="mt-12">
            {{ $kegiatans->links() }}
        </div>
        @endif
    </div>
</section>
@endsection
