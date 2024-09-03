<?php

namespace App\Http\Controllers;

use App\Models\Expense\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NavigationController
{
    public function index()
    {
        return view('navigation');
    }

    public function pin()
    {
        return view('pin');
    }

    public function verifyPin(Request $request)
    {

        try {

            $pin = implode('', $request->input('pin'));

            $valid = User::select(['id','pin'])
                ->where('id', '=', Auth::id())
                ->where('pin','=', $pin)
                ->pluck('pin')
                ->first();

            if(empty($valid)){
                throw new \Exception('Incorrect pin');
            }

            session(['pin_verified' => true]);

            return redirect('/navigation');

        }catch (\Exception $exception){
            return redirect()->back()->withErrors(['error' => $exception->getMessage()]);
        }
    }
}
