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

    </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <meta name="description"
        content="Website Resmi MGMP KIK SMP Jawa Barat - Wadah komunikasi, inovasi, dan kolaborasi guru PKK.">
    <title>@yield('title', 'MGMP KIK Jawa Barat')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Tailwind CDN (fallback) -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
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
    @endif

    <style>
        * {
            font-family: 'Inter', sans-serif;
            -webkit-tap-highlight-color: transparent;
        }

        html {
            scroll-behavior: smooth;
        }



        /* Custom Scrollbar */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        .dark .custom-scrollbar::-webkit-scrollbar-track {
            background: #1e293b;
        }

        .dark .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #475569;
        }

        @media (hover: hover) {
            .custom-scrollbar::-webkit-scrollbar-thumb:hover {
                background: #94a3b8;
            }

            .dark .custom-scrollbar::-webkit-scrollbar-thumb:hover {
                background: #64748b;
            }
        }

        /* Slanted top bar */
        .top-bar-clip {
            clip-path: polygon(40px 0%, 100% 0%, 100% 100%, 0% 100%);
        }

        /* Mobile menu */
        #mobile-menu {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s ease;
        }

        #mobile-menu.open {
            max-height: 600px;
        }

        /* Back to top */
        #back-to-top {
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s;
        }

        #back-to-top.visible {
            opacity: 1;
            pointer-events: all;
        }

        /* Card hover lift */
        .lift {
            transition: transform 0.3s, box-shadow 0.3s;
        }

        @media (hover: hover) {
            .lift:hover {
                transform: translateY(-6px);
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
            }
        }

        /* Scrollbar thin */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-thumb {
            background: #1363a6;
            border-radius: 3px;
        }

        /* Decorative Backgrounds & Blobs */
        .bg-pattern-dots {
            background-image: radial-gradient(rgba(19, 99, 166, 0.08) 1.5px, transparent 1.5px);
            background-size: 24px 24px;
        }

        .bg-pattern-grid {
            background-size: 40px 40px;
            background-image:
                linear-gradient(to right, rgba(19, 99, 166, 0.04) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(19, 99, 166, 0.04) 1px, transparent 1px);
        }

        .blob-shape {
            position: absolute;
            filter: blur(90px);
            z-index: 0;
            opacity: 0.35;
            border-radius: 50%;
            pointer-events: none;
        }

        /* Disable tap highlight on mobile devices */
        * {
            -webkit-tap-highlight-color: transparent;
        }
    </style>
    @stack('styles')
</head>

