@extends('layouts.app')

@section('title', $title ?? 'Error — MGMP KIK Jawa Barat')

@push('styles')
<style>
    .error-page {
        min-height: 60vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 60px 24px;
        text-align: center;
    }
    .error-code {
        font-size: 120px;
        font-weight: 800;
        color: #0B3D6B;
        line-height: 1;
        margin-bottom: 8px;
        letter-spacing: -0.04em;
    }
    .dark .error-code {
        color: #5f99cd;
    }
    .error-divider {
        width: 48px;
        height: 3px;
        background: #ffb800;
        border-radius: 2px;
        margin: 16px auto;
    }
    .error-message {
        font-size: 20px;
        font-weight: 600;
        color: #1a2332;
        margin-bottom: 8px;
    }
    .dark .error-message {
        color: #f1f5f9;
    }
    .error-description {
        font-size: 14px;
        color: #475569;
        line-height: 1.6;
        margin-bottom: 32px;
        max-width: 480px;
    }
    .dark .error-description {
        color: #94a3b8;
    }
    .error-actions {
        display: flex;
        flex-direction: column;
        gap: 12px;
        align-items: center;
    }
    .error-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px 28px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s ease;
        cursor: pointer;
        border: none;
        width: 100%;
        max-width: 280px;
    }
    .error-btn-primary {
        background: #0B3D6B;
        color: white;
    }
    .dark .error-btn-primary {
        background: #3b82f6;
    }
    @media (hover: hover) {
        .error-btn-primary:hover {
            opacity: 0.9;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(11, 61, 107, 0.25);
        }
    }
    .error-btn-secondary {
        background: transparent;
        color: #475569;
        border: 1px solid #e2e8f0;
    }
    .dark .error-btn-secondary {
        color: #94a3b8;
        border-color: #475569;
    }
    @media (hover: hover) {
        .error-btn-secondary:hover {
            border-color: #0B3D6B;
            color: #0B3D6B;
        }
        .dark .error-btn-secondary:hover {
            border-color: #3b82f6;
            color: #3b82f6;
        }
    }
    .error-links {
        margin-top: 32px;
        padding-top: 24px;
        border-top: 1px solid #e2e8f0;
        max-width: 480px;
        width: 100%;
    }
    .dark .error-links {
        border-top-color: #334155;
    }
    .error-links p {
        font-size: 12px;
        color: #475569;
        margin-bottom: 10px;
    }
    .dark .error-links p {
        color: #94a3b8;
    }
    .error-links-nav {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        justify-content: center;
    }
    .error-links-nav a {
        font-size: 13px;
        color: #0B3D6B;
        text-decoration: none;
        padding: 6px 14px;
        border-radius: 8px;
        background: rgba(11, 61, 107, 0.06);
        transition: all 0.15s ease;
        font-weight: 500;
    }
    .dark .error-links-nav a {
        color: #60a5fa;
        background: rgba(59, 130, 246, 0.1);
    }
    @media (hover: hover) {
        .error-links-nav a:hover {
            background: rgba(11, 61, 107, 0.12);
        }
        .dark .error-links-nav a:hover {
            background: rgba(59, 130, 246, 0.2);
        }
    }
    @media (max-width: 480px) {
        .error-code { font-size: 80px; }
        .error-message { font-size: 18px; }
    }
</style>
@endpush

@section('content')
<div class="error-page">
    <div class="error-code">@yield('code', '?')</div>
    <div class="error-divider"></div>
    <h1 class="error-message">@yield('message', 'Terjadi Kesalahan')</h1>
    <p class="error-description">@yield('description', 'Halaman yang Anda cari tidak dapat ditemukan atau telah dipindahkan.')</p>

    <div class="error-actions">
        <a href="{{ route('home') }}" class="error-btn error-btn-primary">
            <i class="fas fa-home"></i>
            Kembali ke Beranda
        </a>
        <a href="javascript:history.back()" class="error-btn error-btn-secondary">
            <i class="fas fa-arrow-left"></i>
            Halaman Sebelumnya
        </a>
    </div>

    <div class="error-links">
        <p>Atau kunjungi:</p>
        <div class="error-links-nav">
            <a href="{{ route('berita') }}">Berita</a>
            <a href="{{ route('program') }}">Program</a>
            <a href="{{ route('galeri') }}">Galeri</a>
            <a href="{{ route('kegiatan') }}">Kegiatan</a>
            <a href="{{ route('agenda') }}">Agenda</a>
            <a href="{{ route('profile.anggota') }}">Profil</a>
        </div>
    </div>
</div>
@endsection
