<?php

namespace App\Http\Controllers\Income;

use App\Models\Income\Customer;

class CustomerController
{
    public function index(){

        $customers =  Customer::get();

        return view('income.customer', [
            'customers' => $customers,
        ]);
    }

}
