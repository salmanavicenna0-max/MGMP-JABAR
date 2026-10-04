@extends('layouts.app')
@section('title', 'Dokumen Pedoman — MGMP KIK')
@section('content')
<div class="min-h-screen bg-slate-50 dark:bg-slate-900 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-6">
            <div class="text-center md:text-left">
                <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight mb-2">Dokumen Pedoman</h1>
                <p class="text-slate-600 dark:text-slate-400 max-w-2xl">Pusat unduhan dokumen pendukung, pedoman pembelajaran, dan kurikulum PKK terbaru.</p>
            </div>

            <!-- Search Bar -->
            <div class="w-full md:w-96 relative group">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400 group-focus-within:text-mgmp transition-colors">
                    <i class="fas fa-search"></i>
                </div>
                <input type="text" class="w-full pl-11 pr-4 py-3.5 bg-white dark:bg-slate-800 border-none shadow-sm rounded-xl text-sm outline-none focus:ring-2 focus:ring-mgmp text-slate-900 dark:text-white placeholder-slate-400 transition-all" placeholder="Cari nama dokumen atau kata kunci...">
            </div>
        </div>

        @php
        function getFileIconData($path) {
            $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
            switch($ext) {
                case 'pdf': return ['icon' => 'fa-file-pdf', 'color' => 'text-red-500', 'bg' => 'bg-red-50 dark:bg-red-500/10'];
                case 'doc': case 'docx': return ['icon' => 'fa-file-word', 'color' => 'text-blue-500', 'bg' => 'bg-blue-50 dark:bg-blue-500/10'];
                case 'xls': case 'xlsx': return ['icon' => 'fa-file-excel', 'color' => 'text-emerald-500', 'bg' => 'bg-emerald-50 dark:bg-emerald-500/10'];
                case 'ppt': case 'pptx': return ['icon' => 'fa-file-powerpoint', 'color' => 'text-orange-500', 'bg' => 'bg-orange-50 dark:bg-orange-500/10'];
                case 'zip': case 'rar': return ['icon' => 'fa-file-archive', 'color' => 'text-amber-500', 'bg' => 'bg-amber-50 dark:bg-amber-500/10'];
                case 'jpg': case 'jpeg': case 'png': return ['icon' => 'fa-file-image', 'color' => 'text-purple-500', 'bg' => 'bg-purple-50 dark:bg-purple-500/10'];
                default: return ['icon' => 'fa-file-alt', 'color' => 'text-slate-500 dark:text-slate-400', 'bg' => 'bg-slate-100 dark:bg-slate-800'];
            }
        }
        @endphp

        <!-- Documents Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($downloads as $item)
                @php
                    $fileData = getFileIconData($item->file_path);
                    $fileExt = strtoupper(pathinfo($item->file_path, PATHINFO_EXTENSION));
                @endphp
                <div class="bg-white dark:bg-slate-800 rounded-2xl p-5 border border-slate-200 dark:border-slate-700 hover:border-mgmp/30 dark:hover:border-mgmp/30 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 flex flex-col h-full group">
                    
                    <!-- File Icon Area -->
                    <div class="w-16 h-16 rounded-2xl {{ $fileData['bg'] }} flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas {{ $fileData['icon'] }} {{ $fileData['color'] }} text-3xl"></i>
                    </div>

                    <!-- Content -->
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="px-2 py-0.5 rounded text-[10px] font-bold tracking-wider uppercase bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300">
                                {{ $fileExt ?: 'FILE' }}
                            </span>
                            @if($item->file_size)
                            <span class="text-[11px] text-slate-400 dark:text-slate-500 font-medium tracking-wide border-l border-slate-200 dark:border-slate-700 pl-2">
                                {{ $item->file_size }}
                            </span>
                            @endif
                        </div>
                        <h3 class="text-[15px] font-bold text-slate-900 dark:text-white leading-snug mb-1 line-clamp-2 group-hover:text-mgmp transition-colors" title="{{ $item->title }}">
                            {{ $item->title }}
                        </h3>
                        @if($item->description)
                            <div class="text-xs text-slate-500 dark:text-slate-400 line-clamp-2 leading-relaxed mt-2">{!! strip_tags($item->description) !!}</div>
                        @endif
                    </div>

                    <!-- Footer / Actions -->
                    <div class="mt-5 pt-4 border-t border-slate-100 dark:border-slate-700/50 flex flex-col gap-2">
                        <div class="flex items-center justify-between text-[11px] text-slate-400 dark:text-slate-500 mb-2 font-medium">
                            <span><i class="far fa-calendar-alt mr-1"></i> {{ $item->created_at ? \Carbon\Carbon::parse($item->created_at)->locale('id')->isoFormat('D MMM YYYY') : '-' }}</span>
                            @if($item->category)
                                <span class="truncate max-w-[100px]"><i class="fas fa-tag mr-1"></i> {{ $item->category }}</span>
                            @endif
                        </div>

                        <div class="flex gap-2 w-full">
                            <a href="{{ asset('storage/'.$item->file_path) }}" target="_blank" class="flex-1 flex items-center justify-center gap-1.5 py-2 px-3 bg-slate-100 hover:bg-slate-200 dark:bg-slate-700 dark:hover:bg-slate-600 text-slate-700 dark:text-slate-200 rounded-lg text-xs font-semibold transition-colors shadow-sm" title="Lihat Dokumen">
                                <i class="fas fa-eye"></i> Preview
                            </a>
                            
                            @auth
                            <a href="{{ asset('storage/'.$item->file_path) }}" download class="flex-1 flex items-center justify-center gap-1.5 py-2 px-3 bg-mgmp hover:bg-mgmp-dark text-white rounded-lg text-xs font-semibold transition-colors shadow-sm" title="Unduh Dokumen">
                                <i class="fas fa-download"></i> Unduh
                            </a>
                            @endauth
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-16 text-center bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700">
                    <div class="w-20 h-20 mx-auto bg-slate-100 dark:bg-slate-700 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-folder-open text-3xl text-slate-400"></i>
                    </div>
                    <p class="text-slate-900 dark:text-white text-lg font-bold mb-1">Belum ada dokumen</p>
                    <p class="text-slate-500 dark:text-slate-400 text-sm">Dokumen yang dipublikasikan akan muncul di sini.</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if(method_exists($downloads, 'links') && $downloads->hasPages())
        <div class="mt-10 flex justify-center">
            {{ $downloads->links() }}
        </div>
        @endif
        
    </div>
</div>
@endsection
