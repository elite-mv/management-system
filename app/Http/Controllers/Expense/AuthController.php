<?php

namespace App\Http\Controllers\Expense;

use App\Models\User;
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

        if (Auth::attempt($credentials, $request->boolean('remember_me'))) {

            $request->session()->regenerate();

            // Retrieve the authenticated user
            $user = Auth::user();

            // Check if the user's company ID is 3
            if ($user->company_id === 3) {
                return redirect()->intended('/income/gti');
            }

            // Default redirection for other users
            return redirect()->intended('/expense/request');
        }

        return back()->withErrors([
            'email' => 'Invalid email or password',
        ])->onlyInput('email');

    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->forget('pin_verified');
        return redirect('/');
    }
}
