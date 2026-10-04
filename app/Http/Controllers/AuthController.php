<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function showRegister()
    {
        if (Auth::check()) return $this->redirectByRole();
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'                  => 'required|string|max:255',
            'asal_sekolah'          => 'required|string|max:255',
            'npsn_sekolah'          => 'required|numeric',
            'email'                 => 'required|email|max:255|unique:users,email',
            'password'              => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => 'required',
            'terms'                 => 'accepted',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'asal_sekolah.required' => 'Asal sekolah wajib diisi.',
            'npsn_sekolah.required' => 'NPSN sekolah wajib diisi.',
            'npsn_sekolah.numeric' => 'NPSN sekolah harus berupa angka.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.min' => 'Kata sandi minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
            'terms.accepted' => 'Anda harus menyetujui Syarat & Ketentuan.',
        ]);

        $user = User::create([
            'name'          => $validated['name'],
            'asal_sekolah'  => $validated['asal_sekolah'],
            'npsn_sekolah'  => $validated['npsn_sekolah'],
            'email'         => $validated['email'],
            'password'      => Hash::make($validated['password']),
            'role'          => 'member',
        ]);

        return redirect()->route('login')->with('success', 'Pendaftaran berhasil! Akun Anda sedang menunggu verifikasi dari Admin sebelum dapat digunakan untuk login.');
    }

    public function showLogin()
    {
        if (Auth::check()) return $this->redirectByRole();
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Kata sandi wajib diisi.',
        ]);

        $user = User::where('email', $credentials['email'])->first();
        if ($user && is_null($user->email_verified_at)) {
            return back()->withErrors(['email' => 'Akun Anda sedang menunggu verifikasi dari Admin. Silakan coba beberapa saat lagi.'])->onlyInput('email');
        }

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return $this->redirectByRole()->with('success', 'Selamat datang kembali, ' . Auth::user()->name . '!');
        }

        return back()->withErrors(['email' => 'Email atau kata sandi salah.'])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Berhasil keluar dari akun.');
    }

    private function redirectByRole()
    {
        return Auth::user()->isAdmin()
            ? redirect()->route('admin.dashboard')
            : redirect()->route('dashboard');
    }
}
