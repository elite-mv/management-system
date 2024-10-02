@extends('layouts.income-index')

@section('title', 'MS [ Income ] - Quotes')

@section('style')
    <style>
        .income-with-nav > nav {
            .quote {
                background-color: rgb(24, 28, 46);
            }
        }

        .quote-item {
            background-color: rgba(0, 0, 0, 0.05);
        }

        .quote-item:hover, .quote-selected {
            background-color: rgba(0, 0, 0, 0.1);
            border: 1px solid #000
        }
    </style>
@endsection

@section('body')
    <div class="w-100 d-flex align-items-start border">
        <div class="container-fluid p-3">
            <div class="row my-3">
                <div class="col-12">
                    <div class="card overflow-x-auto">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-table me-1"></i>
                                <b>List of Quotations</b>
                            </div>
                            <div>
                                <button type="button" class="btn btn-sm btn-danger rounded-0 px-3 d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#quotationModal">
                                    <i class="fas fa-plus-circle me-2"></i>QUOTATION
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="quote">
                                <thead>
                                    <tr>
                                        <th scope="col">QT#</th>
                                        <th scope="col">Sales Officer</th>
                                        <th scope="col">Customer</th>
                                        <th scope="col">Unit</th>
                                        <th scope="col">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($quotation_lists as $quotation)
                                        <tr>
                                            <th scope="row"><small onclick="open_quote({{ $quotation->id }});">QT-{{$quotation->reference}}</small></th>
                                            <td><small onclick="open_quote({{ $quotation->id }});">Sales Officer</small></td>
                                            <td><small onclick="open_quote({{ $quotation->id }});">{{$quotation->customer_name}}</small></td>
                                            <td><small onclick="open_quote({{ $quotation->id }});">{{$quotation->unit}}</small></td>
                                            <td><small onclick="open_quote({{ $quotation->id }});">{{$quotation->message}}</small></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade text-dark" id="quotationModal" tabindex="-1" aria-labelledby="Quotation Configuration" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <form method="POST" action="/income/quote">
                            @csrf
                            <div class="modal-header">
                                <h1 class="modal-title fs-5">Quotation Configuration</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="d-flex gap-3" style="flex-direction: column;">
                                    <div>
                                        <b>Customer Name</b>
                                        <input class="form-control" list="customerSearchSuggestion" id="customerSearch" placeholder="Type to search...">
                                        <datalist id="customerSearchSuggestion">
                                            @foreach($searchCustomers as $customer)
                                                <option value="{{$customer->name}}">
                                            @endforeach
                                        </datalist>
                                    </div>

                                    <div class="d-flex flex-direction-row gap-3">
                                        <div class="w-50">
                                            <b>Start Date</b>
                                            <small><input type="date" class="form-control" name="start_date" disabled></small>
                                        </div>
                                        <div class="w-50">
                                            <b>Expiry Date</b>
                                            <small><input type="date" class="form-control" name="expiry_date"></small>
                                        </div>
                                    </div>

                                    <div>
                                        <b>Email Subject</b>
                                        <small><textarea class="form-control" placeholder="Let your customer know what this quote is for..." name="subject" required></textarea></small>
                                    </div>

                                    <div style="overflow-x: auto;">
                                        <table  class="table table-bordered" id="quotationTable">
                                            <thead>
                                                <tr>
                                                    <th scope="col" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">UNIT DETAILS</th>
                                                    <th scope="col" class="text-end ps-5" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">QUANTITY</th>
                                                    <th scope="col" class="text-end ps-5" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">UNIT COST</th>
                                                    <th scope="col" class="text-end ps-5" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">DISCOUNT(%)</th>
                                                    <th scope="col" class="text-end ps-5" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">AMOUNT</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="p-0">
                                                        <input name="details[]" type="text" class="w-100 p-2 form-control" placeholder="Type the unit details." style="width: 300px;">
                                                    </td>
                                                    <td class="p-0">
                                                        <input name="quantity[]" type="number" class="p-2 rounded-0 border-0 text-end form-control" value="1.00" step=".01">
                                                    </td>
                                                    <td class="p-0">
                                                        <input name="cost[]" type="number" class="p-2 rounded-0 border-0 text-end form-control" value="0.00" step=".01">
                                                    </td>
                                                    <td class="p-0">
                                                        <input name="discount[]" type="number" class="p-2 rounded-0 border-0 text-end form-control" max="100" min="0" value="0" step=".01">
                                                    </td>
                                                    <td class="p-0">
                                                        <input class="p-2 rounded-0 border-0 text-end form-control" value="0.00" step=".01" disabled>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="d-flex flex-direction-row gap-3">

                                        <div class="d-flex flex-direction-row" style="height: 50%; width: 50%;">
                                                <button type="button" class="btn btn-outline-danger rounded-0" id="addItemBtn">+ ITEM</button>
                                                <input type="number" value="1" min="1" max="100" id="addItemInput" class="px-2 rounded-0 border-1 text-end" style="width: 60px; border-style: solid solid solid none;">
                                        </div>

                                        <div class="d-flex p-3 w-100 bg-light gap-2" style="flex-direction: column; border-radius: 10px;">
                                            <div class="d-flex" style="justify-content: left;">
                                                <div>
                                                    <b>Sub Total</b>
                                                </div>
                                                <div class="ms-auto">
                                                    <b id="sub_total">0.00</b>
                                                </div>
                                            </div>

                                            <div class="d-flex" style="justify-content: left;">
                                                <div class="d-flex flex-direction-row align-items-center">
                                                    <small>Discount</small>
                                                    <input type="number" class="px-2 rounded-0 border border-dark text-end ms-3" style="width: 60px; border-style: solid none solid solid !important;" min="0" max="100" value="0" step=".01" id="discountInput">
                                                    <b class="border border-dark rounded-0 px-2" style="border-style: solid solid solid none !important;">%</b>
                                                </div>
                                                <div class="ms-auto">
                                                    <small id="discount">0 %</small>
                                                </div>
                                            </div>

                                            <div class="d-flex" style="justify-content: left;">
                                                <div class="d-flex flex-direction-row align-items-center">
                                                    <small>Shipping Charges</small>
                                                    <input type="number" class="px-2 rounded-0 border border-dark text-end ms-3" style="width: 60px;" value="0" step=".01" id="shippingInput">
                                                </div>
                                                <div class="ms-auto">
                                                    <small id="shipping">0.00</small>
                                                </div>
                                            </div>

                                            <hr class="m-0 mt-2">

                                            <div class="d-flex" style="justify-content: left;">
                                                <div>
                                                    <b>Total <span name="currency"></span></b>
                                                </div>
                                                <div class="ms-auto">
                                                    <b id="total">0.00</b>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div>
                                        <b>Customer Notes</b>
                                        <small><textarea class="form-control" name="message">Looking forward for your business.</textarea></small>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success rounded-pill w-50 mx-auto">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade text-dark" id="customerModal" tabindex="-2" aria-labelledby="Customer Configuration" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <form id="customerForm">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5">Customer Configuration</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="d-flex gap-3" style="flex-direction: column;">
                                    <div>
                                        <b>Customer Name</b>
                                        <div class="d-flex flex-direction-row gap-3">
                                            <small>
                                                <input list="customer_salutation" type="text" name="customer_salutation" placeholder="Type or select..." class="form-control" required>
                                                <datalist id="customer_salutation">
                                                    @foreach($salutations as $salutation)
                                                        <option value="{{$salutation->salutation}}">{{$salutation->salutation}}</option>
                                                    @endforeach
                                                    <option value="Add New">Add New</option>
                                                </datalist>
                                            </small>
                                            <small class="w-100 d-flex align-items-center" style="flex-direction: column;">
                                                <input type="type" class="form-control" name="customer_name" required>
                                                <span>Full Name</span>
                                            </small>
                                        </div>
                                    </div>

                                    <div>
                                        <b>Position</b>
                                        <small><input type="text" class="form-control" name="position"></small>
                                    </div>

                                    <div>
                                        <b>Company</b>
                                        <small><input type="text" class="form-control" name="company"></small>
                                    </div>

                                    <div>
                                        <b>Email</b>
                                        <small><input type="email" class="form-control" name="email" required></small>
                                    </div>

                                    <div>
                                        <b>Contact Number</b>
                                        <small><input type="tel" class="form-control" name="contact_number"></small>
                                    </div>

                                    <div>
                                        <b>Address</b>
                                        <small><textarea class="form-control" name="address"></textarea></small>
                                    </div>

                                    <div>
                                        <b>Currency</b>
                                        <small>
                                            <input list="customer_currency" name="customer_currency" placeholder="Type or select..." class="form-control" required>
                                            <datalist id="customer_currency">
                                                @foreach($currencies as $currency)
                                                    <option value="{{$currency->name}}">{{$currency->name}}</option>
                                                @endforeach
                                                <option value="Add New">Add New</option>
                                            </datalist>
                                        </small>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success rounded-pill w-50 mx-auto">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade text-dark" id="salutationModal" tabindex="-3" aria-labelledby="Salutation Configuration" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <form id="salutationForm">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5">Salutation Configuration</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="d-flex gap-3" style="flex-direction: column;">
                                    <div>
                                        <b>Salutation</b>
                                        <div>
                                            <small class="d-flex align-items-center" style="flex-direction: column;">
                                                <div class="p-3 h-50 w-100">
                                                    <input type="text" class="form-control" name="salutation_salutation" required>
                                                </div>
                                                <div class="p-3 d-flex flex-column align-items-center justify-content-start overflow-y-auto w-100" style="height: 100px;" id="salutation_salutation">
                                                    @if($salutations->isNotEmpty())
                                                        @foreach($salutations as $salutation)
                                                            <div>
                                                                <b>{{$salutation->salutation}}</b>
                                                                <em class="ms-1 text-success">is already added
                                                                    <i class="fas fa-check-circle ms-2"></i>
                                                                </em>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <div>
                                                            <em class="text-muted fw-bold">No data is added yet.</em>
                                                        </div>
                                                    @endif
                                                </div>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success rounded-pill w-50 mx-auto">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade text-dark" id="currencyModal" tabindex="-4" aria-labelledby="Currency Configuration" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <form id="currencyForm">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5">Currency Configuration</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="d-flex gap-3" style="flex-direction: column;">
                                    <div>
                                        <b>Currency</b>
                                        <div>
                                            <small class="d-flex align-items-center" style="flex-direction: column;">
                                                <div class="p-3 h-50 w-100">
                                                    <input type="text" name="currency_currency" class="form-control" required>
                                                </div>
                                                <div class="p-3 d-flex flex-column align-items-center justify-content-start overflow-y-auto w-100" style="height: 100px;" id="currency_currency">
                                                    @if($currencies->isNotEmpty())
                                                        @foreach($currencies as $currency)
                                                            <div>
                                                                <b>{{$currency->name}}</b>
                                                                <em class="ms-1 text-success">is already added
                                                                    <i class="fas fa-check-circle ms-2"></i>
                                                                </em>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <div>
                                                            <em class="text-muted fw-bold">No data is added yet.</em>
                                                        </div>
                                                    @endif
                                                </div>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success rounded-pill w-50 mx-auto">Add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade text-dark" id="viewModal" tabindex="-5" aria-labelledby="View Quotation" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5">View Quotation</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="p-0 d-flex gap-2">
                                <div class="w-25 border overflow-y-auto p-1 d-flex flex-column gap-1 bg-white" id="view_navigation">
                                    {{-- DYNAMIC --}}
                                </div>
                                <div id="email" class="w-75 mx-auto bg-white border border-1 d-flex p-5" style="flex-direction: column; position: relative; overflow: hidden;">
                                    <div style="position: absolute; top: 30px; left: -200px; transform: rotate(-45deg); transform-origin: center center; width: 500px;" class="bg-warning px-3 rounded-0 py-1 text-center">
                                        <b class="text-white">PENDING</b>
                                    </div>
                                    <div style="display:flex; justify-content: space-between; align-items: end;">
                                        <div>
                                            <img src="https://scontent.fmnl17-5.fna.fbcdn.net/v/t39.30808-6/436333164_122097311072279047_9058578855259586650_n.jpg?_nc_cat=108&ccb=1-7&_nc_sid=6ee11a&_nc_ohc=4gW7EZNLtAAQ7kNvgGD9zwu&_nc_ht=scontent.fmnl17-5.fna&oh=00_AYDEgtWUP4OiqtC6EQkysZnm_KiutA-bOhSTiUWsgFeqig&oe=66CDD54C" class="img-fluid" style="width: 75px; height: 75px;" alt="LOGO">
                                        </div>
                                        <div>
                                            <b><h2>QUOTE</h2></b>
                                        </div>
                                    </div>
                                    <div style="display:flex; justify-content: space-between; align-items: start;">
                                        <div class="d-flex" style="flex-direction: column;">
                                            <b>ELITE ACES TRADING INC.</b>
                                            <small>Noveleta,</small>
                                            <small>Cavite,</small>
                                            <small>Philippines</small>

                                        </div>
                                        <div>
                                            <b name="reference">-</b>
                                        </div>
                                    </div>
                                    <div class="mt-3 d-flex" style="flex-direction: column;">
                                        <b>BILL TO</b>
                                        <b name="customer_name" class="text-primary">-</b>
                                    </div>
                                    <div style="display:flex; justify-content: right;">
                                        <div class="d-flex w-50 ps-5" style="flex-direction: column;">
                                            <div style="display:flex; justify-content: space-between;">
                                                <div>
                                                    <small>Quote Date:</small>
                                                </div>
                                                <div>
                                                    <small name="start_date">-</small>
                                                </div>
                                            </div>
                                            <div style="display:flex; justify-content: space-between;">
                                                <div>
                                                    <small>Expiry Date:</small>
                                                </div>
                                                <div>
                                                    <small name="expiry_date">-</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-2">
                                        <div class="overflow-x-auto">
                                            <table class="table table-border table-hover" id="view">
                                                <thead>
                                                    {{-- DYNAMIC CONTENT --}}
                                                </thead>
                                                <tbody>
                                                    {{-- DYNAMIC CONTENT --}}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div style="display:flex; justify-content: right;">
                                        <div class="d-flex w-50 ps-5" style="flex-direction: column;">
                                            <div style="display:flex; justify-content: space-between;">
                                                <div>
                                                    <b>Sub Total:</b>
                                                </div>
                                                <div>
                                                    <b name="sub_total">0.00</b>
                                                </div>
                                            </div>
                                            <div style="display:flex; justify-content: space-between;" id="view_discount">
                                                <div>
                                                    <small>Discount:</small>
                                                </div>
                                                <div>
                                                    <small name="discount">0.00</small>
                                                </div>
                                            </div>
                                            <div style="display:flex; justify-content: space-between;">
                                                <div>
                                                    <small>Shipping Charges:</small>
                                                </div>
                                                <div>
                                                    <small name="shipping_charges">0.00</small>
                                                </div>
                                            </div>
                                            <div style="display:flex; justify-content: space-between;">
                                                <div>
                                                    <b>Total:</b>
                                                </div>
                                                <div>
                                                    <b name="total">0.00</b>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-2 d-flex" style="flex-direction: column;">
                                        <b>SALES OFFICER</b>
                                        <b class="text-primary" name="sales_officer">-</b>
                                    </div>
                                    <div class="mt-2 d-flex" style="flex-direction: column;">
                                        <small>Note:</small>
                                        <small class="ms-5" name="message">-</small>
                                    </div>
                                    <hr class="p-0 my-3 mb-2">
                                    <div>
                                        <small>By clicking proceed, you'll be redirected to our secured system where you can further discuss the process of this quote.</small>
                                    </div>
                                    <div class="mt-2 text-center">
                                        <small>
                                            <button class="btn btn-success rounded-pill w-50 px-5">Proceed</button>
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success rounded-pill w-50 mx-auto" id="send_email">Send To Customer</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script>

        const customerSearch = document.querySelector('#customerSearch');
        const customerSearchSuggestion = document.querySelector('#customerSearchSuggestion');

        const quotationTable = document.querySelector('#quotationTable');

        const addItemBtn = document.querySelector('#addItemBtn');
        const addItemInput = document.querySelector('#addItemInput');

        let timer;
        let prevValue = '';
        const timeoutVal = 300;

        customerSearch.addEventListener('keyup', handleKeyUp);
        customerSearch.addEventListener('keydown', handleKeyPress);

        customerSearch.addEventListener('change', ()=>{

            const options = customerSearchSuggestion.options;

            for (let i = 0; i < options.length; i++) {
                if (options[i].value === customerSearch.value) {
                    prevValue = customerSearch.value;
                }
            }
        });

        function handleKeyUp(e) {

            window.clearTimeout(timer); // prevent errant multiple timeouts from being generated

            customerSearchSuggestion.innerHTML = null;

            timer = window.setTimeout(async () => {

                if(!customerSearch.value.length){
                     return;
                }

                if(prevValue === customerSearch.value){
                    return;
                }

                const formData = new FormData();
                formData.append('search', customerSearch.value)

                const queryString = new URLSearchParams(formData).toString();

                const response = await fetch(`/income/api/customers?${queryString}`);

                const result = await response.json();

                prevValue = customerSearch.value;

                if(response.ok){
                    result.forEach(customer =>{
                        const option = document.createElement('option');
                        option.value = customer.name; // Set the value of the option
                        customerSearchSuggestion.appendChild(option);
                    })
                }

                console.log('suggesting ...');

            }, timeoutVal);
        }

        function handleKeyPress(e) {
            window.clearTimeout(timer);
        }

        addItemBtn.addEventListener('click',()=>{
            appendItem(addItemInput.value);
        })

        function appendItem(max = 1){

            const inputClasList = ['form-control'];

            for (let i = 0; i < max; i++) {

                const tr = document.createElement('tr');
                const details = document.createElement('td');
                const quantity = document.createElement('td');
                const cost = document.createElement('td');
                const discount = document.createElement('td');
                const amount = document.createElement('td');

                const detailsInput = document.createElement('input');
                const quantityInput = document.createElement('input');
                const costInput = document.createElement('input');
                const discountInput = document.createElement('input');
                const amountInput = document.createElement('input');

                detailsInput.setAttribute('name', 'details[]');
                quantityInput.setAttribute('name', 'quantity[]');
                costInput.setAttribute('name', 'cost[]');
                discountInput.setAttribute('name', 'discount[]');

                detailsInput.classList.add(...inputClasList);
                quantityInput.classList.add(...inputClasList);
                costInput.classList.add(...inputClasList);
                discountInput.classList.add(...inputClasList);
                amountInput.classList.add(...inputClasList);

                detailsInput.setAttribute('placeholder', 'Type the unit details.');
                quantityInput.setAttribute('type', 'number');
                costInput.setAttribute('type', 'number');
                discountInput.setAttribute('type', 'number');
                amountInput.disabled = true;

                quantityInput.setAttribute('min', '1');
                costInput.setAttribute('min', '0');
                discountInput.setAttribute('min', '0');

                details.appendChild(detailsInput);
                quantity.appendChild(quantityInput);
                cost.appendChild(costInput);
                discount.appendChild(discountInput);
                amount.appendChild(amountInput);

                tr.appendChild(details);
                tr.appendChild(quantity);
                tr.appendChild(cost);
                tr.appendChild(discount);
                tr.appendChild(amount);

                quotationTable.appendChild(tr)
            }
        }

        window.addEventListener('load', function() {
            Get_Quote();
            const today = new Date();
            const formattedDate = today.toISOString().split('T')[0];
            document.querySelector('.modal-body [name="start_date"]').value = formattedDate;
            document.querySelector('.modal-body [name="expiry_date"]').min = formattedDate;
        });

        $('select[name="customer_name"]').on('change', function() {
            var selectedOption = $(this).find('option:selected');
            var selectedValue = selectedOption.val();

            if (selectedValue === 'Add New') {
                new bootstrap.Modal(document.getElementById('customerModal')).show();
                $(this).val('');
            } else {
                var currency = selectedOption.data('currency');
                var email = selectedOption.data('email');
                $('#quotationModal').find('span[name="currency"]').html(currency);
                window.localStorage.setItem('email', email);
            }
        })

        $('input[name="customer_salutation"]').on('input', function() {
            if ($(this).val() === 'Add New') {
                new bootstrap.Modal(document.getElementById('salutationModal')).show();
                $(this).val('');
            }
        })

        document.querySelector('#salutationForm').addEventListener('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: "/income/customer/salutation/add",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                },
                method: "POST",
                data: {
                    salutation: $(this).find('input[name="salutation_salutation"]').val()
                },
                success: function (data) {
                    $.ajax({
                        url: "/income/customer/salutation/get",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                        },
                        method: "GET",
                        success: function (data) {
                            $('#customerModal').find('#customer_salutation').html('');
                            $('#customerModal').find('#customer_salutation').html(data.options);
                            $('#customerModal').find('#customer_salutation').append('<option value="Add New">Add New</option>');

                            $('#customerModal').find('input[name="customer_salutation"]').val($('#salutationForm').find('input[name="salutation_salutation"]').val());

                            $('#salutationModal').find('#salutation_salutation').append(
                                '<div>' +
                                    '<b>' + $('#salutationForm').find('input[name="salutation_salutation"]').val() + '</b>' +
                                    '<em class="ms-1 text-success">is already added' +
                                        '<i class="fas fa-check-circle ms-2"></i>' +
                                    '</em>' +
                                '</div>'
                            );

                            bootstrap.Modal.getInstance(document.querySelector('#salutationModal')).hide();
                            $('#salutationForm')[0].reset();
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.error('Error:', textStatus, errorThrown);
                        }
                    });
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error('Error:', textStatus, errorThrown);
                }
            });
        });

        $('input[name="customer_currency"]').on('input', function() {
            if ($(this).val() === 'Add New') {
                new bootstrap.Modal(document.getElementById('currencyModal')).show();
                $(this).val('');
            }
        })

        document.querySelector('#currencyForm').addEventListener('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: "/income/customer/currency/add",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                },
                method: "POST",
                data: {
                    name: $(this).find('input[name="currency_currency"]').val()
                },
                success: function (data) {
                    $.ajax({
                        url: "/income/customer/currency/get",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                        },
                        method: "GET",
                        success: function (data) {
                            $(this).find('input[name="name"]').val('');
                            $('#customerModal').find('select[name="currency"]').html('');
                            $('#customerModal').find('select[name="currency"]').html(data.options);
                            $('#customerModal').find('select[name="currency"]').append('<option value="Add New">Add New</option>');

                            $('#customerModal').find('#customer_currency').html('');
                            $('#customerModal').find('#customer_currency').html(data.options);
                            $('#customerModal').find('#customer_currency').append('<option value="Add New">Add New</option>');

                            $('#customerModal').find('input[name="customer_currency"]').val($('#currencyForm').find('input[name="currency_currency"]').val());

                            $('#currencyModal').find('#currency_currency').append(
                                '<div>' +
                                    '<b>' + $('#currencyForm').find('input[name="currency_currency"]').val() + '</b>' +
                                    '<em class="ms-1 text-success">is already added' +
                                        '<i class="fas fa-check-circle ms-2"></i>' +
                                    '</em>' +
                                '</div>'
                            );

                            bootstrap.Modal.getInstance(document.querySelector('#currencyModal')).hide();
                            $('#currencyForm')[0].reset();
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.error('Error:', textStatus, errorThrown);
                        }
                    });
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error('Error:', textStatus, errorThrown);
                }
            });
        });

        document.querySelector('#customerForm').addEventListener('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: "/income/customer/add",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                },
                method: "POST",
                data: {
                    name: $(this).find('input[name="customer_salutation"]').val() + ' ' + $(this).find('input[name="customer_name"]').val(),
                    position: $(this).find('input[name="position"]').val(),
                    company: $(this).find('input[name="company"]').val(),
                    email: $(this).find('input[name="email"]').val(),
                    contact_number: $(this).find('input[name="contact_number"]').val(),
                    address: $(this).find('textarea[name="address"]').val(),
                    currency: $(this).find('input[name="customer_currency"]').val()
                },
                success: function (data) {
                    $.ajax({
                        url: "/income/customer/get",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                        },
                        method: "GET",
                        success: function (data) {
                            $('#customer tbody').html('');
                            $('#customer tbody').html(data.options);
                            Get_Customer($('#customerForm').find('input[name="customer_salutation"]').val() + ' ' + $('#customerForm').find('input[name="customer_name"]').val());
                            bootstrap.Modal.getInstance(document.querySelector('#customerModal')).hide();
                            $('#customerForm')[0].reset();
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.error('Error:', textStatus, errorThrown);
                        }
                    });
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error('Error:', textStatus, errorThrown);
                }
            });
        })

        document.querySelector('.modal-body [name="add_item"]').addEventListener('click', function(event) {
            event.preventDefault();

            const quantity = document.querySelector('.modal-body [name="add_item_number"]').value;

            for (let i = 0; i < quantity; i++) {
                const newRow = `
                    <tr>
                        <th scope="row" class="p-0">
                            <input type="text" class="p-2 rounded-0 border-0 form-control" placeholder="Type the unit details." style="width: 300px;">
                        </th>
                        <td class="p-0">
                            <input type="number" class="p-2 rounded-0 border-0 text-end form-control" value="1.00" step=".01">
                        </td>
                        <td class="p-0">
                            <input type="number" class="p-2 rounded-0 border-0 text-end form-control" value="0.00" step=".01">
                        </td>
                        <td class="p-0">
                            <input type="number" class="p-2 rounded-0 border-0 text-end form-control" max="100" min="0" value="0" step=".01">
                        </td>
                        <td class="p-0">
                            <input type="number" class="p-2 rounded-0 border-0 text-end form-control" value="0.00" step=".01" disabled>
                        </td>
                    </tr>
                `;
                $('#quotation_item tbody').append(newRow);
            }

            document.querySelector('.modal-body [name="add_item_number"]').value = '1';
        });

        $('.modal-body [name="add_item_number"]').on('input', function() {
            if ($(this).val() < 1) {
                $(this).val(1);
            } else if ($(this).val() > 100) {
                $(this).val(100);
            }
        })

        $('#quotationModal').on('submit', function(event){
            event.preventDefault();

            const customer_name = $(this).find('select[name="customer_name"]').val();
            const start_date = $(this).find('input[name="start_date"]').val();
            let expiry_date = $(this).find('input[name="expiry_date"]').val();
            if (!expiry_date) {
                let date = new Date(start_date);
                date.setDate(date.getDate() + 15);
                expiry_date = date.toISOString().split('T')[0];
            }
            const subject = $(this).find('textarea[name="subject"]').val();
            let tableItem = [];
            $('#quotation_item tbody tr').each(function(index) {
                let rowData = {};
                rowData.unit_details = $(this).find('input').eq(0).val();
                rowData.quantity = $(this).find('input').eq(1).val();
                rowData.unit_cost = $(this).find('input').eq(2).val();
                rowData.discount = $(this).find('input').eq(3).val();
                rowData.amount = $(this).find('input').eq(4).val();
                tableItem.push(rowData);
            });
            const unitDetailsString = tableItem.map(item => item.unit_details).join(', ');
            const discount = $('#discountInput').val();
            const shipping = $('#shippingInput').val();
            const message = $(this).find('textarea[name="message"]').val();
            const currency = $(this).find('span[name="currency"]').text();
            const email = window.localStorage.getItem('email');
            const amount = $('#total').text().replace(/,/g, '');
            const direction = "By clicking accept, you'll be redirected to our secured system where you can further process this quote.";

            $.ajax({
                url: "/income/quote/add_list",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                },
                method: "POST",
                data: {
                    customer_name: customer_name,
                    start_date: start_date,
                    expiry_date: expiry_date,
                    subject: subject,
                    unit: unitDetailsString,
                    discount: discount,
                    shipping: shipping,
                    currency: currency,
                    email: email,
                    amount: amount,
                    message: message
                },
                success: function (data) {
                    $.ajax({
                        url: "/income/quote/add_item",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                        },
                        method: "POST",
                        data: {
                            id: data.id,
                            items: tableItem
                        },
                        success: function (data) {
                            $('#quotationModal form').trigger('reset');

                            $.ajax({
                                url: "/income/quote/get_list",
                                headers: {
                                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                                },
                                method: "POST",
                                success: function (response) {

                                    $('#quote tbody').html('');
                                    $('#quote tbody').html(response.options);

                                    $.ajax({
                                        url: "/income/quote/selectNavigation",
                                        headers: {
                                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                                        },
                                        method: "GET",
                                        success: function (navigation) {
                                            $('#view_navigation').html('');
                                            navigation.quotation_lists.forEach(function (quotation) {
                                                if (quotation.id === data.id) {
                                                    $('#view_navigation').append(`
                                                        <div class="quote-selected p-3 d-flex flex-column">
                                                            <div class="d-flex justify-content-between">
                                                                <b>${quotation.customer_name}</b>
                                                            </div>

                                                            <div>
                                                                <small>QT-${quotation.start_date.replace(/-/g, '')}-${String(quotation.id).padStart(3, '0')}</small>
                                                                <small class="text-secondary">| ${quotation.start_date}</small>
                                                                <input type="hidden" value="${quotation.id}">
                                                            </div>
                                                        </div>
                                                    `);
                                                } else {
                                                    $('#view_navigation').append(`
                                                        <div class="quote-item p-3 d-flex flex-column">
                                                            <div class="d-flex justify-content-between">
                                                                <b>${quotation.customer_name}</b>
                                                            </div>

                                                            <div>
                                                                <small>QT-${quotation.start_date.replace(/-/g, '')}-${String(quotation.id).padStart(3, '0')}</small>
                                                                <small class="text-secondary">| ${quotation.start_date}</small>
                                                                <input type="hidden" value="${quotation.id}">
                                                            </div>
                                                        </div>
                                                    `);
                                                }
                                            });

                                            function open_quote(response) {
                                                $.ajax({
                                                    url: "/income/quote/get_navigation_list",
                                                    headers: {
                                                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                                                    },
                                                    data: {
                                                        id: response
                                                    },
                                                    method: "GET",
                                                    success: function (data) {
                                                        $('#viewModal').find('b[name="reference"]').html('QT-' + data.reference);
                                                        $('#viewModal').find('b[name="customer_name"]').html(data.customer_name);
                                                        $('#viewModal').find('small[name="start_date"]').html(data.start_date);
                                                        $('#viewModal').find('small[name="expiry_date"]').html(data.expiry_date);
                                                        if (data.discount == "0") {
                                                            $('#viewModal').find('#view_discount').hide();
                                                        } else {
                                                            $('#viewModal').find('small[name="discount"]').html(data.discount.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + ' %');
                                                            $('#viewModal').find('#view_discount').show();
                                                        }
                                                        $('#viewModal').find('small[name="shipping_charges"]').html(data.currency + ' ' + parseFloat(data.shipping_charges).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
                                                        $('#viewModal').find('small[name="message"]').html(data.message);
                                                        window.localStorage.setItem('email', data.email);
                                                        $('#view tbody').empty();
                                                        $('#view thead').empty();
                                                        $.ajax({
                                                            url: "/income/quote/get_navigation_item",
                                                            headers: {
                                                                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                                                            },
                                                            data: {
                                                                id: data.id
                                                            },
                                                            method: "GET",
                                                            success: function (response) {
                                                                let sub_total = 0;
                                                                const hasDiscount = response.items.some(item => item.discount > 0);
                                                                if (hasDiscount) {
                                                                    $('#view thead').html(
                                                                        '<tr>' +
                                                                            '<th scope="col">Unit Description</th>' +
                                                                            '<th scope="col" class="text-end">Quantity</th>' +
                                                                            '<th scope="col" class="text-end">Unit Cost</th>' +
                                                                            '<th scope="col" class="text-end">Discount</th>' +
                                                                            '<th scope="col" class="text-end">Total</th>' +
                                                                        '</tr>'
                                                                    );
                                                                    response.items.forEach(function(item) {
                                                                        $('#view tbody').append(
                                                                            '<tr>' +
                                                                                '<th scope="row" class="p-2 rounded-0"><small>' + item.unit_detail + '</small></th>' +
                                                                                '<td class="p-2 rounded-0 text-end"><small>' + item.quantity.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + '</small></td>' +
                                                                                '<td class="p-2 rounded-0 text-end"><small>' + data.currency + ' ' + item.unit_cost.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + '</small></td>' +
                                                                                '<td class="p-2 rounded-0 text-end"><small>' + item.discount.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + '</small></td>' +
                                                                                '<td class="p-2 rounded-0 text-end"><small>' + data.currency + ' ' + item.amount.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + '</small></td>' +
                                                                            '</tr>'
                                                                        );
                                                                        sub_total += parseFloat(item.amount);
                                                                    });
                                                                } else {
                                                                    $('#view thead').html(
                                                                        '<tr>' +
                                                                            '<th scope="col">Unit Description</th>' +
                                                                            '<th scope="col" class="text-end">Quantity</th>' +
                                                                            '<th scope="col" class="text-end">Unit Cost</th>' +
                                                                            '<th scope="col" class="text-end">Total</th>' +
                                                                        '</tr>'
                                                                    );
                                                                    response.items.forEach(function(item) {
                                                                        $('#view tbody').append(
                                                                            '<tr>' +
                                                                                '<th scope="row" class="p-2 rounded-0"><small>' + item.unit_detail + '</small></th>' +
                                                                                '<td class="p-2 rounded-0 text-end"><small>' + item.quantity.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + '</small></td>' +
                                                                                '<td class="p-2 rounded-0 text-end"><small>' + data.currency + ' ' + item.unit_cost.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + '</small></td>' +
                                                                                '<td class="p-2 rounded-0 text-end"><small>' + data.currency + ' ' + item.amount.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + '</small></td>' +
                                                                            '</tr>'
                                                                        );
                                                                        sub_total += parseFloat(item.amount);
                                                                    });
                                                                }
                                                                let total = 0;
                                                                $('#ViewModal').find('b[name="sub_total"]').html(data.currency + ' ' + sub_total.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
                                                                if (data.discount || data.discount !== '0') {
                                                                    if (data.discount < 1) {
                                                                        total = sub_total - (sub_total * data.discount);
                                                                    } else {
                                                                        total = sub_total - (sub_total * (data.discount / 100));
                                                                    }

                                                                    if (data.shipping_charges || data.discount !== '0') {
                                                                        total += parseFloat(data.shipping_charges);
                                                                    }
                                                                    $('#ViewModal').find('b[name="total"]').html(data.currency + ' ' + total.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
                                                                }
                                                                $.ajax({
                                                                    url: "/income/quote/get_navigation",
                                                                    headers: {
                                                                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                                                                    },
                                                                    method: "GET",
                                                                    success: function (navigation) {
                                                                        $('#view_navigation').html('');
                                                                        navigation.quotation_lists.forEach(function (quotation) {
                                                                            if (quotation.id === data.id) {
                                                                                $('#view_navigation').append(`
                                                                                    <div class="quote-selected p-3 d-flex flex-column">
                                                                                        <div class="d-flex justify-content-between">
                                                                                            <b>${quotation.customer_name}</b>
                                                                                        </div>

                                                                                        <div>
                                                                                            <small>QT-${quotation.start_date.replace(/-/g, '')}-${String(quotation.id).padStart(3, '0')}</small>
                                                                                            <small class="text-secondary">| ${quotation.start_date}</small>
                                                                                            <input type="hidden" value="${quotation.id}">
                                                                                        </div>
                                                                                    </div>
                                                                                `);
                                                                            } else {
                                                                                $('#view_navigation').append(`
                                                                                    <div class="quote-item p-3 d-flex flex-column">
                                                                                        <div class="d-flex justify-content-between">
                                                                                            <b>${quotation.customer_name}</b>
                                                                                        </div>

                                                                                        <div>
                                                                                            <small>QT-${quotation.start_date.replace(/-/g, '')}-${String(quotation.id).padStart(3, '0')}</small>
                                                                                            <small class="text-secondary">| ${quotation.start_date}</small>
                                                                                            <input type="hidden" value="${quotation.id}">
                                                                                        </div>
                                                                                    </div>
                                                                                `);
                                                                            }
                                                                        });
                                                                        new bootstrap.Modal(document.getElementById('viewModal')).show();
                                                                    },
                                                                    error: function (jqXHR, textStatus, errorThrown) {
                                                                        console.error('Error:', textStatus, errorThrown);
                                                                    }
                                                                });
                                                            },
                                                            error: function (jqXHR, textStatus, errorThrown) {
                                                                console.error('Error:', textStatus, errorThrown);
                                                            }
                                                        });
                                                    },
                                                    error: function (jqXHR, textStatus, errorThrown) {
                                                        console.error('Error:', textStatus, errorThrown);
                                                    }
                                                });
                                            }

                                            bootstrap.Modal.getInstance(document.querySelector('#quotationModal')).hide();
                                            new bootstrap.Modal(document.getElementById('viewModal')).show();
                                        },
                                        error: function (jqXHR, textStatus, errorThrown) {
                                            console.error('Error:', textStatus, errorThrown);
                                        }
                                    });

                                },
                                error: function (jqXHR, textStatus, errorThrown) {
                                    console.error('Error:', textStatus, errorThrown);
                                }
                            });
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.error('Error:', jqXHR, textStatus, errorThrown);
                        }
                    });
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error('Error:', jqXHR, textStatus, errorThrown);
                }
            });
        })

        function calculateTotal() {
            let subtotal = 0;
            $('#quotation_item tbody tr').each(function() {
                const rowAmount = parseFloat($(this).find('input').eq(4).val()) || 0;
                subtotal += rowAmount;
            });

            $('#sub_total').html(subtotal.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));

            const discountInput = $('#discountInput').val();
            const shippingInput = $('#shippingInput').val();

            if (discountInput) {
                let total;

                if (shippingInput !== '0') {
                    if (discountInput < 1) {
                        // Calculate total with shipping and discount
                        total = (subtotal - (subtotal * discountInput)) + parseFloat(shippingInput);
                    } else {
                        // Calculate total with shipping and discount as percentage
                        total = (subtotal - (subtotal * (discountInput / 100))) + parseFloat(shippingInput);
                    }
                } else {
                    if (discountInput < 1) {
                        total = subtotal - (subtotal * discountInput);
                    } else {
                        total = subtotal - (subtotal * (discountInput / 100));
                    }
                }

                // Format total with comma separators and 2 decimal places
                $('#total').html(total.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
            } else {
                // Format subtotal with comma separators and 2 decimal places
                $('#total').html(subtotal.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
            }

        }

        $('#quotation_item tbody').on('input', 'tr input', function() {
            const $row = $(this).closest('tr');
            const $quantityInput = $row.find('input').eq(1);
            const $unitCostInput = $row.find('input').eq(2);
            const $discountInput = $row.find('input').eq(3);
            const $amountInput = $row.find('input').eq(4);
            const quantity = parseFloat($quantityInput.val()) || 0;
            const unit_cost = parseFloat($unitCostInput.val()) || 0;
            const discount = parseFloat($discountInput.val()) || 0;
            let amount;

            if (discount) {
                if (discount > 100 || discount < 0) {
                    $discountInput.val(0);
                    amount = quantity * unit_cost;
                    $amountInput.val(amount.toFixed(2));
                    $('#sub_total').html(amount.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
                    return;
                } else {
                    if (discount < 1) {
                        amount = (quantity * unit_cost) - ((quantity * unit_cost) * discount);
                    } else {
                        amount = (quantity * unit_cost) - ((quantity * unit_cost) * (discount / 100));
                    }
                }
            } else {
                amount = quantity * unit_cost;
            }

            $amountInput.val(amount.toFixed(2));

            calculateTotal();
        });

        $('#discountInput').on('input', function() {
            if ($(this).val() > 100) {
                $(this).val(100);
                $('#discount').html('100 %');
            } else if ($(this).val() < 0) {
                $(this).val(0);
                $('#discount').html('0 %');
            } else {
                $('#discount').html($(this).val() + ' %');
            }

            calculateTotal();
        })

        $('#shippingInput').on('input', function() {
            if ($(this).val() < 0) {
                $(this).val(0);
                $('#shipping').html('0.00');
            } else {
                $('#shipping').html(parseFloat($(this).val()).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
                calculateTotal();
            }
        })

        document.querySelector('#view_navigation').addEventListener('click', function(event) {
            if (event.target.closest('.quote-item')) {
                const quoteItem = event.target.closest('.quote-item');
                $.ajax({
                    url: "/income/quote/get_navigation_list",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        id: quoteItem.querySelector('input[type="hidden"]').value
                    },
                    method: "GET",
                    success: function (data) {
                        $('#viewModal').find('b[name="reference"]').html('QT-' + data.reference);
                        $('#viewModal').find('b[name="customer_name"]').html(data.customer_name);
                        $('#viewModal').find('small[name="start_date"]').html(data.start_date);
                        $('#viewModal').find('small[name="expiry_date"]').html(data.expiry_date);
                        if (data.discount == "0") {
                            $('#viewModal').find('#view_discount').hide();
                        } else {
                            $('#viewModal').find('small[name="discount"]').html(data.discount.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + ' %');
                            $('#viewModal').find('#view_discount').show();
                        }
                        $('#viewModal').find('small[name="shipping_charges"]').html(data.currency + ' ' + parseFloat(data.shipping_charges).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
                        $('#viewModal').find('small[name="message"]').html(data.message);
                        window.localStorage.setItem('email', data.email);
                        $('#view tbody').empty();
                        $('#view thead').empty();
                        $.ajax({
                            url: "/income/quote/get_navigation_item",
                            headers: {
                                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                id: data.id
                            },
                            method: "GET",
                            success: function (response) {
                                let sub_total = 0;

                                // Check if any item has a discount greater than 0
                                const hasDiscount = response.items.some(item => item.discount > 0);

                                if (hasDiscount) {
                                    $('#view thead').html(
                                        '<tr>' +
                                            '<th scope="col">Unit Description</th>' +
                                            '<th scope="col" class="text-end">Quantity</th>' +
                                            '<th scope="col" class="text-end">Unit Cost</th>' +
                                            '<th scope="col" class="text-end">Discount</th>' +
                                            '<th scope="col" class="text-end">Total</th>' +
                                        '</tr>'
                                    );
                                    // Proceed with appending rows
                                    response.items.forEach(function(item) {
                                        $('#view tbody').append(
                                            '<tr>' +
                                                '<th scope="row" class="p-2 rounded-0"><small>' + item.unit_detail + '</small></th>' +
                                                '<td class="p-2 rounded-0 text-end"><small>' + item.quantity.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + '</small></td>' +
                                                '<td class="p-2 rounded-0 text-end"><small>' + data.currency + ' ' + item.unit_cost.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + '</small></td>' +
                                                '<td class="p-2 rounded-0 text-end"><small>' + item.discount.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + '</small></td>' +
                                                '<td class="p-2 rounded-0 text-end"><small>' + data.currency + ' ' + item.amount.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + '</small></td>' +
                                            '</tr>'
                                        );
                                        sub_total += parseFloat(item.amount);
                                    });
                                } else {
                                    $('#view thead').html(
                                        '<tr>' +
                                            '<th scope="col">Unit Description</th>' +
                                            '<th scope="col" class="text-end">Quantity</th>' +
                                            '<th scope="col" class="text-end">Unit Cost</th>' +
                                            '<th scope="col" class="text-end">Total</th>' +
                                        '</tr>'
                                    );
                                    response.items.forEach(function(item) {
                                        $('#view tbody').append(
                                            '<tr>' +
                                                '<th scope="row" class="p-2 rounded-0"><small>' + item.unit_detail + '</small></th>' +
                                                '<td class="p-2 rounded-0 text-end"><small>' + item.quantity.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + '</small></td>' +
                                                '<td class="p-2 rounded-0 text-end"><small>' + data.currency + ' ' + item.unit_cost.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + '</small></td>' +
                                                '<td class="p-2 rounded-0 text-end"><small>' + data.currency + ' ' + item.amount.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + '</small></td>' +
                                            '</tr>'
                                        );
                                        sub_total += parseFloat(item.amount);
                                    });
                                }

                                let total = 0;
                                $('#viewModal').find('b[name="sub_total"]').html(data.currency + ' ' + sub_total.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
                                if (data.discount || data.discount !== '0') {
                                    if (data.discount < 1) {
                                        total = sub_total - (sub_total * data.discount);
                                    } else {
                                        total = sub_total - (sub_total * (data.discount / 100));
                                    }

                                    if (data.shipping_charges || data.discount !== '0') {
                                        total += parseFloat(data.shipping_charges);
                                    }

                                    $('#viewModal').find('b[name="total"]').html(data.currency + ' ' + total.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
                                }

                                $.ajax({
                                    url: "/income/quote/get_navigation",
                                    headers: {
                                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                                    },
                                    method: "GET",
                                    success: function (navigation) {
                                        $('#view_navigation').html('');
                                        navigation.quotation_lists.forEach(function (quotation) {
                                            if (quotation.id === data.id) {
                                                $('#view_navigation').append(`
                                                    <div class="quote-selected p-3 d-flex flex-column">
                                                        <div class="d-flex justify-content-between">
                                                            <b>${quotation.customer_name}</b>
                                                        </div>
                                                        <div>
                                                            <small>QT-${quotation.start_date.replace(/-/g, '')}-${String(quotation.id).padStart(3, '0')}</small>
                                                            <small class="text-secondary">| ${quotation.start_date}</small>
                                                            <input type="hidden" value="${quotation.id}">
                                                        </div>
                                                    </div>
                                                `);
                                            } else {
                                                $('#view_navigation').append(`
                                                    <div class="quote-item p-3 d-flex flex-column">
                                                        <div class="d-flex justify-content-between">
                                                            <b>${quotation.customer_name}</b>
                                                        </div>
                                                        <div>
                                                            <small>QT-${quotation.start_date.replace(/-/g, '')}-${String(quotation.id).padStart(3, '0')}</small>
                                                            <small class="text-secondary">| ${quotation.start_date}</small>
                                                            <input type="hidden" value="${quotation.id}">
                                                        </div>
                                                    </div>
                                                `);
                                            }
                                        });
                                    },
                                    error: function (jqXHR, textStatus, errorThrown) {
                                        console.error('Error:', textStatus, errorThrown);
                                    }
                                });
                            },
                            error: function (jqXHR, textStatus, errorThrown) {
                                console.error('Error:', textStatus, errorThrown);
                            }
                        });
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.error('Error:', textStatus, errorThrown);
                    }
                });
            }
        });

        function open_quote(response) {
            $.ajax({
                url: "/income/quote/get_navigation_list",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: response
                },
                method: "GET",
                success: function (data) {
                    $('#viewModal').find('b[name="reference"]').html('QT-' + data.reference);
                    $('#viewModal').find('b[name="customer_name"]').html(data.customer_name);
                    $('#viewModal').find('small[name="start_date"]').html(data.start_date);
                    $('#viewModal').find('small[name="expiry_date"]').html(data.expiry_date);
                    if (data.discount == "0") {
                        $('#viewModal').find('#view_discount').hide();
                    } else {
                        $('#viewModal').find('small[name="discount"]').html(data.discount.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + ' %');
                        $('#viewModal').find('#view_discount').show();
                    }
                    $('#viewModal').find('small[name="shipping_charges"]').html(data.currency + ' ' + parseFloat(data.shipping_charges).toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
                    $('#viewModal').find('small[name="message"]').html(data.message);
                    window.localStorage.setItem('email', data.email);
                    $('#view tbody').empty();
                    $('#view thead').empty();
                    $.ajax({
                        url: "/income/quote/get_navigation_item",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            id: data.id
                        },
                        method: "GET",
                        success: function (response) {
                            let sub_total = 0;
                            const hasDiscount = response.items.some(item => item.discount > 0);
                            if (hasDiscount) {
                                $('#view thead').html(
                                    '<tr>' +
                                        '<th scope="col">Unit Description</th>' +
                                        '<th scope="col" class="text-end">Quantity</th>' +
                                        '<th scope="col" class="text-end">Unit Cost</th>' +
                                        '<th scope="col" class="text-end">Discount</th>' +
                                        '<th scope="col" class="text-end">Total</th>' +
                                    '</tr>'
                                );
                                response.items.forEach(function(item) {
                                    $('#view tbody').append(
                                        '<tr>' +
                                            '<th scope="row" class="p-2 rounded-0"><small>' + item.unit_detail + '</small></th>' +
                                            '<td class="p-2 rounded-0 text-end"><small>' + item.quantity.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + '</small></td>' +
                                            '<td class="p-2 rounded-0 text-end"><small>' + data.currency + ' ' + item.unit_cost.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + '</small></td>' +
                                            '<td class="p-2 rounded-0 text-end"><small>' + item.discount.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + '</small></td>' +
                                            '<td class="p-2 rounded-0 text-end"><small>' + data.currency + ' ' + item.amount.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + '</small></td>' +
                                        '</tr>'
                                    );
                                    sub_total += parseFloat(item.amount);
                                });
                            } else {
                                $('#view thead').html(
                                    '<tr>' +
                                        '<th scope="col">Unit Description</th>' +
                                        '<th scope="col" class="text-end">Quantity</th>' +
                                        '<th scope="col" class="text-end">Unit Cost</th>' +
                                        '<th scope="col" class="text-end">Total</th>' +
                                    '</tr>'
                                );
                                response.items.forEach(function(item) {
                                    $('#view tbody').append(
                                        '<tr>' +
                                            '<th scope="row" class="p-2 rounded-0"><small>' + item.unit_detail + '</small></th>' +
                                            '<td class="p-2 rounded-0 text-end"><small>' + item.quantity.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + '</small></td>' +
                                            '<td class="p-2 rounded-0 text-end"><small>' + data.currency + ' ' + item.unit_cost.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + '</small></td>' +
                                            '<td class="p-2 rounded-0 text-end"><small>' + data.currency + ' ' + item.amount.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }) + '</small></td>' +
                                        '</tr>'
                                    );
                                    sub_total += parseFloat(item.amount);
                                });
                            }
                            let total = 0;
                            $('#viewModal').find('b[name="sub_total"]').html(data.currency + ' ' + sub_total.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
                            if (data.discount || data.discount !== '0') {
                                if (data.discount < 1) {
                                    total = sub_total - (sub_total * data.discount);
                                } else {
                                    total = sub_total - (sub_total * (data.discount / 100));
                                }

                                if (data.shipping_charges || data.discount !== '0') {
                                    total += parseFloat(data.shipping_charges);
                                }
                                $('#viewModal').find('b[name="total"]').html(data.currency + ' ' + total.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
                            }
                            $.ajax({
                                url: "/income/quote/get_navigation",
                                headers: {
                                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                                },
                                method: "GET",
                                success: function (navigation) {
                                    $('#view_navigation').html('');
                                    navigation.quotation_lists.forEach(function (quotation) {
                                        if (quotation.id === data.id) {
                                            $('#view_navigation').append(`
                                                <div class="quote-selected p-3 d-flex flex-column">
                                                    <div class="d-flex justify-content-between">
                                                        <b>${quotation.customer_name}</b>
                                                    </div>

                                                    <div>
                                                        <small>QT-${quotation.start_date.replace(/-/g, '')}-${String(quotation.id).padStart(3, '0')}</small>
                                                        <small class="text-secondary">| ${quotation.start_date}</small>
                                                        <input type="hidden" value="${quotation.id}">
                                                    </div>
                                                </div>
                                            `);
                                        } else {
                                            $('#view_navigation').append(`
                                                <div class="quote-item p-3 d-flex flex-column">
                                                    <div class="d-flex justify-content-between">
                                                        <b>${quotation.customer_name}</b>
                                                    </div>

                                                    <div>
                                                        <small>QT-${quotation.start_date.replace(/-/g, '')}-${String(quotation.id).padStart(3, '0')}</small>
                                                        <small class="text-secondary">| ${quotation.start_date}</small>
                                                        <input type="hidden" value="${quotation.id}">
                                                    </div>
                                                </div>
                                            `);
                                        }
                                    });
                                    new bootstrap.Modal(document.getElementById('viewModal')).show();
                                },
                                error: function (jqXHR, textStatus, errorThrown) {
                                    console.error('Error:', textStatus, errorThrown);
                                }
                            });
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.error('Error:', textStatus, errorThrown);
                        }
                    });
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error('Error:', textStatus, errorThrown);
                }
            });
        }

        function Get_Customer(response) {
            $.ajax({
                url: "/income/quote/customer/get",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                },
                method: "GET",
                success: function (data) {
                    $('select[name="customer_name"]').html('');
                    $('select[name="customer_name"]').html(data.options);
                    $('select[name="customer_name"]').append('<option value="Add New">Add New</option>');
                    $('select[name="customer_name"]').val(response);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error('Error:', textStatus, errorThrown);
                }
            });
        }

        function Get_Quote() {
            const datatablesSimple = document.getElementById('quote');
            if (datatablesSimple) {
                datatablesSimple.SimpleDataTable = new simpleDatatables.DataTable(datatablesSimple);

                const columnWidths = ['20%', '25%', '25%', '15%', '15%'];
                const headers = datatablesSimple.querySelectorAll('th');

                headers.forEach((header, index) => {
                    header.style.width = columnWidths[index];
                    header.style.fontWeight =
                        ['QT#', 'Sales Officer', 'Customer', 'Unit', 'Amount'].includes(header.textContent.trim())
                        ? 'bold'
                        : 'normal';
                });
            }
        }

    </script>

@endsection
