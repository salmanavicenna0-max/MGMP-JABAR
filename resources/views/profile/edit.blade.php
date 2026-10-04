@extends('layouts.app')

@section('title', 'Edit Profil — MGMP KIK Jawa Barat')

@section('content')
<div class="min-h-screen bg-slate-50 dark:bg-slate-950 py-8">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        @if (session('success'))
            <div class="flash-message mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm flex items-center gap-3 shadow-sm">
                <i class="fas fa-check-circle text-lg"></i>
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-700 text-sm shadow-sm">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="flex flex-col md:flex-row gap-6">
            <!-- Sidebar Navigation -->
            <div class="w-full md:w-1/3 lg:w-1/4">
                <div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden sticky top-8">
                    <!-- Profile Header -->
                    <div class="p-6 text-center border-b border-slate-100 dark:border-slate-800">
                        <div class="relative inline-block mb-4">
                            <img id="avatar-preview-sidebar"
                                src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=6366f1&color=fff&size=256' }}"
                                alt="Foto Profil"
                                class="h-28 w-28 object-cover rounded-full border-4 border-slate-50 dark:border-slate-800 shadow-md">
                        </div>
                        <h3 class="font-bold text-slate-900 dark:text-white text-lg leading-tight">{{ $user->name }}</h3>
                        <p class="text-xs font-semibold text-mgmp mt-1 uppercase tracking-wider">{{ ucfirst($user->role) }}</p>
                    </div>

                    <!-- Nav Links -->
                    <nav class="flex flex-col p-3 space-y-1">
                        <a href="{{ route('dashboard') }}" class="px-4 py-3 text-sm font-medium text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800/50 rounded-lg flex items-center gap-3 transition-colors">
                            <i class="fas fa-home w-5 text-center"></i> Dasbor
                        </a>
                        <a href="{{ route('profile.edit') }}" class="px-4 py-3 text-sm font-bold text-mgmp dark:text-mgmp-light bg-mgmp/10 dark:bg-mgmp/20 rounded-lg flex items-center gap-3 transition-colors">
                            <i class="fas fa-user-edit w-5 text-center"></i> Pengaturan Akun
                        </a>
                        <div class="h-px bg-slate-100 dark:bg-slate-800 my-2"></div>
                        <form action="{{ route('logout') }}" method="POST" class="m-0 p-0">
                            @csrf
                            <button type="submit" class="w-full px-4 py-3 text-sm font-medium text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg flex items-center gap-3 transition-colors text-left">
                                <i class="fas fa-sign-out-alt w-5 text-center"></i> Keluar
                            </button>
                        </form>
                    </nav>
                </div>
            </div>

            <!-- Main Content Area -->
            <div class="w-full md:w-2/3 lg:w-3/4">
                <div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
                    <div class="px-8 py-6 border-b border-slate-100 dark:border-slate-800">
                        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Pengaturan Akun</h1>
                        <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Perbarui informasi profil dan kata sandi Anda</p>
                    </div>

                    <div class="p-8">
                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="space-y-6">
                                <!-- Ubah Foto Profil -->
                                <div>
                                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Ganti Foto Profil</label>
                                    <div class="flex items-center gap-5">
                                        <div class="shrink-0">
                                            <img id="avatar-preview"
                                                src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=6366f1&color=fff&size=128' }}"
                                                alt="Foto Profil"
                                                class="h-16 w-16 object-cover rounded-full border border-slate-200 dark:border-slate-600 shadow-sm">
                                        </div>
                                        <div class="flex-1">
                                            <input type="file" id="avatar-input" name="avatar" accept="image/*"
                                                class="w-full text-sm text-slate-600 dark:text-slate-300 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-mgmp/10 file:text-mgmp hover:file:bg-mgmp/20 dark:file:bg-mgmp/20 dark:file:text-mgmp-light transition-all cursor-pointer">
                                            <p class="text-[11px] text-slate-400 mt-1">JPG, PNG, GIF, atau WebP. Maks 2MB.</p>
                                            @error('avatar')
                                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Email -->
                                <div>
                                    <label for="email" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Alamat Email</label>
                                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                                        class="w-full px-4 py-3 bg-white dark:bg-slate-900 border border-slate-300 dark:border-slate-600 rounded-lg text-sm text-slate-800 dark:text-white focus:ring-2 focus:ring-mgmp/20 focus:border-mgmp transition-all @error('email') border-red-300 @enderror"
                                        placeholder="Masukkan alamat email">
                                    @error('email')
                                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Nama -->
                                <div>
                                    <label for="name" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Nama Lengkap</label>
                                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                                        class="w-full px-4 py-3 bg-white dark:bg-slate-900 border border-slate-300 dark:border-slate-600 rounded-lg text-sm text-slate-800 dark:text-white focus:ring-2 focus:ring-mgmp/20 focus:border-mgmp transition-all @error('name') border-red-300 @enderror"
                                        placeholder="Masukkan nama lengkap">
                                    @error('name')
                                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Asal Sekolah -->
                                <div>
                                    <label for="asal_sekolah" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Asal Sekolah</label>
                                    <input type="text" id="asal_sekolah" name="asal_sekolah" value="{{ old('asal_sekolah', $user->asal_sekolah) }}"
                                        class="w-full px-4 py-3 bg-white dark:bg-slate-900 border border-slate-300 dark:border-slate-600 rounded-lg text-sm text-slate-800 dark:text-white focus:ring-2 focus:ring-mgmp/20 focus:border-mgmp transition-all @error('asal_sekolah') border-red-300 @enderror"
                                        placeholder="Masukkan asal sekolah">
                                    @error('asal_sekolah')
                                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- NPSN Sekolah -->
                                <div>
                                    <label for="npsn_sekolah" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">NPSN Sekolah</label>
                                    <input type="text" id="npsn_sekolah" name="npsn_sekolah" value="{{ old('npsn_sekolah', $user->npsn_sekolah) }}"
                                        class="w-full px-4 py-3 bg-white dark:bg-slate-900 border border-slate-300 dark:border-slate-600 rounded-lg text-sm text-slate-800 dark:text-white focus:ring-2 focus:ring-mgmp/20 focus:border-mgmp transition-all @error('npsn_sekolah') border-red-300 @enderror"
                                        placeholder="Masukkan NPSN sekolah">
                                    @error('npsn_sekolah')
                                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <h3 class="text-lg font-bold text-slate-900 dark:text-white pt-4 pb-2 border-b border-slate-100 dark:border-slate-800">Keamanan</h3>

                                <!-- Password -->
                                <div>
                                    <label for="password" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                                        Password Baru <span class="text-xs font-normal text-slate-400 ml-1">(Biarkan kosong jika tidak diubah)</span>
                                    </label>
                                    <input type="password" id="password" name="password"
                                        class="w-full px-4 py-3 bg-white dark:bg-slate-900 border border-slate-300 dark:border-slate-600 rounded-lg text-sm text-slate-800 dark:text-white focus:ring-2 focus:ring-mgmp/20 focus:border-mgmp transition-all @error('password') border-red-300 @enderror"
                                        placeholder="Masukkan password baru">
                                    @error('password')
                                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Konfirmasi Password -->
                                <div>
                                    <label for="password_confirmation" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Konfirmasi Password</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        class="w-full px-4 py-3 bg-white dark:bg-slate-900 border border-slate-300 dark:border-slate-600 rounded-lg text-sm text-slate-800 dark:text-white focus:ring-2 focus:ring-mgmp/20 focus:border-mgmp transition-all"
                                        placeholder="Ulangi password baru">
                                </div>
                            </div>

                            <div class="mt-8 pt-6 border-t border-slate-100 dark:border-slate-800 flex items-center justify-end">
                                <button type="submit" class="px-8 py-3 bg-mgmp hover:bg-mgmp-dark text-white text-sm font-bold rounded-lg inline-flex items-center gap-2 transition-all shadow-md hover:shadow-lg">
                                    <i class="fas fa-save"></i> Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('avatar-input')?.addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(ev) {
            const preview1 = document.getElementById('avatar-preview');
            const preview2 = document.getElementById('avatar-preview-sidebar');
            if (preview1) preview1.src = ev.target.result;
            if (preview2) preview2.src = ev.target.result;
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endpush
