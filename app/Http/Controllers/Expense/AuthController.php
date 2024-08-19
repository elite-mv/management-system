<?php

namespace App\Http\Controllers\Expense;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function index(){
        return view('/expense/login');
    }

    public function login(Request $request){

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/expense/request');
        }

        return back()->withErrors([
            'email' => 'Invalid email or password',
        ])->onlyInput('email');

    }

    public function logout(Request $request){
        Auth::logout();
        return redirect('/');
    }
}
