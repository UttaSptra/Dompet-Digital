<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($request->only('email', 'password'))){
            return redirect()->route('dashboard')->with('success', 'login berhasil!');
        }

        return back()->withErrors(['email'=> 'Email atau password salah. ']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'logout berhasil. ');
    }
}
