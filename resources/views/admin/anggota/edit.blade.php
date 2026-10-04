@extends('layouts.app')
@section('title', 'Edit Anggota — Admin MGMP KIK')
@section('content')
<div class="min-h-screen bg-slate-50 dark:bg-slate-900 py-8">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(session('success'))<div class="flash-message mb-4 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-lg text-sm">{{ session('success') }}</div>@endif
        @if(session('error'))<div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm">{{ session('error') }}</div>@endif

        <div class="flex items-center gap-3 mb-6">
            <a href="{{ Auth::user()->isAdmin() ? route('admin.dashboard') : route('dashboard') }}" class="px-3 py-2 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 text-sm font-semibold rounded-lg inline-flex items-center gap-2 hover:bg-slate-200 dark:hover:bg-slate-700 transition-all">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <a href="{{ route('admin.anggota.index') }}" class="p-2 text-slate-400 hover:text-slate-600 transition-colors">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Edit Anggota</h1>
        </div>

        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 p-6">
            <form action="{{ route('admin.anggota.update', $user) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                @csrf
                @method('PUT')

                <!-- Avatar Preview -->
                <div class="flex items-center gap-5">
                    <div class="shrink-0">
                        <div id="avatarPreview" class="w-20 h-20 rounded-full overflow-hidden bg-mgmp/10 flex items-center justify-center">
                            @if($user->avatar)
                                <img src="{{ Storage::disk('public')->url($user->avatar) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                            @else
                                <span class="text-2xl font-bold text-mgmp">{{ substr($user->name, 0, 1) }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Foto Profil</label>
                        <input type="file" name="avatar" id="avatarInput" accept="image/jpeg,image/png,image/webp"
                               class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-mgmp/10 file:text-mgmp hover:file:bg-mgmp/20 transition-all">
                        <p class="text-xs text-slate-400 mt-1">JPEG, PNG, atau WebP. Maks 2MB.</p>
                    </div>
                </div>
                @error('avatar')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Nama</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                           class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-lg text-sm text-slate-800 dark:text-white focus:ring-2 focus:ring-mgmp/20 focus:border-mgmp transition-all">
                    @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required
                           class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-lg text-sm text-slate-800 dark:text-white focus:ring-2 focus:ring-mgmp/20 focus:border-mgmp transition-all">
                    @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <!-- Asal Sekolah -->
                <div>
                    <label for="asal_sekolah" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Asal Sekolah</label>
                    <input type="text" name="asal_sekolah" id="asal_sekolah" value="{{ old('asal_sekolah', $user->asal_sekolah) }}" required
                           class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-lg text-sm text-slate-800 dark:text-white focus:ring-2 focus:ring-mgmp/20 focus:border-mgmp transition-all">
                    @error('asal_sekolah')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <!-- NPSN Sekolah -->
                <div>
                    <label for="npsn_sekolah" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">NPSN Sekolah</label>
                    <input type="number" name="npsn_sekolah" id="npsn_sekolah" value="{{ old('npsn_sekolah', $user->npsn_sekolah) }}" required
                           class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-lg text-sm text-slate-800 dark:text-white focus:ring-2 focus:ring-mgmp/20 focus:border-mgmp transition-all">
                    @error('npsn_sekolah')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <!-- Role -->
                <div>
                    <label for="role" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Role</label>
                    <select name="role" id="role"
                            class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-lg text-sm text-slate-800 dark:text-white focus:ring-2 focus:ring-mgmp/20 focus:border-mgmp transition-all">
                        <option value="member" {{ old('role', $user->role) === 'member' ? 'selected' : '' }}>
                            <i class="fas fa-user"></i> Member
                        </option>
                        <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>
                            <i class="fas fa-crown"></i> Admin
                        </option>
                    </select>
                    @error('role')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <!-- Read-only info -->
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Email Verified</label>
                        <p class="text-sm text-slate-500 dark:text-slate-400 py-2.5">{{ $user->email_verified_at ? $user->email_verified_at->format('d M Y H:i') : 'Belum diverifikasi' }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Terdaftar</label>
                        <p class="text-sm text-slate-500 dark:text-slate-400 py-2.5">{{ $user->created_at ? $user->created_at->format('d M Y') : '-' }}</p>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center gap-3 pt-3">
                    <button type="submit" class="px-6 py-2.5 bg-mgmp hover:bg-mgmp-dark text-white text-sm font-semibold rounded-lg inline-flex items-center gap-2 transition-all">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.anggota.index') }}" class="px-6 py-2.5 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 text-sm font-semibold rounded-lg hover:bg-slate-200 dark:hover:bg-slate-600 transition-all">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('avatarInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = function(ev) {
        document.getElementById('avatarPreview').innerHTML = '<img src="' + ev.target.result + '" class="w-full h-full object-cover">';
    };
    reader.readAsDataURL(file);
});
</script>
@endsection
