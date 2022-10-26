<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthenticationController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function logar(Request $request)
    {
        $dados = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        //dd(Hash::make('sua senha'));
        if (Auth::attempt($dados)) {


            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return redirect()->back()->with('danger', 'E-mail ou senha inválidos');

        $request->session()->regenerate();
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
