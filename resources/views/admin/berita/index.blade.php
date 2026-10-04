@extends('layouts.app')
@section('title', 'Kelola Berita - Admin MGMP KIK')
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
                <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Kelola Berita</h1>
            </div>
            <a href="{{ route('admin.berita.create') }}" class="mt-3 sm:mt-0 inline-flex items-center gap-2 px-4 py-2 bg-mgmp hover:bg-mgmp-dark text-white rounded-lg text-sm font-bold transition-all"><i class="fas fa-plus"></i> Tambah Baru</a>
        </div>
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-slate-100 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50">
                            <th class="text-left px-5 py-3 font-bold text-slate-500 uppercase text-xs">#</th>
                            <th class="text-left px-5 py-3 font-bold text-slate-500 uppercase text-xs">Judul</th>
                            <th class="text-center px-5 py-3 font-bold text-slate-500 uppercase text-xs">Status</th>
                            <th class="text-left px-5 py-3 font-bold text-slate-500 uppercase text-xs hidden md:table-cell">Dibuat</th>
                            <th class="text-center px-5 py-3 font-bold text-slate-500 uppercase text-xs">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                        @forelse($data as $item)
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                            <td class="px-5 py-4 text-slate-400">{{ $loop->iteration }}</td>
                            <td class="px-5 py-4">
                                <a href="{{ route('admin.berita.edit', $item) }}" class="font-semibold text-slate-800 dark:text-slate-200 hover:text-mgmp transition-colors">{{ $item->title }}</a>
                            </td>
                            <td class="px-5 py-4 text-center">
                                @if($item->status === 'published')
                                    <span class="px-2 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600">Published</span>
                                @else
                                    <span class="px-2 py-0.5 rounded-full text-xs font-semibold bg-amber-50 dark:bg-amber-900/30 text-amber-600">Draft</span>
                                @endif
                            </td>
                            <td class="px-5 py-4 text-slate-400 text-xs hidden md:table-cell">{{ $item->created_at ? $item->created_at->format('d M Y') : '-' }}</td>
                            <td class="px-5 py-4 text-center">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.berita.edit', $item) }}" class="p-2 text-slate-400 hover:text-mgmp transition-colors" title="Edit"><i class="fas fa-edit"></i></a>
                                    <form action="{{ route('admin.berita.destroy', $item) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-2 text-slate-400 hover:text-red-500 transition-colors" title="Hapus"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="px-5 py-16 text-center">
                                <div class="flex flex-col items-center text-slate-400">
                                    <i class="fas fa-inbox text-4xl mb-3"></i>
                                    <p class="font-semibold">Belum ada data</p>
                                    <p class="text-sm mt-1">Belum ada berita yang ditambahkan.</p>
                                    <a href="{{ route('admin.berita.create') }}" class="mt-4 px-4 py-2 bg-mgmp hover:bg-mgmp-dark text-white rounded-lg text-sm font-bold transition-all"><i class="fas fa-plus mr-1"></i> Tambah Sekarang</a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection