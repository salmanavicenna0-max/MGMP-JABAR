@extends('layouts.app')
@section('title', 'Kelola Anggota — Admin MGMP KIK')
@section('content')
<div class="min-h-screen bg-slate-50 dark:bg-slate-900 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(session('success'))<div class="flash-message mb-4 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-lg text-sm">{{ session('success') }}</div>@endif
        @if(session('error'))<div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm">{{ session('error') }}</div>@endif

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
            <div class="flex items-center gap-3">
                <a href="{{ Auth::user()->isAdmin() ? route('admin.dashboard') : route('dashboard') }}" class="px-3 py-2 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-300 text-sm font-semibold rounded-lg inline-flex items-center gap-2 hover:bg-slate-200 dark:hover:bg-slate-700 transition-all">
                    <i class="fas fa-arrow-left"></i> Dashboard
                </a>
                <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Kelola Anggota</h1>
            </div>
        </div>

        <!-- Search & Filter -->
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 p-4 mb-6">
            <form action="{{ route('admin.anggota.index') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
                <div class="flex-1 relative">
                    <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau email..." class="w-full pl-9 pr-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-lg text-sm text-slate-800 dark:text-white focus:ring-2 focus:ring-mgmp/20 focus:border-mgmp transition-all">
                </div>
                <div class="w-full sm:w-48">
                    <select name="role" class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-lg text-sm text-slate-800 dark:text-white focus:ring-2 focus:ring-mgmp/20 focus:border-mgmp transition-all">
                        <option value="">Semua Role</option>
                        <option value="member" {{ request('role')=='member' ? 'selected' : '' }}>Member</option>
                        <option value="admin" {{ request('role')=='admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>
                <button type="submit" class="px-5 py-2.5 bg-mgmp hover:bg-mgmp-dark text-white text-sm font-semibold rounded-lg inline-flex items-center gap-2 transition-all">
                    <i class="fas fa-filter"></i> Filter
                </button>
                @if(request('search') || request('role'))
                    <a href="{{ route('admin.anggota.index') }}" class="px-5 py-2.5 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 text-sm font-semibold rounded-lg inline-flex items-center gap-2 hover:bg-slate-200 dark:hover:bg-slate-600 transition-all">
                        <i class="fas fa-times"></i> Reset
                    </a>
                @endif
            </form>
        </div>

        <!-- Table -->
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-slate-100 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50">
                            <th class="text-left px-5 py-3 font-bold text-slate-500 uppercase text-xs">#</th>
                            <th class="text-left px-5 py-3 font-bold text-slate-500 uppercase text-xs">Nama</th>
                            <th class="text-left px-5 py-3 font-bold text-slate-500 uppercase text-xs hidden md:table-cell">Email</th>
                            <th class="text-center px-5 py-3 font-bold text-slate-500 uppercase text-xs">Role</th>
                            <th class="text-center px-5 py-3 font-bold text-slate-500 uppercase text-xs">Status</th>
                            <th class="text-left px-5 py-3 font-bold text-slate-500 uppercase text-xs hidden md:table-cell">Terdaftar</th>
                            <th class="text-center px-5 py-3 font-bold text-slate-500 uppercase text-xs">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                        @forelse($users as $user)
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                            <td class="px-5 py-4 text-slate-400">{{ $loop->iteration }}</td>
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full bg-mgmp/10 text-mgmp flex items-center justify-center text-xs font-bold shrink-0 overflow-hidden">
                                        @if($user->avatar)
                                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                                        @else
                                            {{ substr($user->name, 0, 1) }}
                                        @endif
                                    </div>
                                    <span class="font-semibold text-slate-800 dark:text-slate-200">{{ $user->name }}</span>
                                </div>
                            </td>
                            <td class="px-5 py-4 text-slate-500 dark:text-slate-400 text-xs hidden md:table-cell">{{ $user->email }}</td>
                            <td class="px-5 py-4 text-center">
                                @if($user->role === 'admin')
                                    <span class="px-2 py-0.5 rounded-full text-xs font-semibold bg-amber-50 dark:bg-amber-900/30 text-amber-600">
                                        <i class="fas fa-crown"></i> Admin
                                    </span>
                                @else
                                    <span class="px-2 py-0.5 rounded-full text-xs font-semibold bg-blue-50 dark:bg-blue-900/30 text-blue-600">
                                        <i class="fas fa-user"></i> Member
                                    </span>
                                @endif
                            </td>
                            <td class="px-5 py-4 text-center">
                                @if($user->email_verified_at)
                                    <span class="px-2 py-0.5 rounded-full text-xs font-semibold bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600">Active</span>
                                @else
                                    <span class="px-2 py-0.5 rounded-full text-xs font-semibold bg-amber-50 dark:bg-amber-900/30 text-amber-600">Pending</span>
                                @endif
                            </td>
                            <td class="px-5 py-4 text-slate-400 text-xs hidden md:table-cell">{{ $user->created_at ? $user->created_at->format('d M Y') : '-' }}</td>
                            <td class="px-5 py-4 text-center">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.anggota.edit', $user) }}" class="p-2 text-slate-400 hover:text-blue-500 transition-colors" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @if(!$user->email_verified_at)
                                        <form action="{{ route('admin.anggota.verify', $user) }}" method="POST" class="inline" onsubmit="return confirm('Verifikasi anggota ini?')">
                                            @csrf
                                            <button type="submit" class="p-2 text-emerald-500 hover:text-emerald-600 transition-colors" title="Verifikasi">
                                                <i class="fas fa-check-circle"></i>
                                            </button>
                                        </form>
                                    @else
                                        <span class="p-2 text-emerald-300" title="Sudah diverifikasi">
                                            <i class="fas fa-check-circle"></i>
                                        </span>
                                    @endif
                                    @if(!$user->isAdmin())
                                        <form action="{{ route('admin.anggota.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus anggota ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="p-2 text-slate-400 hover:text-red-500 transition-colors" title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @else
                                        <span class="p-2 text-slate-300" title="Admin tidak bisa dihapus">
                                            <i class="fas fa-shield-alt"></i>
                                        </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="px-5 py-16 text-center">
                                <div class="flex flex-col items-center text-slate-400">
                                    <i class="fas fa-users-slash text-4xl mb-3"></i>
                                    <p class="font-semibold">Tidak ada anggota</p>
                                    <p class="text-sm mt-1">Belum ada anggota yang terdaftar.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if($users->hasPages())
        <div class="mt-6">
            {{ $users->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
