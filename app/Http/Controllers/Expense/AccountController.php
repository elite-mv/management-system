<?php

namespace App\Http\Controllers\Expense;

use App\Models\Expense\Company;
use App\Models\Expense\User;
use Illuminate\Http\Request;

class AccountController
{

    public function index(){

        $companies = Company::select('id', 'name', 'logo')->get();

        return view('expense.account', [
            'companies' => $companies
        ]);
    }

    public function update_account(){


    }

     public function accounts(Request $request){

         $query = User::query();

         $query->when($request->input('search'), function ($query) use ($request) {
             $query->where('name', 'like', '%' . $request->input('search'));
             $query->orWhere('email', 'like', $request->input('search') . '%');
         });

         $query->with('role', function ($query){
             $query->select('id', 'name');
         });

         return view('expense.accounts', [
             'users' => $query->paginate(20)
         ]);
     }
}
