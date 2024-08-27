<?php

namespace App\Http\Controllers\Income;

use App\Models\Income\Currency;
use App\Models\Income\Customer;
use App\Models\Income\QuotationItem;
use App\Models\Income\Quotation;
use App\Models\Income\Salutation;
use Illuminate\Http\Request;

class QuoteController
{

    public function index(){

        $customers =  Customer::get();
        $salutations =  Salutation::get();
        $currencies =  Currency::get();
        $quotation_lists = Quotation::orderBy('id', 'desc')->get();

        return view('income.quote', [
            'customers' => $customers,
            'salutations' => $salutations,
            'currencies' => $currencies,
            'quotation_lists' => $quotation_lists
        ]);
    }

    public function customer_get()
    {
        $customers = Customer::get();

        $optionsHtml = '';
        foreach ($customers as $customer) {
            $optionsHtml .= '<option value="' . e($customer->name) . '"  data-currency="' . e($customer->currency) . '" data-email="' . e($customer->email) . '">' . e($customer->name) . '</option>';
        }

        return response()->json(['options' => $optionsHtml]);
    }

    public function add_list(Request $request)
    {
        $quotation = Quotation::create([
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
    }

    public function add_item(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:quotation_lists,id',
            'items' => 'required|array'
        ]);

        $quotation = Quotation::find($request->input('id'));

        if (!$quotation) {
            return response()->json(['error' => 'Quotation not found'], 404);
        }

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
    }

    public function get_list()
    {
        $quotations = Quotation::orderBy('id', 'desc')->get();

        $optionsHtml = '';
        foreach ($quotations as $quote) {
            $optionsHtml .= '
                <tr>
                    <th scope="row"><small onclick="open_quote({{ $quotation->id }});">QT-' . e($quote->reference) . '</small></th>
                    <td><small onclick="open_quote({{ $quotation->id }});">Sample Officer</small></td>
                    <td><small onclick="open_quote({{ $quotation->id }});">' . e($quote->customer_name) . '</small></td>
                    <td><small onclick="open_quote({{ $quotation->id }});">' . e($quote->unit) . '</small></td>
                    <td><small onclick="open_quote({{ $quotation->id }});">' . e($quote->message) . '</small></td>
                    <td><small onclick="open_quote({{ $quotation->id }});">PENDING</small></td>
                </tr>
            ';
        }

        return response()->json(['options' => $optionsHtml]);
    }

    public function get_navigation_list(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:quotation_lists,id'
        ]);

        // Find the quotation based on the ID
        $quote = Quotation::findOrFail($request->input('id'));

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
    }

    public function get_navigation_item(Request $request)
    {
        $request->validate([
            'id' => 'required|integer|exists:quotation_lists,id'
        ]);

        $items = QuotationItem::where('quotation_id', $request->input('id'))->get();

        return response()->json(['items' => $items], 200);
    }

    public function get_navigation(Request $request)
    {
        $quotation_lists = Quotation::orderBy('id', 'desc')->get();
        return response()->json(['success' => true, 'quotation_lists' => $quotation_lists], 200);
    }

}
