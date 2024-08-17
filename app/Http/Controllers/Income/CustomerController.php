<?php

namespace App\Http\Controllers\Income;

class CustomerController
{
    public function index(){

        return view('income.customer', [
            'data' => 'hi john',
            'lovers' => ['joshua', 'jocelyn']
        ]);
    }

}
