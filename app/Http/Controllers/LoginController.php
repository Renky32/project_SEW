<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $login = $request->username;

        $field = filter_var($login, FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'username';

        if (
            Auth::attempt([
                $field => $login,
                'password' => $request->password
            ])
        ) {

            $request->session()->regenerate();

            return redirect('/dashboard');
        }

        return back()
            ->withInput()
            ->with(
                'error',
                'Username/Email atau password salah.'
            );
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login')
            ->with(
                'success',
                'Anda berhasil logout'
            );
    }
}
