<?php

namespace App\Http\Controllers\Income;

use App\Models\Income\Currency;
use App\Models\Income\Customer;
use App\Models\Income\QuotationItem;
use App\Models\Income\QuotationList;
use App\Models\Income\Salutation;
use Illuminate\Http\Request;

class QuoteController
{

    public function index(){

        $customers =  Customer::get();
        $salutations =  Salutation::get();
        $currencies =  Currency::get();
        $quotation_lists = QuotationList::orderBy('id', 'desc')->get();

        return view('income.quote', [
            'customers' => $customers,
            'salutations' => $salutations,
            'currencies' => $currencies,
            'quotation_lists' => $quotation_lists
        ]);
    }

    public function addCustomerData(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:customers,name',
                'position' => 'nullable|string|max:255',
                'company' => 'nullable|string|max:255',
                'email' => 'required|email|max:255|unique:customers,email',
                'contact_number' => 'nullable|string|max:15',
                'address' => 'nullable|string|max:255',
                'currency' => 'nullable|string',
            ]);

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

    public function ReaddCustomerData()
    {
        $customers = Customer::get();

        $optionsHtml = '';
        foreach ($customers as $customer) {
            $optionsHtml .= '<option value="' . e($customer->name) . '">' . e($customer->name) . '</option>';
        }

        return response()->json(['options' => $optionsHtml]);
    }

    public function addQuotationList(Request $request)
    {
        try {
            $request->validate([
                'customer_name' => 'required|string|max:255',
                'start_date' => 'required|string|max:255',
                'expiry_date' => 'required|string|max:255',
                'subject' => 'required|string|max:255',
                'unit' => 'required|string|max:255',
                'discount' => 'required|string|max:255',
                'shipping' => 'required|string|max:255',
                'currency' => 'required|string|max:255',
                'email' => 'required|string|max:255',
                'amount' => 'required|string|max:255',
                'message' => 'required|string|max:255',
            ]);

            $quotation = QuotationList::create([
                'customer_name' => $request->input('customer_name'),
                'start_date' => $request->input('start_date'),
                'expiry_date' => $request->input('expiry_date'),
                'subject' => $request->input('subject'),
                'unit' => $request->input('unit'),
                'discount' => $request->input('discount'),
                'shipping_charges' => $request->input('shipping'),
                'currency' => $request->input('currency'),
                'email' => $request->input('email'),
                'amount' => $request->input('amount'),
                'message' => $request->input('message')
            ]);

            return response()->json(['success' => true, 'id' => $quotation->id], 200);

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

    public function addQuotationItem(Request $request)
    {
        try {
            // Validate the incoming request
            $request->validate([
                'id' => 'required|integer|exists:quotation_lists,id',
                'items' => 'required|array'
            ]);
    
            // Find the quotation based on the ID
            $quotation = QuotationList::find($request->input('id'));
    
            if (!$quotation) {
                return response()->json(['error' => 'Quotation not found'], 404);
            }
    
            // Iterate over the items and save them
            foreach ($request->input('items') as $item) {
                QuotationItem::create([
                    'quotation_id' => $quotation->id,
                    'unit_detail' => $item['unit_details'],
                    'quantity' => $item['quantity'],
                    'unit_cost' => $item['unit_cost'],
                    'discount' => $item['discount'],
                    'amount' => $item['amount']
                ]);
            }
    
            return response()->json(['success' => true], 200);
    
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function ReaddQuotationList()
    {
        $quotations = QuotationList::orderBy('id', 'desc')->get();

        $optionsHtml = '';
        foreach ($quotations as $quote) {
            $optionsHtml .= '
                <tr>
                    <th scope="row"><small>QT-' . e($quote->reference) . '</small></th>
                    <td><small>Sample Officer</small></td>
                    <td><small>' . e($quote->customer_name) . '</small></td>
                    <td><small>' . e($quote->unit) . '</small></td>
                    <td><small>' . e($quote->message) . '</small></td>
                    <input type="hidden" name="id" value="' . e($quote->id) . '">
                </tr>
            ';
        }

        return response()->json(['options' => $optionsHtml]);
    }

    public function getQuotationList(Request $request)
    {
        try {
            // Validate the incoming request
            $request->validate([
                'id' => 'required|integer|exists:quotation_lists,id'
            ]);
    
            // Find the quotation based on the ID
            $quote = QuotationList::findOrFail($request->input('id'));
    
            return response()->json([
                'reference' => $quote->getReferenceAttribute(),
                'customer_name' => $quote->customer_name,
                'start_date' => $quote->start_date,
                'expiry_date' => $quote->expiry_date,
                'subject' => $quote->subject,
                'discount' => $quote->discount,
                'shipping_charges' => $quote->shipping_charges,
                'currency' => $quote->currency,
                'email' => $quote->email,
                'message' => $quote->message,
                'id' => $quote->id,
            ]);
    
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getQuotationItem(Request $request)
    {
        try {
            // Validate the incoming request to ensure the ID exists in the quotation_lists table
            $request->validate([
                'id' => 'required|integer|exists:quotation_lists,id'
            ]);
        
            // Find all items from the quotation_items table that have the given quotation_id
            $items = QuotationItem::where('quotation_id', $request->input('id'))->get();
        
            // Return the items as a JSON response
            return response()->json(['items' => $items], 200);
        
        } catch (\Exception $e) {
            // If there is an error, return the error message with a 500 status code
            return response()->json(['error' => $e->getMessage()], 500);
        }
        
    }

    public function getQuotationNavigation(Request $request)
    {
        // Retrieve all quotation lists
        $quotation_lists = QuotationList::orderBy('id', 'desc')->get();
        return response()->json(['success' => true, 'quotation_lists' => $quotation_lists], 200);
    }

}