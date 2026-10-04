@extends('layouts.app')

@section('content')
<!-- GALERI SECTION -->
<section id="galeri"
    class="section-content bg-slate-50 dark:bg-slate-800/30 pt-10 pb-24 bg-pattern-dots relative overflow-hidden z-0">
    <div class="blob-shape bg-mgmp/15 w-[800px] h-[800px] top-[0%] -right-[25%]"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="mb-12">
            <p class="text-xs font-bold tracking-wider text-mgmp uppercase mb-1">DOKUMENTASI KEGIATAN</p>
            <h2 class="text-3xl font-bold text-slate-900 dark:text-white">Produk KIK</h2>
        </div>

        <!-- Gallery Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($galeris as $item)
            <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-md border border-slate-200 dark:border-slate-700 overflow-hidden hover:shadow-xl hover:border-mgmp/40 hover:-translate-y-1 transition-all duration-300 flex flex-col group">
                <div class="relative h-56 overflow-hidden">
                    @if($item->image)
                    <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    @else
                    <div class="w-full h-full bg-mgmp/10 flex items-center justify-center">
                        <i class="fas fa-image text-4xl text-mgmp/40"></i>
                    </div>
                    @endif
                </div>
                <div class="p-5 flex-grow flex flex-col">
                    @if($item->published_at)
                    <p class="text-xs text-slate-400 dark:text-slate-500 font-medium mb-2"><i class="far fa-calendar-alt mr-1"></i> {{ \Carbon\Carbon::parse($item->published_at)->locale('id')->isoFormat('D MMMM YYYY') }}</p>
                    @endif
                    <h3 class="text-base font-bold text-slate-900 dark:text-white mb-2 group-hover:text-mgmp transition-colors leading-tight">{{ $item->title }}</h3>
                    @if($item->description)
                    <div class="text-slate-500 dark:text-slate-400 text-xs leading-relaxed flex-grow line-clamp-3 prose prose-sm dark:prose-invert">{!! $item->description !!}</div>
                    @endif
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-16">
                <div class="w-20 h-20 mx-auto bg-mgmp/10 rounded-full flex items-center justify-center mb-4">
                    <i class="fas fa-images text-3xl text-mgmp/40"></i>
                </div>
                <p class="text-slate-500 dark:text-slate-400 text-lg font-medium">Belum ada galeri</p>
                <p class="text-slate-400 dark:text-slate-500 text-sm mt-1">Foto-foto kegiatan akan muncul di sini.</p>
            </div>
            @endforelse
        </div>

        @if(method_exists($galeris, 'links'))
        <div class="mt-12">
            {{ $galeris->links() }}
        </div>
        @endif
    </div>
</section>
@endsection
