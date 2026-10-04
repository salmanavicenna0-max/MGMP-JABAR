<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\ProgramController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\KegiatanController;
use App\Http\Controllers\Admin\DownloadController;
use App\Http\Controllers\Admin\AgendaController;
use App\Http\Controllers\Admin\AnggotaController;
use App\Models\Berita;
use App\Models\Program;
use App\Models\Galeri;
use App\Models\Kegiatan;
use App\Models\Download;
use App\Models\Agenda;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    $beritas = Berita::published()->latest()->take(7)->get();
    $kegiatans = Kegiatan::published()->latest()->take(6)->get();
    $galeris = Galeri::published()->latest()->take(6)->get();
    $memberCount = \App\Models\Struktur::count();
    $kegiatanCount = \App\Models\Kegiatan::published()->count();
    return view('welcome', compact('beritas', 'kegiatans', 'galeris', 'memberCount', 'kegiatanCount'));
})->name('home');

Route::get('/search', [SearchController::class, 'index'])->name('search.index');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

/*
|--------------------------------------------------------------------------
| Authenticated Routes (semua role)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'prevent-back'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Profile
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');
});

/*
|--------------------------------------------------------------------------
| Content CRUD Routes (admin + member)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'prevent-back'])->prefix('admin')->name('admin.')->group(function () {
    // CRUD Resources — bisa diakses admin DAN member
    Route::resource('berita', BeritaController::class);
    Route::resource('program', ProgramController::class);
    Route::resource('galeri', GaleriController::class);
    Route::resource('kegiatan', KegiatanController::class);
    Route::resource('download', DownloadController::class);
    Route::resource('agenda', AgendaController::class);
});

/*
|--------------------------------------------------------------------------
| Admin-Only Routes (role: admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin', 'prevent-back'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
    Route::get('/log', function () { return view('admin.log'); })->name('log');

    // Anggota — admin only
    Route::get('/anggota', [AnggotaController::class, 'index'])->name('anggota.index');
    Route::get('/anggota/create', [AnggotaController::class, 'create'])->name('anggota.create');
    Route::post('/anggota', [AnggotaController::class, 'store'])->name('anggota.store');
    Route::get('/anggota/{user}/edit', [AnggotaController::class, 'edit'])->name('anggota.edit');
    Route::put('/anggota/{user}', [AnggotaController::class, 'update'])->name('anggota.update');
    Route::post('/anggota/{user}/verify', [AnggotaController::class, 'verify'])->name('anggota.verify');
    Route::delete('/anggota/{user}', [AnggotaController::class, 'destroy'])->name('anggota.destroy');

    // Settings
    Route::get('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [\App\Http\Controllers\Admin\SettingController::class, 'store'])->name('settings.store');

    // Struktur Organisasi
    Route::get('/struktur/search-user', [\App\Http\Controllers\Admin\StrukturController::class, 'searchUser'])->name('struktur.search-user');
    Route::resource('struktur', \App\Http\Controllers\Admin\StrukturController::class)->except(['show']);

    // Live Chat (CS)
    Route::get('/chat', [\App\Http\Controllers\Admin\ChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/{id}', [\App\Http\Controllers\Admin\ChatController::class, 'show'])->name('chat.show');
    Route::post('/chat/{id}/reply', [\App\Http\Controllers\Admin\ChatController::class, 'reply'])->name('chat.reply');
    Route::post('/chat/{id}/close', [\App\Http\Controllers\Admin\ChatController::class, 'close'])->name('chat.close');
    Route::delete('/chat/{id}', [\App\Http\Controllers\Admin\ChatController::class, 'delete'])->name('chat.delete');
    Route::delete('/chat', [\App\Http\Controllers\Admin\ChatController::class, 'deleteAll'])->name('chat.deleteAll');
});

/*
|--------------------------------------------------------------------------
| Public Chat API (CS)
|--------------------------------------------------------------------------
*/
Route::post('/chat/send', [\App\Http\Controllers\ChatController::class, 'sendMessage'])->name('api.chat.send');
Route::get('/chat/poll', [\App\Http\Controllers\ChatController::class, 'pollMessages'])->name('api.chat.poll');

/*
|--------------------------------------------------------------------------
| Public Pages (homepage theme konsisten)
|--------------------------------------------------------------------------
*/
Route::get('/profile/anggota', function () { 
    $strukturs = \App\Models\Struktur::orderBy('order_num')->get();
    return view('profile.anggota', compact('strukturs')); 
})->name('profile.anggota');

Route::get('/anggota', function () {
    // Tampilkan semua user member yang sudah diverifikasi admin
    $anggotas = \App\Models\User::where('role', 'member')
        ->whereNotNull('email_verified_at')
        ->orderBy('name')
        ->paginate(20);
    $totalAnggota = \App\Models\User::where('role', 'member')
        ->whereNotNull('email_verified_at')
        ->count();
    return view('anggota', compact('anggotas', 'totalAnggota'));
})->name('anggota');
Route::get('/berita', function () { $beritas = Berita::published()->latest()->paginate(9); return view('berita', compact('beritas')); })->name('berita');
Route::get('/berita/{slug}', function ($slug) { 
    $berita = Berita::where('slug', $slug)->published()->firstOrFail();
    return view('berita-detail', compact('berita')); 
})->name('berita.show');
Route::get('/program', function () { $programs = Program::published()->latest()->get(); $kegiatans = Kegiatan::published()->latest()->get(); $agendas = Agenda::published()->latest()->get(); return view('program', compact('programs', 'kegiatans', 'agendas')); })->name('program');
Route::get('/galeri', function () { $galeris = Galeri::published()->latest()->paginate(9); return view('galeri', compact('galeris')); })->name('galeri');
Route::get('/kegiatan', function () { $kegiatans = Kegiatan::published()->latest()->paginate(9); return view('kegiatan', compact('kegiatans')); })->name('kegiatan');
Route::get('/kegiatan/{slug}', function ($slug) { 
    $kegiatan = Kegiatan::where('slug', $slug)->published()->firstOrFail();
    return view('kegiatan-detail', compact('kegiatan')); 
})->name('kegiatan.show');
Route::get('/download', function () { 
    $query = Download::published()->latest();
    if (!auth()->check()) $query->where('is_public', true);
    $downloads = $query->paginate(15); 
    return view('download', compact('downloads')); 
})->name('download');
Route::get('/agenda', function () { $agendas = Agenda::published()->latest()->get(); return view('agenda', compact('agendas')); })->name('agenda');
Route::get('/temp', function () { return view('temp'); })->name('temp');
