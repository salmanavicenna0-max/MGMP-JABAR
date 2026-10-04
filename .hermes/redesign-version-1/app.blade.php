<!DOCTYPE html>
<html lang="id">

<head>
    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('theme', 'light');
        }
        if ('ontouchstart' in window || navigator.maxTouchPoints > 0) {
            document.documentElement.classList.add('touch-device');
        }
    </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <meta name="description"
        content="Website Resmi MGMP PKK SMP Jawa Barat - Wadah komunikasi, inovasi, dan kolaborasi guru PKK.">
    <title>@yield('title', 'MGMP PKK Jawa Barat')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: {
                        mgmp: { DEFAULT: '#1363a6', dark: '#0b5c9c', light: '#5f99cd' },
                        gold: '#ffb800',
                    }
                }
            }
        }
    </script>

    <style>
        * {
            font-family: 'Inter', sans-serif;
            -webkit-tap-highlight-color: transparent;
        }
        html { scroll-behavior: smooth; }

        /* ============================================
           HEADER: Quiet Security + Scroll Shrink
           ============================================ */
        #main-header {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-bottom: 1px solid #e2e8f0;
        }
        .dark #main-header {
            background: rgba(15, 23, 42, 0.92);
            border-bottom-color: #334155;
        }
        #main-header.header-scrolled {
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.06);
        }
        .dark #main-header.header-scrolled {
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.3);
        }

        /* Logo shrink on scroll */
        .header-logo { height: 44px; transition: height 0.3s ease; }
        .header-scrolled .header-logo { height: 32px; }

        /* Text next to logo shrink */
        .header-logo-text { transition: opacity 0.3s ease; }
        .header-scrolled .header-logo-text .logo-sub { display: none; }

        /* Desktop-only hover utilities */
        html:not(.touch-device) .nav-link {
            transition: background-color 0.15s ease, color 0.15s ease;
        }
        html:not(.touch-device) .nav-link:hover {
            background-color: rgba(19, 99, 166, 0.06);
            color: #1363a6;
        }
        html:not(.touch-device) .dark .nav-link:hover {
            background-color: rgba(95, 153, 205, 0.1);
            color: #5f99cd;
        }
        html:not(.touch-device) .utility-btn:hover {
            color: #1363a6;
            border-color: #1363a6;
        }
        html:not(.touch-device) .dark .utility-btn:hover {
            color: #5f99cd;
            border-color: #5f99cd;
        }

        /* Touch device hover override */
        .touch-device *:hover {
            color: revert !important;
            background-color: revert !important;
            border-color: revert !important;
        }

        /* Active nav state */
        .nav-active {
            color: #1363a6 !important;
            background-color: rgba(19, 99, 166, 0.08);
            font-weight: 600;
        }
        .dark .nav-active {
            color: #5f99cd !important;
            background-color: rgba(95, 153, 205, 0.12);
        }

        /* Mobile menu */
        #mobile-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        }
        #mobile-menu.open { max-height: 600px; }

        /* User dropdown */
        .user-dropdown {
            opacity: 0;
            transform: translateY(-8px) scale(0.95);
            pointer-events: none;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .user-dropdown.open {
            opacity: 1;
            transform: translateY(0) scale(1);
            pointer-events: auto;
        }

        /* Back to top */
        #back-to-top {
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s;
        }
        #back-to-top.visible { opacity: 1; pointer-events: auto; }

        /* Custom scrollbar */
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }

        /* Reduced motion */
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation-duration: 0.01ms !important;
                transition-duration: 0.01ms !important;
            }
            html { scroll-behavior: auto; }
        }
    </style>
    @stack('styles')
</head>

