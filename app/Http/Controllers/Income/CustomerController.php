<?php

namespace App\Http\Controllers\Income;

use App\Models\Income\Customer;
use App\Models\Income\Salutation;
use Illuminate\Http\Request;

class CustomerController
{
    public function index(){

        $customers =  Customer::get();
        $salutations =  Salutation::get();

        return view('income.customer', [
            'customers' => $customers,
            'salutations' => $salutations,
        ]);
    }

    public function addCustomerData(Request $request){

        Customer::create([
            'name' => $request->input('salutation') . ' ' . $request->input('full_name'),
            'position' => $request->input('position'),
            'company' => $request->input('company'),
            'email' => $request->input('email'),
            'contact_number' => $request->input('contact_number'),
            'address' => $request->input('address'),
            'currency' => $request->input('currency')
            
        ]);

        return redirect('/income/customer');
    }

    public function addSalutationData(Request $request)
    {
        try {
            $request->validate([
                'salutation' => 'required|string|max:255',
            ]);

            Salutation::create([
                'salutation' => $request->input('salutation'),
            ]);

            return response()->json(['success' => true], 200);

        } catch (\Exception $e) {
            \Log::error('Error creating salutation: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

    public function ReaddSalutationData()
    {
        $salutations = Salutation::all();

        // Generate the HTML for <option> tags
        $optionsHtml = '';
        foreach ($salutations as $salutation) {
            $optionsHtml .= '<option value="' . e($salutation->salutation) . '">' . e($salutation->salutation) . '</option>';
        }

        return response()->json(['options' => $optionsHtml]);
    }

}
