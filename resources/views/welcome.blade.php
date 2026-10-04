@extends('layouts.app')

@push('styles')
<style>
/* Custom Styles to supplement Tailwind */
        .section-content {
            display: none;
            animation: fadeIn 0.4s ease-in-out;
        }

        .section-content.active {
            display: block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Hero Background Slider */
        .slide-bg-1 {
            background-image: url('{{ asset("assets/background1.jpg") }}');
            animation: fade-1 30s infinite;
        }
        .slide-bg-2 {
            background-image: url('{{ asset("assets/background2.png") }}');
            animation: fade-2 30s infinite;
            opacity: 0;
        }
        .slide-bg-3 {
            background-image: url('{{ asset("assets/background3.png") }}');
            animation: fade-3 30s infinite;
            opacity: 0;
        }

        @keyframes fade-1 {
            0% { opacity: 1; transform: scale(1); }
            23.33% { opacity: 1; transform: scale(1.03); }
            33.33% { opacity: 0; transform: scale(1.05); }
            90% { opacity: 0; transform: scale(1); }
            100% { opacity: 1; transform: scale(1); }
        }
        @keyframes fade-2 {
            0% { opacity: 0; transform: scale(1); }
            23.33% { opacity: 0; transform: scale(1); }
            33.33% { opacity: 1; transform: scale(1); }
            56.66% { opacity: 1; transform: scale(1.03); }
            66.66% { opacity: 0; transform: scale(1.05); }
            100% { opacity: 0; transform: scale(1); }
        }
        @keyframes fade-3 {
            0% { opacity: 0; transform: scale(1); }
            56.66% { opacity: 0; transform: scale(1); }
            66.66% { opacity: 1; transform: scale(1); }
            90% { opacity: 1; transform: scale(1.03); }
            100% { opacity: 0; transform: scale(1.05); }
        }

        /* Typewriter Cursor */
        @keyframes cursor-blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0; }
        }
        .typewriter-cursor {
            animation: cursor-blink 0.8s ease-in-out infinite;
            display: inline-block;
            font-weight: 300;
        }

        /* Wave SVG Background */
        .wave-bottom {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            overflow: hidden;
            line-height: 0;
            transform: rotate(180deg);
        }

        .wave-bottom svg {
            position: relative;
            display: block;
            width: calc(100% + 1.3px);
            height: 60px;
        }

        .wave-bottom .shape-fill {
            fill: #ffffff;
        }

        @media (min-width: 768px) {
            .wave-bottom svg {
                height: 120px;
            }
        }

        /* Note: Custom scrollbar styles are now in app.blade.php */

        /* Bagan Organisasi (Org Chart) */
        .org-chart {
            display: flex;
            justify-content: center;
            overflow-x: auto;
            padding-bottom: 2rem;
            padding-top: 1rem;
        }

        .org-chart ul {
            padding-top: 20px;
            position: relative;
            transition: all 0.5s;
            display: flex;
            justify-content: center;
        }

        .org-chart li {
            float: left;
            text-align: center;
            list-style-type: none;
            position: relative;
            padding: 20px 5px 0 5px;
            transition: all 0.5s;
        }

        .org-chart li::before,
        .org-chart li::after {
            content: '';
            position: absolute;
            top: 0;
            right: 50%;
            border-top: 2px solid #cbd5e1;
            width: 50%;
            height: 20px;
        }

        .org-chart li::after {
            right: auto;
            left: 50%;
            border-left: 2px solid #cbd5e1;
        }

        .org-chart li:only-child::after,
        .org-chart li:only-child::before {
            display: none;
        }

        .org-chart li:only-child {
            padding-top: 0;
        }

        .org-chart li:first-child::before,
        .org-chart li:last-child::after {
            border: 0 none;
        }

        .org-chart li:last-child::before {
            border-right: 2px solid #cbd5e1;
            border-radius: 0 5px 0 0;
        }

        .org-chart li:first-child::after {
            border-radius: 5px 0 0 0;
        }

        .org-chart ul ul::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            border-left: 2px solid #cbd5e1;
            width: 0;
            height: 20px;
        }

        .org-node {
            display: inline-flex;
            flex-direction: column;
            align-items: center;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 12px;
            min-width: 140px;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .org-node:hover {
            transform: translateY(-5px);
            border-color: #1363a6;
            box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1);
        }

        .org-node img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 8px;
            border: 2px solid #1363a6;
        }

        .org-node h4 {
            font-size: 0.875rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 2px;
            line-height: 1.2;
        }

        .org-node p {
            font-size: 0.65rem;
            font-weight: 600;
            color: #1363a6;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
</style>
@endpush

@section('content')
<!-- HOME SECTION -->
        <section id="home"
            class="section-content active relative bg-slate-50 dark:bg-slate-800/20 bg-pattern-dots overflow-hidden z-0">
            <!-- Decorative Blobs for Beranda Background -->
            <div class="blob-shape bg-mgmp-light/30 w-[600px] h-[600px] top-[30%] -left-[10%]"></div>
            <div class="blob-shape bg-mgmp/20 w-[500px] h-[500px] top-[50%] -right-[10%]"></div>
            <div class="blob-shape bg-gold/20 w-[600px] h-[600px] bottom-[5%] -left-[5%]"></div>

            <!-- Hero Banner -->
            <div class="relative pb-20 lg:pb-32 overflow-hidden">
                <!-- Slider Backgrounds -->
                <div class="absolute inset-0 z-0 bg-cover bg-center slide-bg-1"></div>
                <div class="absolute inset-0 z-0 bg-cover bg-center slide-bg-2"></div>
                <div class="absolute inset-0 z-0 bg-cover bg-center slide-bg-3"></div>
                
                <!-- Dark Overlay to make text readable over images -->
                <div class="absolute inset-0 bg-mgmp/80 z-0"></div>

                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 pt-16 lg:pt-24 pb-12">
                    <div class="flex flex-col items-start text-left justify-center min-h-[50vh]">

                        <!-- Teks Intro Kiri -->
                        <div class="max-w-3xl flex flex-col items-start">
                            <h1 class="text-4xl tracking-tight font-extrabold text-white sm:text-5xl md:text-6xl mb-2">
                                MGMP KIK
                            </h1>
                            <h1
                                class="text-3xl tracking-tight font-extrabold text-gold sm:text-4xl md:text-5xl mb-6">
                                Jawa Barat
                            </h1>
                            <h2 class="text-2xl md:text-3xl font-bold text-white mb-10 h-8 md:h-10 flex justify-start items-center">
                                <span id="greeting-typewriter"></span><span class="typewriter-cursor ml-1 text-gold">|</span>
                            </h2>
                            <p class="text-white/80 text-base md:text-lg max-w-2xl mb-10 leading-relaxed font-light">
                                Bersama Membangun Pendidikan Kesejahteraan Keluarga yang Berkualitas, Inovatif, dan
                                Berdaya Saing.
                            </p>
                            <div class="flex flex-wrap justify-start gap-4">
                                <a href="{{ route('program') }}" 
                                    class="px-6 py-3 rounded-lg bg-white dark:bg-slate-900 text-mgmp font-semibold hover:bg-slate-50 dark:bg-slate-800 shadow-lg shadow-black/5 transition-all">
                                    Lihat Program Kami
                                </a>
                                <a href="{{ route('profile.anggota') }}" 
                                    class="px-6 py-3 rounded-lg bg-transparent border border-white/40 text-white font-semibold hover:bg-white dark:bg-slate-900/10 transition-all">
                                    Profil Kami
                                </a>
                            </div>
                        </div>

                    </div>
                </div>

                <!-- SVG Wave Bottom -->
                <div class="wave-bottom">
                    <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"
                        preserveAspectRatio="none">
                        <path
                            d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"
                            class="shape-fill"></path>
                    </svg>
                </div>
            </div>

            <!-- Stats Section -->
            <div class="w-full bg-white dark:bg-slate-900 pt-8 pb-16 relative z-20">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-8 md:gap-4 divide-x divide-slate-100">
                        <div class="flex items-center justify-center md:justify-start space-x-4 px-4">
                            <div
                                class="w-12 h-12 rounded-xl bg-slate-50 dark:bg-slate-800 flex items-center justify-center text-mgmp text-xl flex-shrink-0">
                                <i class="fas fa-users"></i>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-mgmp">{{ $memberCount }}</h3>
                                <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">Anggota Guru PKK</p>
                            </div>
                        </div>
                        <div class="flex items-center justify-center md:justify-start space-x-4 px-4">
                            <div
                                class="w-12 h-12 rounded-xl bg-slate-50 dark:bg-slate-800 flex items-center justify-center text-mgmp text-xl flex-shrink-0">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-mgmp">{{ \App\Models\Setting::where('key', 'stat_kabupaten')->first()->value ?? '27' }}</h3>
                                <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">Kabupaten / Kota</p>
                            </div>
                        </div>
                        <div class="flex items-center justify-center md:justify-start space-x-4 px-4">
                            <div
                                class="w-12 h-12 rounded-xl bg-slate-50 dark:bg-slate-800 flex items-center justify-center text-mgmp text-xl flex-shrink-0">
                                <i class="far fa-calendar-check"></i>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-mgmp">{{ $kegiatanCount }}</h3>
                                <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">Kegiatan Per Tahun</p>
                            </div>
                        </div>
                        <div class="flex items-center justify-center md:justify-start space-x-4 px-4">
                            <div
                                class="w-12 h-12 rounded-xl bg-slate-50 dark:bg-slate-800 flex items-center justify-center text-mgmp text-xl flex-shrink-0">
                                <i class="fas fa-award"></i>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-mgmp">{{ \App\Models\Setting::where('key', 'stat_tahun')->first()->value ?? '15+' }}</h3>
                                <p class="text-xs text-slate-500 dark:text-slate-400 font-medium">Tahun Berdiri</p>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="max-w-7xl mx-auto mt-16 border-t border-slate-200 dark:border-slate-700">
            </div>

            {{-- 
            <!-- Kata Sambutan Section -->
            <div class="w-full bg-slate-50 dark:bg-slate-800 py-20 border-b border-slate-100 dark:border-slate-800 relative overflow-hidden">
                <div class="blob-shape bg-mgmp/20 w-[400px] h-[400px] top-[10%] -right-[5%]"></div>
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                        <!-- Photo -->
                        <div class="lg:col-span-5 flex justify-center">
                            <div class="relative w-72 md:w-80 h-96">
                                <div
                                    class="absolute inset-0 bg-mgmp rounded-2xl transform rotate-3 scale-105 opacity-20">
                                </div>
                                <div
                                    class="absolute inset-0 bg-gold rounded-2xl transform -rotate-3 scale-105 opacity-30">
                                </div>
                                <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80"
                                    alt="Ketua MGMP KIK Jawa Barat"
                                    class="absolute inset-0 w-full h-full object-cover rounded-2xl shadow-xl border-4 border-white">
                                <div
                                    class="absolute -bottom-6 -left-6 bg-white dark:bg-slate-900 p-4 rounded-xl shadow-lg border border-slate-100 dark:border-slate-800 flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 rounded-full bg-slate-50 dark:bg-slate-800 text-mgmp flex items-center justify-center text-xl">
                                        <i class="fas fa-quote-left"></i>
                                    </div>
                                    <div>
                                        <p class="text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">Ketua MGMP
                                        </p>
                                        <p class="font-bold text-slate-800 dark:text-slate-100">Dra. Hj. Sri Mulyani, M.Pd</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Text -->
                        <div class="lg:col-span-7">
                            <div class="border-l-8 border-gold pl-4 mb-2">
                                <h2 class="text-3xl md:text-4xl font-black text-slate-900 dark:text-white uppercase tracking-tighter">
                                    Kata Sambutan
                                </h2>
                            </div>
                            <p class="text-sm font-bold tracking-wider text-mgmp uppercase pl-4 mb-8">Ketua
                                MGMP KIK Jawa Barat</p>

                            <div class="prose prose-slate max-w-none text-slate-600 dark:text-slate-300 space-y-4">
                                <p class="text-lg md:text-xl font-light italic leading-relaxed text-slate-700 dark:text-slate-200">
                                    "Selamat datang di portal resmi Musyawarah Guru Mata Pelajaran (MGMP) Pendidikan
                                    Kesejahteraan Keluarga Jawa Barat."
                                </p>
                                <p class="leading-relaxed text-justify">
                                    Kami berkomitmen untuk terus menjadi wadah yang inspiratif dan kolaboratif bagi
                                    seluruh guru PKK. Di era transformasi digital dan Kurikulum Merdeka ini, peran guru
                                    vokasi sangatlah krusial dalam mencetak generasi yang kompeten, mandiri, dan
                                    berkarakter.
                                </p>
                                <p class="leading-relaxed text-justify">
                                    Melalui website ini, kami berharap dapat memfasilitasi pertukaran informasi,
                                    peningkatan kompetensi, serta mempererat tali silaturahmi antar pendidik se-Jawa
                                    Barat. Mari bersama-sama kita majukan pendidikan vokasi!
                                </p>
                            </div>

                            <div class="mt-8 pt-8 border-t border-slate-200 dark:border-slate-700">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/e/e4/Signature_dummy.png"
                                    alt="Tanda Tangan" class="h-16 opacity-60 mb-2 filter grayscale mix-blend-multiply">
                                <p class="font-bold text-slate-800 dark:text-slate-100">Dra. Hj. Sri Mulyani, M.Pd</p>
                                <p class="text-sm text-slate-500 dark:text-slate-400">Ketua MGMP KIK Jawa Barat</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            --}}

            <!-- Featured News & List (Image 5 Style) -->
            <div class="w-full bg-white dark:bg-slate-900 py-20 border-b border-slate-100 dark:border-slate-800 relative">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col md:flex-row md:justify-between md:items-end gap-4 mb-10">
                        <div>
                            <div class="border-l-8 border-gold pl-4 mb-2">
                                <h2 class="text-3xl md:text-4xl font-black text-slate-900 dark:text-white uppercase tracking-tighter">
                                    Berita
                                    & Kegiatan</h2>
                            </div>
                            <p class="text-sm font-bold tracking-wider text-mgmp uppercase pl-4">Informasi
                                Terkini
                            </p>
                        </div>
                        <a href="{{ route('berita') }}" 
                            class="text-sm font-semibold text-mgmp hover:text-mgmp flex items-center transition-colors">
                            Semua Berita <i class="fas fa-arrow-right ml-2 text-xs"></i>
                        </a>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                        <!-- Featured Large Card -->
                        <div class="lg:col-span-7 xl:col-span-8">
                            <div
                                class="bg-white dark:bg-slate-900 rounded-2xl shadow-md border border-slate-200 dark:border-slate-700 overflow-hidden hover:shadow-xl hover:border-mgmp/40 hover:-translate-y-1 transition-all duration-300 cursor-pointer h-full flex flex-col group">
                                <div class="relative h-72 md:h-80 overflow-hidden">
@php $featured = $beritas->first() @endphp
@if($featured)
                                    <img src="{{ $featured->image ? asset('storage/' . $featured->image) : 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80' }}"
                                        alt="{{ $featured->title }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
@else
                                    <div class="w-full h-full bg-slate-100 dark:bg-slate-800 flex flex-col items-center justify-center text-slate-400 dark:text-slate-500">
                                        <i class="far fa-newspaper text-5xl mb-3"></i>
                                        <p class="font-semibold">Belum ada berita saat ini</p>
                                    </div>
@endif
                                </div>
                                @if($featured)
                                <div class="p-6 md:p-8 flex-grow flex flex-col justify-between" data-aos="fade-right">
                                    <div>
                                        <p class="text-xs text-slate-400 dark:text-slate-500 font-medium mb-3"><i
                                                class="far fa-calendar-alt mr-1"></i> {{ $featured->published_at ? $featured->published_at->format('d M Y') : $featured->created_at->format('d M Y') }}</p>
                                        <h3
                                            class="text-xl md:text-2xl font-bold text-slate-900 dark:text-white mb-3 group-hover:text-mgmp transition-colors">
                                            {{ $featured->title }}</h3>
                                        <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed mb-6">
                                            {{ $featured->excerpt }}
                                        </p>
                                    </div>
                                    <a href="{{ route('berita.show', $featured->slug) }}" class="text-mgmp font-semibold text-sm flex items-center">
                                        Baca Selengkapnya <i class="fas fa-arrow-right ml-2 text-xs"></i>
                                    </a>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Side List -->
                        @if($beritas->count() > 1)
                        <div class="lg:col-span-5 xl:col-span-4 flex flex-col space-y-4">
                            @foreach($beritas->slice(1) as $berita)
                            <a href="{{ route('berita.show', $berita->slug) }}"
                                class="bg-white dark:bg-slate-900 rounded-2xl p-3 flex gap-4 items-center shadow-md border border-slate-200 dark:border-slate-700 hover:shadow-xl hover:border-mgmp/40 transition-all duration-300 cursor-pointer group hover:-translate-y-1 block">
                                <img src="{{ $berita->image ? asset('storage/' . $berita->image) : 'https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80' }}"
                                    alt="{{ $berita->title }}" class="w-24 h-24 rounded-xl object-cover">
                                <div>
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="text-[10px] text-slate-400 dark:text-slate-500">{{ $berita->published_at ? $berita->published_at->format('d M Y') : $berita->created_at->format('d M Y') }}</span>
                                    </div>
                                    <h4
                                        class="text-sm font-bold text-slate-800 dark:text-slate-100 leading-tight group-hover:text-mgmp transition-colors line-clamp-2">
                                        {{ $berita->title }}</h4>
                                </div>
                            </a>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Informasi Utama Section (Reference Disdik Jawa Barat) -->
            <div class="w-full bg-slate-50 dark:bg-slate-800 py-20 border-b border-slate-100 dark:border-slate-800 relative z-20">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="mb-10">
                        <div class="border-l-8 border-gold pl-4 mb-2">
                            <h2 class="text-3xl md:text-4xl font-black text-slate-900 dark:text-white uppercase tracking-tighter">
                                Informasi
                            </h2>
                        </div>
                        <p class="text-sm font-bold tracking-wider text-mgmp uppercase pl-4">Layanan & Dokumen
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">
                        <!-- Card 1 -->
                        <div
                            class="bg-white dark:bg-slate-900 rounded-2xl shadow-md border border-slate-200 dark:border-slate-700 hover:shadow-xl hover:border-mgmp/40 hover:-translate-y-1 p-8 flex flex-col h-full transition-all duration-300 group">
                            <div class="bg-slate-50 dark:bg-slate-800/70 w-full h-32 rounded-xl flex items-center justify-center mb-8">
                                <i class="fas fa-graduation-cap text-5xl text-mgmp"></i>
                            </div>
                            <h3 class="text-xl font-bold text-slate-800 dark:text-slate-100 mb-3">Pendaftaran Anggota</h3>
                            <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed flex-grow mb-8">
                                Pendaftaran dan pengumuman hasil seleksi keanggotaan MGMP KIK Jawa Barat secara terbuka.
                            </p>
                            <a href="#"
                                class="block w-full text-center border-2 border-mgmp text-mgmp hover:bg-mgmp hover:text-white font-bold text-xs tracking-wider py-3 rounded-full uppercase transition-colors">
                                Lihat Selengkapnya
                            </a>
                        </div>

                        <!-- Card 2 -->
                        <div
                            class="bg-white dark:bg-slate-900 rounded-2xl shadow-md border border-slate-200 dark:border-slate-700 hover:shadow-xl hover:border-mgmp/40 hover:-translate-y-1 p-8 flex flex-col h-full transition-all duration-300 group">
                            <div class="bg-slate-50 dark:bg-slate-800/70 w-full h-32 rounded-xl flex items-center justify-center mb-8">
                                <i class="fas fa-book-open text-5xl text-mgmp"></i>
                            </div>
                            <h3 class="text-xl font-bold text-slate-800 dark:text-slate-100 mb-3">Dokumen Pedoman</h3>
                            <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed flex-grow mb-8">
                                Dokumen pendukung, pedoman pembelajaran, dan kurikulum PKK terbaru yang dapat diunduh
                                oleh
                                anggota.
                            </p>
                            <a href="#"
                                class="block w-full text-center border-2 border-mgmp text-mgmp hover:bg-mgmp hover:text-white font-bold text-xs tracking-wider py-3 rounded-full uppercase transition-colors">
                                Lihat Selengkapnya
                            </a>
                        </div>

                        <!-- Card 3 -->
                        <div
                            class="bg-white dark:bg-slate-900 rounded-2xl shadow-md border border-slate-200 dark:border-slate-700 hover:shadow-xl hover:border-mgmp/40 hover:-translate-y-1 p-8 flex flex-col h-full transition-all duration-300 group">
                            <div class="bg-slate-50 dark:bg-slate-800/70 w-full h-32 rounded-xl flex items-center justify-center mb-8">
                                <i class="fas fa-poll text-5xl text-mgmp"></i>
                            </div>
                            <h3 class="text-xl font-bold text-slate-800 dark:text-slate-100 mb-3">Survey Kebutuhan</h3>
                            <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed flex-grow mb-8">
                                Kuisioner ini memberikan wawasan mendalam tentang kualitas pendidikan yang disediakan
                                oleh
                                sekolah-sekolah di Jawa Barat.
                            </p>
                            <a href="#"
                                class="block w-full text-center border-2 border-mgmp text-mgmp hover:bg-mgmp hover:text-white font-bold text-xs tracking-wider py-3 rounded-full uppercase transition-colors">
                                Lihat Selengkapnya
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Program Unggulan -->
            <div class="w-full bg-white dark:bg-slate-900 py-20 border-b border-slate-100 dark:border-slate-800 relative">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-12 flex flex-col items-center">
                        <p class="text-sm font-bold tracking-wider text-mgmp uppercase mb-3">Apa Yang Kami
                            Lakukan
                        </p>
                        <div class="relative inline-block mb-6">
                            <h2 class="text-3xl md:text-4xl font-black text-slate-900 dark:text-white uppercase tracking-tighter">
                                Program
                                Unggulan</h2>
                            <div
                                class="absolute -bottom-3 left-1/2 -translate-x-1/2 w-24 h-1.5 bg-gold rounded-full">
                            </div>
                        </div>
                        <p class="text-slate-500 dark:text-slate-400 max-w-2xl mx-auto text-sm">Berbagai inisiatif strategis kami untuk
                            meningkatkan kualitas guru PKK dan pendidikan vokasi di Jawa Barat.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Card 1 -->
                        <div class="group relative bg-white dark:bg-slate-800 rounded-3xl p-8 border-2 border-transparent hover:border-mgmp/20 shadow-lg hover:shadow-xl hover:-translate-y-2 transition-all duration-300" data-aos="fade-up" data-aos-delay="100">
                            <div
                                class="w-12 h-12 rounded-xl bg-slate-50 dark:bg-slate-800 text-mgmp-light flex items-center justify-center text-xl mb-6 group-hover:scale-110 transition-transform">
                                <i class="fas fa-book-open"></i>
                            </div>
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Pengembangan Kurikulum</h3>
                            <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed">Sinkronisasi kurikulum industri dan
                                sekolah
                                untuk memastikan lulusan siap kerja.</p>
                        </div>
                        <!-- Card 2 -->
                        <div
                            class="bg-slate-50 dark:bg-slate-800/60 p-6 rounded-2xl shadow-md border border-gold/20 hover:shadow-xl hover:border-gold/50 hover:-translate-y-1 transition-all duration-300 group" data-aos="fade-up" data-aos-delay="200">
                            <div
                                class="w-12 h-12 rounded-xl bg-slate-50 dark:bg-slate-800 text-gold flex items-center justify-center text-xl mb-6 group-hover:scale-110 transition-transform">
                                <i class="fas fa-chalkboard-teacher"></i>
                            </div>
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Peningkatan SDM Guru</h3>
                            <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed">Pelatihan dan workshop untuk terus
                                mengasah
                                kompetensi pedagogik & profesional guru.</p>
                        </div>
                        <!-- Card 3 -->
                        <div
                            class="bg-emerald-50/60 dark:bg-slate-800/60 p-6 rounded-2xl shadow-md border border-emerald-500/20 hover:shadow-xl hover:border-emerald-500/50 hover:-translate-y-1 transition-all duration-300 group" data-aos="fade-up" data-aos-delay="300">
                            <div
                                class="w-12 h-12 rounded-xl bg-emerald-100 dark:bg-slate-800 text-emerald-500 flex items-center justify-center text-xl mb-6 group-hover:scale-110 transition-transform">
                                <i class="fas fa-award"></i>
                            </div>
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Apresiasi & Penghargaan</h3>
                            <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed">Pemilihan guru berprestasi dan pameran
                                inovasi
                                karya guru se-Jawa Barat.</p>
                        </div>
                        <!-- Card 4 -->
                        <div
                            class="bg-purple-50/60 dark:bg-slate-800/60 p-6 rounded-2xl shadow-md border border-purple-500/20 hover:shadow-xl hover:border-purple-500/50 hover:-translate-y-1 transition-all duration-300 group" data-aos="fade-up" data-aos-delay="400">
                            <div
                                class="w-12 h-12 rounded-xl bg-slate-50 dark:bg-slate-800 text-purple-500 flex items-center justify-center text-xl mb-6 group-hover:scale-110 transition-transform">
                                <i class="fas fa-handshake"></i>
                            </div>
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-2">Kolaborasi & Kemitraan</h3>
                            <p class="text-slate-500 dark:text-slate-400 text-sm leading-relaxed">Kerja sama dengan DUDI untuk magang guru
                                dan
                                penyaluran lulusan SMK.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Info Section -->
            <div class="w-full bg-slate-50 dark:bg-slate-800/20 py-20 border-b border-slate-100 dark:border-slate-800 relative">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid md:grid-cols-2 gap-12">
                    <!-- Pengumuman -->
                    <div>
                        <div class="border-l-8 border-gold pl-4 mb-2">
                            <h2 class="text-2xl md:text-3xl font-black text-slate-900 dark:text-white uppercase tracking-tighter">
                                Pengumuman
                            </h2>
                        </div>
                        <p class="text-xs font-bold tracking-wider text-mgmp uppercase mb-6 pl-4">Informasi
                            Penting
                        </p>

                        <div class="space-y-3">
                            <div
                                class="bg-white dark:bg-slate-900 p-4 border border-slate-200 dark:border-slate-700 shadow-md rounded-xl hover:shadow-lg hover:border-mgmp/40 hover:-translate-y-1 transition-all duration-300 cursor-pointer flex justify-between items-center group">
                                <div>
                                    <h4
                                        class="font-bold text-slate-800 dark:text-slate-100 group-hover:text-mgmp transition-colors text-sm mb-1">
                                        Pendaftaran Anggota MGMP KIK Jawa Barat 2025/2026</h4>
                                    <div class="flex items-center text-[10px] text-slate-500 dark:text-slate-400 gap-2">
                                        <span><i class="far fa-calendar-alt mr-1"></i> 20 Juni 2025</span>
                                        <span
                                            class="bg-amber-100 text-amber-700 px-2 py-0.5 rounded font-semibold">Penting</span>
                                    </div>
                                </div>
                                <i
                                    class="fas fa-chevron-right text-slate-300 group-hover:text-mgmp transition-colors text-xs"></i>
                            </div>
                            <div
                                class="bg-white dark:bg-slate-900 p-4 border border-slate-200 dark:border-slate-700 shadow-md rounded-xl hover:shadow-lg hover:border-mgmp/40 hover:-translate-y-1 transition-all duration-300 cursor-pointer flex justify-between items-center group">
                                <div>
                                    <h4
                                        class="font-bold text-slate-800 dark:text-slate-100 group-hover:text-mgmp transition-colors text-sm mb-1">
                                        Jadwal Rapat Pleno Semester Ganjil 2025</h4>
                                    <div class="flex items-center text-[10px] text-slate-500 dark:text-slate-400 gap-2">
                                        <span><i class="far fa-calendar-alt mr-1"></i> 15 Juni 2025</span>
                                    </div>
                                </div>
                                <i
                                    class="fas fa-chevron-right text-slate-300 group-hover:text-mgmp transition-colors text-xs"></i>
                            </div>
                            <div
                                class="bg-white dark:bg-slate-900 p-4 border border-slate-200 dark:border-slate-700 shadow-md rounded-xl hover:shadow-lg hover:border-mgmp/40 hover:-translate-y-1 transition-all duration-300 cursor-pointer flex justify-between items-center group">
                                <div>
                                    <h4
                                        class="font-bold text-slate-800 dark:text-slate-100 group-hover:text-mgmp transition-colors text-sm mb-1">
                                        Penyerahan Berkas Sertifikasi Triwulan 2</h4>
                                    <div class="flex items-center text-[10px] text-slate-500 dark:text-slate-400 gap-2">
                                        <span><i class="far fa-calendar-alt mr-1"></i> 10 Juli 2025</span>
                                        <span
                                            class="bg-blue-100 text-blue-700 px-2 py-0.5 rounded font-semibold">Tenggat</span>
                                    </div>
                                </div>
                                <i
                                    class="fas fa-chevron-right text-slate-300 group-hover:text-mgmp transition-colors text-xs"></i>
                            </div>
                            <div
                                class="p-4 border border-slate-100 dark:border-slate-800 rounded-xl hover:shadow-sm transition-all cursor-pointer flex justify-between items-center group bg-white dark:bg-slate-900">
                                <div>
                                    <h4
                                        class="font-bold text-slate-800 dark:text-slate-100 group-hover:text-mgmp transition-colors text-sm mb-1">
                                        Pendataan Guru PKK Calon Instruktur Nasional</h4>
                                    <div class="flex items-center text-[10px] text-slate-500 dark:text-slate-400 gap-2">
                                        <span><i class="far fa-calendar-alt mr-1"></i> 25 Juli 2025</span>
                                    </div>
                                </div>
                                <i
                                    class="fas fa-chevron-right text-slate-300 group-hover:text-mgmp transition-colors text-xs"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Tentang -->
                    <div>
                        <div class="border-l-8 border-gold pl-4 mb-2">
                            <h2 class="text-2xl md:text-3xl font-black text-slate-900 dark:text-white uppercase tracking-tighter">MGMP
                                PKK
                                Jawa Barat</h2>
                        </div>
                        <p class="text-xs font-bold tracking-wider text-mgmp uppercase mb-4 pl-4">Tentang
                            Organisasi</p>
                        <p class="text-slate-600 dark:text-slate-300 text-sm leading-relaxed mb-4 text-justify">
                            Musyawarah Guru Mata Pelajaran (MGMP) Pendidikan Kesejahteraan Keluarga (PKK) Jawa Barat
                            adalah
                            wadah profesional bagi para guru PKK di tingkat SMA/SMK/MA se-Jawa Barat. Kami
                            hadir
                            untuk mendorong peningkatan kompetensi, kreativitas, dan profesionalisme guru PKK demi
                            terwujudnya pendidikan berkualitas.
                        </p>
                        <a href="#" class="text-mgmp font-semibold text-sm hover:underline">Pelajari lebih
                            lanjut
                            &rarr;</a>
                    </div>
                </div>
            </div>

            <!-- FAQ Section -->
            <div class="w-full bg-white dark:bg-slate-900 py-20 border-b border-slate-100 dark:border-slate-800 relative">
                <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-12 flex flex-col items-center">
                        <p class="text-sm font-bold tracking-wider text-mgmp uppercase mb-3">Tanya Jawab</p>
                        <div class="relative inline-block mb-6">
                            <h2 class="text-3xl md:text-4xl font-black text-slate-900 dark:text-white uppercase tracking-tighter">
                                FAQ Keanggotaan
                            </h2>
                            <div
                                class="absolute -bottom-3 left-1/2 -translate-x-1/2 w-24 h-1.5 bg-gold rounded-full">
                            </div>
                        </div>
                        <p class="text-slate-500 dark:text-slate-400 max-w-2xl mx-auto text-sm">Pertanyaan yang paling sering ditanyakan
                            oleh calon anggota maupun anggota aktif MGMP KIK Jawa Barat.</p>
                    </div>

                    <div class="space-y-4">
                        <!-- FAQ Item 1 -->
                        <details
                            class="group bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl shadow-sm [&_summary::-webkit-details-marker]:hidden">
                            <summary
                                class="flex cursor-pointer items-center justify-between gap-1.5 rounded-2xl p-6 text-slate-900 dark:text-white font-bold hover:text-mgmp transition-colors">
                                <span>Bagaimana cara mendaftar menjadi anggota MGMP KIK Jawa Barat?</span>
                                <span class="shrink-0 transition duration-300 group-open:-rotate-180">
                                    <i class="fas fa-chevron-down text-mgmp"></i>
                                </span>
                            </summary>
                            <div
                                class="px-6 pb-6 text-slate-600 dark:text-slate-300 text-sm leading-relaxed border-t border-slate-100 dark:border-slate-800 pt-4 mt-2">
                                Pendaftaran dapat dilakukan melalui portal anggota yang akan segera dibuka. Anda perlu
                                menyiapkan scan SK Mengajar terakhir, pas foto, dan surat rekomendasi dari Kepala
                                Sekolah.
                            </div>
                        </details>

                        <!-- FAQ Item 2 -->
                        <details
                            class="group bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl shadow-sm [&_summary::-webkit-details-marker]:hidden">
                            <summary
                                class="flex cursor-pointer items-center justify-between gap-1.5 rounded-2xl p-6 text-slate-900 dark:text-white font-bold hover:text-mgmp transition-colors">
                                <span>Apakah anggota mendapatkan e-sertifikat dari setiap kegiatan?</span>
                                <span class="shrink-0 transition duration-300 group-open:-rotate-180">
                                    <i class="fas fa-chevron-down text-mgmp"></i>
                                </span>
                            </summary>
                            <div
                                class="px-6 pb-6 text-slate-600 dark:text-slate-300 text-sm leading-relaxed border-t border-slate-100 dark:border-slate-800 pt-4 mt-2">
                                Ya, setiap peserta yang mengikuti pelatihan atau workshop resmi yang diselenggarakan
                                oleh MGMP KIK Jawa Barat dan memenuhi syarat kehadiran minimal akan mendapatkan e-sertifikat
                                dengan jam pelajaran (JP) yang diakui.
                            </div>
                        </details>

                        <!-- FAQ Item 3 -->
                        <details
                            class="group bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl shadow-sm [&_summary::-webkit-details-marker]:hidden">
                            <summary
                                class="flex cursor-pointer items-center justify-between gap-1.5 rounded-2xl p-6 text-slate-900 dark:text-white font-bold hover:text-mgmp transition-colors">
                                <span>Kapan jadwal rutin pertemuan MGMP tingkat kabupaten dilaksanakan?</span>
                                <span class="shrink-0 transition duration-300 group-open:-rotate-180">
                                    <i class="fas fa-chevron-down text-mgmp"></i>
                                </span>
                            </summary>
                            <div
                                class="px-6 pb-6 text-slate-600 dark:text-slate-300 text-sm leading-relaxed border-t border-slate-100 dark:border-slate-800 pt-4 mt-2">
                                Pertemuan rutin tingkat kabupaten (Rapat Pleno) biasanya diadakan 2 kali dalam satu tahun
                                ajaran (awal semester ganjil dan genap). Namun, untuk kegiatan pelatihan teknis bisa
                                diadakan setiap bulan.
                            </div>
                        </details>
                    </div>
                </div>
            </div>

            <!-- Logo Mitra Section -->
            <div class="w-full bg-slate-50 dark:bg-slate-800 py-16 border-b border-slate-100 dark:border-slate-800 relative">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <p class="text-center text-sm font-bold tracking-wider text-slate-400 dark:text-slate-500 uppercase mb-8">Berkolaborasi
                        Bersama Mitra Terbaik</p>
                    <div class="flex flex-wrap justify-center items-center gap-8 md:gap-16">
                        <div
                            class="flex items-center gap-2 text-slate-500 dark:text-slate-400 hover:text-mgmp opacity-60 hover:opacity-100 transition-all cursor-pointer grayscale hover:grayscale-0">
                            <i class="fas fa-university text-4xl"></i>
                            <span class="font-bold text-xl">Disdik Jawa Barat</span>
                        </div>
                        <div
                            class="flex items-center gap-2 text-slate-500 dark:text-slate-400 hover:text-blue-700 opacity-60 hover:opacity-100 transition-all cursor-pointer grayscale hover:grayscale-0">
                            <i class="fas fa-building text-4xl"></i>
                            <span class="font-bold text-xl">KEMDIKBUD</span>
                        </div>
                        <div
                            class="flex items-center gap-2 text-slate-500 dark:text-slate-400 hover:text-gold opacity-60 hover:opacity-100 transition-all cursor-pointer grayscale hover:grayscale-0">
                            <i class="fas fa-industry text-4xl"></i>
                            <span class="font-bold text-xl">DUDI Partner</span>
                        </div>
                        <div
                            class="flex items-center gap-2 text-slate-500 dark:text-slate-400 hover:text-amber-500 opacity-60 hover:opacity-100 transition-all cursor-pointer grayscale hover:grayscale-0">
                            <i class="fas fa-award text-4xl"></i>
                            <span class="font-bold text-xl">LSP Jawa Barat</span>
                        </div>
                        <div
                            class="flex items-center gap-2 text-slate-500 dark:text-slate-400 hover:text-teal-600 opacity-60 hover:opacity-100 transition-all cursor-pointer grayscale hover:grayscale-0">
                            <i class="fas fa-laptop-code text-4xl"></i>
                            <span class="font-bold text-xl">EdTech Mitra</span>
                        </div>
                    </div>
                </div>
            </div>


        </section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mendapatkan jam saat ini dalam zona waktu WIB (Asia/Jakarta)
        const hour = parseInt(new Intl.DateTimeFormat('en-US', { timeZone: 'Asia/Jakarta', hour: 'numeric', hourCycle: 'h23' }).format(new Date()));
        
        let greetings = [];
        if (hour >= 3 && hour < 10) {
            greetings = ['Wilujeng Enjing'];
        } else if (hour >= 10 && hour < 15) {
            greetings = ['Wilujeng Siang'];
        } else if (hour >= 15 && hour < 18) {
            greetings = ['Wilujeng Sonten'];
        } else {
            greetings = ['Wilujeng Wengi'];
        }

        const typewriterEl = document.getElementById('greeting-typewriter');
        if (!typewriterEl) return;

        let wordIndex = 0;
        let charIndex = 0;
        let isDeleting = false;

        function typeWriter() {
            const currentWord = greetings[wordIndex];
            
            if (isDeleting) {
                typewriterEl.textContent = currentWord.substring(0, charIndex - 1);
                charIndex--;
            } else {
                typewriterEl.textContent = currentWord.substring(0, charIndex + 1);
                charIndex++;
            }

            let typeSpeed = isDeleting ? 40 : 120;

            if (!isDeleting && charIndex === currentWord.length) {
                typeSpeed = 3000; // Pause longer when word is fully typed
                isDeleting = true;
            } else if (isDeleting && charIndex === 0) {
                isDeleting = false;
                wordIndex = (wordIndex + 1) % greetings.length;
                typeSpeed = 600; // Pause before typing the new word
            }

            setTimeout(typeWriter, typeSpeed);
        }

        // Start the animation with a slight delay so it looks natural
        setTimeout(typeWriter, 800);
    });
</script>
@endpush
