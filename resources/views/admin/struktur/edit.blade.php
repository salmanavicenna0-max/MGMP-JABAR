@extends('layouts.app')

@section('title', 'Edit Pengurus — Admin Dashboard')

@section('content')
<div class="min-h-screen bg-slate-50 dark:bg-slate-950 py-8">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="flex items-center gap-4 mb-8">
            <a href="{{ route('admin.struktur.index') }}" class="w-10 h-10 rounded-full bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 flex items-center justify-center text-slate-500 hover:text-mgmp transition-colors">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Edit Pengurus</h1>
                <p class="text-sm text-slate-500 dark:text-slate-400">Ubah anggota atau jabatan pengurus ini.</p>
            </div>
        </div>

        @if($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-rose-50 border border-rose-200 text-rose-700 text-sm">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
            <form action="{{ route('admin.struktur.update', $struktur->id) }}" method="POST" id="strukturForm" class="p-6">
                @csrf
                @method('PUT')

                <!-- ===== LIVE SEARCH ANGGOTA ===== -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                        <i class="fas fa-search mr-1 text-mgmp"></i> Cari / Ganti Anggota
                    </label>

                    <!-- Search Input -->
                    <div class="relative">
                        <input
                            type="text"
                            id="searchInput"
                            placeholder="Ketik nama, email, atau asal sekolah..."
                            autocomplete="off"
                            class="w-full px-4 py-3 pl-11 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white focus:ring-2 focus:ring-mgmp/50 focus:border-mgmp outline-none transition-all"
                        >
                        <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                        <div id="searchSpinner" class="hidden absolute right-4 top-1/2 -translate-y-1/2">
                            <i class="fas fa-spinner fa-spin text-mgmp"></i>
                        </div>
                    </div>

                    <!-- Dropdown Hasil -->
                    <div id="searchResults" class="hidden mt-2 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl shadow-lg overflow-hidden max-h-64 overflow-y-auto z-50 relative">
                    </div>

                    <!-- Hidden input -->
                    <input type="hidden" name="user_id" id="selectedUserId"
                        value="{{ old('user_id', $selectedUser?->id ?? '') }}">
                </div>

                <!-- ===== PREVIEW ANGGOTA TERPILIH (pre-filled dari data lama) ===== -->
                <div id="selectedPreview" class="{{ $selectedUser || $struktur->name ? '' : 'hidden' }} mb-6 p-4 rounded-xl bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800">
                    <div class="flex items-center gap-4">
                        <div class="w-14 h-14 rounded-full overflow-hidden bg-slate-200 dark:bg-slate-700 border-2 border-emerald-300 flex-shrink-0">
                            @if($selectedUser?->avatar_url)
                                <img id="previewAvatar" src="{{ $selectedUser->avatar_url }}" alt="{{ $struktur->name }}" class="w-full h-full object-cover">
                                <div id="previewAvatarFallback" class="hidden w-full h-full flex items-center justify-center text-slate-400 text-xl"><i class="fas fa-user"></i></div>
                            @elseif($struktur->image)
                                <img id="previewAvatar" src="{{ str_starts_with($struktur->image, 'assets/') ? asset($struktur->image) : Storage::url($struktur->image) }}" alt="{{ $struktur->name }}" class="w-full h-full object-cover">
                                <div id="previewAvatarFallback" class="hidden w-full h-full flex items-center justify-center text-slate-400 text-xl"><i class="fas fa-user"></i></div>
                            @else
                                <img id="previewAvatar" src="" class="w-full h-full object-cover hidden">
                                <div id="previewAvatarFallback" class="w-full h-full flex items-center justify-center text-slate-400 text-xl"><i class="fas fa-user"></i></div>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <p id="previewName" class="font-bold text-slate-900 dark:text-white text-base truncate">{{ $struktur->name }}</p>
                            <p id="previewEmail" class="text-sm text-slate-500 dark:text-slate-400 truncate">{{ $selectedUser?->email ?? '' }}</p>
                            <p id="previewSekolah" class="text-xs text-emerald-700 dark:text-emerald-400 mt-0.5 truncate">{{ $struktur->unit ? '🏫 ' . $struktur->unit : '' }}</p>
                        </div>
                        <button type="button" id="clearUser" class="p-2 text-slate-400 hover:text-rose-500 transition-colors flex-shrink-0" title="Ganti anggota">
                            <i class="fas fa-times-circle"></i>
                        </button>
                    </div>
                </div>

                <!-- ===== JABATAN & URUTAN ===== -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Jabatan</label>

                        @php
                            $jabatanList = ['Ketua','Wakil Ketua','Sekretaris','Bendahara','Kepala Bidang DIKLAT','Humas & Kerja Sama','Pengembangan Organisasi','Anggota'];
                            $isCustomRole = !in_array($struktur->role, $jabatanList);
                        @endphp

                        <div class="flex gap-2">
                            <select name="{{ $isCustomRole ? '' : 'role' }}" id="roleSelect" {{ $isCustomRole ? '' : 'required' }}
                                class="flex-1 px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white focus:ring-2 focus:ring-mgmp/50 focus:border-mgmp outline-none transition-all">
                                <option value="">Pilih Jabatan...</option>
                                @foreach($jabatanList as $j)
                                    <option value="{{ $j }}" {{ (!$isCustomRole && old('role', $struktur->role) == $j) ? 'selected' : '' }}>{{ $j }}</option>
                                @endforeach
                            </select>
                            <button type="button" id="toggleCustomRole" title="{{ $isCustomRole ? 'Pilih dari daftar' : 'Jabatan custom' }}"
                                class="px-3 py-2.5 bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-500 hover:text-mgmp transition-colors text-sm">
                                <i class="fas {{ $isCustomRole ? 'fa-list' : 'fa-pen' }}"></i>
                            </button>
                        </div>
                        <!-- Input jabatan custom -->
                        <input type="text" id="customRole"
                            name="{{ $isCustomRole ? 'role' : '' }}"
                            value="{{ $isCustomRole ? old('role', $struktur->role) : '' }}"
                            placeholder="Ketik jabatan custom..."
                            class="{{ $isCustomRole ? '' : 'hidden' }} mt-2 w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white focus:ring-2 focus:ring-mgmp/50 focus:border-mgmp outline-none transition-all"
                            {{ $isCustomRole ? 'required' : '' }}>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Urutan Tampil</label>
                        <input type="number" name="order_num" value="{{ old('order_num', $struktur->order_num) }}" required min="0"
                            class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white focus:ring-2 focus:ring-mgmp/50 focus:border-mgmp outline-none transition-all">
                        <p class="text-xs text-slate-500 mt-1">Angka kecil = tampil paling atas.</p>
                    </div>

                </div>

                <div class="mt-8 flex justify-end">
                    <button type="submit" class="px-6 py-2.5 bg-mgmp hover:bg-mgmp-dark text-white font-bold rounded-xl shadow-md hover:shadow-lg transition-all flex items-center gap-2">
                        <i class="fas fa-save"></i> Perbarui Pengurus
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
(function () {
    const searchInput     = document.getElementById('searchInput');
    const searchResults   = document.getElementById('searchResults');
    const searchSpinner   = document.getElementById('searchSpinner');
    const selectedUserId  = document.getElementById('selectedUserId');
    const selectedPreview = document.getElementById('selectedPreview');
    const clearUser       = document.getElementById('clearUser');
    const previewAvatar   = document.getElementById('previewAvatar');
    const previewAvatarFb = document.getElementById('previewAvatarFallback');
    const previewName     = document.getElementById('previewName');
    const previewEmail    = document.getElementById('previewEmail');
    const previewSekolah  = document.getElementById('previewSekolah');
    const roleSelect      = document.getElementById('roleSelect');
    const toggleCustom    = document.getElementById('toggleCustomRole');
    const customRole      = document.getElementById('customRole');

    const searchUrl = "{{ route('admin.struktur.search-user') }}";

    let debounceTimer = null;
    let isCustomMode  = {{ $isCustomRole ? 'true' : 'false' }};

    // ---- Live Search ----
    searchInput.addEventListener('input', function () {
        clearTimeout(debounceTimer);
        const q = this.value.trim();
        if (q.length < 2) {
            searchResults.classList.add('hidden');
            searchResults.innerHTML = '';
            return;
        }
        debounceTimer = setTimeout(() => fetchUsers(q), 300);
    });

    function fetchUsers(q) {
        searchSpinner.classList.remove('hidden');
        fetch(`${searchUrl}?q=${encodeURIComponent(q)}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(r => r.json())
        .then(users => {
            searchSpinner.classList.add('hidden');
            renderResults(users);
        })
        .catch(() => searchSpinner.classList.add('hidden'));
    }

    function renderResults(users) {
        if (users.length === 0) {
            searchResults.innerHTML = `<div class="px-4 py-8 text-center text-sm text-slate-500"><i class="fas fa-user-slash mr-2"></i>Tidak ada anggota ditemukan</div>`;
        } else {
            searchResults.innerHTML = users.map(u => `
                <div class="flex items-center gap-3 px-4 py-3 cursor-pointer hover:bg-slate-50 dark:hover:bg-slate-700 transition-colors border-b border-slate-100 dark:border-slate-700 last:border-0 select-result"
                    data-id="${u.id}"
                    data-name="${escHtml(u.name)}"
                    data-email="${escHtml(u.email)}"
                    data-sekolah="${escHtml(u.asal_sekolah || '')}"
                    data-avatar="${escHtml(u.avatar_url || '')}">
                    <div class="w-10 h-10 rounded-full overflow-hidden bg-slate-200 flex-shrink-0 border border-slate-200">
                        ${u.avatar_url
                            ? `<img src="${escHtml(u.avatar_url)}" class="w-full h-full object-cover" alt="${escHtml(u.name)}">`
                            : `<div class="w-full h-full flex items-center justify-center text-slate-400"><i class="fas fa-user"></i></div>`}
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold text-slate-900 dark:text-white truncate">${escHtml(u.name)}</p>
                        <p class="text-xs text-slate-500 truncate">${escHtml(u.asal_sekolah || u.email)}</p>
                    </div>
                    <span class="text-xs px-2 py-0.5 rounded-full ${u.role === 'admin' ? 'bg-rose-100 text-rose-600' : 'bg-blue-100 text-blue-600'} font-medium flex-shrink-0">${escHtml(u.role)}</span>
                </div>
            `).join('');
        }
        searchResults.classList.remove('hidden');
        searchResults.querySelectorAll('.select-result').forEach(el => {
            el.addEventListener('click', () => selectUser(el.dataset));
        });
    }

    function selectUser(data) {
        selectedUserId.value = data.id;
        previewName.textContent    = data.name;
        previewEmail.textContent   = data.email;
        previewSekolah.textContent = data.sekolah ? '🏫 ' + data.sekolah : '';

        if (data.avatar) {
            previewAvatar.src = data.avatar;
            previewAvatar.classList.remove('hidden');
            previewAvatarFb.classList.add('hidden');
        } else {
            previewAvatar.classList.add('hidden');
            previewAvatarFb.classList.remove('hidden');
        }

        selectedPreview.classList.remove('hidden');
        searchInput.value = '';
        searchResults.classList.add('hidden');
    }

    // ---- Clear ----
    clearUser.addEventListener('click', () => {
        selectedUserId.value = '';
        selectedPreview.classList.add('hidden');
        searchInput.value = '';
        searchInput.focus();
    });

    // ---- Tutup dropdown klik luar ----
    document.addEventListener('click', e => {
        if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
            searchResults.classList.add('hidden');
        }
    });

    // ---- Custom jabatan toggle ----
    toggleCustom.addEventListener('click', () => {
        isCustomMode = !isCustomMode;
        customRole.classList.toggle('hidden', !isCustomMode);
        if (isCustomMode) {
            roleSelect.name = '';
            roleSelect.required = false;
            customRole.name = 'role';
            customRole.required = true;
            customRole.focus();
            toggleCustom.innerHTML = '<i class="fas fa-list"></i>';
            toggleCustom.title = 'Pilih dari daftar';
        } else {
            customRole.name = '';
            customRole.required = false;
            customRole.value = '';
            roleSelect.name = 'role';
            roleSelect.required = true;
            toggleCustom.innerHTML = '<i class="fas fa-pen"></i>';
            toggleCustom.title = 'Jabatan custom';
        }
    });

    function escHtml(str) {
        if (!str) return '';
        return str.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
    }
})();
</script>
@endsection
