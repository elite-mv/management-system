<?php

namespace App\Http\Controllers\Expense;

use App\Models\Expense\Company;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function  index()
    {

        $companies = Company::where('archive', false)->paginate(10);

        return view('expense.entity', [
            'companies' => $companies,
        ]);
    }

    public function addCompany(Request $request){

        try {

            DB::beginTransaction();

            $company = new Company();

            $company->name = $request->input('name');
            $company->priority = $request->input('priority');

            if($request->file('logo')){
                $company->logo = $request->file('logo')->store('public');
            }

            $company->save();

            DB::commit();

        }catch (\Exception $exception){
            DB::rollBack();
        }

        return redirect()->back();
    }

    public function deleteCompany(Company $company){

        try {


            DB::beginTransaction();

            $company->archive = 1;

            $company->save();

            DB::commit();

        }catch (\Exception $exception){
            DB::rollBack();
        }

        return redirect()->back();
    }

    public function updateCompany(Request $request, Company $company){

        try {

            DB::beginTransaction();

            $company->name = $request->input('name');
            $company->priority = $request->input('priority');

            if($request->file('logo')){
                $company->logo = $request->file('logo')->store('public');
            }

            $company->save();

            DB::commit();

        }catch (\Exception $exception){
            DB::rollBack();
        }

        return redirect()->back();
    }
}
