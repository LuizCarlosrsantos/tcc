<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        if (!Auth::check()) {
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                $remember = $request->input('remember', false);
                $email = $request->input('email');
                $password = $request->input('password');

                Auth::attempt(['email' => $email, 'password' => $password], $remember);

                return redirect()->route('curriculum.index');
            }
        }

        return redirect()->back()->withErrors(['message' => 'Usuário ou senha inválidos'])->withInput();
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