<body class="bg-slate-50 text-slate-800 dark:bg-slate-950 dark:text-slate-100 antialiased overflow-x-hidden">

    <!-- ===================== HEADER (NEW: Quiet Security) ===================== -->
    <header id="main-header" class="sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16 md:h-20">

                <!-- Logo + Text -->
                <a href="{{ url('/') }}" class="flex items-center gap-3 shrink-0">
                    <img src="{{ asset('assets/Logo_Mgmp_PKK_jabar-removebg-preview.png') }}?v={{ time() }}"
                         alt="Logo MGMP PKK"
                         class="header-logo w-auto object-contain">
                    <div class="header-logo-text leading-tight hidden sm:block">
                        <div class="logo-sub text-[10px] text-slate-400 dark:text-slate-500 font-medium tracking-wider uppercase">
                            Dinas Pendidikan Jawa Barat
                        </div>
                        <div class="text-[13px] font-bold text-[#0B3D6B] dark:text-white leading-tight">
                            MGMP PKK
                        </div>
                    </div>
                </a>

                <!-- Desktop Nav (center) -->
                <nav class="hidden lg:flex items-center space-x-1 text-[13px] font-medium">
                    @php
                        $navItems = [
                            ['url' => url('/'), 'label' => 'Beranda', 'match' => '/'],
                            ['url' => route('profil.anggota'), 'label' => 'Profil', 'match' => 'profil*'],
                            ['url' => route('program'), 'label' => 'Program', 'match' => 'program'],
                            ['url' => route('berita'), 'label' => 'Berita', 'match' => 'berita'],
                            ['url' => route('galeri'), 'label' => 'Galeri', 'match' => 'galeri'],
                            ['url' => route('kegiatan'), 'label' => 'Kegiatan', 'match' => 'kegiatan'],
                            ['url' => route('agenda'), 'label' => 'Agenda', 'match' => 'agenda'],
                        ];
                    @endphp
                    @foreach($navItems as $item)
                        <a href="{{ $item['url'] }}"
                           class="nav-link px-3 py-2 rounded-lg {{ request()->is($item['match']) ? 'nav-active' : 'text-slate-600 dark:text-slate-300' }}">
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </nav>

                <!-- Right: Utility Icons -->
                <div class="flex items-center gap-2">
                    <!-- Search -->
                    <button class="utility-btn w-9 h-9 rounded-lg border border-slate-200 dark:border-slate-700 text-slate-400 dark:text-slate-500 transition flex items-center justify-center"
                            title="Cari">
                        <i class="fas fa-search text-xs"></i>
                    </button>

                    <!-- Dark Mode -->
                    <button class="dark-toggle-btn utility-btn w-9 h-9 rounded-lg border border-slate-200 dark:border-slate-700 text-slate-400 dark:text-slate-500 transition flex items-center justify-center"
                            title="Mode Gelap" id="dark-toggle">
                        <i class="fas fa-moon text-xs"></i>
                    </button>

                    <!-- User Avatar / Login -->
                    @auth
                        <!-- Avatar dengan dropdown -->
                        <div class="relative">
                            <button id="user-avatar-btn"
                                    class="w-9 h-9 rounded-full bg-[#0B3D6B] text-white flex items-center justify-center text-xs font-bold shadow-sm transition hover:ring-2 hover:ring-[#0B3D6B]/20 focus:outline-none">
                                @if(Auth::user()->avatar)
                                    <img src="{{ Auth::user()->avatar }}" class="w-full h-full rounded-full object-cover" alt="Avatar">
                                @else
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                @endif
                            </button>

                            <!-- Dropdown -->
                            <div id="user-dropdown"
                                 class="user-dropdown absolute right-0 mt-2 w-52 bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-slate-100 dark:border-slate-700 py-2 z-50">
                                <div class="px-4 py-2 border-b border-slate-100 dark:border-slate-700">
                                    <div class="text-sm font-semibold text-slate-800 dark:text-slate-100">{{ Auth::user()->name }}</div>
                                    <div class="text-xs text-slate-400 dark:text-slate-500">{{ Auth::user()->email }}</div>
                                </div>
                                <a href="{{ Auth::user()->isAdmin() ? route('admin.dashboard') : route('dashboard') }}"
                                   class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700/50 transition">
                                    <i class="fas fa-th-large w-4 text-center text-slate-400"></i> Dasbor
                                </a>
                                <a href="{{ route('profile.edit') }}"
                                   class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700/50 transition">
                                    <i class="fas fa-user-pen w-4 text-center text-slate-400"></i> Edit Profil
                                </a>
                                <div class="border-t border-slate-100 dark:border-slate-700 my-1"></div>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                            class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition text-left">
                                        <i class="fas fa-sign-out-alt w-4 text-center"></i> Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}"
                           class="w-9 h-9 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-500 dark:text-slate-400 flex items-center justify-center transition hover:bg-slate-200 dark:hover:bg-slate-700"
                           title="Masuk Anggota">
                            <i class="fas fa-user text-sm"></i>
                        </a>
                    @endauth

                    <!-- Mobile: Burger -->
                    <button id="burger-btn"
                            class="lg:hidden w-9 h-9 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 flex items-center justify-center transition active:bg-slate-200 dark:active:bg-slate-700"
                            aria-label="Toggle Menu">
                        <i class="fas fa-bars text-sm"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu"
             class="lg:hidden bg-white dark:bg-slate-900 border-t border-slate-100 dark:border-slate-800">
            <div class="px-6 py-4 flex flex-col space-y-1 text-sm font-medium">
                @foreach($navItems as $item)
                    <a href="{{ $item['url'] }}"
                       class="block px-4 py-2.5 rounded-lg transition-colors {{ request()->is($item['match']) ? 'nav-active' : 'text-slate-600 dark:text-slate-300 active:bg-slate-50 dark:active:bg-slate-800/50' }}">
                        {{ $item['label'] }}
                    </a>
                @endforeach

                <!-- Auth Section (bottom) -->
                <div class="pt-4 mt-2 border-t border-slate-100 dark:border-slate-800">
                    @auth
                        <a href="{{ Auth::user()->isAdmin() ? route('admin.dashboard') : route('dashboard') }}"
                           class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 rounded-lg text-sm font-semibold transition active:bg-slate-200 dark:active:bg-slate-700">
                            <i class="fas fa-th-large"></i> Dasbor
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="mt-2">
                            @csrf
                            <button type="submit"
                                    class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 rounded-lg text-sm font-semibold transition active:bg-slate-200 dark:active:bg-slate-700">
                                <i class="fas fa-sign-out-alt"></i> Keluar
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                           class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 rounded-lg text-sm font-semibold transition active:bg-slate-200 dark:active:bg-slate-700">
                            <i class="fas fa-sign-in-alt"></i> Masuk / Daftar
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- ===================== FOOTER (unchanged) ===================== -->
    <footer class="bg-[#083a64] text-white pt-12 pb-6 text-sm font-sans mt-auto">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8 mb-10">
                <div class="lg:col-span-1">
                    <a href="{{ url('/') }}" class="flex items-center space-x-2 mb-6 hover:opacity-80 transition-opacity">
                        <img src="{{ asset('assets/Logo_Mgmp_PKK_jabar-removebg-preview.png') }}?v={{ time() }}" alt="Logo MGMP PKK" class="h-20 md:h-24 w-auto object-contain origin-left scale-110">
                    </a>
                    <h4 class="font-bold mb-1 flex items-center gap-2"><i class="far fa-clock"></i> Jam Operasional</h4>
                    <p class="text-white/90">Senin &ndash; Jumat | 08.00 &ndash; 16.00 WIB <span class="bg-emerald-500 text-white text-[10px] px-2 py-0.5 rounded-full ml-1 font-bold">Buka</span></p>
                </div>
                <div>
                    <h4 class="font-bold mb-3 flex items-center gap-2"><i class="fas fa-map-marker-alt"></i> Alamat</h4>
                    <p class="text-white/90 leading-relaxed">Gedung Guru Jawa Barat<br>Jl. Gajah Mada No. 20 Purwodadi<br>Jawa Tengah 58111</p>
                </div>
                <div>
                    <h4 class="font-bold mb-3 flex items-center gap-2"><i class="fas fa-envelope"></i> Surel</h4>
                    <a href="mailto:info@mgmppkkjabar.id" class="text-white/90 hover:underline break-all">info@mgmppkkjabar.id</a>
                </div>
                <div>
                    <h4 class="font-bold mb-3 flex items-center gap-2"><i class="fas fa-headset"></i> Bantuan</h4>
                    <p class="text-white/90">Telp (0292) 4264318<br>Faks (0292) 4264881</p>
                </div>
                <div>
                    <h4 class="font-bold mb-3 flex items-center gap-2"><i class="fas fa-globe"></i> Media Sosial</h4>
                    <div class="flex space-x-3 mb-8">
                        <a href="#" class="w-8 h-8 rounded border border-white hover:bg-white dark:bg-slate-900 hover:text-blue-600 transition flex items-center justify-center"><i class="fab fa-facebook-f text-xs"></i></a>
                        <a href="#" class="w-8 h-8 rounded border border-white hover:bg-white dark:bg-slate-900 hover:text-blue-600 transition flex items-center justify-center"><span class="font-bold text-xs" style="font-family:sans-serif;">X</span></a>
                        <a href="#" class="w-8 h-8 rounded border border-white hover:bg-white dark:bg-slate-900 hover:text-blue-600 transition flex items-center justify-center"><i class="fab fa-instagram text-xs"></i></a>
                        <a href="#" class="w-8 h-8 rounded border border-white hover:bg-white dark:bg-slate-900 hover:text-blue-600 transition flex items-center justify-center"><i class="fab fa-youtube text-xs"></i></a>
                    </div>
                </div>
            </div>

            <h4 class="font-bold text-lg mb-6 flex items-center gap-2"><i class="fas fa-sitemap"></i> Sitemap</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12 text-sm text-white/90">
                <div>
                    <h5 class="font-bold mb-4 text-white">Profil & Organisasi</h5>
                    <ul class="space-y-3">
                        <li><a href="{{ route('profil.anggota') }}" class="hover:underline hover:text-white transition-colors">Data Anggota</a></li>
                        <li><a href="#" class="hover:underline hover:text-white transition-colors">Susunan Pengurus</a></li>
                        <li><a href="#" class="hover:underline hover:text-white transition-colors">Visi & Misi</a></li>
                        <li><a href="#" class="hover:underline hover:text-white transition-colors">Sejarah MGMP</a></li>
                        <li><a href="#" class="hover:underline hover:text-white transition-colors">Program Kerja</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="font-bold mb-4 text-white">Layanan Akademik</h5>
                    <ul class="space-y-3">
                        <li><a href="#" class="hover:underline hover:text-white transition-colors">Bank Modul & Soal</a></li>
                        <li><a href="#" class="hover:underline hover:text-white transition-colors">Jurnal Ilmiah Guru</a></li>
                        <li><a href="#" class="hover:underline hover:text-white transition-colors">Sertifikasi & Diklat</a></li>
                        <li><a href="#" class="hover:underline hover:text-white transition-colors">Panduan Kurikulum Merdeka</a></li>
                        <li><a href="#" class="hover:underline hover:text-white transition-colors">Karya Inovatif</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="font-bold mb-4 text-white">Publikasi & Informasi</h5>
                    <ul class="space-y-3">
                        <li><a href="{{ route('berita') }}" class="hover:underline hover:text-white transition-colors">Berita Terkini</a></li>
                        <li><a href="{{ route('agenda') }}" class="hover:underline hover:text-white transition-colors">Agenda Kegiatan</a></li>
                        <li><a href="#" class="hover:underline hover:text-white transition-colors">Galeri Dokumentasi</a></li>
                        <li><a href="#" class="hover:underline hover:text-white transition-colors">Pengumuman</a></li>
                    </ul>
                </div>
                <div>
                    <h5 class="font-bold mb-4 text-white">Tautan Terkait</h5>
                    <ul class="space-y-3">
                        <li><a href="https://kemdikbud.go.id" target="_blank" class="hover:underline hover:text-white transition-colors">Kemendikbudristek RI</a></li>
                        <li><a href="https://disdik.jabarprov.go.id/" target="_blank" class="hover:underline hover:text-white transition-colors">Dinas Pendidikan Provinsi</a></li>
                        <li><a href="#" class="hover:underline hover:text-white transition-colors">PGRI Jawa Barat</a></li>
                        <li><a href="#" class="hover:underline hover:text-white transition-colors">Portal Guru Penggerak</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="border-t border-white/20 pt-5 mt-4">
            <div class="max-w-7xl mx-auto px-6 text-xs text-white font-bold text-center md:text-left">
                Copyright &copy; {{ date('Y') }} MGMP PKK Jawa Barat. All Rights Reserved.
            </div>
        </div>
    </footer>

    <!-- ===================== BACK TO TOP ===================== -->
    <button id="back-to-top" onclick="window.scrollTo({top:0,behavior:'smooth'})"
        class="fixed bottom-28 right-6 z-50 w-12 h-12 bg-mgmp hover:bg-gold hover:text-mgmp-dark text-white rounded-full shadow-xl flex items-center justify-center transition">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- ===================== SCRIPTS ===================== -->
    <script>
        // ---- Mobile Menu ----
        const burgerBtn = document.getElementById('burger-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        burgerBtn?.addEventListener('click', () => {
            mobileMenu.classList.toggle('open');
        });

        // ---- Back to Top ----
        const btt = document.getElementById('back-to-top');
        window.addEventListener('scroll', () => {
            btt?.classList.toggle('visible', window.scrollY > 400);
        }, { passive: true });

        // ---- Header Scroll Shrink ----
        const header = document.getElementById('main-header');
        window.addEventListener('scroll', () => {
            header?.classList.toggle('header-scrolled', window.scrollY > 50);
        }, { passive: true });

        // ---- Dark Mode Toggle ----
        const darkToggles = document.querySelectorAll('.dark-toggle-btn');
        function updateDarkIcon() {
            const isDark = document.documentElement.classList.contains('dark');
            darkToggles.forEach(toggle => {
                const icon = toggle.querySelector('i');
                if (icon) {
                    icon.classList.toggle('fa-moon', !isDark);
                    icon.classList.toggle('fa-sun', isDark);
                }
                toggle.setAttribute('title', isDark ? 'Mode Terang' : 'Mode Gelap');
            });
        }
        updateDarkIcon();
        darkToggles.forEach(toggle => {
            toggle.addEventListener('click', () => {
                if (document.documentElement.classList.contains('dark')) {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('theme', 'light');
                } else {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                }
                updateDarkIcon();
            });
        });

        // ---- User Avatar Dropdown ----
        const userAvatarBtn = document.getElementById('user-avatar-btn');
        const userDropdown = document.getElementById('user-dropdown');
        if (userAvatarBtn && userDropdown) {
            userAvatarBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                userDropdown.classList.toggle('open');
            });
            document.addEventListener('click', (e) => {
                if (!userAvatarBtn.contains(e.target) && !userDropdown.contains(e.target)) {
                    userDropdown.classList.remove('open');
                }
            });
        }
    </script>

    @stack('scripts')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 800, once: true, offset: 100 });
    </script>

</body>
</html>
