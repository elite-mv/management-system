<?php

namespace App\Http\Controllers\Expense;

use App\Models\Expense\Company;
use App\Models\Expense\User;
use Illuminate\Http\Request;
use App\Models\Expense\Request as ModelsRequest;
use App\Models\Expense\RequestItem;
use Illuminate\Support\Facades\Auth;
use App\Enums\RequestApprovalStatus;
use Illuminate\Support\Facades\DB;

class AccountController
{

    public function index(){

        $companies = Company::select('id', 'name', 'logo')->get();
        $requests_query = ModelsRequest::query();
        $requests_query->with(['approvals' => function($query){
            $query->select(['id','request_id',DB::raw('COUNT(*) as count')])
            ->where('status', RequestApprovalStatus::APPROVED->name)
            ->groupBy('request_id','id');
        }])->where('prepared_by', Auth::id());
        $requests = $requests_query->get();

        return view('expense.account', [
            'companies' => $companies,
            'requests' => $requests
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
            $user->password = bcrypt($request->input('password'));
            $user->save();

            return response()->json(['success' => true], 200);
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }

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
