<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Header Preview — MGMP PKK</title>
    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        }
        if ('ontouchstart' in window || navigator.maxTouchPoints > 0) {
            document.documentElement.classList.add('touch-device');
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: { mgmp: { DEFAULT: '#1363a6', dark: '#0b5c9c', light: '#5f99cd' }, gold: '#ffb800' }
                }
            }
        }
    </script>
    <style>
        * { font-family: 'Inter', sans-serif; -webkit-tap-highlight-color: transparent; }
        html { scroll-behavior: smooth; }

        /* HEADER */
        #main-header {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-bottom: 1px solid #e2e8f0;
        }
        .dark #main-header { background: rgba(15, 23, 42, 0.92); border-bottom-color: #334155; }
        #main-header.header-scrolled { box-shadow: 0 4px 24px rgba(0, 0, 0, 0.06); }
        .dark #main-header.header-scrolled { box-shadow: 0 4px 24px rgba(0, 0, 0, 0.3); }
        .header-logo { height: 44px; transition: height 0.3s ease, opacity 0.3s ease; }
        .header-scrolled .header-logo { height: 28px; }
        .header-logo-text { transition: all 0.3s ease; }
        .header-scrolled .header-logo-text .logo-sub { opacity: 0; height: 0; overflow: hidden; margin: 0; }
        .header-scrolled .header-logo-text .logo-main { font-size: 12px; }
        .header-scrolled .header-logo-wrap { gap: 8px !important; }

        /* HOVER */
        html:not(.touch-device) .nav-link { transition: background-color 0.15s ease, color 0.15s ease; }
        html:not(.touch-device) .nav-link:hover { background-color: rgba(19, 99, 166, 0.06); color: #1363a6; }
        html:not(.touch-device) .dark .nav-link:hover { background-color: rgba(95, 153, 205, 0.1); color: #5f99cd; }
        html:not(.touch-device) .utility-btn:hover { color: #1363a6; border-color: #1363a6; }
        html:not(.touch-device) .dark .utility-btn:hover { color: #5f99cd; border-color: #5f99cd; }
        .touch-device *:hover { color: revert !important; background-color: revert !important; border-color: revert !important; }

        /* ACTIVE NAV */
        .nav-active { color: #1363a6 !important; background-color: rgba(19, 99, 166, 0.08); font-weight: 600; }
        .dark .nav-active { color: #5f99cd !important; background-color: rgba(95, 153, 205, 0.12); }

        /* MOBILE MENU */
        #mobile-menu { max-height: 0; overflow: hidden; transition: max-height 0.35s cubic-bezier(0.4, 0, 0.2, 1); }
        #mobile-menu.open { max-height: 600px; }

        /* USER DROPDOWN */
        .user-dropdown { opacity: 0; transform: translateY(-8px) scale(0.95); pointer-events: none; transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1); }
        .user-dropdown.open { opacity: 1; transform: translateY(0) scale(1); pointer-events: auto; }

        /* REDUCED MOTION */
        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after { animation-duration: 0.01ms !important; transition-duration: 0.01ms !important; }
            html { scroll-behavior: auto; }
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-800 dark:bg-slate-950 dark:text-slate-100 antialiased">

    <!-- BADGE: ini test preview -->
    <div class="fixed top-0 left-0 right-0 z-[100] bg-amber-500 text-white text-center py-1 text-xs font-bold tracking-wide">
        ⚠️ TEST PREVIEW — Header Redesign v1
    </div>

    <!-- ===================== HEADER (TEST) ===================== -->
    <header id="main-header" class="sticky top-7 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16 md:h-20">

                <!-- Logo + Text -->
                <a href="{{ url('/') }}" class="header-logo-wrap flex items-center gap-3 shrink-0">
                    <img src="{{ asset('assets/Logo_Mgmp_PKK_jabar-removebg-preview.png') }}"
                         alt="Logo MGMP PKK"
                         class="header-logo w-auto object-contain">
                    <div class="header-logo-text leading-tight hidden sm:block">
                        <div class="logo-sub text-[10px] text-slate-400 dark:text-slate-500 font-medium tracking-wider uppercase">
                            Dinas Pendidikan Jawa Barat
                        </div>
                        <div class="logo-main text-[13px] font-bold text-[#0B3D6B] dark:text-white leading-tight">
                            MGMP PKK
                        </div>
                    </div>
                </a>

                <!-- Desktop Nav -->
                <nav class="hidden lg:flex items-center space-x-1 text-[13px] font-medium">
                    <a href="{{ url('/') }}" class="nav-link px-3 py-2 rounded-lg nav-active">Beranda</a>
                    <a href="{{ route('profil.anggota') }}" class="nav-link px-3 py-2 rounded-lg text-slate-600 dark:text-slate-300">Profil</a>
                    <a href="{{ route('program') }}" class="nav-link px-3 py-2 rounded-lg text-slate-600 dark:text-slate-300">Program</a>
                    <a href="{{ route('berita') }}" class="nav-link px-3 py-2 rounded-lg text-slate-600 dark:text-slate-300">Berita</a>
                    <a href="{{ route('galeri') }}" class="nav-link px-3 py-2 rounded-lg text-slate-600 dark:text-slate-300">Galeri</a>
                    <a href="{{ route('kegiatan') }}" class="nav-link px-3 py-2 rounded-lg text-slate-600 dark:text-slate-300">Kegiatan</a>
                    <a href="{{ route('agenda') }}" class="nav-link px-3 py-2 rounded-lg text-slate-600 dark:text-slate-300">Agenda</a>
                </nav>

                <!-- Right: Utility Icons -->
                <div class="flex items-center gap-2">
                    <!-- Search -->
                    <button class="utility-btn w-9 h-9 rounded-lg border border-slate-200 dark:border-slate-700 text-slate-400 dark:text-slate-500 transition flex items-center justify-center" title="Cari">
                        <i class="fas fa-search text-xs"></i>
                    </button>

                    <!-- Dark Mode -->
                    <button class="dark-toggle-btn utility-btn w-9 h-9 rounded-lg border border-slate-200 dark:border-slate-700 text-slate-400 dark:text-slate-500 transition flex items-center justify-center" title="Mode Gelap" id="dark-toggle">
                        <i class="fas fa-moon text-xs"></i>
                    </button>

                    <!-- User: LOGGED IN state (for demo) -->
                    <div class="relative">
                        <button id="user-avatar-btn" class="w-9 h-9 rounded-full bg-[#0B3D6B] text-white flex items-center justify-center text-xs font-bold shadow-sm transition hover:ring-2 hover:ring-[#0B3D6B]/20 focus:outline-none">
                            A
                        </button>
                        <div id="user-dropdown" class="user-dropdown absolute right-0 mt-2 w-52 bg-white dark:bg-slate-800 rounded-xl shadow-lg border border-slate-100 dark:border-slate-700 py-2 z-50">
                            <div class="px-4 py-2 border-b border-slate-100 dark:border-slate-700">
                                <div class="text-sm font-semibold text-slate-800 dark:text-slate-100">Admin Demo</div>
                                <div class="text-xs text-slate-400 dark:text-slate-500">admin@mgmppkkjabar.id</div>
                            </div>
                            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700/50 transition">
                                <i class="fas fa-th-large w-4 text-center text-slate-400"></i> Dasbor
                            </a>
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700/50 transition">
                                <i class="fas fa-user-pen w-4 text-center text-slate-400"></i> Edit Profil
                            </a>
                            <div class="border-t border-slate-100 dark:border-slate-700 my-1"></div>
                            <a href="{{ route('login') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20 transition">
                                <i class="fas fa-sign-out-alt w-4 text-center"></i> Keluar
                            </a>
                        </div>
                    </div>

                    <!-- Burger (mobile) -->
                    <button id="burger-btn" class="lg:hidden w-9 h-9 rounded-lg bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 flex items-center justify-center transition active:bg-slate-200 dark:active:bg-slate-700" aria-label="Toggle Menu">
                        <i class="fas fa-bars text-sm"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="lg:hidden bg-white dark:bg-slate-900 border-t border-slate-100 dark:border-slate-800">
            <div class="px-6 py-4 flex flex-col space-y-1 text-sm font-medium">
                <a href="{{ url('/') }}" class="block px-4 py-2.5 rounded-lg nav-active">Beranda</a>
                <a href="{{ route('profil.anggota') }}" class="block px-4 py-2.5 rounded-lg text-slate-600 dark:text-slate-300 active:bg-slate-50 dark:active:bg-slate-800/50">Profil</a>
                <a href="{{ route('program') }}" class="block px-4 py-2.5 rounded-lg text-slate-600 dark:text-slate-300 active:bg-slate-50 dark:active:bg-slate-800/50">Program</a>
                <a href="{{ route('berita') }}" class="block px-4 py-2.5 rounded-lg text-slate-600 dark:text-slate-300 active:bg-slate-50 dark:active:bg-slate-800/50">Berita</a>
                <a href="{{ route('galeri') }}" class="block px-4 py-2.5 rounded-lg text-slate-600 dark:text-slate-300 active:bg-slate-50 dark:active:bg-slate-800/50">Galeri</a>
                <a href="{{ route('kegiatan') }}" class="block px-4 py-2.5 rounded-lg text-slate-600 dark:text-slate-300 active:bg-slate-50 dark:active:bg-slate-800/50">Kegiatan</a>
                <a href="{{ route('agenda') }}" class="block px-4 py-2.5 rounded-lg text-slate-600 dark:text-slate-300 active:bg-slate-50 dark:active:bg-slate-800/50">Agenda</a>

                <div class="pt-4 mt-2 border-t border-slate-100 dark:border-slate-800">
                    <a href="{{ route('admin.dashboard') }}" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 rounded-lg text-sm font-semibold transition active:bg-slate-200 dark:active:bg-slate-700">
                        <i class="fas fa-th-large"></i> Dasbor
                    </a>
                    <a href="{{ route('login') }}" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 rounded-lg text-sm font-semibold transition active:bg-slate-200 dark:active:bg-slate-700 mt-2">
                        <i class="fas fa-sign-out-alt"></i> Keluar
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- ===================== DEMO CONTENT ===================== -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="text-center mb-16">
            <h1 class="text-3xl md:text-4xl font-bold text-slate-800 dark:text-white mb-4">
                Header Preview
            </h1>
            <p class="text-slate-500 dark:text-slate-400 max-w-lg mx-auto">
                Scroll ke bawah untuk melihat efek shrink. Klik avatar untuk dropdown menu. Coba mode gelap.
            </p>
        </div>

        <!-- Feature cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-16">
            <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 p-6">
                <div class="w-10 h-10 rounded-lg bg-blue-50 dark:bg-blue-900/30 flex items-center justify-center mb-4">
                    <i class="fas fa-user-shield text-blue-500"></i>
                </div>
                <h3 class="font-bold text-slate-800 dark:text-white mb-2">Quiet Security</h3>
                <p class="text-sm text-slate-500 dark:text-slate-400">Login hanya icon 👤 — tidak mengundang spam registrasi. Nama user tidak tampil di header.</p>
            </div>
            <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 p-6">
                <div class="w-10 h-10 rounded-lg bg-purple-50 dark:bg-purple-900/30 flex items-center justify-center mb-4">
                    <i class="fas fa-arrows-alt-v text-purple-500"></i>
                </div>
                <h3 class="font-bold text-slate-800 dark:text-white mb-2">Scroll Shrink</h3>
                <p class="text-sm text-slate-500 dark:text-slate-400">Header mengecil + shadow + backdrop-blur saat scroll &gt; 50px.</p>
            </div>
            <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 p-6">
                <div class="w-10 h-10 rounded-lg bg-emerald-50 dark:bg-emerald-900/30 flex items-center justify-center mb-4">
                    <i class="fas fa-palette text-emerald-500"></i>
                </div>
                <h3 class="font-bold text-slate-800 dark:text-white mb-2">Avatar + Inisial</h3>
                <p class="text-sm text-slate-500 dark:text-slate-400">Jika tidak ada foto profil, tampilkan inisial nama. Dropdown: Dasbor, Edit Profil, Keluar.</p>
            </div>
        </div>

        <!-- Scroll content -->
        <div class="space-y-6">
            @for($i = 1; $i <= 8; $i++)
                <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 p-6">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-slate-400">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-slate-800 dark:text-white">Konten Demo {{ $i }}</h3>
                            <p class="text-sm text-slate-500 dark:text-slate-400">Scroll ke bawah untuk melihat header shrink effect.</p>
                        </div>
                    </div>
                </div>
            @endfor
        </div>

        <!-- Color Reference -->
        <div class="mt-12 bg-white dark:bg-slate-800 rounded-xl border border-slate-200 dark:border-slate-700 p-6">
            <h3 class="font-bold text-slate-800 dark:text-white mb-4">Color Reference</h3>
            <div class="flex flex-wrap gap-3">
                <div class="w-16 h-16 rounded-lg bg-[#0B3D6B] flex items-center justify-center text-white text-[10px] font-mono">#0B3D6B</div>
                <div class="w-16 h-16 rounded-lg bg-[#1363a6] flex items-center justify-center text-white text-[10px] font-mono">#1363a6</div>
                <div class="w-16 h-16 rounded-lg bg-[#C8A415] flex items-center justify-center text-white text-[10px] font-mono">#C8A415</div>
                <div class="w-16 h-16 rounded-lg bg-[#F8FAFC] border flex items-center justify-center text-slate-600 text-[10px] font-mono">#F8FAFC</div>
                <div class="w-16 h-16 rounded-lg bg-[#475569] flex items-center justify-center text-white text-[10px] font-mono">#475569</div>
                <div class="w-16 h-16 rounded-lg bg-[#0F172A] flex items-center justify-center text-white text-[10px] font-mono">#0F172A</div>
            </div>
        </div>
    </main>

    <!-- Scripts -->
    <script>
        // Mobile Menu
        const burgerBtn = document.getElementById('burger-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        burgerBtn?.addEventListener('click', () => { mobileMenu.classList.toggle('open'); });

        // Header Scroll
        const header = document.getElementById('main-header');
        window.addEventListener('scroll', () => {
            header?.classList.toggle('header-scrolled', window.scrollY > 50);
        }, { passive: true });

        // Dark Mode
        const darkToggle = document.getElementById('dark-toggle');
        darkToggle?.addEventListener('click', () => {
            const icon = darkToggle.querySelector('i');
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('theme', 'light');
                icon?.classList.replace('fa-sun', 'fa-moon');
                darkToggle.title = 'Mode Gelap';
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('theme', 'dark');
                icon?.classList.replace('fa-moon', 'fa-sun');
                darkToggle.title = 'Mode Terang';
            }
        });

        // User Dropdown
        const userAvatarBtn = document.getElementById('user-avatar-btn');
        const userDropdown = document.getElementById('user-dropdown');
        userAvatarBtn?.addEventListener('click', (e) => {
            e.stopPropagation();
            userDropdown?.classList.toggle('open');
        });
        document.addEventListener('click', (e) => {
            if (!userAvatarBtn?.contains(e.target) && !userDropdown?.contains(e.target)) {
                userDropdown?.classList.remove('open');
            }
        });
    </script>

</body>
</html>
