@extends('layouts.app')
@section('title', 'Edit Dokumen — Admin MGMP KIK')
@php $is_create = false;
$item = $data; @endphp
@section('content')
    <div class="min-h-screen bg-slate-50 dark:bg-slate-900 py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div
                class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
                <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
                    <div>
                        <h1 class="text-xl font-bold text-slate-900 dark:text-white">Edit Dokumen</h1>
                        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Perbarui dokumen</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="{{ Auth::user()->isAdmin() ? route('admin.dashboard') : route('dashboard') }}"
                            class="px-3 py-2 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 text-sm font-semibold rounded-lg inline-flex items-center gap-2 hover:bg-slate-200 dark:hover:bg-slate-700 transition-all">
                            <i class="fas fa-home"></i> Dashboard
                        </a>
                        <a href="{{ route('admin.download.index') }}"
                            class="px-4 py-2 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 text-sm font-semibold rounded-lg inline-flex items-center gap-2 hover:bg-slate-200 dark:hover:bg-slate-700 transition-all">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="p-6">
                    <form action="{{ route('admin.download.update', $data) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="space-y-5">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">Judul
                                    <span class="text-red-500">*</span></label>
                                <input type="text" name="title" value="{{ old('title', $data->title) }}"
                                    class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg text-sm text-slate-800 dark:text-white focus:ring-2 focus:ring-mgmp/20 focus:border-mgmp @error('title') border-red-300 @enderror"
                                    placeholder="Masukkan judul dokumen">
                                @error('title') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label
                                    class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">Deskripsi</label>
                                <textarea id="content-editor" name="description" rows="10"
                                    class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg text-sm text-slate-800 dark:text-white focus:ring-2 focus:ring-mgmp/20 focus:border-mgmp @error('description') border-red-300 @enderror"
                                    placeholder="Deskripsi dokumen">{{ old('description', $data->description) }}</textarea>
                                @error('description') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label
                                    class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">Kategori</label>
                                <input type="text" name="category" value="{{ old('category', $data->category) }}"
                                    class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg text-sm text-slate-800 dark:text-white focus:ring-2 focus:ring-mgmp/20 focus:border-mgmp @error('category') border-red-300 @enderror"
                                    placeholder="Contoh: Modul, Soal, Panduan">
                                @error('category') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">File
                                    <span class="text-xs text-slate-400 font-normal">(kosongkan jika tidak ingin mengubah, Dokumen: pdf, doc, xls, ppt, zip. max 10MB)</span></label>
                                @if($data->file_path)
                                    <div
                                        class="mb-2 p-3 bg-slate-50 dark:bg-slate-700 rounded-lg border border-slate-200 dark:border-slate-600">
                                        <p class="text-xs text-slate-500 dark:text-slate-400 flex items-center gap-2">
                                            <i class="fas fa-file"></i> File saat ini: <span
                                                class="font-mono text-mgmp">{{ $data->file_path }}</span>
                                        </p>
                                    </div>
                                @endif
                                <input type="file" name="file" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.zip,.rar,.txt"
                                    class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg text-sm text-slate-500 focus:ring-2 focus:ring-mgmp/20 focus:border-mgmp file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-mgmp file:text-white hover:file:bg-mgmp-dark @error('file') border-red-300 @enderror">
                                @error('file') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-1">Status
                                    <span class="text-red-500">*</span></label>
                                <select name="status"
                                    class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg text-sm text-slate-800 dark:text-white focus:ring-2 focus:ring-mgmp/20 focus:border-mgmp">
                                    <option value="draft" {{ old('status', $data->status) == 'draft' ? 'selected' : '' }}>
                                        Draft</option>
                                    <option value="published" {{ old('status', $data->status) == 'published' ? 'selected' : '' }}>Published</option>
                                </select>
                            </div>
                            
                            <div>
                                <label class="flex items-center gap-2 cursor-pointer mt-2">
                                    <input type="checkbox" name="is_public" class="w-4 h-4 text-mgmp bg-slate-100 border-slate-300 rounded focus:ring-mgmp dark:focus:ring-mgmp dark:ring-offset-slate-800 focus:ring-2 dark:bg-slate-700 dark:border-slate-600" {{ old('is_public', $data->is_public ?? true) ? 'checked' : '' }}>
                                    <span class="text-sm font-semibold text-slate-700 dark:text-slate-300">Tampilkan untuk Pengunjung (Publik)</span>
                                </label>
                                <p class="text-xs text-slate-500 mt-1 ml-6">Jika tidak dicentang, dokumen ini hanya akan muncul dan bisa dicari oleh Anggota/Admin yang sudah login.</p>
                            </div>
                        </div>

                        <div class="mt-8 pt-5 border-t border-slate-100 dark:border-slate-800 flex justify-end">
                            <button type="submit"
                                class="px-6 py-2.5 bg-mgmp hover:bg-mgmp-dark text-white text-sm font-bold rounded-lg inline-flex items-center gap-2 transition-all shadow-sm">
                                <i class="fas fa-save"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.8.3/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            tinymce.init({
                selector: '#content-editor',
                plugins: 'lists link image preview',
                toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | preview',
                menubar: false,
                height: 300
            });
        });
    </script>
@endsection