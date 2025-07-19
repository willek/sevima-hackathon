<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function login() {
        return view('pages.auth.login');
    }

    public function postLogin(Request $request) {

        $creds = [
            'email' => $request->email,
            'password' => $request->password
        ];

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($creds)) {
            return redirect()->route('dashboard');
        }

        return redirect()->route('auth.login')->with('error', 'Invalid credentials');
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
        }

        return redirect()->route('auth.login');
    }
}
