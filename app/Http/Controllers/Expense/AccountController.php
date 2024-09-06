<?php

namespace App\Http\Controllers\Expense;

use App\Models\Expense\Company;
use App\Models\Expense\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController
{

    public function index(){

        $companies = Company::select('id', 'name', 'logo')->get();

        return view('expense.account', [
            'companies' => $companies
        ]);
    }

    public function update_name(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'current_id' => 'required|exists:users,id',
        ]);

        $user = User::find($request->input('current_id'));
    
        if ($user) {
            $user->name = $request->input('name');
            $user->save();
    
            return response()->json(['success' => true], 200);
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }
    }
     

    public function update_secret_pin(Request $request) {

        $request->validate([
            'secret_pin' => 'required|string|max:255',
            'current_id' => 'required|exists:users,id',
        ]);

        $user = User::find($request->input('current_id'));
    
        if ($user) {
            $user->pin = $request->input('secret_pin');
            $user->save();
    
            return response()->json(['success' => true], 200);
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }
        
    }

    public function update_password(Request $request) {

        $request->validate([
            'password' => 'required|string|max:255',
            'current_id' => 'required|exists:users,id',
        ]);

        $user = User::find($request->input('current_id'));
    
        if ($user) {
            $user->password = $request->input('password');
            $user->save();
    
            return response()->json(['success' => true], 200);
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }
        
    }

    // public function accounts(Request $request){

    //     $query = User::query();

    //     $query->when($request->input('search'), function ($query) use ($request) {
    //         $query->where('name', 'like', '%' . $request->input('search'));
    //         $query->orWhere('email', 'like', $request->input('search') . '%');
    //     });

    //     $query->with('role', function ($query){
    //         $query->select('id', 'name');
    //     });

    //     return view('expense.accounts', [
    //         'users' => $query->paginate(20)
    //     ]);
    // }
}
