<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    // HALAMAN PROFIL
    public function index()
    {
        return view('profile.show', [
            'user' => auth()->user()
        ]);
    }

    // UPDATE PROFIL
    public function update(Request $request)
    {
        $user = $request->user();

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id)
            ],
            'phone' => ['nullable', 'string', 'max:20'],
            'jabatan' => ['nullable', 'string', 'max:255'],
            'instansi' => ['nullable', 'string', 'max:255'],
            'alamat' => ['nullable', 'string'],
        ]);

        $user->update($data);

        return back()->with(
            'success',
            'Profil berhasil diperbarui.'
        );
    }

    // UPDATE PASSWORD
    public function updatePassword(Request $request)
    {
        $request->validateWithBag('password', [
            'current_password' => ['required'],
            'password' => [
                'required',
                'confirmed',
                Password::min(8)->mixedCase()->numbers()->symbols()
            ],
        ]);

        $user = $request->user();

        if (!Hash::check(
            $request->current_password,
            $user->password
        )) {
            return back()->withErrors([
                'current_password' => 'Password saat ini salah.'
            ], 'password');
        }

        $user->update([
            'password' => $request->password
        ]);

        return back()->with(
            'success',
            'Password berhasil diganti.'
        );
    }
}