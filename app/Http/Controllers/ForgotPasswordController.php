<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Validation\Rules\Password as PasswordRule;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    // Menampilkan form memasukkan email
    public function create()
    {
        return view('landing.partials.auth.forgot-password');
    }

    // Mengirim tautan reset password
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        // Pesan dibuat umum agar tidak membocorkan
        // apakah sebuah email terdaftar atau tidak.
        return back()->with(
            'status',
            'Jika email tersebut terdaftar, tautan reset password akan dikirimkan.'
        );
    }

    // Menampilkan form password baru
    public function edit(Request $request, string $token)
    {
        return view('landing.partials.auth.reset-password', [
            'token' => $token,
            'email' => $request->query('email'),
        ]);
    }

    // Memproses password baru
    public function update(Request $request)
    {
        $request->validate([
            'token' => ['required'],
            'email' => ['required', 'email'],
            'password' => [
                'required',
                'confirmed',
                PasswordRule::defaults(),
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
                    'password' => $password,
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()
                ->route('login')
                ->with('status', 'Password berhasil diperbarui. Silakan login kembali.');
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors([
                'email' => __($status),
            ]);
    }
}