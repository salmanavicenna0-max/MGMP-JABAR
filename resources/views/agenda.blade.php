@extends('layouts.app')

@section('content')
    <!-- AGENDA SECTION -->
    <section id="agenda"
        class="section-content bg-white dark:bg-slate-900 pt-16 pb-24 bg-pattern-dots relative overflow-hidden z-0">
        <div class="blob-shape bg-gold/10 w-[600px] h-[600px] top-[20%] -left-[15%]"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="mb-12">
                <p class="text-xs font-bold tracking-wider text-mgmp uppercase mb-1">JADWAL & AGENDA</p>
                <h2 class="text-3xl font-bold text-slate-900 dark:text-white">Agenda MGMP KIK Jabar</h2>
            </div>

            <div class="space-y-4 max-w-4xl mx-auto">
                @forelse($agendas as $item)
                    <div
                        class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl p-4 sm:p-5 flex flex-col sm:flex-row items-start sm:items-center gap-4 sm:gap-6 shadow-md hover:shadow-lg hover:border-mgmp/40 hover:-translate-y-1 transition-all duration-300">
                        @if($item->image)
                        <div class="w-full sm:w-32 h-40 sm:h-24 rounded-xl overflow-hidden flex-shrink-0">
                            <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                        </div>
                        @endif
                        <div
                            class="flex sm:flex-col items-center sm:items-center gap-3 sm:gap-1 sm:w-24 flex-shrink-0 sm:border-r border-b sm:border-b-0 border-slate-100 dark:border-slate-800 pb-3 sm:pb-0 sm:pr-4 w-full justify-start sm:justify-center">
                            <div
                                class="bg-mgmp/10 text-mgmp dark:bg-mgmp-light/10 dark:text-mgmp-light w-10 h-10 rounded-xl sm:hidden flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-calendar-alt text-lg"></i>
                            </div>
                            <div class="text-left sm:text-center">
                                <div class="text-slate-800 dark:text-slate-200 text-sm sm:text-base font-bold">
                                    {{ $item->date ? \Carbon\Carbon::parse($item->date)->locale('id')->isoFormat('D MMM') : '' }}
                                </div>
                                <div class="text-slate-500 dark:text-slate-400 text-xs font-medium">{{ $item->time ?: '' }}
                                </div>
                            </div>
                        </div>
                        <div class="flex-grow w-full">
                            <div class="flex justify-between items-start gap-2">
                                <h4 class="text-slate-800 dark:text-slate-100 font-bold mb-1.5 text-base leading-snug">
                                    {{ $item->title }}
                                </h4>
                                <span
                                    class="bg-slate-50 dark:bg-slate-800 text-mgmp-light text-[10px] font-bold px-2.5 py-1 rounded-full sm:hidden flex-shrink-0 border border-slate-100 dark:border-slate-700">Agenda</span>
                            </div>
                            @if($item->description)
                                <div class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed mb-2 prose prose-sm dark:prose-invert">{!! $item->description !!}</div>
                            @endif
                            @if($item->location)
                                <div
                                    class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-slate-50 dark:bg-slate-800/50 rounded-md mt-1">
                                    <i class="fas fa-map-marker-alt text-mgmp/70 text-xs"></i>
                                    <span
                                        class="text-slate-500 dark:text-slate-400 text-xs font-medium">{{ $item->location }}</span>
                                </div>
                            @endif
                        </div>
                        <div class="flex-shrink-0 hidden sm:block">
                            <span
                                class="bg-slate-50 dark:bg-slate-800 text-mgmp-light text-xs font-bold px-4 py-2 rounded-full border border-slate-100 dark:border-slate-700">Agenda</span>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-16">
                        <div class="w-20 h-20 mx-auto bg-mgmp/10 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-calendar-check text-3xl text-mgmp/40"></i>
                        </div>
                        <p class="text-slate-500 dark:text-slate-400 text-lg font-medium">Belum ada agenda</p>
                        <p class="text-slate-400 dark:text-slate-500 text-sm mt-1">Agenda terbaru akan muncul di sini.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection