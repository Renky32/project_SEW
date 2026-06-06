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
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            $user = Auth::user();

            return match($user->role) {
                'staff' => redirect('/admin/dashboard'),
                'dokter' => redirect('/dokter/dashboard'),
                'pasien' => redirect('/pasien/dashboard'),
                default => redirect('/login')
            };
        }

        return back()->withErrors([
            'email' => 'Email atau Password salah'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}