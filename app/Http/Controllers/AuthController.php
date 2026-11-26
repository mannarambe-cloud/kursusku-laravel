<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;

class AuthController extends Controller
{
    // =====================================
    // MENAMPILKAN HALAMAN LOGIN
    // =====================================

    public function showLogin()
    {
        return view('auth.login');
    }

    // =====================================
    // MENAMPILKAN HALAMAN REGISTER
    // =====================================

    public function showRegister()
    {
        return view('auth.register');
    }

    // =====================================
    // PROSES REGISTER
    // =====================================

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'name.required' => 'Nama lengkap harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password harus diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak sama.',
        ]);

        // Membuat username otomatis dari email
        $username = Str::before($request->email, '@');

        // Memastikan username tidak duplikat
        $baseUsername = $username;
        $counter = 1;

        while (User::where('username', $username)->exists()) {
            $username = $baseUsername . $counter;
            $counter++;
        }

        // Menyimpan data pengguna
        $user = User::create([
            'name' => $request->name,
            'username' => $username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => 'aktif',
        ]);

        // Login otomatis setelah daftar
        Auth::login($user);

        $request->session()->regenerate();

        return redirect()->route('dashboard')
            ->with('success', 'Pendaftaran berhasil! Selamat datang di KursusKu.');
    }

    // =====================================
    // PROSES LOGIN
    // =====================================

    public function login(Request $request)
    {
        $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'login.required' => 'Username atau email harus diisi.',
            'password.required' => 'Password harus diisi.',
        ]);

        $login = $request->input('login');

        $field = filter_var($login, FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'username';

        $credentials = [
            $field => $login,
            'password' => $request->input('password'),
            'status' => 'aktif',
        ];

        if (Auth::attempt(
            $credentials,
            $request->boolean('remember')
        )) {

            $request->session()->regenerate();

            return redirect()->intended(route('dashboard'))
                ->with('success', 'Login berhasil! Selamat datang di KursusKu.');
        }

        return back()
            ->withErrors([
                'login' => 'Username/email atau password salah, atau akun tidak aktif.',
            ])
            ->onlyInput('login');
    }

    // =====================================
    // LOGOUT
    // =====================================

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home')
            ->with('success', 'Kamu berhasil logout.');
    }

    // =====================================
    // HALAMAN LUPA PASSWORD
    // =====================================

    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    // =====================================
    // KIRIM LINK RESET PASSWORD
    // =====================================

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with(
                'success',
                'Link reset password berhasil dikirim ke email.'
            );
        }

        return back()->withErrors([
            'email' => __($status),
        ]);
    }

    // =====================================
    // HALAMAN RESET PASSWORD
    // =====================================

    public function showResetPassword(Request $request, $token)
    {
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->email,
        ]);
    }

    // =====================================
    // PROSES RESET PASSWORD
    // =====================================

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => [
                'required',
                'confirmed',
                'min:8',
            ],
        ]);

        $status = Password::reset(
            $request->only(
                'email',
                'password',
                'password_confirmation',
                'token'
            ),

            function ($user, $password) {

                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login')
                ->with(
                    'success',
                    'Password berhasil diubah. Silakan login kembali.'
                );
        }

        return back()->withErrors([
            'email' => [__($status)],
        ]);
    }
}