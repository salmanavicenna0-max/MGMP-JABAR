@extends('layouts.app')
@section('title', 'Program, Kegiatan & Agenda — MGMP KIK Jawa Barat')
@section('content')
<!-- PROGRAM SECTION -->
        <section id="program"
            class="section-content bg-slate-50 dark:bg-slate-900 pt-12 pb-24 border-t border-slate-100 dark:border-slate-800 relative overflow-hidden z-0 min-h-screen">
            <div class="blob-shape bg-gold/10 w-[600px] h-[600px] top-[20%] -left-[15%]"></div>
            <div class="blob-shape bg-mgmp-light/10 w-[500px] h-[500px] bottom-[10%] -right-[5%]"></div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="mb-10 text-center">
                    <h2 class="text-3xl md:text-4xl font-black text-slate-900 dark:text-white uppercase tracking-tighter mb-4">Program & Kegiatan</h2>
                    <p class="text-slate-500 dark:text-slate-400 max-w-2xl mx-auto text-sm">Informasi lengkap mengenai program unggulan, kegiatan mendatangkan, dan agenda MGMP KIK Jawa Barat.</p>
                </div>

                <!-- Tabs Navigation -->
                <div class="flex flex-wrap justify-center gap-2 mb-10 bg-white dark:bg-slate-800 p-2 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 w-fit mx-auto">
                    <button class="tab-btn active px-6 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 bg-mgmp text-white shadow-md" data-target="tab-program">
                        <i class="fas fa-clipboard-list mr-2"></i> Program
                    </button>
                    <button class="tab-btn px-6 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700" data-target="tab-kegiatan">
                        <i class="fas fa-calendar-alt mr-2"></i> Jadwal Kegiatan
                    </button>
                    <button class="tab-btn px-6 py-2.5 rounded-xl text-sm font-bold transition-all duration-300 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700" data-target="tab-agenda">
                        <i class="fas fa-calendar-check mr-2"></i> Agenda
                    </button>
                </div>

                @php
                $colors = [
                    ['border' => 'border-mgmp/20', 'icon_border' => 'border-mgmp/20', 'icon_text' => 'text-mgmp-light'],
                    ['border' => 'border-gold/20', 'icon_border' => 'border-gold/20', 'icon_text' => 'text-gold'],
                    ['border' => 'border-emerald-500/20', 'icon_border' => 'border-emerald-500/20', 'icon_text' => 'text-emerald-500'],
                    ['border' => 'border-purple-500/20', 'icon_border' => 'border-purple-500/20', 'icon_text' => 'text-purple-500'],
                ];
                @endphp

                <!-- Tab Content: Program -->
                <div id="tab-program" class="tab-content transition-opacity duration-300">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        @forelse($programs as $item)
                        @php $c = $colors[$loop->index % count($colors)]; @endphp
                        <div class="bg-white dark:bg-slate-800/40 border {{ $c['border'] }} p-6 rounded-2xl flex flex-col md:flex-row gap-5 hover:shadow-md transition-shadow">
                            @if($item->image)
                            <div class="w-full md:w-48 h-48 md:h-32 rounded-xl overflow-hidden flex-shrink-0">
                                <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                            </div>
                            @else
                            <div class="flex-shrink-0 hidden md:block">
                                <div class="w-12 h-12 bg-slate-50 dark:bg-slate-900 rounded-xl border {{ $c['icon_border'] }} flex items-center justify-center {{ $c['icon_text'] }} text-xl shadow-sm">
                                    <i class="fas {{ $item->icon ?: 'fa-clipboard-list' }}"></i>
                                </div>
                            </div>
                            @endif
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2 md:hidden">
                                    @if(!$item->image)
                                    <div class="w-10 h-10 bg-slate-50 dark:bg-slate-900 rounded-lg border {{ $c['icon_border'] }} flex items-center justify-center {{ $c['icon_text'] }} shadow-sm">
                                        <i class="fas {{ $item->icon ?: 'fa-clipboard-list' }}"></i>
                                    </div>
                                    @endif
                                    <h3 class="text-slate-800 dark:text-slate-100 font-bold text-lg leading-tight">{{ $item->title }}</h3>
                                </div>
                                <h3 class="text-slate-800 dark:text-slate-100 font-bold text-lg mb-2 hidden md:block">{{ $item->title }}</h3>
                                <div class="text-slate-600 dark:text-slate-300 text-sm leading-relaxed prose prose-sm dark:prose-invert">{!! $item->description !!}</div>
                            </div>
                        </div>
                        @empty
                        <div class="col-span-full text-center py-12 bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700">
                            <div class="w-16 h-16 mx-auto bg-mgmp/10 rounded-full flex items-center justify-center mb-3">
                                <i class="fas fa-clipboard-list text-2xl text-mgmp/40"></i>
                            </div>
                            <p class="text-slate-500 dark:text-slate-400">Belum ada program</p>
                        </div>
                        @endforelse
                    </div>
                </div>

                <!-- Tab Content: Kegiatan -->
                <div id="tab-kegiatan" class="tab-content hidden opacity-0 transition-opacity duration-300 max-w-4xl mx-auto">
                    <div class="space-y-4">
                        @forelse($kegiatans as $kegiatan)
                        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl p-4 flex flex-col sm:flex-row sm:items-center gap-4 sm:gap-6 shadow-md hover:shadow-lg hover:border-mgmp/40 hover:-translate-y-1 transition-all duration-300">
                            @if($kegiatan->image)
                            <div class="w-full sm:w-32 h-40 sm:h-24 rounded-xl overflow-hidden flex-shrink-0">
                                <img src="{{ asset('storage/'.$kegiatan->image) }}" alt="{{ $kegiatan->title }}" class="w-full h-full object-cover">
                            </div>
                            @endif
                            <div class="text-left sm:text-center sm:w-20 flex-shrink-0 sm:border-r border-b sm:border-b-0 border-slate-100 dark:border-slate-800 pb-3 sm:pb-0 sm:pr-4 flex sm:flex-col items-center gap-3 sm:gap-0">
                                <div class="bg-mgmp/10 text-mgmp dark:bg-mgmp-light/10 dark:text-mgmp-light w-10 h-10 rounded-xl sm:hidden flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-calendar-alt text-lg"></i>
                                </div>
                                <div>
                                    <div class="text-slate-700 dark:text-slate-200 text-sm font-bold">{{ $kegiatan->date ? \Carbon\Carbon::parse($kegiatan->date)->locale('id')->isoFormat('MMMM') : '' }}</div>
                                    <div class="text-slate-400 dark:text-slate-500 text-xs">{{ $kegiatan->date ? \Carbon\Carbon::parse($kegiatan->date)->format('Y') : '' }}</div>
                                </div>
                            </div>
                            <div class="flex-grow">
                                <h4 class="text-slate-800 dark:text-slate-100 font-bold mb-1">
                                    <a href="{{ route('kegiatan.show', $kegiatan->slug) }}" class="hover:text-mgmp transition-colors">{{ $kegiatan->title }}</a>
                                </h4>
                                <p class="text-slate-400 dark:text-slate-500 text-xs flex items-center gap-1"><i class="fas fa-map-marker-alt"></i> {{ $kegiatan->location }}</p>
                            </div>
                            <div class="flex-shrink-0 hidden md:block">
                                <span class="bg-slate-50 dark:bg-slate-800 text-mgmp-light text-[11px] font-bold px-3 py-1.5 rounded-full">Mendatang</span>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-12 bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700">
                            <div class="w-16 h-16 mx-auto bg-mgmp/10 rounded-full flex items-center justify-center mb-3">
                                <i class="fas fa-calendar-alt text-2xl text-mgmp/40"></i>
                            </div>
                            <p class="text-slate-500 dark:text-slate-400">Belum ada jadwal kegiatan</p>
                        </div>
                        @endforelse
                    </div>
                </div>

                <!-- Tab Content: Agenda -->
                <div id="tab-agenda" class="tab-content hidden opacity-0 transition-opacity duration-300 max-w-4xl mx-auto">
                    <div class="space-y-4">
                        @forelse($agendas as $item)
                        <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl p-4 sm:p-5 flex flex-col sm:flex-row items-start sm:items-center gap-4 sm:gap-6 shadow-md hover:shadow-lg hover:border-mgmp/40 hover:-translate-y-1 transition-all duration-300">
                            @if($item->image)
                            <div class="w-full sm:w-32 h-40 sm:h-24 rounded-xl overflow-hidden flex-shrink-0">
                                <img src="{{ asset('storage/'.$item->image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                            </div>
                            @endif
                            <div class="flex sm:flex-col items-center sm:items-center gap-3 sm:gap-1 sm:w-24 flex-shrink-0 sm:border-r border-b sm:border-b-0 border-slate-100 dark:border-slate-800 pb-3 sm:pb-0 sm:pr-4 w-full justify-start sm:justify-center">
                                <div class="bg-mgmp/10 text-mgmp dark:bg-mgmp-light/10 dark:text-mgmp-light w-10 h-10 rounded-xl sm:hidden flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-calendar-alt text-lg"></i>
                                </div>
                                <div class="text-left sm:text-center">
                                    <div class="text-slate-800 dark:text-slate-200 text-sm sm:text-base font-bold">
                                        {{ $item->date ? \Carbon\Carbon::parse($item->date)->locale('id')->isoFormat('D MMM') : '' }}
                                    </div>
                                    <div class="text-slate-500 dark:text-slate-400 text-xs font-medium">{{ $item->time ?: '' }}</div>
                                </div>
                            </div>
                            <div class="flex-grow w-full">
                                <div class="flex justify-between items-start gap-2">
                                    <h4 class="text-slate-800 dark:text-slate-100 font-bold mb-1.5 text-base leading-snug">
                                        {{ $item->title }}
                                    </h4>
                                    <span class="bg-slate-50 dark:bg-slate-800 text-mgmp-light text-[10px] font-bold px-2.5 py-1 rounded-full sm:hidden flex-shrink-0 border border-slate-100 dark:border-slate-700">Agenda</span>
                                </div>
                                @if($item->description)
                                    <div class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed mb-2 prose prose-sm dark:prose-invert">{!! $item->description !!}</div>
                                @endif
                                @if($item->location)
                                    <div class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-slate-50 dark:bg-slate-800/50 rounded-md mt-1">
                                        <i class="fas fa-map-marker-alt text-mgmp/70 text-xs"></i>
                                        <span class="text-slate-500 dark:text-slate-400 text-xs font-medium">{{ $item->location }}</span>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-shrink-0 hidden sm:block">
                                <span class="bg-slate-50 dark:bg-slate-800 text-mgmp-light text-xs font-bold px-4 py-2 rounded-full border border-slate-100 dark:border-slate-700">Agenda</span>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-16 bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700">
                            <div class="w-20 h-20 mx-auto bg-mgmp/10 rounded-full flex items-center justify-center mb-4">
                                <i class="fas fa-calendar-check text-3xl text-mgmp/40"></i>
                            </div>
                            <p class="text-slate-500 dark:text-slate-400 text-lg font-medium">Belum ada agenda</p>
                            <p class="text-slate-400 dark:text-slate-500 text-sm mt-1">Agenda terbaru akan muncul di sini.</p>
                        </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </section>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const tabBtns = document.querySelectorAll('.tab-btn');
                const tabContents = document.querySelectorAll('.tab-content');

                tabBtns.forEach(btn => {
                    btn.addEventListener('click', () => {
                        // Reset all buttons
                        tabBtns.forEach(b => {
                            b.classList.remove('bg-mgmp', 'text-white', 'shadow-md', 'active');
                            b.classList.add('text-slate-600', 'dark:text-slate-300', 'hover:bg-slate-100', 'dark:hover:bg-slate-700');
                        });
                        
                        // Set clicked button to active
                        btn.classList.add('bg-mgmp', 'text-white', 'shadow-md', 'active');
                        btn.classList.remove('text-slate-600', 'dark:text-slate-300', 'hover:bg-slate-100', 'dark:hover:bg-slate-700');

                        // Hide all content
                        tabContents.forEach(content => {
                            content.classList.add('hidden', 'opacity-0');
                        });

                        // Show target content
                        const targetId = btn.getAttribute('data-target');
                        const targetContent = document.getElementById(targetId);
                        
                        targetContent.classList.remove('hidden');
                        // Slight delay for opacity transition to work after display block
                        setTimeout(() => {
                            targetContent.classList.remove('opacity-0');
                        }, 50);
                    });
                });
            });
        </script>
@endsection
