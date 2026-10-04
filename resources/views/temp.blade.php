@extends('layouts.app')

@push('styles')
<style>
    /* ===== Quick Access Cards ===== */
    .qa-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.75rem;
        padding: 1.25rem 1rem;
        border-radius: 1rem;
        background: white;
        border: 1px solid #e2e8f0;
        text-decoration: none;
        transition: box-shadow 0.2s, border-color 0.2s;
    }
    .qa-card:active {
        transform: scale(0.97);
    }
    .qa-icon {
        width: 48px;
        height: 48px;
        border-radius: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
    }
    .qa-label {
        font-size: 0.8rem;
        font-weight: 600;
        text-align: center;
        color: #334155;
        line-height: 1.3;
    }

    /* ===== Statistik Counter ===== */
    .stat-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.375rem;
        padding: 1rem 0.5rem;
    }
    .stat-number {
        font-size: 1.75rem;
        font-weight: 800;
        color: #1363a6;
        line-height: 1;
    }
    .stat-label {
        font-size: 0.7rem;
        font-weight: 600;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        text-align: center;
    }

    /* ===== Berita Cards ===== */
    .berita-featured {
        border-radius: 1rem;
        overflow: hidden;
        background: white;
        border: 1px solid #e2e8f0;
    }
    .berita-featured img {
        width: 100%;
        height: 220px;
        object-fit: cover;
    }
    .berita-small {
        display: flex;
        gap: 0.875rem;
        padding: 0.875rem;
        border-radius: 0.75rem;
        background: white;
        border: 1px solid #e2e8f0;
        text-decoration: none;
        color: inherit;
    }
    .berita-small img {
        width: 80px;
        height: 80px;
        border-radius: 0.5rem;
        object-fit: cover;
        flex-shrink: 0;
    }

    /* ===== Pengumuman ===== */
    .pengumuman-item {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 0.75rem;
        padding: 0.875rem 1rem;
        border-radius: 0.75rem;
        background: white;
        border: 1px solid #e2e8f0;
    }
    .badge {
        display: inline-block;
        padding: 0.15rem 0.5rem;
        border-radius: 9999px;
        font-size: 0.625rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.03em;
        white-space: nowrap;
    }
    .badge-penting { background: #fef2f2; color: #dc2626; }
    .badge-tenggat { background: #eff6ff; color: #2563eb; }
    .badge-info { background: #f0fdf4; color: #16a34a; }

    /* ===== Kalender Mini ===== */
    .mini-cal {
        width: 100%;
        border-collapse: collapse;
    }
    .mini-cal th {
        font-size: 0.625rem;
        font-weight: 700;
        color: #94a3b8;
        text-transform: uppercase;
        padding: 0.375rem 0;
        text-align: center;
    }
    .mini-cal td {
        font-size: 0.7rem;
        text-align: center;
        padding: 0.25rem;
        color: #475569;
        border-radius: 0.375rem;
    }
    .mini-cal td.today {
        background: #1363a6;
        color: white;
        font-weight: 700;
    }
    .mini-cal td.has-event {
        position: relative;
    }
    .mini-cal td.has-event::after {
        content: '';
        display: block;
        width: 4px;
        height: 4px;
        background: #ffb800;
        border-radius: 50%;
        margin: 1px auto 0;
    }

    /* ===== Program Cards ===== */
    .program-card {
        padding: 1.5rem;
        border-radius: 1rem;
        background: white;
        border: 1px solid #e2e8f0;
    }
    .program-icon {
        width: 44px;
        height: 44px;
        border-radius: 0.75rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.125rem;
        margin-bottom: 1rem;
    }

    /* ===== FAQ Accordion ===== */
    .faq-item {
        border: 1px solid #e2e8f0;
        border-radius: 0.75rem;
        overflow: hidden;
        background: white;
    }
    .faq-item summary {
        padding: 1rem 1.25rem;
        font-weight: 600;
        font-size: 0.875rem;
        color: #1e293b;
        cursor: pointer;
        list-style: none;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .faq-item summary::-webkit-details-marker { display: none; }
    .faq-item summary::after {
        content: '\f078';
        font-family: 'Font Awesome 6 Free';
        font-weight: 900;
        font-size: 0.75rem;
        color: #94a3b8;
        transition: transform 0.2s;
    }
    .faq-item[open] summary::after {
        transform: rotate(180deg);
    }
    .faq-answer {
        padding: 0 1.25rem 1rem;
        font-size: 0.8125rem;
        color: #64748b;
        line-height: 1.7;
        border-top: 1px solid #f1f5f9;
        padding-top: 0.875rem;
        margin-top: 0;
    }

    /* ===== Galeri Grid ===== */
    .galeri-item {
        border-radius: 0.75rem;
        overflow: hidden;
        aspect-ratio: 4/3;
        background: #e2e8f0;
    }
    .galeri-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* ===== Mitra Logo ===== */
    .mitra-item {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem 1.5rem;
        opacity: 0.5;
    }
    .mitra-item img, .mitra-item i {
        max-height: 40px;
        filter: grayscale(100%);
    }

    /* ===== Section Divider ===== */
    .section-divider {
        width: 40px;
        height: 3px;
        background: #ffb800;
        border-radius: 2px;
        margin: 0 auto 1rem;
    }

    /* ===== Dark mode adjustments ===== */
    .dark .qa-card,
    .dark .berita-featured,
    .dark .berita-small,
    .dark .pengumuman-item,
    .dark .program-card,
    .dark .faq-item {
        background: #1e293b;
        border-color: #334155;
    }
    .dark .qa-label,
    .dark .berita-small h4,
    .dark .pengumuman-item h4 {
        color: #f1f5f9;
    }
    .dark .stat-number { color: #5f99cd; }
    .dark .mini-cal td { color: #94a3b8; }
</style>
@endpush

@section('title', 'Beranda — MGMP KIK Jawa Barat')

@section('content')

<!-- ============================================ -->
<!-- HERO SECTION                                -->
<!-- ============================================ -->
<section class="relative overflow-hidden bg-mgmp">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 right-0 w-96 h-96 bg-white rounded-full -translate-y-1/2 translate-x-1/3"></div>
        <div class="absolute bottom-0 left-0 w-72 h-72 bg-white rounded-full translate-y-1/2 -translate-x-1/4"></div>
    </div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24 relative z-10">
        <div class="max-w-2xl">
            <p class="text-blue-200 text-xs font-bold tracking-widest uppercase mb-3">MGMP KIK SMP Jawa Barat</p>
            <h1 class="text-3xl md:text-5xl font-extrabold text-white leading-tight mb-4">
                Guru PKK Jawa Barat<br>
                <span class="text-gold">Bersama Berkembang</span>
            </h1>
            <p class="text-white/70 text-sm md:text-base leading-relaxed mb-8 max-w-lg">
                Wadah resmi musyawarah, pelatihan, dan berbagi praktik terbaik bagi guru Pendidikan Kesejahteraan Keluarga di seluruh Jawa Barat.
            </p>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('program') }}" class="px-5 py-2.5 bg-white text-mgmp font-semibold text-sm rounded-lg inline-flex items-center gap-2">
                    Lihat Program <i class="fas fa-arrow-right text-xs"></i>
                </a>
                <a href="{{ route('login') }}" class="px-5 py-2.5 border border-white/30 text-white font-semibold text-sm rounded-lg inline-flex items-center gap-2">
                    Masuk <i class="fas fa-sign-in-alt text-xs"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- Wave -->
    <div class="absolute bottom-0 left-0 w-full overflow-hidden" style="line-height:0;">
        <svg viewBox="0 0 1200 60" preserveAspectRatio="none" class="w-full h-8 md:h-14">
            <path d="M0,60 L0,30 Q300,0 600,30 Q900,60 1200,30 L1200,60 Z" fill="#f8fafc"/>
        </svg>
    </div>
</section>


<!-- ============================================ -->
<!-- QUICK ACCESS CARDS                           -->
<!-- ============================================ -->
<section class="bg-slate-50 dark:bg-slate-950 -mt-1 pt-8 pb-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-3 md:grid-cols-6 gap-3 md:gap-4">
            <a href="{{ route('agenda') }}" class="qa-card">
                <div class="qa-icon bg-blue-50 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400">
                    <i class="far fa-calendar-check"></i>
                </div>
                <span class="qa-label">Agenda</span>
            </a>
            <a href="{{ route('berita') }}" class="qa-card">
                <div class="qa-icon bg-amber-50 text-amber-600 dark:bg-amber-900/30 dark:text-amber-400">
                    <i class="far fa-newspaper"></i>
                </div>
                <span class="qa-label">Berita</span>
            </a>
            <a href="{{ route('kegiatan') }}" class="qa-card">
                <div class="qa-icon bg-emerald-50 text-emerald-600 dark:bg-emerald-900/30 dark:text-emerald-400">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <span class="qa-label">Kegiatan</span>
            </a>
            <a href="{{ route('galeri') }}" class="qa-card">
                <div class="qa-icon bg-purple-50 text-purple-600 dark:bg-purple-900/30 dark:text-purple-400">
                    <i class="fas fa-images"></i>
                </div>
                <span class="qa-label">Galeri</span>
            </a>
            <a href="{{ route('download') }}" class="qa-card">
                <div class="qa-icon bg-rose-50 text-rose-600 dark:bg-rose-900/30 dark:text-rose-400">
                    <i class="fas fa-download"></i>
                </div>
                <span class="qa-label">Download</span>
            </a>
            <a href="{{ route('profile.anggota') }}" class="qa-card">
                <div class="qa-icon bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-400">
                    <i class="fas fa-users"></i>
                </div>
                <span class="qa-label">Anggota</span>
            </a>
        </div>
    </div>
</section>


<!-- ============================================ -->
<!-- STATISTIK                                    -->
<!-- ============================================ -->
<section class="bg-white dark:bg-slate-900 py-10 border-b border-slate-100 dark:border-slate-800">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="stat-item">
                <span class="stat-number">1.200+</span>
                <span class="stat-label">Anggota Aktif</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">27</span>
                <span class="stat-label">Kabupaten / Kota</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">48</span>
                <span class="stat-label">Kegiatan / Tahun</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">15+</span>
                <span class="stat-label">Tahun Berdiri</span>
            </div>
        </div>
    </div>
</section>


<!-- ============================================ -->
<!-- BERITA & PENGUMUMAN (2 kolom)                -->
<!-- ============================================ -->
<section class="bg-slate-50 dark:bg-slate-950 py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

            <!-- KIRI: Berita -->
            <div class="lg:col-span-8">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <div class="section-divider" style="margin:0 0 0.5rem 0;"></div>
                        <h2 class="text-xl md:text-2xl font-bold text-slate-900 dark:text-white">Berita Terkini</h2>
                    </div>
                    <a href="{{ route('berita') }}" class="text-mgmp text-xs font-semibold inline-flex items-center gap-1">
                        Semua Berita <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <!-- Featured -->
                <div class="berita-featured mb-4">
                    <img src="https://images.unsplash.com/photo-1524178232363-1fb2b075b655?w=800&q=80" alt="Pelatihan Guru">
                    <div class="p-5">
                        <div class="flex items-center gap-2 mb-2">
                            <span class="badge" style="background:#eff6ff;color:#2563eb;">Pelatihan</span>
                            <span class="text-xs text-slate-400">18 Juni 2025</span>
                        </div>
                        <h3 class="text-base md:text-lg font-bold text-slate-900 dark:text-white mb-2 leading-snug">
                            Pelatihan Peningkatan Kompetensi Guru PKK Se-Jawa Barat 2025
                        </h3>
                        <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed line-clamp-2">
                            MGMP KIK Jawa Barat mengadakan pelatihan intensif selama 3 hari untuk meningkatkan kompetensi pedagogik dan profesional guru PKK.
                        </p>
                    </div>
                </div>

                <!-- Small Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <a href="{{ route('berita') }}" class="berita-small">
                        <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?w=200&q=80" alt="">
                        <div>
                            <span class="text-[10px] font-bold text-mgmp">Seminar</span>
                            <h4 class="text-sm font-semibold text-slate-800 dark:text-slate-100 leading-tight line-clamp-2 mt-0.5">Seminar Nasional Inovasi Pembelajaran PKK di Era Digital</h4>
                            <span class="text-[10px] text-slate-400 mt-1 block">05 Juni 2025</span>
                        </div>
                    </a>
                    <a href="{{ route('berita') }}" class="berita-small">
                        <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?w=200&q=80" alt="">
                        <div>
                            <span class="text-[10px] font-bold text-mgmp">Workshop</span>
                            <h4 class="text-sm font-semibold text-slate-800 dark:text-slate-100 leading-tight line-clamp-2 mt-0.5">Workshop Pengembangan Modul Ajar Kurikulum Merdeka PKK</h4>
                            <span class="text-[10px] text-slate-400 mt-1 block">22 Mei 2025</span>
                        </div>
                    </a>
                    <a href="{{ route('berita') }}" class="berita-small">
                        <img src="https://images.unsplash.com/photo-1531545514256-b1400bc00f31?w=200&q=80" alt="">
                        <div>
                            <span class="text-[10px] font-bold text-mgmp">Lomba</span>
                            <h4 class="text-sm font-semibold text-slate-800 dark:text-slate-100 leading-tight line-clamp-2 mt-0.5">Lomba Karya Inovatif Guru PKK Tingkat Jawa Barat</h4>
                            <span class="text-[10px] text-slate-400 mt-1 block">10 Mei 2025</span>
                        </div>
                    </a>
                    <a href="{{ route('berita') }}" class="berita-small">
                        <img src="https://images.unsplash.com/photo-1515162816999-a0c47dc192f7?w=200&q=80" alt="">
                        <div>
                            <span class="text-[10px] font-bold text-mgmp">Info</span>
                            <h4 class="text-sm font-semibold text-slate-800 dark:text-slate-100 leading-tight line-clamp-2 mt-0.5">Pendaftaran Anggota Baru MGMP KIK Jawa Barat Periode 2025-2026</h4>
                            <span class="text-[10px] text-slate-400 mt-1 block">02 Mei 2025</span>
                        </div>
                    </a>
                </div>
            </div>

            <!-- KANAN: Pengumuman + Kalender -->
            <div class="lg:col-span-4 space-y-6">

                <!-- Pengumuman -->
                <div>
                    <div class="section-divider" style="margin:0 0 0.5rem 0;"></div>
                    <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-4">Pengumuman</h2>
                    <div class="space-y-2.5">
                        <div class="pengumuman-item">
                            <div class="min-w-0 flex-1">
                                <h4 class="text-sm font-semibold text-slate-800 dark:text-slate-100 leading-snug mb-1">Pendaftaran Anggota MGMP KIK 2025/2026</h4>
                                <div class="flex items-center gap-2">
                                    <span class="text-[10px] text-slate-400">20 Jun 2025</span>
                                    <span class="badge badge-penting">Penting</span>
                                </div>
                            </div>
                            <i class="fas fa-chevron-right text-xs text-slate-300 mt-1 shrink-0"></i>
                        </div>
                        <div class="pengumuman-item">
                            <div class="min-w-0 flex-1">
                                <h4 class="text-sm font-semibold text-slate-800 dark:text-slate-100 leading-snug mb-1">Jadwal Rapat Pleno Semester Ganjil 2025</h4>
                                <div class="flex items-center gap-2">
                                    <span class="text-[10px] text-slate-400">15 Jun 2025</span>
                                </div>
                            </div>
                            <i class="fas fa-chevron-right text-xs text-slate-300 mt-1 shrink-0"></i>
                        </div>
                        <div class="pengumuman-item">
                            <div class="min-w-0 flex-1">
                                <h4 class="text-sm font-semibold text-slate-800 dark:text-slate-100 leading-snug mb-1">Penyerahan Berkas Sertifikasi Triwulan 2</h4>
                                <div class="flex items-center gap-2">
                                    <span class="text-[10px] text-slate-400">10 Jul 2025</span>
                                    <span class="badge badge-tenggat">Tenggat</span>
                                </div>
                            </div>
                            <i class="fas fa-chevron-right text-xs text-slate-300 mt-1 shrink-0"></i>
                        </div>
                        <div class="pengumuman-item">
                            <div class="min-w-0 flex-1">
                                <h4 class="text-sm font-semibold text-slate-800 dark:text-slate-100 leading-snug mb-1">Pendataan Guru PKK Calon Instruktur</h4>
                                <div class="flex items-center gap-2">
                                    <span class="text-[10px] text-slate-400">25 Jul 2025</span>
                                    <span class="badge badge-info">Info</span>
                                </div>
                            </div>
                            <i class="fas fa-chevron-right text-xs text-slate-300 mt-1 shrink-0"></i>
                        </div>
                    </div>
                </div>

                <!-- Kalender Mini -->
                <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-100 dark:border-slate-700 p-4">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-sm font-bold text-slate-800 dark:text-white">Juni 2025</h3>
                        <span class="text-[10px] text-mgmp font-semibold cursor-pointer">Lihat Agenda &rarr;</span>
                    </div>
                    <table class="mini-cal">
                        <thead>
                            <tr>
                                <th>Sn</th><th>Sr</th><th>Rb</th><th>Km</th><th>Jm</th><th>Sb</th><th>Mg</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td></td><td></td><td></td><td></td><td></td><td></td><td class="today">1</td>
                            </tr>
                            <tr>
                                <td>2</td><td>3</td><td>4</td><td>5</td><td>6</td><td>7</td><td>8</td>
                            </tr>
                            <tr>
                                <td>9</td><td>10</td><td>11</td><td>12</td><td class="has-event">13</td><td>14</td><td>15</td>
                            </tr>
                            <tr>
                                <td>16</td><td>17</td><td class="has-event">18</td><td>19</td><td>20</td><td>21</td><td>22</td>
                            </tr>
                            <tr>
                                <td>23</td><td>24</td><td>25</td><td>26</td><td>27</td><td>28</td><td>29</td>
                            </tr>
                            <tr>
                                <td>30</td><td></td><td></td><td></td><td></td><td></td><td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</section>


<!-- ============================================ -->
<!-- PROGRAM UNGGULAN                             -->
<!-- ============================================ -->
<section class="bg-white dark:bg-slate-900 py-14 border-b border-slate-100 dark:border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <div class="section-divider"></div>
            <h2 class="text-xl md:text-2xl font-bold text-slate-900 dark:text-white">Program Unggulan</h2>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-2 max-w-md mx-auto">Inisiatif utama kami untuk meningkatkan kualitas guru PKK di Jawa Barat.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="program-card">
                <div class="program-icon bg-blue-50 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400">
                    <i class="fas fa-book-open"></i>
                </div>
                <h3 class="text-sm font-bold text-slate-900 dark:text-white mb-1.5">Pengembangan Kurikulum</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">Sinkronisasi kurikulum industri dan sekolah supaya lulusan siap kerja.</p>
            </div>
            <div class="program-card">
                <div class="program-icon bg-amber-50 text-amber-600 dark:bg-amber-900/30 dark:text-amber-400">
                    <i class="fas fa-chalkboard-teacher"></i>
                </div>
                <h3 class="text-sm font-bold text-slate-900 dark:text-white mb-1.5">Peningkatan SDM Guru</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">Pelatihan dan workshop untuk mengasah kompetensi pedagogik guru.</p>
            </div>
            <div class="program-card">
                <div class="program-icon bg-emerald-50 text-emerald-600 dark:bg-emerald-900/30 dark:text-emerald-400">
                    <i class="fas fa-award"></i>
                </div>
                <h3 class="text-sm font-bold text-slate-900 dark:text-white mb-1.5">Apresiasi & Penghargaan</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">Pemilihan guru berprestasi dan pameran inovasi karya guru.</p>
            </div>
            <div class="program-card">
                <div class="program-icon bg-purple-50 text-purple-600 dark:bg-purple-900/30 dark:text-purple-400">
                    <i class="fas fa-handshake"></i>
                </div>
                <h3 class="text-sm font-bold text-slate-900 dark:text-white mb-1.5">Kolaborasi & Kemitraan</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">Kerja sama dengan DUDI untuk magang guru dan penyaluran lulusan.</p>
            </div>
        </div>

        <div class="text-center mt-8">
            <a href="{{ route('program') }}" class="text-mgmp text-sm font-semibold inline-flex items-center gap-1.5">
                Lihat Semua Program <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>
    </div>
</section>


<!-- ============================================ -->
<!-- INFORMASI & DOKUMEN                          -->
<!-- ============================================ -->
<section class="bg-slate-50 dark:bg-slate-950 py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <div class="section-divider"></div>
            <h2 class="text-xl md:text-2xl font-bold text-slate-900 dark:text-white">Layanan & Dokumen</h2>
            <p class="text-sm text-slate-500 dark:text-slate-400 mt-2">Akses cepat ke informasi penting untuk anggota.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-100 dark:border-slate-700 p-6 text-center">
                <div class="w-12 h-12 rounded-xl bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 flex items-center justify-center mx-auto mb-4 text-xl">
                    <i class="fas fa-user-plus"></i>
                </div>
                <h3 class="text-sm font-bold text-slate-900 dark:text-white mb-2">Pendaftaran Anggota</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed mb-4">Pendaftaran terbuka untuk guru PKK SMA/SMK/MA se-Jawa Barat.</p>
                <a href="{{ route('login') }}" class="text-mgmp text-xs font-semibold">Selengkapnya &rarr;</a>
            </div>
            <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-100 dark:border-slate-700 p-6 text-center">
                <div class="w-12 h-12 rounded-xl bg-amber-50 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400 flex items-center justify-center mx-auto mb-4 text-xl">
                    <i class="fas fa-file-alt"></i>
                </div>
                <h3 class="text-sm font-bold text-slate-900 dark:text-white mb-2">Dokumen Pedoman</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed mb-4">Silabus, RPP, dan panduan kurikulum PKK terbaru untuk anggota.</p>
                <a href="{{ route('download') }}" class="text-mgmp text-xs font-semibold">Selengkapnya &rarr;</a>
            </div>
            <div class="bg-white dark:bg-slate-800 rounded-xl border border-slate-100 dark:border-slate-700 p-6 text-center">
                <div class="w-12 h-12 rounded-xl bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 flex items-center justify-center mx-auto mb-4 text-xl">
                    <i class="fas fa-chart-bar"></i>
                </div>
                <h3 class="text-sm font-bold text-slate-900 dark:text-white mb-2">Survey Kebutuhan</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed mb-4">Isi kuisioner untuk membantu kami memahami kebutuhan guru PKK.</p>
                <a href="#" class="text-mgmp text-xs font-semibold">Selengkapnya &rarr;</a>
            </div>
        </div>
    </div>
</section>


<!-- ============================================ -->
<!-- FAQ                                          -->
<!-- ============================================ -->
<section class="bg-white dark:bg-slate-900 py-14 border-b border-slate-100 dark:border-slate-800">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <div class="section-divider"></div>
            <h2 class="text-xl md:text-2xl font-bold text-slate-900 dark:text-white">Pertanyaan Umum</h2>
        </div>

        <div class="space-y-3">
            <details class="faq-item">
                <summary>Bagaimana cara mendaftar menjadi anggota MGMP KIK?</summary>
                <div class="faq-answer">
                    Pendaftaran bisa lewat portal anggota di website ini. Persiapkan scan SK Mengajar terakhir, pas foto, dan surat rekomendasi dari Kepala Sekolah. Pendaftaran dibuka setiap awal semester.
                </div>
            </details>
            <details class="faq-item">
                <summary>Apakah setiap kegiatan menghasilkan e-sertifikat?</summary>
                <div class="faq-answer">
                    Ya. Peserta yang mengikuti pelatihan atau workshop resmi dari MGMP KIK dan memenuhi syarat kehadiran minimal akan mendapat e-sertifikat dengan jam pelajaran yang diakui.
                </div>
            </details>
            <details class="faq-item">
                <summary>Kapan rapat rutin MGMP tingkat kabupaten dilaksanakan?</summary>
                <div class="faq-answer">
                    Rapat pleno tingkat kabupaten diadakan 2 kali setahun, awal semester ganjil dan genap. Pelatihan teknis bisa lebih sering, tergantung jadwal pengurus.
                </div>
            </details>
            <details class="faq-item">
                <summary>Siapa yang boleh bergabung?</summary>
                <div class="faq-answer">
                    Guru mata pelajaran PKK yang mengajar di SMA, SMK, atau MA negeri maupun swasta di wilayah Jawa Barat. Guru-guru dari jenjang SMP juga diperbolehkan bergabung.
                </div>
            </details>
        </div>
    </div>
</section>


<!-- ============================================ -->
<!-- GALERI KEGIATAN                              -->
<!-- ============================================ -->
<section class="bg-slate-50 dark:bg-slate-950 py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between mb-8">
            <div>
                <div class="section-divider" style="margin:0 0 0.5rem 0;"></div>
                <h2 class="text-xl md:text-2xl font-bold text-slate-900 dark:text-white">Galeri Kegiatan</h2>
            </div>
            <a href="{{ route('galeri') }}" class="text-mgmp text-xs font-semibold inline-flex items-center gap-1">
                Lihat Semua <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
            <div class="galeri-item">
                <img src="https://images.unsplash.com/photo-1577896851231-70ef18881754?w=400&q=80" alt="Kegiatan 1" loading="lazy">
            </div>
            <div class="galeri-item">
                <img src="https://images.unsplash.com/photo-1543269865-cbf427effbad?w=400&q=80" alt="Kegiatan 2" loading="lazy">
            </div>
            <div class="galeri-item">
                <img src="https://images.unsplash.com/photo-1529333166437-7750a6dd5a70?w=400&q=80" alt="Kegiatan 3" loading="lazy">
            </div>
            <div class="galeri-item">
                <img src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=400&q=80" alt="Kegiatan 4" loading="lazy">
            </div>
            <div class="galeri-item">
                <img src="https://images.unsplash.com/photo-1516321497487-e288fb19713f?w=400&q=80" alt="Kegiatan 5" loading="lazy">
            </div>
            <div class="galeri-item">
                <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=400&q=80" alt="Kegiatan 6" loading="lazy">
            </div>
        </div>
    </div>
</section>


<!-- ============================================ -->
<!-- MITRA & REKANAN                              -->
<!-- ============================================ -->
<section class="bg-white dark:bg-slate-900 py-12 border-b border-slate-100 dark:border-slate-800">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <p class="text-center text-xs font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-8">Bekerja Sama Dengan</p>
        <div class="flex flex-wrap justify-center items-center gap-8 md:gap-14">
            <div class="mitra-item">
                <i class="fas fa-university text-3xl text-slate-400 dark:text-slate-600"></i>
            </div>
            <div class="mitra-item">
                <i class="fas fa-building text-3xl text-slate-400 dark:text-slate-600"></i>
            </div>
            <div class="mitra-item">
                <i class="fas fa-industry text-3xl text-slate-400 dark:text-slate-600"></i>
            </div>
            <div class="mitra-item">
                <i class="fas fa-award text-3xl text-slate-400 dark:text-slate-600"></i>
            </div>
            <div class="mitra-item">
                <i class="fas fa-laptop-code text-3xl text-slate-400 dark:text-slate-600"></i>
            </div>
        </div>
    </div>
</section>

@endsection
