<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{

    public function logIn(Request $request)
    {
        // dd(Hash::Make($request->password));

        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'E-mail é obrigatório',
            'password.required' => 'A senha é obrigatória',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            return view('layouts.create');
            dd('logou');
        } else {

            return redirect()->back()->with('danger', 'E-mail ou senha inválidos');

            $request->session()->regenerate();
        }
    }
}
