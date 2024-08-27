<?php

namespace App\Http\Controllers\Income;
use Illuminate\Http\Request;

class IncomeController
{

    public function index(Request $request){

        $company = $request->attributes->get('selected_company');

        return view('income.home', [
            'company' => $company
        ]);
    }

}
