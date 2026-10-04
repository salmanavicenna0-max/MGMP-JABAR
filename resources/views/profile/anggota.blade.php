@extends('layouts.app')

@section('title', 'Profil Keanggotaan - MGMP KIK')

@push('styles')
<style>
/* Bagan Organisasi (Org Chart) */

        /* Cards Layout */
        .org-node {
            display: inline-flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 16px 12px;
            width: 100%;
            max-width: 250px;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .org-node:hover {
            transform: translateY(-5px);
            border-color: #0f766e;
            box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1);
        }
        
        .org-node:active { transform: scale(0.98); }

        .org-node img, .org-node .w-10 {
            width: 64px !important;
            height: 64px !important;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 10px !important;
            border: 2px solid #0f766e;
            background: #f8fafc;
        }

        .org-node h4 {
            font-size: 1.05rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 4px;
            line-height: 1.2;
        }

        .org-node p {
            font-size: 0.75rem;
            font-weight: 600;
            color: #0f766e;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin: 0;
        }

        .org-node.border-dashed {
            background: #f8fafc;
            border: 1px dashed #cbd5e1;
            cursor: default;
        }
        .org-node.border-dashed:hover {
            transform: none;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
            border-color: #cbd5e1;
        }

        /* Dark mode adjustments */
        html.dark .org-node {
            background: #1e293b;
            border-color: #334155;
            box-shadow: 0 4px 15px -3px rgba(0,0,0,0.3);
        }
        html.dark .org-node h4 { color: #f8fafc; }
        html.dark .org-node p { color: #2dd4bf; }
        html.dark .org-node img { border-color: #2dd4bf; background: #0f172a; }
        html.dark .org-node.border-dashed { background: #0f172a; border-color: #334155; }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<div class="relative bg-gradient-to-br from-mgmp via-[#083a64] to-blue-900 text-white overflow-hidden py-16 md:py-20 shadow-inner">
    <div class="absolute inset-0 bg-pattern-dots opacity-10"></div>
    <div class="absolute -top-24 -right-24 w-96 h-96 bg-white opacity-10 rounded-full blur-3xl"></div>
    <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-gold opacity-20 rounded-full blur-3xl"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 flex flex-col items-center justify-center text-center">
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-black uppercase tracking-tight mb-6 drop-shadow-lg">
            Profil & Visi Misi <span class="text-gold">MGMP KIK</span>
        </h1>
        <p class="text-lg md:text-2xl font-medium text-blue-100 max-w-2xl drop-shadow-sm border-t border-white/20 pt-6">
            Provinsi Jawa Barat
        </p>
    </div>
</div>

<div class="py-16 relative overflow-hidden z-0 bg-slate-50 dark:bg-slate-900 bg-pattern-dots">

            <!-- Decorative Blobs -->
            <div class="blob-shape bg-mgmp/10 w-[500px] h-[500px] top-[10%] -right-[10%]"></div>
            <div class="blob-shape bg-gold/10 w-[400px] h-[400px] bottom-[20%] -left-[5%]"></div>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
                <div class="mb-16">
                    <!-- Visi & Misi -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-16 items-stretch">
                        <!-- Visi -->
                        <div class="h-full bg-blue-50/80 dark:bg-blue-900/10 border border-blue-100 dark:border-blue-800/50 shadow-md p-8 md:p-12 rounded-3xl flex flex-col justify-center hover:shadow-lg transition-all duration-300 relative overflow-hidden group">
                            <!-- Vector / Graphic Element -->
                            <i class="fas fa-rocket absolute -right-10 -bottom-10 text-[14rem] text-mgmp/5 dark:text-mgmp/10 group-hover:scale-110 group-hover:-rotate-12 transition-transform duration-700"></i>
                            <div class="absolute top-0 left-0 w-2 h-full bg-mgmp"></div>
                            
                            <div class="flex items-center gap-4 mb-8 relative z-10">
                                <div class="w-14 h-14 rounded-2xl bg-mgmp text-white flex items-center justify-center shrink-0 shadow-lg shadow-mgmp/30">
                                    <i class="fas fa-eye text-2xl"></i>
                                </div>
                                <h3 class="text-3xl font-black text-slate-900 dark:text-white uppercase tracking-widest">Visi</h3>
                            </div>
                            <div class="relative z-10 pl-6 md:pl-8 border-l-4 border-mgmp/30 py-2">
                                <i class="fas fa-quote-left text-5xl text-mgmp/20 absolute -top-6 -left-5"></i>
                                <p class="text-slate-800 dark:text-slate-200 text-xl md:text-2xl font-bold italic leading-relaxed">
                                    "Menjadi MGMP Kreativitas, Inovasi, dan Kewirausahaan yang profesional, inovatif, dan kolaboratif dalam membentuk guru unggul serta generasi entrepreneur yang berdaya saing global."
                                </p>
                            </div>
                        </div>

                        <!-- Misi -->
                        <div class="h-full flex flex-col justify-center bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 shadow-md p-8 md:p-12 rounded-3xl hover:shadow-lg transition-all duration-300 relative overflow-hidden group">
                            <!-- Vector / Graphic Element -->
                            <i class="fas fa-tasks absolute -right-10 -bottom-10 text-[14rem] text-slate-100 dark:text-slate-700/30 group-hover:scale-110 group-hover:rotate-12 transition-transform duration-700"></i>
                            <div class="absolute top-0 left-0 w-2 h-full bg-gold"></div>
                            
                            <div class="flex items-center gap-4 mb-8 relative z-10">
                                <div class="w-14 h-14 rounded-2xl bg-gold text-white flex items-center justify-center shrink-0 shadow-lg shadow-gold/30">
                                    <i class="fas fa-bullseye text-2xl"></i>
                                </div>
                                <h3 class="text-3xl font-black text-slate-900 dark:text-white uppercase tracking-widest">Misi</h3>
                            </div>
                            <div class="flex flex-col gap-6 relative z-10">
                                <div class="flex gap-5 items-start">
                                    <div class="w-10 h-10 rounded-full bg-gold/10 text-gold flex items-center justify-center shrink-0 font-black text-lg border border-gold/20 shadow-sm mt-0.5">1</div>
                                    <p class="text-slate-700 dark:text-slate-300 font-medium leading-relaxed text-[15px]">Mengembangkan kompetensi guru secara profesional dan berkelanjutan.</p>
                                </div>
                                <div class="flex gap-5 items-start">
                                    <div class="w-10 h-10 rounded-full bg-gold/10 text-gold flex items-center justify-center shrink-0 font-black text-lg border border-gold/20 shadow-sm mt-0.5">2</div>
                                    <p class="text-slate-700 dark:text-slate-300 font-medium leading-relaxed text-[15px]">Menghadirkan pembelajaran kreatif, inovatif, dan berbasis proyek.</p>
                                </div>
                                <div class="flex gap-5 items-start">
                                    <div class="w-10 h-10 rounded-full bg-gold/10 text-gold flex items-center justify-center shrink-0 font-black text-lg border border-gold/20 shadow-sm mt-0.5">3</div>
                                    <p class="text-slate-700 dark:text-slate-300 font-medium leading-relaxed text-[15px]">Memperkuat sinergi dengan dunia usaha, industri, dan perguruan tinggi.</p>
                                </div>
                                <div class="flex gap-5 items-start">
                                    <div class="w-10 h-10 rounded-full bg-gold/10 text-gold flex items-center justify-center shrink-0 font-black text-lg border border-gold/20 shadow-sm mt-0.5">4</div>
                                    <p class="text-slate-700 dark:text-slate-300 font-medium leading-relaxed text-[15px]">Menghasilkan inovasi pembelajaran, karya ilmiah, dan produk kewirausahaan.</p>
                                </div>
                                <div class="flex gap-5 items-start">
                                    <div class="w-10 h-10 rounded-full bg-gold/10 text-gold flex items-center justify-center shrink-0 font-black text-lg border border-gold/20 shadow-sm mt-0.5">5</div>
                                    <p class="text-slate-700 dark:text-slate-300 font-medium leading-relaxed text-[15px]">Menumbuhkan karakter, kreativitas, dan jiwa entrepreneur peserta didik.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tagline -->
                    <div class="max-w-4xl bg-gradient-to-r from-mgmp to-blue-800 p-8 md:p-10 rounded-2xl shadow-xl mb-16 relative overflow-hidden transform hover:scale-[1.01] transition-transform duration-300">
                        <!-- Decorative bg -->
                        <div class="absolute -right-10 -top-10 w-40 h-40 bg-white opacity-5 rounded-full blur-2xl"></div>
                        <div class="absolute -left-10 -bottom-10 w-40 h-40 bg-gold opacity-10 rounded-full blur-2xl"></div>
                        <i class="fas fa-quote-left absolute top-6 left-8 text-white/10 text-6xl"></i>
                        
                        <div class="relative z-10 text-center">
                            <p class="text-xs font-bold uppercase tracking-[0.2em] text-gold mb-3">Tagline MGMP</p>
                            <h3 class="text-2xl md:text-3xl font-light text-white italic leading-snug">
                                "Menginspirasi Guru, <span class="font-bold text-gold">Menciptakan Inovasi</span>, Membangun Entrepreneur."
                            </h3>
                        </div>
                    </div>
                </div>

                <!-- Roadmap Strategis -->
                <div class="mb-16">
                    <div class="mb-10 text-center md:text-left flex flex-col md:flex-row md:items-end justify-between border-b-2 border-slate-100 dark:border-slate-800 pb-4">
                        <div>
                            <h2 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight mb-2">Roadmap Strategis</h2>
                            <p class="text-sm font-semibold tracking-wider text-mgmp uppercase">MGMP Kreativitas, Inovasi dan Kewirausahaan (KIK)</p>
                        </div>
                    </div>

                    <div data-aos="fade-up" class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 border-t-4 border-t-mgmp shadow-md p-8 rounded-xl mb-16 relative overflow-hidden max-w-4xl md:ml-6">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-mgmp/5 rounded-bl-full z-0"></div>
                        <div class="relative z-10">
                            <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">Arah Strategis</h3>
                            <p class="text-slate-500 dark:text-slate-400 text-sm mb-6 pb-6 border-b border-slate-100 dark:border-slate-800">Roadmap lima tahun difokuskan pada 5 Pilar Transformasi MGMP KIK.</p>
                            <div class="overflow-x-auto">
                                <table class="w-full text-sm text-left">
                                    <thead>
                                        <tr class="bg-blue-50/80 dark:bg-blue-900/20 text-mgmp dark:text-blue-400 border-b-2 border-mgmp/20 dark:border-blue-500/30">
                                            <th class="px-6 py-4 font-extrabold uppercase tracking-widest rounded-tl-lg text-sm">Pilar</th>
                                            <th class="px-6 py-4 font-extrabold uppercase tracking-widest rounded-tr-lg text-sm">Fokus</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-slate-600 dark:text-slate-300 divide-y divide-slate-100 dark:divide-slate-700/50">
                                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors group">
                                            <td class="px-6 py-4 font-black text-slate-800 dark:text-white w-1/3 group-hover:text-mgmp dark:group-hover:text-blue-400 transition-colors text-[15px]">Professional Teacher</td>
                                            <td class="px-6 py-4 font-medium text-[15px]">Peningkatan kompetensi guru</td>
                                        </tr>
                                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors group">
                                            <td class="px-6 py-4 font-black text-slate-800 dark:text-white group-hover:text-mgmp dark:group-hover:text-blue-400 transition-colors text-[15px]">Innovative Learning</td>
                                            <td class="px-6 py-4 font-medium text-[15px]">Transformasi pembelajaran</td>
                                        </tr>
                                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors group">
                                            <td class="px-6 py-4 font-black text-slate-800 dark:text-white group-hover:text-mgmp dark:group-hover:text-blue-400 transition-colors text-[15px]">Strategic Partnership</td>
                                            <td class="px-6 py-4 font-medium text-[15px]">Kolaborasi dengan DUDI dan perguruan tinggi</td>
                                        </tr>
                                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors group">
                                            <td class="px-6 py-4 font-black text-slate-800 dark:text-white group-hover:text-mgmp dark:group-hover:text-blue-400 transition-colors text-[15px]">Innovation & Research</td>
                                            <td class="px-6 py-4 font-medium text-[15px]">Publikasi, inovasi, dan karya guru</td>
                                        </tr>
                                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors group">
                                            <td class="px-6 py-4 font-black text-slate-800 dark:text-white rounded-bl-lg group-hover:text-mgmp dark:group-hover:text-blue-400 transition-colors text-[15px]">Entrepreneurship Ecosystem</td>
                                            <td class="px-6 py-4 font-medium rounded-br-lg text-[15px]">Penguatan kewirausahaan peserta didik</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="mb-10 text-center md:text-left flex flex-col md:flex-row md:items-end justify-between border-b-2 border-slate-100 dark:border-slate-800 pb-4">
                        <div>
                            <h3 class="text-3xl font-black text-slate-900 dark:text-white tracking-tight mb-2">Timeline 2025–2029</h3>
                            <p class="text-sm font-semibold tracking-wider text-mgmp uppercase">Langkah Konkret Setiap Tahun</p>
                        </div>
                    </div>
                    
                    <div class="max-w-5xl mx-auto" id="timeline-tabs">
                        <!-- Tab Headers -->
                        <div class="flex flex-nowrap overflow-x-auto pb-4 mb-6 border-b border-slate-200 dark:border-slate-700 gap-2 md:gap-4 scrollbar-hide">
                            <button onclick="switchTab('2025')" id="tab-btn-2025" class="tab-btn active bg-mgmp text-white shadow-md px-8 py-3 rounded-full text-sm font-bold whitespace-nowrap transition-all duration-300 border border-transparent">2025</button>
                            <button onclick="switchTab('2026')" id="tab-btn-2026" class="tab-btn bg-white dark:bg-slate-900 text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-800 px-8 py-3 rounded-full text-sm font-bold whitespace-nowrap transition-all duration-300 border border-slate-200 dark:border-slate-700">2026</button>
                            <button onclick="switchTab('2027')" id="tab-btn-2027" class="tab-btn bg-white dark:bg-slate-900 text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-800 px-8 py-3 rounded-full text-sm font-bold whitespace-nowrap transition-all duration-300 border border-slate-200 dark:border-slate-700">2027</button>
                            <button onclick="switchTab('2028')" id="tab-btn-2028" class="tab-btn bg-white dark:bg-slate-900 text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-800 px-8 py-3 rounded-full text-sm font-bold whitespace-nowrap transition-all duration-300 border border-slate-200 dark:border-slate-700">2028</button>
                            <button onclick="switchTab('2029')" id="tab-btn-2029" class="tab-btn bg-white dark:bg-slate-900 text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-800 px-8 py-3 rounded-full text-sm font-bold whitespace-nowrap transition-all duration-300 border border-slate-200 dark:border-slate-700">2029</button>
                        </div>
                        
                        <!-- Tab Content -->
                        <div class="relative min-h-[300px]">
                            <!-- 2025 -->
                            <div id="tab-content-2025" class="tab-content block bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 shadow-md p-8 rounded-xl relative overflow-hidden animate-fade-in">
                                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-mgmp to-blue-500"></div>
                                <div class="mb-8 pb-6 border-b border-slate-100 dark:border-slate-800 text-center md:text-left">
                                    <h4 class="text-4xl font-black text-slate-900 dark:text-white mb-2">2025</h4>
                                    <p class="text-slate-500 dark:text-slate-400 font-medium text-lg">Penguatan Organisasi dan Kompetensi Guru</p>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                                    <div class="bg-slate-50 dark:bg-slate-800/50 p-6 rounded-xl border border-slate-100 dark:border-slate-700">
                                        <h5 class="text-sm font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-4 flex items-center gap-2"><i class="fas fa-list-check text-mgmp"></i> Program Prioritas</h5>
                                        <ul class="text-[15px] text-slate-600 dark:text-slate-400 space-y-3 list-disc pl-5 marker:text-mgmp">
                                            <li>Penataan organisasi & SOP MGMP</li>
                                            <li>Penyusunan Program Kerja Lima Tahun</li>
                                            <li>Workshop Kurikulum KIK, ATP & Modul Ajar</li>
                                            <li>Pelatihan: Deep Learning, PjBL, Design Thinking, AI</li>
                                            <li>Lesson Study</li>
                                        </ul>
                                    </div>
                                    <div class="bg-blue-50/50 dark:bg-blue-900/10 p-6 rounded-xl border border-blue-100 dark:border-blue-900/30">
                                        <h5 class="text-sm font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-4 flex items-center gap-2"><i class="fas fa-bullseye text-gold"></i> Target</h5>
                                        <ul class="text-[15px] text-slate-600 dark:text-slate-400 space-y-3 list-disc pl-5 marker:text-gold">
                                            <li>100% guru mengikuti pelatihan</li>
                                            <li>Terbentuk database guru & Website aktif</li>
                                            <li>Bank Modul Ajar mulai tersedia</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- 2026 -->
                            <div id="tab-content-2026" class="tab-content hidden bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 shadow-md p-8 rounded-xl relative overflow-hidden animate-fade-in">
                                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-mgmp to-blue-500"></div>
                                <div class="mb-8 pb-6 border-b border-slate-100 dark:border-slate-800 text-center md:text-left">
                                    <h4 class="text-4xl font-black text-slate-900 dark:text-white mb-2">2026</h4>
                                    <p class="text-slate-500 dark:text-slate-400 font-medium text-lg">Transformasi Pembelajaran</p>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                                    <div class="bg-slate-50 dark:bg-slate-800/50 p-6 rounded-xl border border-slate-100 dark:border-slate-700">
                                        <h5 class="text-sm font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-4 flex items-center gap-2"><i class="fas fa-list-check text-mgmp"></i> Program Prioritas</h5>
                                        <ul class="text-[15px] text-slate-600 dark:text-slate-400 space-y-3 list-disc pl-5 marker:text-mgmp">
                                            <li>Open Class & Teaching Factory Sharing</li>
                                            <li>Penyusunan Modul & Bank Soal Digital</li>
                                            <li>Digital Assessment</li>
                                            <li>Webinar Nasional & Kompetisi Best Practice</li>
                                            <li>Coaching PTK</li>
                                        </ul>
                                    </div>
                                    <div class="bg-blue-50/50 dark:bg-blue-900/10 p-6 rounded-xl border border-blue-100 dark:border-blue-900/30">
                                        <h5 class="text-sm font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-4 flex items-center gap-2"><i class="fas fa-bullseye text-gold"></i> Target</h5>
                                        <ul class="text-[15px] text-slate-600 dark:text-slate-400 space-y-3 list-disc pl-5 marker:text-gold">
                                            <li>Seluruh sekolah menerapkan Project Based Learning</li>
                                            <li>Minimal satu inovasi pembelajaran per guru</li>
                                            <li>Portal Digital MGMP berjalan aktif</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- 2027 -->
                            <div id="tab-content-2027" class="tab-content hidden bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 shadow-md p-8 rounded-xl relative overflow-hidden animate-fade-in">
                                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-mgmp to-blue-500"></div>
                                <div class="mb-8 pb-6 border-b border-slate-100 dark:border-slate-800 text-center md:text-left">
                                    <h4 class="text-4xl font-black text-slate-900 dark:text-white mb-2">2027</h4>
                                    <p class="text-slate-500 dark:text-slate-400 font-medium text-lg">Kolaborasi dan Hilirisasi</p>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                                    <div class="bg-slate-50 dark:bg-slate-800/50 p-6 rounded-xl border border-slate-100 dark:border-slate-700">
                                        <h5 class="text-sm font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-4 flex items-center gap-2"><i class="fas fa-list-check text-mgmp"></i> Program Prioritas</h5>
                                        <ul class="text-[15px] text-slate-600 dark:text-slate-400 space-y-3 list-disc pl-5 marker:text-mgmp">
                                            <li>MoU dengan DUDI & Perguruan Tinggi</li>
                                            <li>Kelas Praktisi & Program Guru Magang</li>
                                            <li>Business Mentor & Inkubasi Bisnis Sekolah</li>
                                            <li>Expo Produk Siswa</li>
                                            <li>Business Plan Competition</li>
                                        </ul>
                                    </div>
                                    <div class="bg-blue-50/50 dark:bg-blue-900/10 p-6 rounded-xl border border-blue-100 dark:border-blue-900/30">
                                        <h5 class="text-sm font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-4 flex items-center gap-2"><i class="fas fa-bullseye text-gold"></i> Target</h5>
                                        <ul class="text-[15px] text-slate-600 dark:text-slate-400 space-y-3 list-disc pl-5 marker:text-gold">
                                            <li>Terjalin kemitraan aktif dengan DUDI & perguruan tinggi</li>
                                            <li>Setiap sekolah memiliki minimal satu program kewirausahaan</li>
                                            <li>Terbentuk jejaring mentor bisnis</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- 2028 -->
                            <div id="tab-content-2028" class="tab-content hidden bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 shadow-md p-8 rounded-xl relative overflow-hidden animate-fade-in">
                                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-mgmp to-blue-500"></div>
                                <div class="mb-8 pb-6 border-b border-slate-100 dark:border-slate-800 text-center md:text-left">
                                    <h4 class="text-4xl font-black text-slate-900 dark:text-white mb-2">2028</h4>
                                    <p class="text-slate-500 dark:text-slate-400 font-medium text-lg">Inovasi, Riset, dan Publikasi</p>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                                    <div class="bg-slate-50 dark:bg-slate-800/50 p-6 rounded-xl border border-slate-100 dark:border-slate-700">
                                        <h5 class="text-sm font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-4 flex items-center gap-2"><i class="fas fa-list-check text-mgmp"></i> Program Prioritas</h5>
                                        <ul class="text-[15px] text-slate-600 dark:text-slate-400 space-y-3 list-disc pl-5 marker:text-mgmp">
                                            <li>Penelitian Tindakan Kelas (PTK) & Jurnal MGMP</li>
                                            <li>Penulisan Buku Guru & Siswa</li>
                                            <li>Seminar Nasional</li>
                                            <li>Pendaftaran HKI & Hak Cipta Modul</li>
                                            <li>Produksi Video Pembelajaran & Podcast</li>
                                        </ul>
                                    </div>
                                    <div class="bg-blue-50/50 dark:bg-blue-900/10 p-6 rounded-xl border border-blue-100 dark:border-blue-900/30">
                                        <h5 class="text-sm font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-4 flex items-center gap-2"><i class="fas fa-bullseye text-gold"></i> Target</h5>
                                        <ul class="text-[15px] text-slate-600 dark:text-slate-400 space-y-3 list-disc pl-5 marker:text-gold">
                                            <li>Terbit buku karya guru & publikasi artikel ilmiah</li>
                                            <li>Inovasi pembelajaran terdokumentasi dengan baik</li>
                                            <li>HKI dan hak cipta bertambah</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- 2029 -->
                            <div id="tab-content-2029" class="tab-content hidden bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 shadow-md p-8 rounded-xl relative overflow-hidden animate-fade-in">
                                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-mgmp to-blue-500"></div>
                                <div class="mb-8 pb-6 border-b border-slate-100 dark:border-slate-800 text-center md:text-left">
                                    <h4 class="text-4xl font-black text-slate-900 dark:text-white mb-2">2029</h4>
                                    <p class="text-slate-500 dark:text-slate-400 font-medium text-lg">Center of Excellence</p>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                                    <div class="bg-slate-50 dark:bg-slate-800/50 p-6 rounded-xl border border-slate-100 dark:border-slate-700">
                                        <h5 class="text-sm font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-4 flex items-center gap-2"><i class="fas fa-list-check text-mgmp"></i> Program Prioritas</h5>
                                        <ul class="text-[15px] text-slate-600 dark:text-slate-400 space-y-3 list-disc pl-5 marker:text-mgmp">
                                            <li>MGMP Digital Academy & AI Learning Center</li>
                                            <li>Entrepreneur Camp & Startup School Competition</li>
                                            <li>Entrepreneur Festival</li>
                                            <li>International Webinar</li>
                                            <li>Benchmarking Nasional & Internasional</li>
                                        </ul>
                                    </div>
                                    <div class="bg-blue-50/50 dark:bg-blue-900/10 p-6 rounded-xl border border-blue-100 dark:border-blue-900/30">
                                        <h5 class="text-sm font-bold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-4 flex items-center gap-2"><i class="fas fa-bullseye text-gold"></i> Target</h5>
                                        <ul class="text-[15px] text-slate-600 dark:text-slate-400 space-y-3 list-disc pl-5 marker:text-gold">
                                            <li>MGMP menjadi rujukan nasional</li>
                                            <li>Guru menjadi narasumber tingkat nasional</li>
                                            <li>Produk siswa menembus pasar yang lebih luas</li>
                                            <li>Ekosistem pembelajaran inovatif berkelanjutan</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <script>
                        function switchTab(year) {
                            // hide all contents
                            document.querySelectorAll('.tab-content').forEach(el => {
                                el.classList.add('hidden');
                                el.classList.remove('block');
                            });
                            // reset all buttons
                            document.querySelectorAll('.tab-btn').forEach(btn => {
                                btn.classList.remove('bg-mgmp', 'text-white', 'shadow-md', 'active', 'border-transparent');
                                btn.classList.add('bg-white', 'dark:bg-slate-900', 'text-slate-500', 'hover:bg-slate-100', 'dark:hover:bg-slate-800', 'border-slate-200', 'dark:border-slate-700');
                            });
                            
                            // show target content
                            const content = document.getElementById('tab-content-' + year);
                            if(content) {
                                content.classList.remove('hidden');
                                content.classList.add('block');
                            }
                            
                            // highlight active button
                            const activeBtn = document.getElementById('tab-btn-' + year);
                            if(activeBtn) {
                                activeBtn.classList.remove('bg-white', 'dark:bg-slate-900', 'text-slate-500', 'hover:bg-slate-100', 'dark:hover:bg-slate-800', 'border-slate-200', 'dark:border-slate-700');
                                activeBtn.classList.add('bg-mgmp', 'text-white', 'shadow-md', 'active', 'border-transparent');
                            }
                        }
                    </script>
                </div>

                <!-- Struktur Organisasi -->
                <div class="mb-10 text-center md:text-left">
                    <div class="border-l-8 border-gold pl-4 mb-2 text-left inline-block w-full">
                        <h2 class="text-3xl font-black text-slate-900 dark:text-white uppercase tracking-tighter">Struktur Organisasi</h2>
                    </div>
                    <p class="text-sm font-bold tracking-wider text-mgmp uppercase pl-4 text-left">Susunan Pengurus</p>
                </div>

                                <div class="w-full py-8 overflow-hidden flex flex-col items-center">
                    
                    <!-- 1. Ketua -->
                    <div class="flex flex-col items-center relative z-10" data-aos="fade-up">
                        @foreach($strukturs->where('role', 'Ketua') as $item)
                        <div class="org-node relative z-10" onclick="openModal({{ $item->id }})">
                            <img src="{{ $item->display_image }}" alt="{{ $item->role }}">
                            <h4>{{ $item->display_name }}</h4>
                            <p>{{ $item->role }}</p>
                        </div>
                        @endforeach
                        <!-- Garis penghubung ke bawah -->
                        <div class="w-0.5 h-12 bg-slate-300 dark:bg-slate-600"></div>
                    </div>

                    <!-- 2. Sekretaris & Bendahara -->
                    <div class="relative w-full max-w-4xl flex flex-col items-center z-10" data-aos="fade-up" data-aos-delay="100">
                        <!-- Top horizontal line joining Sekretaris & Bendahara -->
                        <!-- Central Line: from Ketua down to Kepala Bidang -->
                        <div class="absolute left-1/2 top-0 bottom-[-48px] w-0.5 bg-slate-300 dark:bg-slate-600 -translate-x-1/2 z-0 hidden md:block"></div>
                        
                        <!-- Horizontal branch connecting Sekretaris and Bendahara -->
                        <div class="absolute top-12 left-[25%] right-[25%] h-0.5 bg-slate-300 dark:bg-slate-600 hidden md:block"></div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-12 md:gap-y-0 w-full mb-12">
                            <!-- Sekretaris -->
                            <div class="flex flex-col items-center relative h-full">
                                <!-- Top Stub -->
                                <div class="w-0.5 h-8 bg-slate-300 dark:bg-slate-600 hidden md:block absolute top-12 z-0"></div>
                                
                                <div class="flex flex-col items-center w-full relative pt-0 md:pt-20">
                                    <div class="org-node relative z-10 bg-slate-50 dark:bg-slate-800 border-dashed mb-6">
                                        <div class="w-10 h-10 rounded-full bg-slate-200 flex items-center justify-center text-slate-400 dark:text-slate-500 mb-2 mt-1">
                                            <i class="fas fa-pen-nib"></i>
                                        </div>
                                        <h4 class="text-slate-600 dark:text-slate-300">Sekretaris</h4>
                                    </div>
                                    <div class="flex flex-col gap-4 relative w-full items-center">
                                        <!-- Inner vertical line extending to bottom horizontal branch -->
                                        <div class="absolute left-1/2 top-[-24px] bottom-[80px] w-0.5 bg-slate-300 dark:bg-slate-600 -translate-x-1/2 z-0 hidden md:block"></div>
                                        
                                        @foreach($strukturs->where('role', 'Sekretaris') as $item)
                                        <div class="org-node relative z-10" onclick="openModal({{ $item->id }})">
                                            <img src="{{ $item->display_image }}" alt="{{ $item->role }}">
                                            <h4>{{ $item->display_name }}</h4>
                                            <p>{{ $item->role }}</p>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                                
                            </div>

                            <!-- Bendahara -->
                            <div class="flex flex-col items-center relative h-full">
                                <!-- Top Stub -->
                                <div class="w-0.5 h-8 bg-slate-300 dark:bg-slate-600 hidden md:block absolute top-12 z-0"></div>
                                
                                <div class="flex flex-col items-center w-full relative pt-0 md:pt-20">
                                    <div class="org-node relative z-10 bg-slate-50 dark:bg-slate-800 border-dashed mb-6">
                                        <div class="w-10 h-10 rounded-full bg-slate-200 flex items-center justify-center text-slate-400 dark:text-slate-500 mb-2 mt-1">
                                            <i class="fas fa-wallet"></i>
                                        </div>
                                        <h4 class="text-slate-600 dark:text-slate-300">Bendahara</h4>
                                    </div>
                                    <div class="flex flex-col gap-4 relative w-full items-center">
                                        <!-- Inner vertical line extending to bottom horizontal branch -->
                                        <div class="absolute left-1/2 top-[-24px] bottom-[80px] w-0.5 bg-slate-300 dark:bg-slate-600 -translate-x-1/2 z-0 hidden md:block"></div>
                                        
                                        @foreach($strukturs->where('role', 'Bendahara') as $item)
                                        <div class="org-node relative z-10" onclick="openModal({{ $item->id }})">
                                            <img src="{{ $item->display_image }}" alt="{{ $item->role }}">
                                            <h4>{{ $item->display_name }}</h4>
                                            <p>{{ $item->role }}</p>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                                
                            </div>
                        </div>


                        

                    </div>

                    <!-- Spacer for mobile vs desktop -->
                    <div class="h-0 md:h-12"></div>

                    <!-- 3. Kepala Bidang Header -->
                    <div class="flex flex-col items-center relative z-10" data-aos="fade-up" data-aos-delay="150">
                        <div class="px-8 py-3 bg-slate-100 dark:bg-slate-800 text-slate-800 dark:text-white font-bold rounded-full shadow-sm text-sm uppercase tracking-widest relative border border-slate-300 dark:border-slate-600">
                            Kepala Bidang
                        </div>
                        <div class="w-0.5 h-12 bg-slate-300 dark:bg-slate-600"></div>
                    </div>

                    <!-- 4. Bidang Grid (DIKLAT, HUMAS, PENGEMBANGAN) -->
                    <div class="relative w-full max-w-5xl flex flex-col items-center z-10" data-aos="fade-up" data-aos-delay="200">
                        <div class="absolute top-0 left-[16.66%] right-[16.66%] h-0.5 bg-slate-300 dark:bg-slate-600 hidden md:block"></div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-x-8 gap-y-12 w-full">
                            
                            <!-- Bidang DIKLAT -->
                            <div class="flex flex-col items-center relative h-full">
                                <!-- Top Stub -->
                                <div class="w-0.5 h-16 bg-slate-300 dark:bg-slate-600 hidden md:block absolute top-0 z-0"></div>
                                
                                <div class="flex flex-col items-center w-full relative pt-0 md:pt-16">
                                    <div class="org-node relative z-10 bg-slate-50 dark:bg-slate-800 border-dashed mb-6">
                                        <div class="w-10 h-10 rounded-full bg-slate-200 flex items-center justify-center text-slate-400 dark:text-slate-500 mb-2 mt-1">
                                            <i class="fas fa-chalkboard-teacher"></i>
                                        </div>
                                        <h4 class="text-slate-600 dark:text-slate-300">Bidang DIKLAT</h4>
                                    </div>

                                    <div class="flex flex-col gap-4 relative w-full items-center">
                                        <div class="absolute left-1/2 top-[-24px] bottom-[80px] w-0.5 bg-slate-300 dark:bg-slate-600 -translate-x-1/2 z-0 hidden md:block"></div>
                                        
                                        @foreach($strukturs->where('role', 'Kepala Bidang DIKLAT') as $item)
                                        <div class="org-node relative z-10" onclick="openModal({{ $item->id }})">
                                            <img src="{{ $item->display_image }}" alt="{{ $item->role }}">
                                            <h4>{{ $item->display_name }}</h4>
                                            <p>{{ $item->role }}</p>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- Humas & Kerja Sama -->
                            <div class="flex flex-col items-center relative h-full">
                                <!-- Top Stub -->
                                <div class="w-0.5 h-16 bg-slate-300 dark:bg-slate-600 hidden md:block absolute top-0 z-0"></div>
                                
                                <div class="flex flex-col items-center w-full relative pt-0 md:pt-16">
                                    <div class="org-node relative z-10 bg-slate-50 dark:bg-slate-800 border-dashed mb-6">
                                        <div class="w-10 h-10 rounded-full bg-slate-200 flex items-center justify-center text-slate-400 dark:text-slate-500 mb-2 mt-1">
                                            <i class="fas fa-handshake"></i>
                                        </div>
                                        <h4 class="text-slate-600 dark:text-slate-300">Humas & Kerja Sama</h4>
                                    </div>

                                    <div class="flex flex-col gap-4 relative w-full items-center">
                                        <div class="absolute left-1/2 top-[-24px] bottom-[80px] w-0.5 bg-slate-300 dark:bg-slate-600 -translate-x-1/2 z-0 hidden md:block"></div>
                                        @foreach($strukturs->where('role', 'Humas & Kerja Sama') as $item)
                                        <div class="org-node relative z-10" onclick="openModal({{ $item->id }})">
                                            <img src="{{ $item->display_image }}" alt="{{ $item->role }}">
                                            <h4>{{ $item->display_name }}</h4>
                                            <p>{{ $item->role }}</p>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- Pengembangan Organisasi -->
                            <div class="flex flex-col items-center relative h-full">
                                <!-- Top Stub -->
                                <div class="w-0.5 h-16 bg-slate-300 dark:bg-slate-600 hidden md:block absolute top-0 z-0"></div>
                                
                                <div class="flex flex-col items-center w-full relative pt-0 md:pt-16">
                                    <div class="org-node relative z-10 bg-slate-50 dark:bg-slate-800 border-dashed mb-6">
                                        <div class="w-10 h-10 rounded-full bg-slate-200 flex items-center justify-center text-slate-400 dark:text-slate-500 mb-2 mt-1">
                                            <i class="fas fa-sitemap"></i>
                                        </div>
                                        <h4 class="text-slate-600 dark:text-slate-300">Pengembangan Org.</h4>
                                    </div>

                                    <div class="flex flex-col gap-4 relative w-full items-center">
                                        <div class="absolute left-1/2 top-[-24px] bottom-[80px] w-0.5 bg-slate-300 dark:bg-slate-600 -translate-x-1/2 z-0 hidden md:block"></div>
                                        @foreach($strukturs->where('role', 'Pengembangan Organisasi') as $item)
                                        <div class="org-node relative z-10" onclick="openModal({{ $item->id }})">
                                            <img src="{{ $item->display_image }}" alt="{{ $item->role }}">
                                            <h4>{{ $item->display_name }}</h4>
                                            <p>{{ $item->role }}</p>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
        
</div>

<!-- Modal Profile / Profil -->
<div id="profileModal" class="fixed inset-0 z-[100] hidden flex items-center justify-center">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity opacity-0" id="modalBackdrop" onclick="closeModal()"></div>
    
    <!-- Modal Content -->
    <div class="bg-white dark:bg-slate-900 w-11/12 max-w-lg mx-auto rounded-2xl shadow-2xl relative z-10 transform scale-95 opacity-0 transition-all duration-300 overflow-hidden flex flex-col" id="modalContent">
        <!-- Close Button -->
        <button onclick="closeModal()" class="absolute top-4 right-4 w-8 h-8 flex items-center justify-center rounded-full bg-slate-100 dark:bg-slate-800 text-slate-500 hover:text-slate-800 dark:hover:text-white transition-colors z-20">
            <i class="fas fa-times"></i>
        </button>
        
                <!-- Header (Full Photo) -->
        <div class="relative w-full h-64 sm:h-80 bg-slate-100 dark:bg-slate-800 rounded-t-2xl overflow-hidden flex justify-center p-4">
            <img id="modalImg" src="" alt="Profile" class="max-w-full max-h-full object-contain drop-shadow-md rounded-lg">
        </div>
        
                <!-- Body -->
        <div class="pt-8 pb-10 px-6 text-center">
            <h3 id="modalName" class="text-2xl md:text-3xl font-black text-slate-800 dark:text-white leading-tight"></h3>
            <p id="modalRole" class="text-sm font-bold text-mgmp uppercase tracking-widest mt-2 mb-6"></p>
            
            <div class="mt-6 flex justify-center gap-4 flex-col sm:flex-row items-center">
                <!-- Unit Kerja -->
                <div class="bg-slate-50 dark:bg-slate-800/80 border border-slate-100 dark:border-slate-700 rounded-xl p-4 w-full max-w-[220px] shadow-sm inline-flex items-center gap-4 text-left">
                    <div class="w-10 h-10 rounded-full bg-mgmp/10 flex items-center justify-center text-mgmp shrink-0">
                        <i class="fas fa-building text-lg"></i>
                    </div>
                    <div>
                        <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Unit Kerja</span>
                        <span id="modalUnit" class="text-slate-700 dark:text-slate-300 font-semibold text-xs leading-snug block"></span>
                    </div>
                </div>
                <!-- Pendidikan -->
                <div class="bg-slate-50 dark:bg-slate-800/80 border border-slate-100 dark:border-slate-700 rounded-xl p-4 w-full max-w-[220px] shadow-sm inline-flex items-center gap-4 text-left">
                    <div class="w-10 h-10 rounded-full bg-mgmp/10 flex items-center justify-center text-mgmp shrink-0">
                        <i class="fas fa-graduation-cap text-lg"></i>
                    </div>
                    <div>
                        <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Pendidikan & Gelar</span>
                        <span id="modalEdu" class="text-slate-700 dark:text-slate-300 font-semibold text-xs leading-snug block"></span>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Data Dummy Profil Anggota
        const profiles = {
            @foreach($strukturs as $item)
            {{ $item->id }}: { 
                name: "{{ addslashes($item->display_name) }}", 
                role: "{{ addslashes($item->role) }}", 
                img: "{{ $item->display_image_url ?? '' }}", 
                edu: "{{ addslashes($item->education) }}", 
                unit: "{{ addslashes($item->display_unit) }}" 
            },
            @endforeach
        };

    const modal = document.getElementById('profileModal');
    const backdrop = document.getElementById('modalBackdrop');
    const content = document.getElementById('modalContent');
    
    function openModal(id) {
        const data = profiles[id];
        if(!data) return;

        // Set data
        document.getElementById('modalName').textContent = data.name;
        document.getElementById('modalRole').textContent = data.role;
                const imgEl = document.getElementById('modalImg');
        if (data.img) {
            imgEl.src = data.img;
            imgEl.style.display = 'block';
        } else {
            // Placeholder fallback
            imgEl.src = 'https://ui-avatars.com/api/?name=' + encodeURIComponent(data.name) + '&background=0f766e&color=fff&size=256';
            imgEl.style.display = 'block';
        }
        document.getElementById('modalEdu').textContent = data.edu;
        document.getElementById('modalUnit').textContent = data.unit;


        // Show modal
        modal.classList.remove('hidden');
        // Trigger reflow
        void modal.offsetWidth;
        
        // Animate in
        backdrop.classList.remove('opacity-0');
        content.classList.remove('opacity-0', 'scale-95');
    }

    function closeModal() {
        // Animate out
        backdrop.classList.add('opacity-0');
        content.classList.add('opacity-0', 'scale-95');
        
        // Hide after animation
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }
</script>
@endpush
