@extends('layouts.app')
@section('title', 'Edit Produk KIK — Admin MGMP KIK')
@php $is_create = false; $item = $data; @endphp
@section('content')
<div class="min-h-screen bg-slate-50 dark:bg-slate-900 py-8">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
            <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
                <div>
                    <h1 class="text-xl font-bold text-slate-900 dark:text-white">Edit Produk KIK</h1>
                    <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Perbarui data produk KIK</p>
                </div>
                <div class="flex items-center gap-2">
                    <a href="{{ Auth::user()->isAdmin() ? route('admin.dashboard') : route('dashboard') }}" class="px-3 py-2 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 text-sm font-semibold rounded-lg inline-flex items-center gap-2 hover:bg-slate-200 dark:hover:bg-slate-700 transition-all">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                    <a href="{{ route('admin.galeri.index') }}" class="px-4 py-2 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 text-sm font-semibold rounded-lg inline-flex items-center gap-2 hover:bg-slate-200 dark:hover:bg-slate-700 transition-all">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.galeri.update', $data) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="space-y-5">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">Judul <span class="text-red-500">*</span></label>
                            <input type="text" name="title" value="{{ old('title', $data->title) }}" class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg text-sm text-slate-800 dark:text-white focus:ring-2 focus:ring-mgmp/20 focus:border-mgmp @error('title') border-red-300 @enderror" placeholder="Masukkan judul foto">
                            @error('title') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">Deskripsi</label>
                            <textarea name="description" rows="4" class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg text-sm text-slate-800 dark:text-white focus:ring-2 focus:ring-mgmp/20 focus:border-mgmp @error('description') border-red-300 @enderror" placeholder="Deskripsi foto">{{ old('description', $data->description) }}</textarea>
                            @error('description') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">Gambar <span class="text-xs text-slate-400 font-normal">(kosongkan jika tidak ingin mengubah, max 3MB)</span></label>
                            @if($data->image)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/'.$data->image) }}" class="w-32 h-24 object-cover rounded-lg border border-slate-200 dark:border-slate-700">
                                    <p class="text-xs text-slate-400 mt-1">Gambar saat ini</p>
                                </div>
                            @endif
                            <input type="file" name="image" class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg text-sm text-slate-500 focus:ring-2 focus:ring-mgmp/20 focus:border-mgmp file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-mgmp file:text-white hover:file:bg-mgmp-dark @error('image') border-red-300 @enderror">
                            @error('image') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">Status <span class="text-red-500">*</span></label>
                            <select name="status" class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg text-sm text-slate-800 dark:text-white focus:ring-2 focus:ring-mgmp/20 focus:border-mgmp">
                                <option value="draft" {{ old('status', $data->status)=='draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status', $data->status)=='published' ? 'selected' : '' }}>Published</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-8 pt-5 border-t border-slate-100 dark:border-slate-800 flex justify-end">
                        <button type="submit" class="px-6 py-2.5 bg-mgmp hover:bg-mgmp-dark text-white text-sm font-bold rounded-lg inline-flex items-center gap-2 transition-all shadow-sm">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
