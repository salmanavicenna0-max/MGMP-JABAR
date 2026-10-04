<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Akun - MGMP KIK Jawa Barat</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: { sans: ['Inter', 'sans-serif'] },
                        colors: { mgmp: { DEFAULT: '#1363a6', dark: '#0b5c9c', light: '#5f99cd' }, gold: '#ffb800' }
                    }
                }
            }
        </script>
    @endif
    <style>
        * { font-family: 'Inter', sans-serif; }
        body { background: #f0f4f8; }
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            33% { transform: translateY(-10px) rotate(1deg); }
            66% { transform: translateY(5px) rotate(-1deg); }
        }
        .float { animation: float 8s ease-in-out infinite; }
        .float-delay { animation: float 10s ease-in-out 3s infinite; }
        .input-transition { transition: all 0.2s ease; }
        .brand-panel {
            background: linear-gradient(135deg, #1363a6 0%, #0a4a7a 50%, #07345c 100%);
        }
        .brand-pattern {
            position: absolute; inset: 0;
            background-image: radial-gradient(circle at 25% 25%, rgba(255,255,255,0.04) 0%, transparent 50%),
                              radial-gradient(circle at 75% 75%, rgba(255,255,255,0.04) 0%, transparent 50%),
                              linear-gradient(45deg, transparent 48%, rgba(255,255,255,0.02) 50%, transparent 52%),
                              linear-gradient(-45deg, transparent 48%, rgba(255,255,255,0.02) 50%, transparent 52%);
            background-size: 100% 100%, 100% 100%, 60px 60px, 60px 60px;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 antialiased">

    <div class="w-full max-w-[900px] md:bg-white md:rounded-2xl md:shadow-[0_8px_30px_rgba(0,0,0,0.08)] md:overflow-hidden flex flex-col md:flex-row min-h-screen md:min-h-[600px]">

        <!-- Brand Panel -->
        <div class="md:w-[38%] brand-panel p-10 flex flex-col justify-center items-center relative overflow-hidden hidden md:flex">
            <div class="brand-pattern"></div>
            <div class="absolute top-[-40px] right-[-40px] w-40 h-40 rounded-full border border-white/10 float"></div>
            <div class="absolute bottom-[30px] left-[-30px] w-32 h-32 rounded-full border border-white/8 float-delay"></div>

            <div class="relative z-10 flex flex-col items-center text-center">
                <img src="{{ asset('assets/Logo_Mgmp_PKK_jabar-removebg-preview.png') }}" alt="Logo MGMP KIK" class="w-20 h-20 object-contain mb-4">
                <h2 class="text-sm font-bold text-white/60 uppercase tracking-wider mb-1">Dinas Pendidikan Jawa Barat</h2>
                <h2 class="text-xl font-bold text-white leading-tight mb-2">MGMP KIK</h2>
                <p class="text-sm text-blue-200/70 leading-relaxed">Daftar dan akses materi, jadwal, serta jaringan guru PKK se-Jawa Barat.</p>
            </div>
        </div>

        <!-- Form Panel -->
        <div class="w-full md:w-[62%] p-8 md:p-10 lg:p-12 flex flex-col justify-center">
            <div class="max-w-sm w-full mx-auto">

                @if (session('success'))
                    <div class="flash-message mb-5 p-3.5 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs flex items-center gap-2.5">
                        <i class="fas fa-check-circle text-emerald-500"></i> {{ session('success') }}
                    </div>
                @endif

                <div class="mb-7">
                    <h3 class="text-xl font-bold text-slate-900">Daftar Akun</h3>
                    <p class="text-sm text-slate-500 mt-1">Lengkapi data untuk membuat akun baru.</p>
                </div>

                <form action="{{ route('register') }}" method="POST" class="space-y-3.5">
                    @csrf

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1.5">Nama Lengkap</label>
                        <div class="relative group">
                            <i class="far fa-user absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-sm group-focus-within:text-mgmp input-transition"></i>
                            <input type="text" name="name" value="{{ old('name') }}" required autofocus
                                   placeholder="Nama lengkap dengan gelar"
                                   class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border @error('name') border-red-400 @else border-slate-200 @enderror rounded-xl text-sm text-slate-800 focus:bg-white focus:ring-2 focus:ring-mgmp/15 focus:border-mgmp outline-none input-transition placeholder:text-slate-400">
                        </div>
                        @error('name')
                            <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1.5">Asal Sekolah</label>
                        <div class="relative group">
                            <i class="fas fa-school absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-sm group-focus-within:text-mgmp input-transition"></i>
                            <input type="text" name="asal_sekolah" value="{{ old('asal_sekolah') }}" required
                                   placeholder="Nama sekolah asal"
                                   class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border @error('asal_sekolah') border-red-400 @else border-slate-200 @enderror rounded-xl text-sm text-slate-800 focus:bg-white focus:ring-2 focus:ring-mgmp/15 focus:border-mgmp outline-none input-transition placeholder:text-slate-400">
                        </div>
                        @error('asal_sekolah')
                            <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1.5">NPSN Sekolah</label>
                        <div class="relative group">
                            <i class="fas fa-hashtag absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-sm group-focus-within:text-mgmp input-transition"></i>
                            <input type="number" name="npsn_sekolah" value="{{ old('npsn_sekolah') }}" required
                                   placeholder="Nomor Pokok Sekolah Nasional"
                                   class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border @error('npsn_sekolah') border-red-400 @else border-slate-200 @enderror rounded-xl text-sm text-slate-800 focus:bg-white focus:ring-2 focus:ring-mgmp/15 focus:border-mgmp outline-none input-transition placeholder:text-slate-400">
                        </div>
                        @error('npsn_sekolah')
                            <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1.5">Email</label>
                        <div class="relative group">
                            <i class="far fa-envelope absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-sm group-focus-within:text-mgmp input-transition"></i>
                            <input type="email" name="email" value="{{ old('email') }}" required
                                   placeholder="nama@sekolah.sch.id"
                                   class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border @error('email') border-red-400 @else border-slate-200 @enderror rounded-xl text-sm text-slate-800 focus:bg-white focus:ring-2 focus:ring-mgmp/15 focus:border-mgmp outline-none input-transition placeholder:text-slate-400">
                        </div>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1.5">Kata Sandi</label>
                        <div class="relative group">
                            <i class="fas fa-lock absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-sm group-focus-within:text-mgmp input-transition"></i>
                            <input type="password" name="password" required placeholder="Min. 8 karakter"
                                   class="w-full pl-10 pr-10 py-2.5 bg-slate-50 border @error('password') border-red-400 @else border-slate-200 @enderror rounded-xl text-sm text-slate-800 focus:bg-white focus:ring-2 focus:ring-mgmp/15 focus:border-mgmp outline-none input-transition placeholder:text-slate-400">
                            <button type="button" onclick="togglePw(this)"
                                    class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 input-transition">
                                <i class="far fa-eye text-sm"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 mb-1.5">Konfirmasi Sandi</label>
                        <div class="relative group">
                            <i class="fas fa-lock absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-sm group-focus-within:text-mgmp input-transition"></i>
                            <input type="password" name="password_confirmation" required placeholder="Ulangi kata sandi"
                                   class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-800 focus:bg-white focus:ring-2 focus:ring-mgmp/15 focus:border-mgmp outline-none input-transition placeholder:text-slate-400">
                        </div>
                    </div>

                    <!-- Terms -->
                    <div class="flex items-start gap-2 pt-1">
                        <input id="terms" name="terms" type="checkbox" required
                               class="w-4 h-4 mt-0.5 text-mgmp bg-white border-slate-300 rounded focus:ring-mgmp cursor-pointer shrink-0">
                        <label for="terms" class="text-xs text-slate-500 cursor-pointer select-none leading-relaxed">
                            Saya menyetujui <a href="#" class="font-semibold text-mgmp hover:underline">Syarat & Ketentuan</a> dan <a href="#" class="font-semibold text-mgmp hover:underline">Kebijakan Privasi</a>.
                        </label>
                    </div>
                    @error('terms')
                        <p class="text-red-500 text-xs flex items-center gap-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                    @enderror

                    <button type="submit"
                            class="w-full bg-mgmp hover:bg-mgmp-dark text-white font-semibold rounded-xl py-2.5 text-sm transition-all flex items-center justify-center gap-2 shadow-[0_4px_12px_rgba(19,99,166,0.25)] hover:shadow-[0_4px_16px_rgba(19,99,166,0.35)]">
                        Daftar Sekarang <i class="fas fa-arrow-right text-xs"></i>
                    </button>
                </form>

                <div class="mt-6 pt-5 border-t border-slate-100 text-center">
                    <p class="text-xs text-slate-500">
                        Sudah punya akun?
                        <a href="{{ route('login') }}" class="font-semibold text-mgmp hover:underline ml-1">Masuk di sini</a>
                    </p>
                </div>

                <div class="mt-4 text-center">
                    <a href="{{ route('home') }}" class="text-xs text-slate-400 hover:text-slate-600 transition-colors">
                        <i class="fas fa-arrow-left mr-1"></i> Kembali ke beranda
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePw(btn) {
            const inp = btn.previousElementSibling;
            inp.type = inp.type === 'password' ? 'text' : 'password';
            btn.querySelector('i').classList.toggle('fa-eye');
            btn.querySelector('i').classList.toggle('fa-eye-slash');
        }
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var flashMessages = document.querySelectorAll('.flash-message');
        flashMessages.forEach(function(el) {
            setTimeout(function() {
                el.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                el.style.opacity = '0';
                el.style.transform = 'translateY(-10px)';
                setTimeout(function() { el.remove(); }, 300);
            }, 3000);
        });
    });
    </script>
</body>
</html>
