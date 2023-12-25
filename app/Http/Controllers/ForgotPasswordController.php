<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    // Menampilkan formulir lupa kata sandi
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email')->with(['title' => 'Lupa Sandi']);
    }

    // Mengirim email dengan tautan reset kata sandi (opsional)
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        // Anda dapat memutuskan apakah ingin mengirim email reset di sini
        // Jika tidak, langsung tampilkan formulir reset
        return $this->showResetForm($request, Str::random(60));
    }

    // Menampilkan formulir reset kata sandi
    public function showResetForm(Request $request, $token)
    {
        $title = 'Reset Sandi';
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email, 'title' => $title,
            ]
        );
    }

    // Proses reset kata sandi
    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ]);

        // Cari pengguna dengan email yang sesuai
        $user = User::where('email', $request->email)->first();

        if ($user) {
            // Reset kata sandi dan hapus token (opsional)
            $user->update([
                'password' => Hash::make($request->password),
            ]);

            return redirect()->route('home.index')->with(['status' => 'Kata sandi berhasil direset']);
        }

        return back()->withErrors(['email' => ['Email tidak ditemukan']]);
    }
}


