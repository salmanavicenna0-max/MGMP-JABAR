@extends('layouts.app')

@section('title', 'Daftar Anggota - MGMP KIK Jawa Barat')

@section('content')
<!-- ANGGOTA SECTION -->
<section id="anggota"
    class="section-content bg-slate-50 dark:bg-slate-800/30 pt-10 pb-24 bg-pattern-dots relative overflow-hidden z-0 min-h-screen">
    <div class="blob-shape bg-mgmp/15 w-[800px] h-[800px] top-[0%] -right-[25%]"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="mb-10 text-center">
            <p class="text-xs font-bold tracking-wider text-mgmp uppercase mb-1">DAFTAR ANGGOTA</p>
            <h2 class="text-3xl font-bold text-slate-900 dark:text-white mb-3">Anggota Terdaftar</h2>
            <div class="inline-flex items-center justify-center px-4 py-2 bg-white dark:bg-slate-900 rounded-full shadow-sm border border-slate-200 dark:border-slate-700">
                <i class="fas fa-users text-mgmp mr-2"></i>
                <span class="text-sm font-semibold text-slate-700 dark:text-slate-300">Total Anggota: <span class="text-mgmp font-bold">{{ number_format($totalAnggota, 0, ',', '.') }}</span></span>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-md border border-slate-200 dark:border-slate-700 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-slate-600 dark:text-slate-400">
                    <thead class="bg-slate-50 dark:bg-slate-800 text-xs uppercase text-slate-700 dark:text-slate-300 font-semibold border-b border-slate-200 dark:border-slate-700">
                        <tr>
                            <th scope="col" class="px-6 py-4 w-16 text-center">No</th>
                            <th scope="col" class="px-6 py-4">Nama Anggota</th>
                            <th scope="col" class="px-6 py-4">Asal Sekolah</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-700/50">
                        @forelse($anggotas as $index => $anggota)
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/50 transition-colors">
                                <td class="px-6 py-4 text-center font-medium">{{ $anggotas->firstItem() + $index }}</td>
                                <td class="px-6 py-4 font-semibold text-slate-900 dark:text-white">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-mgmp/10 text-mgmp flex items-center justify-center shrink-0 overflow-hidden border border-slate-200 dark:border-slate-700">
                                            <img src="{{ $anggota->avatar_url ?? 'https://ui-avatars.com/api/?name='.urlencode($anggota->name).'&background=0f766e&color=fff' }}" alt="{{ $anggota->name }}" class="w-full h-full object-cover">
                                        </div>
                                        {{ $anggota->name }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    {{ $anggota->asal_sekolah ?: '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-12 text-center text-slate-500 dark:text-slate-400">
                                    <i class="fas fa-users-slash text-3xl mb-3 text-slate-300 dark:text-slate-600"></i>
                                    <p>Belum ada data anggota.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if(method_exists($anggotas, 'links') && $anggotas->hasPages())
                <div class="p-4 border-t border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/30">
                    {{ $anggotas->links() }}
                </div>
            @endif
        </div>
    </div>
</section>
@endsection
