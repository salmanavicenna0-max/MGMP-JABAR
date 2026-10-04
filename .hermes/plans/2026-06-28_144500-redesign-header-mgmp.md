# Redesign Header — MGMP PKK Jawa Barat

> **Goal:** Merancang ulang header/navbar yang sesuai dengan identitas website pemerintah institusi pendidikan, memutuskan strategi visibility login/register untuk guru anggota.

**Architecture:** Satu file Blade layout (`layouts/app.blade.php`) mengandung header + mobile menu. Semua perubahan ada di file ini saja.

**Tech Stack:** Laravel Blade + Tailwind CSS (CDN fallback) + Font Awesome (existing, akan dievaluasi)

**Referensi:** Government design system dari `responsive-web` skill (palette #0B3D6B/#C8A415, Lexend + Source Sans 3, Lucide icons)

---

## Context & Analisis

### Siapa Pengguna?

| Persona | Kebutuhan | Perilaku |
|---------|-----------|----------|
| **Masyarakat umum** | Baca berita, lihat program, download info | Tidak butuh login |
| **Guru anggota MGMP PKK** | Akses dashboard, kelola konten, download eksklusif | Butuh login |
| **Admin (pengurus)** | CRUD konten, kelola anggota | Butuh login, akses /admin |

### Masalah Saat Ini

1. **"Masuk / Daftar" = tombol biru prominent** di desktop nav (line 303-305) — setara visual dengan search & dark mode. Terlalu mencolok untuk situs pemerintah.
2. **Di mobile menu**, "Masuk / Daftar" jadi satu-satunya CTA setelah nav items — memaksa user non-member melihat login flow.
3. **Top blue bar** dengan info kontak + sosmed bagus, tapi tidak responsif (hidden di mobile).
4. **Nav items** berantakan secara visual: inline link + border-left separator + button group = terlalu banyak visual breakpoints.

### Pendekatan

Untuk login/register pada situs MGMP PKK, **jangan disembunyikan total** — ini bukan portal rahasia. Tapi **jangan ditonjolkan sebagai CTA utama**.

Alasan:
- ✅ Guru anggota perlu akses mudah ke dashboard
- ✅ Transparansi — proses keanggotaan terbuka
- ✅ Govt site tetap harus accessible

Tapi:
- ❌ Bukan landing page CTA — konten publik adalah prioritas
- ❌ Tidak perlu mengundang publik untuk daftar — pendaftaran untuk guru tertentu

**Rekomendasi: Subtle & Positioned Right** — login sebagai icon di pojok kanan atas (top bar), bukan tombol biru di main nav.

---

## Dua Opsi

### Opsi A: Minimal Government (Direkomendasikan)

Header bersih ala disdik.jabarprov.go.id — dua baris:

**Baris 1 (thin strip):**
- Kiri: logo kecil + nama institusi
- Kanan: search icon + dark mode toggle + **login icon (siluet user)** — baru setelah diklik muncul form/login page

**Baris 2 (main nav):**
- Beranda | Profil | Program | Berita | Galeri | Agenda
- Flat horizontal, active state underline
- Tidak ada tombol aksi

**Mobile:**
- Hamburger di kiri, logo di tengah, login icon + dark mode di kanan
- Menu dropdown: nav items + login/register di bagian paling bawah (setelah border pemisah)

### Opsi B: Semi-Prominent (Kompromi)

Sama seperti Opsi A, tapi login tetap sebagai **text link kecil** di main nav (bukan tombol biru):

**Baris 1:** Info kontak + sosmed (desktop only)
**Baris 2:**
- Kiri: logo
- Tengah: nav links
- Kanan: "Masuk" (text link, ukuran kecil, warna #475569) | dark mode toggle

**Mobile:** 
- Hamburger menu, login di bagian bawah setelah border pemisah

---

## Perubahan Detail (Opsi A — Rekomendasi)

### File yang Diubah
- `resources/views/layouts/app.blade.php` — header full rewrite

### Task 1: Audit dan Backup

**Objective:** Backup file yang akan diubah

**Files:**
- Backup: `resources/views/layouts/app.blade.php` → `app.blade.php.backup`

**Steps:**
1. `cp resources/views/layouts/app.blade.php resources/views/layouts/app.blade.php.backup`
2. Verifikasi backup ada

### Task 2: Restruktur Header — Dua Baris

**Objective:** Ubah header dari satu baris (top bar + nav campur) menjadi dua baris terpisah: utility bar + main navigation.

**Files:**
- Modify: `resources/views/layouts/app.blade.php` (section header, lines 182-361)

**Struktur baru:**

```blade
<header>
  <!-- Top Utility Bar (hidden mobile) -->
  <div class="hidden lg:block bg-[#0B3D6B] text-white text-[11px]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-9">
      <!-- Kiri: info kontak -->
      <div class="flex items-center gap-4">
        <span><i class="fas fa-map-marker-alt text-[#C8A415]"></i> Gedung Guru Jawa Barat</span>
        <span><i class="fas fa-phone-alt text-[#C8A415]"></i> (022) 4264318</span>
      </div>
      <!-- Kanan: sosmed + login -->
      <div class="flex items-center gap-3">
        <span class="flex items-center gap-2">
          <a href="#" class="hover:text-[#C8A415] transition"><i class="fab fa-facebook-f"></i></a>
          <a href="#" class="hover:text-[#C8A415] transition font-bold">X</a>
          <a href="#" class="hover:text-[#C8A415] transition"><i class="fab fa-instagram"></i></a>
          <a href="#" class="hover:text-[#C8A415] transition"><i class="fab fa-youtube"></i></a>
        </span>
        <span class="text-white/30">|</span>
        @auth
          <a href="{{ route('dashboard') }}" class="hover:text-[#C8A415] transition">
            <i class="fas fa-th-large"></i> Dasbor
          </a>
        @else
          <a href="{{ route('login') }}" class="hover:text-[#C8A415] transition">
            <i class="fas fa-sign-in-alt"></i> Masuk
          </a>
        @endauth
      </div>
    </div>
  </div>

  <!-- Main Nav -->
  <div class="bg-white dark:bg-slate-900 border-b border-slate-100 dark:border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center h-16 md:h-20">

        <!-- Logo -->
        <a href="{{ url('/') }}" class="flex items-center shrink-0">
          <img src="{{ asset('assets/Logo_Mgmp_PKK_jabar-removebg-preview.png') }}" alt="MGMP PKK"
               class="h-10 md:h-12 w-auto">
        </a>

        <!-- Desktop Nav -->
        <nav class="hidden lg:flex items-center space-x-1 font-medium text-sm">
          <a href="{{ url('/') }}" class="px-3 py-2 rounded-lg transition-colors {{ request()->is('/') ? 'text-[#0B3D6B] bg-[#EBF3FA] font-semibold' : 'text-[#475569] hover:text-[#0B3D6B] hover:bg-[#F8FAFC]' }}">Beranda</a>
          <a href="{{ route('profil.anggota') }}" class="px-3 py-2 rounded-lg transition-colors {{ request()->is('profil*') ? 'text-[#0B3D6B] bg-[#EBF3FA] font-semibold' : 'text-[#475569] hover:text-[#0B3D6B] hover:bg-[#F8FAFC]' }}">Profil</a>
          <a href="{{ route('program') }}" class="px-3 py-2 rounded-lg transition-colors {{ request()->is('program') ? 'text-[#0B3D6B] bg-[#EBF3FA] font-semibold' : 'text-[#475569] hover:text-[#0B3D6B] hover:bg-[#F8FAFC]' }}">Program</a>
          <a href="{{ route('berita') }}" class="px-3 py-2 rounded-lg transition-colors {{ request()->is('berita') ? 'text-[#0B3D6B] bg-[#EBF3FA] font-semibold' : 'text-[#475569] hover:text-[#0B3D6B] hover:bg-[#F8FAFC]' }}">Berita</a>
          <a href="{{ route('galeri') }}" class="px-3 py-2 rounded-lg transition-colors {{ request()->is('galeri') ? 'text-[#0B3D6B] bg-[#EBF3FA] font-semibold' : 'text-[#475569] hover:text-[#0B3D6B] hover:bg-[#F8FAFC]' }}">Galeri</a>
          <a href="{{ route('kegiatan') }}" class="px-3 py-2 rounded-lg transition-colors {{ request()->is('kegiatan') ? 'text-[#0B3D6B] bg-[#EBF3FA] font-semibold' : 'text-[#475569] hover:text-[#0B3D6B] hover:bg-[#F8FAFC]' }}">Kegiatan</a>
        </nav>

        <!-- Right: Desktop Actions -->
        <div class="hidden lg:flex items-center gap-2">
          <button class="w-9 h-9 rounded-lg border border-slate-200 dark:border-slate-700 text-slate-400 hover:text-[#0B3D6B] hover:border-[#0B3D6B] transition flex items-center justify-center" title="Cari">
            <i class="fas fa-search text-xs"></i>
          </button>
          <button class="dark-toggle-btn w-9 h-9 rounded-lg border border-slate-200 dark:border-slate-700 text-slate-400 hover:text-[#0B3D6B] hover:border-[#0B3D6B] transition flex items-center justify-center" title="Mode Gelap">
            <i class="fas fa-moon text-xs"></i>
          </button>
          {{-- Mobile login user icon (shown on mobile in header, text link in utility bar above for desktop) --}}
        </div>

        <!-- Mobile: Icons -->
        <div class="flex lg:hidden items-center gap-2">
          @auth
            <a href="{{ route('dashboard') }}" class="w-9 h-9 rounded-full bg-[#0B3D6B] text-white flex items-center justify-center">
              <i class="fas fa-user text-sm"></i>
            </a>
          @else
            <a href="{{ route('login') }}" class="w-9 h-9 rounded-full bg-slate-100 dark:bg-slate-800 text-[#475569] dark:text-slate-300 flex items-center justify-center">
              <i class="fas fa-sign-in-alt text-sm"></i>
            </a>
          @endauth
          <button class="dark-toggle-btn w-9 h-9 rounded-full bg-slate-100 dark:bg-slate-800 text-[#475569] dark:text-slate-300 flex items-center justify-center">
            <i class="fas fa-moon text-sm"></i>
          </button>
          <button id="burger-btn" class="w-10 h-10 rounded-full bg-slate-100 dark:bg-slate-800 text-[#0B3D6B] flex items-center justify-center" aria-label="Menu">
            <i class="fas fa-bars text-lg"></i>
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Mobile Menu (same as before, restructured) -->
  <div id="mobile-menu" class="lg:hidden bg-white dark:bg-slate-900 border-t border-slate-100 dark:border-slate-800">
    <div class="px-6 py-6 flex flex-col items-center space-y-1 text-sm font-medium">
      {{-- Nav items --}}
      <a href="{{ url('/') }}" class="w-full max-w-[250px] block py-3 rounded-xl text-center transition-colors {{ request()->is('/') ? 'text-[#0B3D6B] font-bold bg-[#EBF3FA]' : 'text-[#475569]' }}">Beranda</a>
      {{-- ... same pattern for all nav links ... --}}

      {{-- Separator before auth section --}}
      <div class="w-full pt-6 mt-2 border-t border-slate-100 dark:border-slate-800">
        @auth
          <a href="{{ route('dashboard') }}" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-[#0B3D6B] text-white rounded-lg text-sm font-bold">Dasbor</a>
          <form method="POST" action="{{ route('logout') }}" class="mt-2">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-slate-100 dark:bg-slate-800 text-[#475569] dark:text-slate-300 rounded-lg text-sm font-bold">Keluar</button>
          </form>
        @else
          <a href="{{ route('login') }}" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-slate-100 dark:bg-slate-800 text-[#475569] dark:text-slate-300 rounded-lg text-sm font-bold">
            <i class="fas fa-sign-in-alt"></i> Masuk / Daftar
          </a>
        @endauth
      </div>
    </div>
  </div>
</header>
```

### Task 3: Update Touch-Device Hover Handling

**Objective:** Implement scoped hover utilities dari `responsive-web` skill, ganti hover class inline dengan CSS approach.

**Files:**
- Modify: `resources/views/layouts/app.blade.php` — tambah CSS rules di `<style>` section

**CSS tambahan:**
```css
/* Desktop-only hover utilities */
html:not(.touch-device) .nav-link {
    transition: background-color 0.15s ease, color 0.15s ease;
}
html:not(.touch-device) .nav-link:hover {
    background-color: #F8FAFC;
    color: #0B3D6B;
}

html:not(.touch-device) .utility-link:hover {
    color: #C8A415;
}

/* Active nav link style */
.nav-link-active {
    color: #0B3D6B;
    background-color: #EBF3FA;
    font-weight: 600;
}
```

**Why:** Lebih maintainable daripada inline `hover:` classes yang perlu di-revert dengan `!important`.

### Task 4: Update Active State Pattern

**Objective:** Ganti active state dari `border-b-2` menjadi `bg-[#EBF3FA]` (pill shape) — lebih modern dan gov-style.

**Rationale:**
- `border-b-2` bermasalah: menggeser layout saat aktif (menambah tinggi elemen)
- Pill/shape background memberikan visual feedback yang lebih jelas
- Konsisten dengan disdik.jabarprov.go.id

### Task 5: Mobile Menu Restructure

**Objective:** Urutan mobile menu: nav items → separator → auth section di paling bawah.

**Perubahan:**
- Nav items berurutan (beranda, profil, program, berita, galeri, kegiatan)
- Separator line
- Auth section (login/register atau dashboard/logout)
- Tidak ada tombol biru mencolok di nav items

### Task 6: CSS Cleanup

**Objective:** Hapus CSS yang tidak terpakai terkait header lama.

- `top-bar-clip` → ganti jadi utility bar tanpa clip-path (straight, clean)
- Hapus animasi slider yang tidak perlu di header section

---

## Trade-off Analysis

| Aspek | Opsi A (Rekomendasi) | Opsi B (Kompromi) |
|-------|----------------------|-------------------|
| **Gov identity** | 🟢 Sangat kuat — mirip disdik | 🟡 Cukup — masih ada login di nav |
| **Login discoverability** | 🟡 Di utility bar + mobile icon — perlu cari | 🟢 Text link jelas di nav |
| **Mobile UX** | 🟢 Bersih, login di icon + menu bawah | 🟢 Sama |
| **Implementasi effort** | ~100 baris header rewrite | ~60 baris |
| **Waktu** | ~30 menit | ~20 menit |

**Rekomendasi: Opsi A** — karena:
1. Website pemerintah seharusnya memprioritaskan konten publik, bukan login
2. Guru anggota tetap bisa akses login via icon di utility bar (desktop) atau icon + menu (mobile)
3. Konsisten dengan anti-pattern guide dari UI/UX Pro Max: "Masuk/Daftar prominent buttons" → "Subtle text link, positioned right in navbar"

---

## Anti-Patterns yang Dihindari

| ❌ Lama | ✅ Baru |
|---------|---------|
| Tombol "Masuk/Daftar" biru besar di nav | Icon login kecil di utility bar / mobile icon |
| Clip-path miring di top bar | Utility bar lurus, solid #0B3D6B |
| Border-b-2 untuk active state | Pill background (`bg-[#EBF3FA]`) |
| Hover: class inline di Blade | Scoped CSS utilities |
| Nav + actions campur separator | Pisah: nav tengah, actions kanan |

---

## Verification

- [ ] Backup file sebelum edit
- [ ] Desktop: utility bar muncul, logo kiri, nav tengah, actions kanan
- [ ] Mobile: hamburger, nav items, login via icon di header
- [ ] Login icon → halaman login
- [ ] Setelah login: icon jadi avatar/dasbor
- [ ] Dark mode tetap berfungsi
- [ ] Touch-device hover tidak aktif
- [ ] Validasi dengan `git diff` sebelum commit

---

## Open Questions

1. **Font swap?** Saat ini pakai Inter + Font Awesome. Gov standard pakai Lexend/Source Sans 3 + Lucide. Apakah perlu diganti nanti di plan terpisah?
2. **Nav items — Kegiatan dan Agenda?** Saat ini tidak ada di desktop nav (hanya beranda, profil, program, berita, galeri). Perlu ditambah?
3. **Apakah search button fungsional?** Saat ini hanya tombol tanpa fungsi — perlu dimatikan atau diimplementasikan?
