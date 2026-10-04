@extends('layouts.app')
@section('title', 'Kelola Download — Admin MGMP KIK')
@section('content')
<div class="min-h-screen bg-slate-50 dark:bg-slate-900 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(session('success'))<div class="flash-message mb-4 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-lg text-sm">{{ session('success') }}</div>@endif
        @if(session('error'))<div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm">{{ session('error') }}</div>@endif
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
            <div class="flex items-center gap-3">
                <a href="{{ Auth::user()->isAdmin() ? route('admin.dashboard') : route('dashboard') }}" class="px-3 py-2 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 text-sm font-semibold rounded-lg inline-flex items-center gap-2 hover:bg-slate-200 dark:hover:bg-slate-700 transition-all">
                    <i class="fas fa-arrow-left"></i> Dashboard
                </a>
                <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Kelola Download</h1>
            </div>
            <a href="{{ route('admin.download.create') }}" class="mt-3 sm:mt-0 inline-flex items-center gap-2 px-4 py-2 bg-mgmp hover:bg-mgmp-dark text-white rounded-lg text-sm font-bold transition-all"><i class="fas fa-plus"></i> Tambah Baru</a>
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
            @forelse($data as $item)
                @php
                    $fileData = getFileIconData($item->file_path);
                    $fileExt = strtoupper(pathinfo($item->file_path, PATHINFO_EXTENSION));
                @endphp
                <div class="bg-white dark:bg-slate-800 rounded-2xl p-5 border border-slate-200 dark:border-slate-700 hover:border-mgmp/30 dark:hover:border-mgmp/30 hover:shadow-lg hover:-translate-y-1 transition-all duration-300 flex flex-col h-full group relative">
                    
                    <!-- Admin Actions (Absolute Top Right) -->
                    <div class="absolute top-4 right-4 flex gap-1 z-10 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <a href="{{ route('admin.download.edit', $item) }}" class="w-8 h-8 rounded-full bg-white dark:bg-slate-800 shadow border border-slate-200 dark:border-slate-700 flex items-center justify-center text-slate-500 hover:text-mgmp hover:border-mgmp transition-colors" title="Edit">
                            <i class="fas fa-edit text-xs"></i>
                        </a>
                        <form action="{{ route('admin.download.destroy', $item) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="w-8 h-8 rounded-full bg-white dark:bg-slate-800 shadow border border-slate-200 dark:border-slate-700 flex items-center justify-center text-slate-500 hover:text-red-500 hover:border-red-500 transition-colors" title="Hapus">
                                <i class="fas fa-trash text-xs"></i>
                            </button>
                        </form>
                    </div>

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
                            @if($item->formatted_size)
                            <span class="text-[11px] text-slate-400 dark:text-slate-500 font-medium tracking-wide border-l border-slate-200 dark:border-slate-700 pl-2">
                                {{ $item->formatted_size }}
                            </span>
                            @endif
                        </div>
                        <h3 class="text-[15px] font-bold text-slate-900 dark:text-white leading-snug mb-1 line-clamp-2 group-hover:text-mgmp transition-colors" title="{{ $item->title }}">
                            {{ $item->title }}
                        </h3>
                        <div class="mt-2 flex items-center gap-2">
                            @if($item->status === 'published')
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600">Published</span>
                            @else
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold bg-amber-50 dark:bg-amber-900/30 text-amber-600">Draft</span>
                            @endif
                        </div>
                    </div>

                    <!-- Footer / Actions -->
                    <div class="mt-5 pt-4 border-t border-slate-100 dark:border-slate-700/50 flex flex-col gap-2">
                        <div class="flex items-center justify-between text-[11px] text-slate-400 dark:text-slate-500 mb-2 font-medium">
                            <span><i class="far fa-calendar-alt mr-1"></i> {{ $item->created_at ? $item->created_at->format('d M Y') : '-' }}</span>
                            @if($item->category)
                                <span class="truncate max-w-[100px]"><i class="fas fa-tag mr-1"></i> {{ $item->category }}</span>
                            @endif
                        </div>

                        <div class="flex gap-2 w-full">
                            <a href="{{ asset('storage/'.$item->file_path) }}" target="_blank" class="flex-1 flex items-center justify-center gap-1.5 py-2 px-3 bg-slate-100 hover:bg-slate-200 dark:bg-slate-700 dark:hover:bg-slate-600 text-slate-700 dark:text-slate-200 rounded-lg text-xs font-semibold transition-colors shadow-sm" title="Lihat Dokumen">
                                <i class="fas fa-eye"></i> Preview
                            </a>
                            <a href="{{ asset('storage/'.$item->file_path) }}" download class="flex-1 flex items-center justify-center gap-1.5 py-2 px-3 bg-mgmp hover:bg-mgmp-dark text-white rounded-lg text-xs font-semibold transition-colors shadow-sm" title="Unduh Dokumen">
                                <i class="fas fa-download"></i> Unduh
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-16 text-center bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700">
                    <div class="w-20 h-20 mx-auto bg-slate-100 dark:bg-slate-700 rounded-full flex items-center justify-center mb-4">
                        <i class="fas fa-folder-open text-3xl text-slate-400"></i>
                    </div>
                    <p class="text-slate-900 dark:text-white text-lg font-bold mb-1">Belum ada dokumen</p>
                    <p class="text-slate-500 dark:text-slate-400 text-sm mb-4">Dokumen yang ditambahkan akan muncul di sini.</p>
                    <a href="{{ route('admin.download.create') }}" class="px-4 py-2 bg-mgmp hover:bg-mgmp-dark text-white rounded-lg text-sm font-bold transition-all"><i class="fas fa-plus mr-1"></i> Tambah Sekarang</a>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
