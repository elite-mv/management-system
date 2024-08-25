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

    public function addCustomerData(Request $request){

        Customer::create([
            'name' => $request->input('pre_name') . ' ' . $request->input('full_name'),
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
                'salutation' => 'required|string|max:255|unique:salutations,salutation',
            ]);

            Salutation::create([
                'salutation' => $request->input('salutation'),
            ]);

            return response()->json(['success' => true], 200);

        } catch (\Illuminate\Database\QueryException $e) {
            $INTEGRITY_CONSTRAINT_VIOLATION = 23000;

            if ($e->getCode() ==  $INTEGRITY_CONSTRAINT_VIOLATION ) {
                return response()->json(['error' => 'Salutation already exists'], 400);
            }

            return response()->json(['error' => $e->getMessage()], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function ReaddSalutationData()
    {
        $salutations = Salutation::get();

        $optionsHtml = '';
        foreach ($salutations as $salutation) {
            $optionsHtml .= '<option value="' . e($salutation->salutation) . '">' . e($salutation->salutation) . '</option>';
        }

        return response()->json(['options' => $optionsHtml]);
    }

    public function addCurrencyData(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:currencies,name',
            ]);

            Currency::create([
                'name' => $request->input('name'),
            ]);

            return response()->json(['success' => true], 200);

        } catch (\Illuminate\Database\QueryException $e) {
            $INTEGRITY_CONSTRAINT_VIOLATION = 23000;
            if ($e->getCode() ==  $INTEGRITY_CONSTRAINT_VIOLATION ) {
                return response()->json(['error' => 'Currency already exists'], 400);
            }

            return response()->json(['error' => $e->getMessage()], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function ReaddCurrencyData()
    {
        $currencies = Currency::get();

        $optionsHtml = '';
        foreach ($currencies as $currency) {
            $optionsHtml .= '<option value="' . e($currency->name) . '">' . e($currency->name) . '</option>';
        }

        return response()->json(['options' => $optionsHtml]);
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

    public function ReaddCustomerData()
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

    public function selectCustomerData(Request $request)
    {
        // Get the 'id' from the request query parameters
        $id = $request->query('id');

        // Perform your query logic here. Example:
        $customer = Customer::where('id', $id)->first();

        // Check if data is found
        if ($customer) {
            // Return the data as a JSON response
            return response()->json($customer);
        } else {
            // Return an error response if not found
            return response()->json(['message' => 'Currency not found'], 404);
        }
    }

}
