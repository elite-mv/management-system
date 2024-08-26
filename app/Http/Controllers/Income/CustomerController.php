<?php

namespace App\Http\Controllers\Income;

use App\Models\Income\Currency;
use App\Models\Income\Customer;
use App\Models\Income\Salutation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CustomerController
{


    public function index(){

        $customers =  Customer::get();
        $salutations =  Salutation::get();
        $currencies =  Currency::get();

        return view('income.customer', [
            'customers' => $customers,
            'salutations' => $salutations,
            'currencies' => $currencies
        ]);
    }

    public function salutation_add(Request $request)
    {
        $request->validate([
            'salutation' => 'required|string|max:255|unique:salutations,salutation',
        ]);

        Salutation::create([
            'salutation' => $request->input('salutation'),
        ]);

        return response()->json(['success' => true], 200);
    }

    public function salutation_get()
    {
        $salutations = Salutation::get();

        $optionsHtml = '';
        foreach ($salutations as $salutation) {
            $optionsHtml .= '<option value="' . e($salutation->salutation) . '">' . e($salutation->salutation) . '</option>';
        }

        return response()->json(['options' => $optionsHtml]);
    }

    public function currency_add(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:currencies,name',
        ]);

        Currency::create([
            'name' => $request->input('name'),
        ]);

        return response()->json(['success' => true], 200);
    }

    public function currency_get()
    {
        $currencies = Currency::get();

        $optionsHtml = '';
        foreach ($currencies as $currency) {
            $optionsHtml .= '<option value="' . e($currency->name) . '">' . e($currency->name) . '</option>';
        }

        return response()->json(['options' => $optionsHtml]);
    }

    public function customer_add(Request $request){

        Customer::create([
            'name' => $request->input('name'),
            'position' => $request->input('position'),
            'company' => $request->input('company'),
            'email' => $request->input('email'),
            'contact_number' => $request->input('contact_number'),
            'address' => $request->input('address'),
            'currency' => $request->input('currency')
        ]);

        return response()->json(['success' => true], 200);
    }

    public function customer_get()
    {
        $customers = Customer::get();

        $optionsHtml = '';
        foreach ($customers as $customer) {
            $optionsHtml .= '
                <tr>
                    <th scope="row"><small>' . e($customer->name) . '</small></th>
                    <td><small>' . e($customer->position) . '</small></td>
                    <td><small>' . e($customer->company) . '</small></td>
                    <td><small>' . e($customer->contact_number) . '</small></td>
                    <td><small>' . e($customer->address) . '</small></td>
                    <td><small>' . e($customer->currency) . '</small></td>
                    <input type="hidden" name="id" value="' . e($customer->id) . '">
                </tr>
            ';
        }

        return response()->json(['options' => $optionsHtml]);
    }

    public function customer_select(Request $request)
    {
        $id = $request->query('id');
        $customer = Customer::where('id', $id)->first();
        if ($customer) {
            return response()->json($customer);
        } else {
            return response()->json(['message' => 'Currency not found'], 404);
        }
    }

    public function updateCustomerData(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'contact_number' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'currency' => 'required|string|max:255',
        ]);

        $customer = Customer::find($request->input('id'));

        if ($customer) {

            $customer->update($validatedData);

            return response()->json(['success' => true], 200);
        } else {
            return response()->json(['error' => 'Customer not found'], 404);
        }
    }

    

}