<body class="bg-slate-50 text-slate-800 dark:bg-slate-950 dark:text-slate-100 antialiased overflow-x-hidden">

    <!-- ===================== HEADER ===================== -->
    <header
        class="sticky top-0 z-50 bg-white dark:bg-slate-900 border-b border-slate-100 dark:border-slate-800 shadow-md"
        id="main-header">
        <!-- Top Blue Bar (Slanted, MGMP style) -->
        <div class="hidden lg:block relative h-9">
            <!-- Background Slanted Shape -->
            <div class="top-bar-clip absolute top-0 right-0 w-[85%] xl:w-[75%] h-full bg-mgmp dark:bg-mgmp-dark"></div>

            <!-- Content Wrapper (Aligned with main container) -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex justify-end relative z-10">
                <div class="flex items-center h-full gap-6 pr-4">
                    <!-- Info (Alamat, Telp, Email) -->
                    <div
                        class="flex items-center gap-4 text-white text-[11px] font-medium border-r border-white/20 pr-6">
                        <span class="flex items-center gap-1.5"><i class="fas fa-map-marker-alt text-gold"></i> SMKN 4
                            BANDUNG, JALAN KLININGAN NO. 6 BUAHBATU BANDUNG</span>
                        <span class="flex items-center gap-1.5"><i class="fas fa-phone-alt text-gold"></i>
                            085320886607</span>
                        <span class="flex items-center gap-1.5"><i class="fas fa-envelope text-gold"></i>
                            Erinaarisha@gmail.com</span>
                    </div>

                    <!-- Media Sosial -->
                    <div class="flex items-center gap-4 text-white text-[11px]">
                        <a href="#" title="WhatsApp" class="hover:text-gold transition"><i
                                class="fab fa-whatsapp"></i></a>
                        <a href="#" title="Facebook" class="hover:text-gold transition"><i
                                class="fab fa-facebook-f"></i></a>
                        <a href="#" title="X (Twitter)" class="hover:text-gold transition font-bold"
                            style="font-family:sans-serif;">X</a>
                        <a href="#" title="Instagram" class="hover:text-gold transition"><i
                                class="fab fa-instagram"></i></a>
                        <a href="#" title="YouTube" class="hover:text-gold transition"><i
                                class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
        </div> <!-- Main Nav -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-2 h-[4.5rem] md:h-20 relative">

                <!-- Left Side: Mobile Burger + Logo -->
                <div class="flex items-center gap-3 md:gap-4 flex-shrink-0 z-20">
                    <!-- Mobile Burger -->
                    <button
                        class="lg:hidden w-10 h-10 rounded-full bg-slate-100 dark:bg-slate-800 text-mgmp dark:text-mgmp-light transition flex items-center justify-center shrink-0"
                        id="burger-btn" aria-label="Toggle Menu">
                        <i class="fas fa-bars text-lg"></i>
                    </button>

                    <!-- Logo with Text -->
                    <a href="{{ route('home') }}" class="flex items-center shrink-0 gap-3 group">
                        <img src="{{ asset('assets/Logo_Mgmp_PKK_jabar-removebg-preview.png') }}?v={{ time() }}"
                            alt="Logo MGMP KIK"
                            class="h-10 md:h-12 lg:h-14 w-auto object-contain block dark:hidden transition-transform group-hover:scale-105">
                        <img src="{{ asset('assets/Logo_Mgmp_PKK_jabar-removebg-preview.png') }}?v={{ time() }}"
                            alt="Logo MGMP KIK"
                            class="h-10 md:h-12 lg:h-14 w-auto object-contain hidden dark:block transition-transform group-hover:scale-105">
                        <div class="flex flex-col justify-center">
                            <span
                                class="text-base sm:text-lg md:text-xl font-bold leading-none text-slate-800 dark:text-white tracking-tight">MGMP
                                KIK</span>
                            <span
                                class="text-[8px] sm:text-[10px] md:text-xs font-medium text-slate-500 dark:text-slate-400 mt-1 uppercase tracking-wider">Provinsi
                                Jawa Barat</span>
                        </div>
                    </a>
                </div>

                <!-- Center: Desktop Nav -->
                <div class="hidden lg:flex absolute inset-0 justify-center items-center pointer-events-none z-10">
                    <nav class="flex items-center space-x-6 text-sm font-medium pointer-events-auto" id="desktop-nav">
                        <a href="{{ route('home') }}"
                            class="{{ request()->routeIs('home') ? 'text-mgmp dark:text-mgmp-light font-bold border-b-2 border-mgmp dark:border-mgmp-light pb-1' : 'text-slate-600 dark:text-slate-300 hover:text-mgmp dark:hover:text-mgmp-light transition' }}">Beranda</a>
                        <a href="{{ route('profile.anggota') }}"
                            class="{{ request()->is('profile*') ? 'text-mgmp dark:text-mgmp-light font-bold border-b-2 border-mgmp dark:border-mgmp-light pb-1' : 'text-slate-600 dark:text-slate-300 hover:text-mgmp dark:hover:text-mgmp-light transition' }}">Profil</a>
                        <a href="{{ route('anggota') }}"
                            class="{{ request()->is('anggota') ? 'text-mgmp dark:text-mgmp-light font-bold border-b-2 border-mgmp dark:border-mgmp-light pb-1' : 'text-slate-600 dark:text-slate-300 hover:text-mgmp dark:hover:text-mgmp-light transition' }}">Anggota</a>
                        <a href="{{ route('program') }}"
                            class="{{ request()->is('program') ? 'text-mgmp dark:text-mgmp-light font-bold border-b-2 border-mgmp dark:border-mgmp-light pb-1' : 'text-slate-600 dark:text-slate-300 hover:text-mgmp dark:hover:text-mgmp-light transition' }}">Program</a>
                        <a href="{{ route('berita') }}"
                            class="{{ request()->is('berita') ? 'text-mgmp dark:text-mgmp-light font-bold border-b-2 border-mgmp dark:border-mgmp-light pb-1' : 'text-slate-600 dark:text-slate-300 hover:text-mgmp dark:hover:text-mgmp-light transition' }}">Berita</a>
                        <a href="{{ route('galeri') }}"
                            class="{{ request()->is('galeri') ? 'text-mgmp dark:text-mgmp-light font-bold border-b-2 border-mgmp dark:border-mgmp-light pb-1' : 'text-slate-600 dark:text-slate-300 hover:text-mgmp dark:hover:text-mgmp-light transition' }}">Produk KIK</a>
                    </nav>
                </div>

                <!-- Right Side: Mobile Icons + Desktop Auth -->
                <div class="flex items-center gap-2 z-20">
                    <!-- Mobile Only Icons -->
                    <div class="flex lg:hidden items-center gap-2">
                        <button
                            class="search-btn w-9 h-9 rounded-full bg-slate-100 dark:bg-slate-800 text-mgmp dark:text-mgmp-light transition flex items-center justify-center shrink-0"
                            title="Cari">
                            <i class="fas fa-search text-sm"></i>
                        </button>
                        <button
                            class="dark-toggle-btn w-9 h-9 rounded-full bg-slate-100 dark:bg-slate-800 text-mgmp dark:text-mgmp-light transition flex items-center justify-center shrink-0"
                            title="Mode Gelap">
                            <i class="fas fa-moon text-sm"></i>
                        </button>
                        @auth
                            <!-- Profile Dropdown -->
                            <div class="relative inline-block text-left" id="mobile-profile-dropdown">
                                <button id="mobile-profile-btn"
                                    class="w-9 h-9 rounded-full bg-[#083a64] text-white flex items-center justify-center shrink-0 shadow-sm focus:outline-none overflow-hidden"
                                    title="Menu Profil">
                                    @if(Auth::user()->avatar)
                                        <img src="{{ Auth::user()->avatar_url }}" alt="Avatar"
                                            class="w-full h-full object-cover">
                                    @else
                                        <i class="fas fa-user text-sm pointer-events-none"></i>
                                    @endif
                                </button>
                                <!-- Dropdown Menu -->
                                <div id="mobile-profile-menu"
                                    class="hidden absolute right-0 mt-2 w-48 bg-white dark:bg-slate-800 rounded-xl shadow-lg py-2 border border-slate-100 dark:border-slate-700 z-50 origin-top-right transition-all">
                                    @if(Auth::user()->isAdmin())
                                        <a href="{{ route('admin.dashboard') }}"
                                            class="flex items-center gap-3 px-4 py-2.5 text-sm font-semibold text-slate-700 dark:text-slate-300 dark: transition">
                                            <i class="fas fa-th-large w-4 text-center"></i> Dasbor Admin
                                        </a>
                                    @else
                                        <a href="{{ route('dashboard') }}"
                                            class="flex items-center gap-3 px-4 py-2.5 text-sm font-semibold text-slate-700 dark:text-slate-300 dark: transition">
                                            <i class="fas fa-th-large w-4 text-center"></i> Dasbor
                                        </a>
                                    @endif
                                    <div class="h-px bg-slate-100 dark:bg-slate-700 my-1"></div>
                                    <form action="{{ route('logout') }}" method="POST" class="m-0 p-0">
                                        @csrf
                                        <button type="submit"
                                            class="w-full flex items-center gap-3 px-4 py-2.5 text-sm font-semibold text-red-600 dark: transition text-left">
                                            <i class="fas fa-sign-out-alt w-4 text-center"></i> Keluar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endauth
                    </div>

                    <!-- Desktop Icons / Auth -->
                    <div class="hidden lg:flex items-center space-x-2">
                        @auth
                            <!-- Desktop Profile Dropdown -->
                            <div class="relative inline-block text-left" id="desktop-profile-dropdown">
                                <button id="desktop-profile-btn"
                                    class="flex items-center gap-2 pl-1.5 pr-3 py-1.5 rounded-full bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 transition-all focus:outline-none mr-2 border border-slate-200 dark:border-slate-700">
                                    <div
                                        class="w-6 h-6 rounded-full overflow-hidden bg-[#083a64] text-white flex items-center justify-center shrink-0">
                                        @if(Auth::user()->avatar)
                                            <img src="{{ Auth::user()->avatar_url }}"
                                                alt="{{ Auth::user()->name }}"
                                                class="w-full h-full object-cover pointer-events-none">
                                        @else
                                            <i class="fas fa-user text-[10px] pointer-events-none"></i>
                                        @endif
                                    </div>
                                    <span
                                        class="text-xs font-bold text-slate-700 dark:text-slate-300 pointer-events-none">{{ explode(' ', Auth::user()->name)[0] }}</span>
                                    <i class="fas fa-chevron-down text-[10px] text-slate-400 pointer-events-none"></i>
                                </button>

                                <div id="desktop-profile-menu"
                                    class="hidden absolute right-2 mt-2 w-48 bg-white dark:bg-slate-800 rounded-xl shadow-lg py-2 border border-slate-100 dark:border-slate-700 z-50 origin-top-right transition-all">
                                    @if(Auth::user()->isAdmin())
                                        <a href="{{ route('admin.dashboard') }}"
                                            class="flex items-center gap-3 px-4 py-2.5 text-sm font-semibold text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700/50 transition">
                                            <i class="fas fa-th-large w-4 text-center"></i> Dasbor Admin
                                        </a>
                                    @else
                                        <a href="{{ route('dashboard') }}"
                                            class="flex items-center gap-3 px-4 py-2.5 text-sm font-semibold text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700/50 transition">
                                            <i class="fas fa-th-large w-4 text-center"></i> Dasbor
                                        </a>
                                    @endif
                                    <div class="h-px bg-slate-100 dark:bg-slate-700 my-1"></div>
                                    <form action="{{ route('logout') }}" method="POST" class="m-0 p-0">
                                        @csrf
                                        <button type="submit"
                                            class="w-full flex items-center gap-3 px-4 py-2.5 text-sm font-semibold text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 transition text-left">
                                            <i class="fas fa-sign-out-alt w-4 text-center"></i> Keluar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('login') }}"
                                class="mr-2 px-4 py-1.5 border-2 border-mgmp text-mgmp dark:text-mgmp-light dark:border-mgmp-light hover:bg-mgmp hover:text-white dark:hover:bg-mgmp-light dark:hover:text-slate-900 rounded-lg text-xs font-bold shadow-sm transition-all flex items-center gap-2">
                                <i class="fas fa-sign-in-alt"></i> Masuk
                            </a>
                            <a href="{{ route('register') }}"
                                class="mr-2 px-4 py-1.5 bg-mgmp hover:bg-[#0f4f85] text-white rounded-lg text-xs font-bold shadow hover:shadow-md transition-all flex items-center gap-2">
                                <i class="fas fa-user-plus"></i> Daftar
                            </a>
                        @endauth

                        <div class="flex items-center border-l border-slate-200 dark:border-slate-800 pl-2 gap-2">
                            <button
                                class="search-btn w-8 h-8 rounded border border-slate-200 dark:border-slate-700 text-slate-400 dark:text-slate-500 hover:text-mgmp dark:hover:text-mgmp-light hover:border-mgmp dark:hover:border-mgmp-light transition flex items-center justify-center"
                                title="Cari">
                                <i class="fas fa-search text-xs"></i>
                            </button>
                            <button
                                class="dark-toggle-btn w-8 h-8 rounded border border-slate-200 dark:border-slate-700 text-slate-400 dark:text-slate-500 hover:text-mgmp dark:hover:text-mgmp-light hover:border-mgmp dark:hover:border-mgmp-light transition flex items-center justify-center"
                                title="Mode Gelap" id="dark-toggle">
                                <i class="fas fa-moon text-xs"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu"
            class="lg:hidden bg-white dark:bg-slate-900 border-t border-slate-100 dark:border-slate-800 text-center">
            <div class="px-6 py-6 flex flex-col items-center space-y-1 text-sm font-medium">
                <a href="{{ route('home') }}"
                    class="w-full max-w-[250px] block {{ request()->routeIs('home') ? 'text-mgmp dark:text-mgmp-light font-bold' : 'text-slate-600 dark:text-slate-300 dark:' }} py-3 rounded-xl transition-colors">Beranda</a>
                <a href="{{ route('profile.anggota') }}"
                    class="w-full max-w-[250px] block {{ request()->is('profile*') ? 'text-mgmp dark:text-mgmp-light font-bold' : 'text-slate-600 dark:text-slate-300 dark:' }} py-3 rounded-xl transition-colors">Profil</a>
                <a href="{{ route('anggota') }}"
                    class="w-full max-w-[250px] block {{ request()->is('anggota') ? 'text-mgmp dark:text-mgmp-light font-bold' : 'text-slate-600 dark:text-slate-300 dark:' }} py-3 rounded-xl transition-colors">Anggota</a>
                <a href="{{ route('program') }}"
                    class="w-full max-w-[250px] block {{ request()->is('program') ? 'text-mgmp dark:text-mgmp-light font-bold' : 'text-slate-600 dark:text-slate-300 dark:' }} py-3 rounded-xl transition-colors">Program</a>
                <a href="{{ route('berita') }}"
                    class="w-full max-w-[250px] block {{ request()->is('berita') ? 'text-mgmp dark:text-mgmp-light font-bold' : 'text-slate-600 dark:text-slate-300 dark:' }} py-3 rounded-xl transition-colors">Berita</a>
                <a href="{{ route('galeri') }}"
                    class="w-full max-w-[250px] block {{ request()->is('galeri') ? 'text-mgmp dark:text-mgmp-light font-bold' : 'text-slate-600 dark:text-slate-300 dark:' }} py-3 rounded-xl transition-colors">Produk KIK</a>

                <div class="w-full pt-6 mt-2 border-t border-slate-100 dark:border-slate-800">
                    @auth
                        @if(Auth::user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}"
                                class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-mgmp text-white rounded-lg text-sm font-bold shadow transition-all">
                                <i class="fas fa-th-large"></i> Dasbor Admin
                            </a>
                        @else
                            <a href="{{ route('dashboard') }}"
                                class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-mgmp text-white rounded-lg text-sm font-bold shadow transition-all">
                                <i class="fas fa-th-large"></i> Dasbor
                            </a>
                        @endif
                        <form action="{{ route('logout') }}" method="POST" class="mt-2">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 dark: rounded-lg text-sm font-bold transition-all">
                                <i class="fas fa-sign-out-alt"></i> Keluar
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                            class="w-full mb-2 flex items-center justify-center gap-2 px-4 py-2 border-2 border-mgmp text-mgmp dark:text-mgmp-light dark:border-mgmp-light rounded-lg text-sm font-bold shadow transition-all">
                            <i class="fas fa-sign-in-alt"></i> Masuk
                        </a>
                        <a href="{{ route('register') }}"
                            class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-mgmp text-white rounded-lg text-sm font-bold shadow transition-all">
                            <i class="fas fa-user-plus"></i> Daftar
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- ===================== FOOTER ===================== -->
    <footer class="bg-[#083a64] text-white pt-12 pb-6 text-sm font-sans mt-auto">
        <div class="max-w-7xl mx-auto px-6">

            <!-- Top Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8 mb-10">
                <!-- Brand & Ops -->
                <div class="lg:col-span-1">
                    <a href="{{ route('home') }}"
                        class="flex items-center space-x-2 mb-6 hover:opacity-80 transition-opacity">
                        <img src="{{ asset('assets/Logo_Mgmp_PKK_jabar-removebg-preview.png') }}?v={{ time() }}"
                            alt="Logo MGMP KIK" class="h-20 md:h-24 w-auto object-contain origin-left scale-110">
                    </a>
                    <h4 class="font-bold mb-1 flex items-center gap-2"><i class="far fa-clock"></i> Jam Operasional</h4>
                    <p class="text-white/90">Senin &ndash; Jumat | 08.00 &ndash; 14.00 WIB <span
                            class="bg-emerald-500 text-white text-[10px] px-2 py-0.5 rounded-full ml-1 font-bold">Buka</span>
                    </p>
                </div>

                <!-- Alamat -->
                <div>
                    <h4 class="font-bold mb-3 flex items-center gap-2"><i class="fas fa-map-marker-alt"></i> Alamat</h4>
                    <p class="text-white/90 leading-relaxed">
                        SMKN 4 BANDUNG<br>
                        JALAN KLININGAN NO. 6 BUAHBATU BANDUNG
                    </p>
                </div>

                <!-- Surel -->
                <div>
                    <h4 class="font-bold mb-3 flex items-center gap-2"><i class="fas fa-envelope"></i> Email</h4>
                    <a href="mailto:Erinaarisha@gmail.com"
                        class="text-white/90 hover:underline break-all">Erinaarisha@gmail.com</a>
                </div>

                <!-- Bantuan -->
                <div>
                    <h4 class="font-bold mb-3 flex items-center gap-2"><i class="fas fa-headset"></i> Bantuan</h4>
                    <p class="text-white/90">085320886607</p>
                </div>

                <!-- Media Sosial -->
                <div>
                    <h4 class="font-bold mb-3 flex items-center gap-2"><i class="fas fa-globe"></i> Media Sosial</h4>
                    <div class="flex space-x-3 mb-8">
                        <a href="#"
                            class="w-8 h-8 rounded border border-white hover:bg-white dark:bg-slate-900 hover:text-blue-600 transition flex items-center justify-center"><i
                                class="fab fa-whatsapp text-xs"></i></a>
                        <a href="#"
                            class="w-8 h-8 rounded border border-white hover:bg-white dark:bg-slate-900 hover:text-blue-600 transition flex items-center justify-center"><i
                                class="fab fa-facebook-f text-xs"></i></a>
                        <a href="#"
                            class="w-8 h-8 rounded border border-white hover:bg-white dark:bg-slate-900 hover:text-blue-600 transition flex items-center justify-center"><span
                                class="font-bold text-xs" style="font-family:sans-serif;">X</span></a>
                        <a href="#"
                            class="w-8 h-8 rounded border border-white hover:bg-white dark:bg-slate-900 hover:text-blue-600 transition flex items-center justify-center"><i
                                class="fab fa-instagram text-xs"></i></a>
                        <a href="#"
                            class="w-8 h-8 rounded border border-white hover:bg-white dark:bg-slate-900 hover:text-blue-600 transition flex items-center justify-center"><i
                                class="fab fa-youtube text-xs"></i></a>
                    </div>
                </div>
            </div>

            <!-- Sitemap Section -->
            <h4 class="font-bold text-lg mb-6 flex items-center gap-2"><i class="fas fa-sitemap"></i> Sitemap</h4>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12 text-sm text-white/90">
                <!-- Profil -->
                <div>
                    <h5 class="font-bold mb-4 text-white">Profil & Organisasi</h5>
                    <ul class="space-y-3">
                        <li><a href="{{ route('profile.anggota') }}"
                                class="hover:underline hover:text-white transition-colors">Data Anggota</a></li>
                        <li><a href="#" class="hover:underline hover:text-white transition-colors">Susunan Pengurus</a>
                        </li>
                        <li><a href="#" class="hover:underline hover:text-white transition-colors">Visi & Misi</a></li>
                        <li><a href="#" class="hover:underline hover:text-white transition-colors">Sejarah MGMP</a></li>
                        <li><a href="#" class="hover:underline hover:text-white transition-colors">Program Kerja</a>
                        </li>
                    </ul>
                </div>

                <!-- Layanan -->
                <div>
                    <h5 class="font-bold mb-4 text-white">Layanan Akademik</h5>
                    <ul class="space-y-3">
                        <li><a href="#" class="hover:underline hover:text-white transition-colors">Bank Modul & Soal</a>
                        </li>
                        <li><a href="#" class="hover:underline hover:text-white transition-colors">Jurnal Ilmiah
                                Guru</a></li>
                        <li><a href="#" class="hover:underline hover:text-white transition-colors">Sertifikasi &
                                Diklat</a></li>
                        <li><a href="#" class="hover:underline hover:text-white transition-colors">Panduan Kurikulum
                                Merdeka</a></li>
                        <li><a href="#" class="hover:underline hover:text-white transition-colors">Karya Inovatif</a>
                        </li>
                    </ul>
                </div>

                <!-- Publikasi -->
                <div>
                    <h5 class="font-bold mb-4 text-white">Publikasi & Informasi</h5>
                    <ul class="space-y-3">
                        <li><a href="{{ route('berita') }}"
                                class="hover:underline hover:text-white transition-colors">Berita Terkini</a></li>
                        <li><a href="{{ route('agenda') }}"
                                class="hover:underline hover:text-white transition-colors">Agenda Kegiatan</a></li>
                        <li><a href="#" class="hover:underline hover:text-white transition-colors">Produk KIK
                                Dokumentasi</a></li>
                        <li><a href="#" class="hover:underline hover:text-white transition-colors">Pengumuman</a></li>
                    </ul>
                </div>

                <!-- Eksternal -->
                <div>
                    <h5 class="font-bold mb-4 text-white">Tautan Terkait</h5>
                    <ul class="space-y-3">
                        <li><a href="#" class="hover:underline hover:text-white transition-colors">Kemendikbudristek
                                RI</a></li>
                        <li><a href="#" class="hover:underline hover:text-white transition-colors">Dinas Pendidikan
                                Provinsi</a></li>
                        <li><a href="#" class="hover:underline hover:text-white transition-colors">PGRI Jawa Barat</a>
                        </li>
                        <li><a href="#" class="hover:underline hover:text-white transition-colors">Portal Guru
                                Penggerak</a></li>
                    </ul>
                </div>
            </div>

        </div>

        <!-- Copyright -->
        <div class="border-t border-white/20 pt-5 mt-4">
            <div class="max-w-7xl mx-auto px-6 text-xs text-white font-bold text-center md:text-left">
                Copyright &copy; 2026 Krissagi 67 Team.All Rights Reserved
            </div>
        </div>
    </footer>

    <!-- ===================== BACK TO TOP ===================== -->
    <button id="back-to-top" onclick="window.scrollTo({top:0,behavior:'smooth'})"
        class="fixed bottom-28 right-6 z-50 w-12 h-12 bg-mgmp hover:bg-gold hover:text-mgmp-dark text-white rounded-full shadow-xl flex items-center justify-center transition">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- ===================== FLOATING CS WIDGET (LEFT) ===================== -->
    <div class="fixed bottom-6 left-6 z-[60] flex items-end justify-start">

        <!-- CS Popup Panel -->
        <div id="cs-popup-panel"
            class="absolute bottom-[80px] left-0 w-[calc(100vw-3rem)] sm:w-[360px] max-h-[calc(100vh-100px)] bg-slate-50 dark:bg-slate-800/90 backdrop-blur-md rounded-2xl shadow-2xl border border-slate-200 dark:border-slate-700 p-4 flex-col origin-bottom-left transition-all duration-300 opacity-0 scale-95 pointer-events-none z-[70] flex">

            <!-- ================= HOME VIEW ================= -->
            <div id="cs-home-view" class="flex flex-col gap-3 w-full">
                <!-- Top Box -->
                <div
                    class="flex flex-col gap-3 w-full shadow-sm rounded-xl bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 px-5 py-4 relative">
                    <button onclick="toggleCSWidget()"
                        class="absolute top-3 right-3 text-slate-300 hover:text-slate-500 dark:text-slate-400 transition-colors w-6 h-6 flex items-center justify-center rounded-full hover:bg-slate-50 dark:bg-slate-800">
                        <i class="fas fa-times text-sm"></i>
                    </button>
                    <div class="flex items-center justify-between gap-2 pr-4">
                        <div class="flex flex-col">
                            <div class="font-bold text-slate-800 dark:text-slate-100 text-[15px]">Kami sedang online
                            </div>
                            <div class="text-slate-500 dark:text-slate-400 text-xs mt-0.5">Biasanya membalas dalam
                                beberapa menit</div>
                        </div>
                        <div class="flex shrink-0">
                            <div
                                class="w-10 h-10 rounded-full border border-slate-200 dark:border-slate-700 shadow-sm overflow-hidden bg-white dark:bg-slate-900 flex items-center justify-center p-0.5">
                                <img src="{{ asset('assets/maskot.png') }}"
                                    alt="CS" class="w-full h-full object-cover rounded-full">
                            </div>
                        </div>
                    </div>
                    <button onclick="toggleChatView(true)"
                        class="inline-flex items-center gap-1.5 font-semibold text-mgmp hover:text-mgmp-dark transition-colors text-[13px] mt-1 w-max outline-none">
                        <span>Mulai Percakapan</span>
                        <i class="fas fa-chevron-right text-[10px]"></i>
                    </button>
                </div>

                <!-- Bottom Box (Articles) -->
                <div
                    class="w-full shadow-sm rounded-xl bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 px-5 py-4 mt-1">
                    <div class="flex flex-col gap-3">
                        <h3 class="font-bold text-slate-800 dark:text-slate-100 text-[15px]">Berita Terbaru</h3>
                        <div class="flex flex-col gap-3.5 mt-1 max-h-[180px] overflow-y-auto pr-2 custom-scrollbar">
                            @php
                                $csBeritaTerbaru = \App\Models\Berita::published()->latest('published_at')->take(5)->get();
                            @endphp
                            @forelse($csBeritaTerbaru as $b)
                                <a href="{{ route('berita.show', $b->slug) }}"
                                    class="flex items-start justify-between rounded group text-slate-600 dark:text-slate-300 hover:text-mgmp gap-3 transition-colors">
                                    <span
                                        class="leading-snug text-[13px] group-hover:underline underline-offset-2">{{ $b->title }}</span>
                                    <i
                                        class="fas fa-chevron-right text-[10px] shrink-0 mt-1 text-slate-400 dark:text-slate-500 group-hover:text-mgmp"></i>
                                </a>
                            @empty
                                <div class="text-[13px] text-slate-400 dark:text-slate-500">Belum ada berita terbaru.</div>
                            @endforelse
                        </div>
                        <div class="mt-2">
                            <a href="{{ route('berita') }}"
                                class="font-semibold text-[13px] inline-flex text-mgmp hover:text-mgmp-dark transition-colors">
                                Lihat semua berita
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ================= CHAT VIEW ================= -->
            <div id="cs-chat-view"
                class="hidden flex-col h-[350px] sm:h-[450px] max-h-[calc(100vh-150px)] bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-100 dark:border-slate-800 overflow-hidden relative">
                <!-- Header -->
                <div class="bg-mgmp p-3 flex items-center justify-between text-white shadow-sm z-10 relative">
                    <div class="flex items-center gap-3">
                        <button onclick="toggleChatView(false)"
                            class="hover:bg-white hover:text-mgmp w-8 h-8 flex items-center justify-center rounded-full transition-colors outline-none">
                            <i class="fas fa-arrow-left"></i>
                        </button>
                        <div
                            class="w-9 h-9 rounded-full border-2 border-white/80 bg-white dark:bg-slate-900 flex items-center justify-center p-0.5 shrink-0">
                            <img src="{{ asset('assets/maskot.png') }}"
                                class="w-full h-full object-cover rounded-full">
                        </div>
                        <div class="flex flex-col">
                            <div class="font-bold text-sm leading-tight">Customer Service</div>
                            <div
                                class="text-[11px] text-emerald-300 flex items-center gap-1.5 mt-0.5 font-medium tracking-wide">
                                <span class="relative flex h-2 w-2">
                                    <span
                                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                                </span>
                                Sedang online
                            </div>
                        </div>
                    </div>
                    <button onclick="toggleCSWidget()"
                        class="hover:bg-white hover:text-mgmp w-8 h-8 flex items-center justify-center rounded-full transition-colors outline-none">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <!-- Chat Body -->
                <div id="cs-chat-body"
                    class="flex-1 p-4 overflow-y-auto custom-scrollbar flex flex-col gap-4 bg-slate-50 dark:bg-slate-800/50 relative">
                    <!-- Timestamp -->
                    <div class="text-center text-[10px] text-slate-400 dark:text-slate-500 font-medium mb-2"
                        id="cs-chat-time"></div>
                    <!-- Messages will be injected here via JS -->
                </div>

                <!-- Chat Input -->
                <div
                    class="p-3 bg-white dark:bg-slate-900 border-t border-slate-100 dark:border-slate-800 flex items-center gap-2">
                    <input type="text" id="cs-chat-input" placeholder="Ketik pesan..."
                        class="flex-1 bg-slate-100 dark:bg-slate-800 rounded-full px-4 py-2.5 text-[13px] outline-none border border-transparent focus:border-mgmp/30 focus:bg-white dark:bg-slate-900 focus:shadow-sm transition-all text-slate-700 dark:text-slate-200">
                    <button id="cs-chat-send"
                        class="w-10 h-10 rounded-full bg-mgmp text-white flex items-center justify-center shrink-0 hover:bg-mgmp-dark hover:scale-105 transition-all shadow-md">
                        <i class="fas fa-paper-plane text-xs -ml-0.5"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Hover Chat Bubble -->
        <div id="cs-hover-bubble"
            class="absolute left-[80px] bottom-3 bg-white dark:bg-slate-900 text-slate-800 dark:text-slate-100 text-sm font-bold px-4 py-3 rounded-2xl shadow-xl border border-slate-100 dark:border-slate-800 opacity-0 -translate-x-4 transition-all duration-300 pointer-events-none whitespace-nowrap flex items-center gap-2">
            <div
                class="absolute top-1/2 -left-[6px] -translate-y-1/2 w-0 h-0 border-y-[6px] border-y-transparent border-r-[6px] border-r-white">
            </div>
            Hubungi Saya
        </div>

        <!-- Mascot Button -->
        <button onclick="toggleCSWidget()" id="cs-mascot-btn"
            class="relative w-16 h-16 rounded-full bg-white dark:bg-slate-900 shadow-[0_10px_25px_-5px_rgba(0,0,0,0.3)] border-4 border-mgmp flex items-center justify-center hover:scale-110 hover:-translate-y-1 transition-all duration-300 overflow-visible cursor-pointer hover:border-gold outline-none">
            <img src="{{ asset('assets/maskot.png') }}"
                alt="CS Mascot" class="w-full h-full object-cover rounded-full p-0.5">

            <!-- Notification Dot -->
            <span class="absolute top-0 right-0 flex h-4 w-4">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-4 w-4 bg-red-500 border-2 border-white"></span>
            </span>
        </button>
    </div>

    <!-- ===================== SCRIPTS ===================== -->
    <script>
        // ---- Mobile Menu ----
        const burgerBtn = document.getElementById('burger-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        burgerBtn?.addEventListener('click', () => {
            mobileMenu.classList.toggle('open');
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', (e) => {
            if (mobileMenu?.classList.contains('open') &&
                !mobileMenu.contains(e.target) &&
                !burgerBtn?.contains(e.target)) {
                mobileMenu.classList.remove('open');
            }
        });

        // ---- Back to Top ----
        const btt = document.getElementById('back-to-top');
        window.addEventListener('scroll', () => {
            btt?.classList.toggle('visible', window.scrollY > 400);
        });

        // ---- Dark Mode Toggle ----
        const darkToggles = document.querySelectorAll('.dark-toggle-btn');

        function updateDarkIcon() {
            const isDark = document.documentElement.classList.contains('dark');
            darkToggles.forEach(toggle => {
                const icon = toggle.querySelector('i');
                if (isDark) {
                    if (icon) {
                        icon.classList.remove('fa-moon');
                        icon.classList.add('fa-sun');
                    }
                    toggle.setAttribute('title', 'Mode Terang');
                } else {
                    if (icon) {
                        icon.classList.remove('fa-sun');
                        icon.classList.add('fa-moon');
                    }
                    toggle.setAttribute('title', 'Mode Gelap');
                }
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

        // ---- CS Widget Logic ----
        const csMascotBtn = document.getElementById('cs-mascot-btn');
        const csHoverBubble = document.getElementById('cs-hover-bubble');
        const csPopupPanel = document.getElementById('cs-popup-panel');
        const csHomeView = document.getElementById('cs-home-view');
        const csChatView = document.getElementById('cs-chat-view');
        const csChatBody = document.getElementById('cs-chat-body');
        const csChatInput = document.getElementById('cs-chat-input');
        const csChatSend = document.getElementById('cs-chat-send');
        let csPopupOpen = false;
        let chatInitialized = false;

        // Initialize Time
        document.getElementById('cs-chat-time').textContent = 'Hari ini, ' + new Intl.DateTimeFormat('id-ID', { timeStyle: 'short' }).format(new Date());

        // Handle Hover (skip di touch device)
        if (!('ontouchstart' in window || navigator.maxTouchPoints > 0)) {
            csMascotBtn?.addEventListener('mouseenter', () => {
                if (!csPopupOpen) {
                    csHoverBubble.classList.remove('opacity-0', '-translate-x-4');
                    csHoverBubble.classList.add('opacity-100', 'translate-x-0');
                }
            });
            csMascotBtn?.addEventListener('mouseleave', () => {
                csHoverBubble.classList.add('opacity-0', '-translate-x-4');
                csHoverBubble.classList.remove('opacity-100', 'translate-x-0');
            });
        }

        // Handle Click Toggle
        function toggleCSWidget() {
            csPopupOpen = !csPopupOpen;

            if (csPopupOpen) {
                csHoverBubble.classList.add('opacity-0', '-translate-x-4');
                csHoverBubble.classList.remove('opacity-100', 'translate-x-0');
                csPopupPanel.classList.remove('opacity-0', 'scale-95', 'pointer-events-none');
                csPopupPanel.classList.add('opacity-100', 'scale-100', 'pointer-events-auto');
                csMascotBtn.classList.add('border-gold');
                csMascotBtn.classList.remove('border-mgmp');
            } else {
                csPopupPanel.classList.add('opacity-0', 'scale-95', 'pointer-events-none');
                csPopupPanel.classList.remove('opacity-100', 'scale-100', 'pointer-events-auto');
                csMascotBtn.classList.remove('border-gold');
                csMascotBtn.classList.add('border-mgmp');
            }
        }

        // Handle Chat View Toggle
        function toggleChatView(show) {
            if (show) {
                csHomeView.classList.add('hidden');
                csChatView.classList.remove('hidden');
                csChatView.classList.add('flex');

                if (!chatInitialized) {
                    chatInitialized = true;

                    if (!currentChatSession) {
                        // Send first message
                        setTimeout(() => {
                            appendMessage('Wilujeng Sumping 👋', false);
                            const typingId = showTypingIndicator();
                            setTimeout(() => {
                                removeTypingIndicator(typingId);
                                appendMessage('Ada yang bisa kami bantu?', false);
                            }, 1500);
                        }, 500);
                    } else {
                        // We will load history from poll
                        csChatBody.innerHTML = ''; 
                    }
                }
            } else {
                csChatView.classList.add('hidden');
                csChatView.classList.remove('flex');
                csHomeView.classList.remove('hidden');
            }
        }

        function appendMessage(text, isUser) {
            const wrapper = document.createElement('div');
            wrapper.className = `flex w-full ${isUser ? 'justify-end' : 'justify-start'}`;

            const bubbleWrapper = document.createElement('div');
            bubbleWrapper.className = `flex max-w-[85%] items-end gap-2 ${isUser ? 'flex-row-reverse' : ''}`;

            if (!isUser) {
                const avatar = document.createElement('img');
                avatar.src = "{{ asset('assets/maskot.png') }}";
                avatar.className = 'w-6 h-6 rounded-full border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 object-cover shrink-0 mb-0.5';
                bubbleWrapper.appendChild(avatar);
            }

            const bubble = document.createElement('div');
            bubble.className = `px-4 py-2.5 text-[13px] shadow-sm leading-relaxed break-words ${isUser ? 'bg-mgmp text-white rounded-2xl rounded-br-sm' : 'bg-white dark:bg-slate-900 text-slate-700 dark:text-slate-200 rounded-2xl rounded-bl-sm border border-slate-100 dark:border-slate-800'}`;
            bubble.textContent = text;

            bubbleWrapper.appendChild(bubble);
            wrapper.appendChild(bubbleWrapper);
            csChatBody.appendChild(wrapper);
            csChatBody.scrollTop = csChatBody.scrollHeight;
        }

        function showTypingIndicator() {
            const id = 'typing-' + Date.now();
            const wrapper = document.createElement('div');
            wrapper.id = id;
            wrapper.className = 'flex w-full justify-start';

            const bubbleWrapper = document.createElement('div');
            bubbleWrapper.className = 'flex max-w-[85%] items-end gap-2';

            const avatar = document.createElement('img');
            avatar.src = "{{ asset('assets/maskot.png') }}";
            avatar.className = 'w-6 h-6 rounded-full border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 object-cover shrink-0 mb-0.5';
            bubbleWrapper.appendChild(avatar);

            const bubble = document.createElement('div');
            bubble.className = 'bg-white dark:bg-slate-900 rounded-2xl rounded-bl-sm border border-slate-100 dark:border-slate-800 px-4 py-3.5 shadow-sm flex items-center gap-1.5 h-10';
            bubble.innerHTML = '<div class="w-1.5 h-1.5 rounded-full bg-slate-300 animate-bounce" style="animation-delay: 0ms"></div><div class="w-1.5 h-1.5 rounded-full bg-slate-300 animate-bounce" style="animation-delay: 150ms"></div><div class="w-1.5 h-1.5 rounded-full bg-slate-300 animate-bounce" style="animation-delay: 300ms"></div>';

            bubbleWrapper.appendChild(bubble);
            wrapper.appendChild(bubbleWrapper);
            csChatBody.appendChild(wrapper);
            csChatBody.scrollTop = csChatBody.scrollHeight;
            return id;
        }

        function removeTypingIndicator(id) {
            const el = document.getElementById(id);
            if (el) el.remove();
        }

        // Chat State
        let currentChatSession = localStorage.getItem('cs_session_id') || null;
        let chatPollInterval = null;
        let lastMessageId = 0;

        function startChatPolling(skipClear) {
            if (chatPollInterval) clearInterval(chatPollInterval);
            
            // Initial Load — load full history
            fetch(`{{ str_replace('http://', 'https://', route('api.chat.poll')) }}?session_id=${currentChatSession}&last_id=0`)
                .then(r => r.json())
                .then(data => {
                    if(data.messages && data.messages.length > 0) {
                        if (!skipClear) {
                            // Returning visitor: clear placeholder and show history
                            csChatBody.innerHTML = '';
                            data.messages.forEach(msg => {
                                appendMessage(msg.message, msg.sender === 'visitor');
                                lastMessageId = Math.max(lastMessageId, msg.id);
                            });
                        } else {
                            // First message just sent: DON'T clear (greeting is already visible),
                            // just update lastMessageId so polling won't re-append the message
                            data.messages.forEach(msg => {
                                lastMessageId = Math.max(lastMessageId, msg.id);
                            });
                        }
                    }
                    
                    // Start interval for NEW admin messages only
                    chatPollInterval = setInterval(() => {
                        if(!currentChatSession) return;
                        fetch(`{{ str_replace('http://', 'https://', route('api.chat.poll')) }}?session_id=${currentChatSession}&last_id=${lastMessageId}`)
                            .then(r => r.json())
                            .then(data => {
                                if(data.messages && data.messages.length > 0) {
                                    data.messages.forEach(msg => {
                                        appendMessage(msg.message, false);
                                        lastMessageId = Math.max(lastMessageId, msg.id);
                                    });
                                }
                            });
                    }, 3000);
                });
        }

        if (currentChatSession) {
            startChatPolling();
        }

        // Handle User Sending Message
        function handleSendMessage() {
            const text = csChatInput.value.trim();
            if (!text) return;

            appendMessage(text, true);
            csChatInput.value = '';

            const payload = {
                message: text,
                session_id: currentChatSession,
                name: "{{ auth()->check() ? auth()->user()->name : 'Pengunjung' }}"
            };
            
            @if(auth()->check())
                payload.email = "{{ auth()->user()->email }}";
            @endif

            fetch("{{ str_replace('http://', 'https://', route('api.chat.send')) }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify(payload)
            })
            .then(r => {
                if (r.status === 404) {
                    // Stale session, clear it and retry
                    localStorage.removeItem('cs_session_id');
                    currentChatSession = null;
                    payload.session_id = null;
                    // Resend silently
                    return fetch("{{ str_replace('http://', 'https://', route('api.chat.send')) }}", {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify(payload)
                    }).then(res => res.json());
                }
                return r.json();
            })
            .then(data => {
                if (data.error) {
                    console.error('Chat error:', data.error);
                    return;
                }
                if (data.session_id && !currentChatSession) {
                    currentChatSession = data.session_id;
                    localStorage.setItem('cs_session_id', currentChatSession);
                    // skipClear=true: greeting & first message already visible, don't wipe them
                    startChatPolling(true);
                }
                if (data.message && data.message.id) {
                    lastMessageId = Math.max(lastMessageId, data.message.id);
                }
            })
            .catch(err => console.error('Chat request failed', err));
        }

        csChatSend?.addEventListener('click', handleSendMessage);
        csChatInput?.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') handleSendMessage();
        });

        // Profile Dropdowns Toggle
        function setupDropdown(btnId, menuId) {
            const btn = document.getElementById(btnId);
            const menu = document.getElementById(menuId);
            if (btn && menu) {
                btn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    menu.classList.toggle('hidden');
                });
                document.addEventListener('click', (e) => {
                    if (!btn.contains(e.target) && !menu.contains(e.target)) {
                        menu.classList.add('hidden');
                    }
                });
            }
        }

        setupDropdown('mobile-profile-btn', 'mobile-profile-menu');
        setupDropdown('desktop-profile-btn', 'desktop-profile-menu');

    </script>

    <!-- Auto-dismiss flash messages (3 seconds) -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const flashMessages = document.querySelectorAll('.flash-message');
            flashMessages.forEach(function (el) {
                setTimeout(function () {
                    el.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                    el.style.opacity = '0';
                    el.style.transform = 'translateY(-10px)';
                    setTimeout(function () { el.remove(); }, 300);
                }, 3000);
            });
        });
    </script>

    @stack('scripts')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
            offset: 100,
        });
    </script>

    <!-- Global Search Modal -->
    <div id="searchModal" class="fixed inset-0 z-[100] hidden opacity-0 transition-opacity duration-300">
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" id="searchModalOverlay"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto p-4 sm:p-6 md:p-20 mt-10">
            <div
                class="mx-auto max-w-2xl transform divide-y divide-slate-100 dark:divide-slate-800 rounded-2xl bg-white dark:bg-slate-900 shadow-2xl ring-1 ring-black ring-opacity-5 transition-all flex flex-col">
                <form action="{{ route('search.index') ?? '#' }}" method="GET" class="relative flex items-center"
                    id="searchForm">
                    <i class="fas fa-search absolute left-4 text-slate-400"></i>
                    <input type="text" name="q" id="searchInput"
                        class="h-12 w-full border-0 bg-transparent pl-11 pr-10 text-slate-900 dark:text-white placeholder-slate-400 focus:ring-0 sm:text-sm outline-none"
                        placeholder="Cari..." autocomplete="off">
                    <button type="button" id="closeSearchBtn"
                        class="absolute right-2 text-slate-400 hover:text-red-500 transition-colors w-7 h-7 flex items-center justify-center outline-none"
                        title="Tutup">
                        <i class="fas fa-times text-sm"></i>
                    </button>
                </form>

                <!-- Search Suggestions Dropdown -->
                <div id="searchSuggestions"
                    class="hidden flex-col max-h-80 overflow-y-auto custom-scrollbar bg-slate-50 dark:bg-slate-900/50 rounded-b-2xl">
                    <!-- Javascript will inject list items here -->
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // Search Modal Logic
            const searchModal = document.getElementById('searchModal');
            const searchInput = document.getElementById('searchInput');
            const searchForm = document.getElementById('searchForm');
            const searchSuggestions = document.getElementById('searchSuggestions');
            const searchModalOverlay = document.getElementById('searchModalOverlay');
            const searchBtns = document.querySelectorAll('.search-btn');

            const searchCategories = [
                { id: 'berita', name: 'Berita', icon: 'fa-newspaper' },
                { id: 'program', name: 'Program', icon: 'fa-clipboard-list' },
                { id: 'agenda', name: 'Agenda', icon: 'fa-calendar-alt' },
                { id: 'kegiatan', name: 'Kegiatan', icon: 'fa-calendar-check' },
                { id: 'galeri', name: 'Produk KIK', icon: 'fa-images' },
                { id: 'dokumen', name: 'Dokumen', icon: 'fa-file-alt' }
            ];

            function escapeHtml(unsafe) {
                return (unsafe || '').toString()
                    .replace(/&/g, "&amp;")
                    .replace(/</g, "&lt;")
                    .replace(/>/g, "&gt;")
                    .replace(/"/g, "&quot;")
                    .replace(/'/g, "&#039;");
            }

            searchInput.addEventListener('input', function () {
                const query = this.value.trim();

                if (query.length > 0) {
                    searchSuggestions.innerHTML = '';
                    searchCategories.forEach(cat => {
                        const item = document.createElement('a');
                        item.href = `{{ route('search.index') ?? '#' }}?q=${encodeURIComponent(query)}&type=${cat.id}`;
                        item.className = 'flex items-center gap-3 px-4 py-3 hover:bg-slate-100 dark:hover:bg-slate-800 cursor-pointer transition-colors border-b border-slate-200/50 dark:border-slate-800/50 last:border-0 text-slate-700 dark:text-slate-300';
                        item.innerHTML = `
                            <div class="w-6 h-6 rounded-full bg-slate-200 dark:bg-slate-700 flex items-center justify-center shrink-0">
                                <i class="fas ${cat.icon} text-slate-500 dark:text-slate-400 text-[10px]"></i>
                            </div>
                            <div class="text-sm font-medium">
                                "<span class="font-bold text-slate-900 dark:text-white">${escapeHtml(query)}</span>" di ${cat.name}
                            </div>
                        `;
                        searchSuggestions.appendChild(item);
                    });
                    searchSuggestions.classList.remove('hidden');
                    searchSuggestions.classList.add('flex');
                } else {
                    searchSuggestions.classList.add('hidden');
                    searchSuggestions.classList.remove('flex');
                }
            });

            searchForm.addEventListener('submit', function (e) {
                if (searchInput.value.trim() === '') {
                    e.preventDefault();
                }
            });

            function openSearch() {
                searchModal.classList.remove('hidden');
                setTimeout(() => {
                    searchModal.classList.remove('opacity-0');
                    searchInput.focus();
                }, 10);
            }

            function closeSearch() {
                searchModal.classList.add('opacity-0');
                setTimeout(() => {
                    searchModal.classList.add('hidden');
                }, 300);
            }

            searchBtns.forEach(btn => btn.addEventListener('click', openSearch));
            searchModalOverlay.addEventListener('click', closeSearch);
            document.getElementById('closeSearchBtn')?.addEventListener('click', closeSearch);
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && !searchModal.classList.contains('hidden')) closeSearch();
                // Ctrl+K or Cmd+K shortcut
                if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                    e.preventDefault();
                    openSearch();
                }
            });
        });
    </script>
</body>

</html>