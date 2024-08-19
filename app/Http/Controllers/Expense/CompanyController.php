<?php

namespace App\Http\Controllers\Expense;

use App\Models\Expense\Company;

class CompanyController extends Controller
{
    public function  index()
    {

        $companies = Company::paginate(10);

        return view('entity', [
            'companies' => $companies,
        ]);
    }
}
