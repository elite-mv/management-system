@extends('layouts.expense-index')


@section('title', 'Request')


@section('style')
    <style type="text/css">
        .cart-items {
            cursor: pointer;
        }

        .cart-items:hover {
            background: rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(0, 0, 0, 0.1) !important;
        }

        .uploaded-img {
            height: 250px;
            width: auto;
            max-width: none;
            max-height: none;
        }

        .past_request_nav {
            color: rgb(255, 255, 255, 1.0);
        }
    </style>

    <style>

        :root {
            --blue: rgba(173, 216, 230, 1.0);
            --red: rgba(255, 0, 0, 0.4);
            --yellow: rgba(255, 255, 0, 0.4);
            --green: rgba(75, 200, 75, 0.5);
            --gray: rgba(0, 0, 0, 0.2)
        }

        .bg-red {
            background-color: var(--red) !important;
        }

        .bg-green {
            background-color: var(--green) !important;
        }

        .bg-yellow {
            background-color: var(--yellow) !important;
        }

        .bg-blue {
            background-color: var(--blue) !important;
        }

        .bg-gray {
            background-color: var(--gray) !important;
        }

        td {
            padding: 0 !important;
            border: 1px solid black;
        }

        .box-shadow-none {
            -webkit-box-shadow: none;
            -moz-box-shadow: none;
            box-shadow: none;
        }

        .outline-0 {
            outline: none
        }

        .pointer:hover {
            cursor: pointer;
            background-color: #f8f9fa;
        }

        .selectable:hover {
            cursor: pointer !important;
            background-color: var(--gray);
        }

        select {
            cursor: pointer;
        }

    </style>
@endsection


@section('body')


    <form id="requestForm" method="POST" action="/expense/request">
        @csrf
        <div class="py-3 px-3 px-md-0">

            <div class="row m-0">
                <div class="col-sm-12 col-md-10 mx-auto">

                    <div class="d-flex overflow-y-auto m-0 p-3 mb-3" style="gap: 0 30px; border-radius: 7px;
                    background-color: rgba(255, 255, 255, 0.2);
                    box-shadow: 0 25px 45px rgba(0, 0, 0, 0.1);
                    border: 1px solid rgba(255, 255, 255, 0.5);
                    border-right: 1px solid rgba(255, 255, 255, 0.2);
                    border-bottom: 1px solid rgba(255, 255, 255, 0.2);" id="show_entity">
                        @foreach ($companies as $company)
                            <div class="col-auto p-0" style="display: flex; flex-direction: column; margin-inline: auto; min-width: 130px;
                            background-color: rgba(255, 255, 255, 0.3);
                            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
                            border: 1px solid rgba(255, 255, 255, 0.5);
                            border-right: 1px solid rgba(255, 255, 255, 0.2);
                            border-bottom: 1px solid rgba(255, 255, 255, 0.2);">
                                <div style="width: 100px; height:100px;" class="mx-auto">
                                    <img style="object-fit: contain; height: 100px;" src="/././images/logos/{{ $company->logo }}" class="d-block mx-auto img-fluid" alt="{{ $company->name }}">
                                </div>

                                <div class="bg-danger bg-gradient px-3 rounded-0 m-1 mt-0 border">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="company" value="{{ $company->id }}" id="companySupplier{{$company->id}}">
                                        <label class="form-check-label text-white" for="companySupplier{{$company->id}}">
                                            {{ $company->name }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="m-0 border p-3 mb-3" style="border-radius: 7px;
                    background-color: rgba(255, 255, 255, 0.2);
                    box-shadow: 0 25px 45px rgba(0, 0, 0, 0.1);
                    border: 1px solid rgba(255, 255, 255, 0.5);
                    border-right: 1px solid rgba(255, 255, 255, 0.2);
                    border-bottom: 1px solid rgba(255, 255, 255, 0.2);" id="request_details">
                        <div class="d-flex flex-column gap-2 p-4" style="background-color: rgba(255, 255, 255, 0.3);
                            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
                            border: 1px solid rgba(255, 255, 255, 0.5);
                            border-right: 1px solid rgba(255, 255, 255, 0.2);
                            border-bottom: 1px solid rgba(255, 255, 255, 0.2);">
                            <label class="text-center text-white bg-dark bg-gradient fw-bold py-1 mb-2">REQUEST DETAILS</label>
                            <div class="row">
                                <p class="col-12 col-md-2 fw-bold">Supplier:</p>
                                <div class="col-12 col-md-10">
                                    <input type="text" class="p-2 form-control" name="supplier">
                                </div>
                            </div>
                            <div class="row">
                                <p class="col-12 col-md-2 fw-bold">Paid to:</p>
                                <div class="col-12 col-md-10">
                                    <input type="text" class="p-2 form-control" name="paidTo">
                                </div>
                            </div>
                            <div class="row">
                                <p class="col-12 col-md-2 fw-bold">Requested by:</p>
                                <div class="col-sm-12 col-md-10">
                                    <input type="text" class="p-2 form-control" name="requestedBy" required>
                                </div>
                            </div>
                            <div class="row">
                                <p class="col-12 col-md-2 fw-bold">Prepared by</p>
                                <div class="col-sm-12 col-md-10">
                                    <input type="text" class="p-2 form-control" name="preparedBy" value="" disabled>
                                </div>
                            </div>
                            <div class="row">
                                <p class="col-12 col-md-2 fw-bold">Payment Type</p>
                                <div class="col-sm-12 col-md-10">
                                    <select class="p-2 form-control" name="paymentType">
                                        <option value="">SELECT AN OPTION</option>
                                        <option value="CASH">CASH</option>
                                        <option value="ONLINE TRANSFER">ONLINE TRANSFER</option>
                                        <option value="GCASH">GCASH</option>
                                        <option value="CREDIT CARD">CREDIT CARD</option>
                                        <option value="CHECK">CHECK</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <p class="col-12 col-md-2 fw-bold">Terms</p>
                                <div class="col-sm-12 col-md-10">
                                    <input type="text" class="p-2 form-control" name="terms" value="">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="m-0 border p-3 mb-3" style="border-radius: 7px;
                    background-color: rgba(255, 255, 255, 0.2);
                    box-shadow: 0 25px 45px rgba(0, 0, 0, 0.1);
                    border: 1px solid rgba(255, 255, 255, 0.5);
                    border-right: 1px solid rgba(255, 255, 255, 0.2);
                    border-bottom: 1px solid rgba(255, 255, 255, 0.2);" id="request_items">
                        <div class="d-flex flex-column p-4 gap-4" style="background-color: rgba(255, 255, 255, 0.3);
                            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
                            border: 1px solid rgba(255, 255, 255, 0.5);
                            border-right: 1px solid rgba(255, 255, 255, 0.2);
                            border-bottom: 1px solid rgba(255, 255, 255, 0.2);">

                            <div class="d-flex flex-column justify-content-start overflow-x-auto p-4">
                                <table class="table table-bordered table-responsive table-hover" id="request_cart">
                                    <thead class="table-dark">
                                        <tr>
                                            <th scope="col" class="text-center">QTY</th>
                                            <th scope="col" class="text-center">UOM</th>
                                            <th scope="col" class="text-center">JOB ORDER</th>
                                            <th scope="col" class="text-center">DESCRIPTION</th>
                                            <th scope="col" class="text-center">UNIT COST</th>
                                            <th scope="col" class="text-center">TOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>

                            <div class="d-flex flex-column justify-content-start overflow-x-auto p-4 gap-2">
                                <label class="text-center text-white bg-dark bg-gradient fw-bold py-1 mb-2">REQUEST ITEMS</label>

                                <input type="hidden" id="requestId" class="d-none">

                                <div class="row">
                                    <p class="col-12 col-md-2 fw-bold">Quantity:</p>
                                    <div class="col-12 col-md-10">
                                        <input type="number" id="requestQuantity" min="1" class="p-2 form-control" autocomplete="off">
                                    </div>
                                </div>

                                <div class="row">
                                    <p class="col-12 col-md-2 fw-bold">Units of measurement:</p>
                                    <div class="col-12 col-md-10">
                                        <select id="requestUnitOfMeasure" class="p-2 form-control">
                                            <option disabled selected>--</option>
                                            @foreach($measurements as $measurement)
                                                <option value="{{$measurement->id}}">{{$measurement->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <p class="col-12 col-md-2 fw-bold">Job Order:</p>
                                    <div class="col-12 col-md-10">
                                        <select id="requestJobOrder" class="form-control p-2">
                                            <option disabled selected>--</option>
                                            @foreach($jobOrders as $jobOrder)
                                                <option value="{{$jobOrder->id}}">{{$jobOrder->reference}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <p class="col-12 col-md-2 fw-bold">Description:</p>
                                    <div class="col-12 col-md-10">
                                        <input type="text" id="requestDescription" class="p-2 form-control" autocomplete="off">
                                    </div>
                                </div>

                                <div class="row">
                                    <p class="col-12 col-md-2 fw-bold">Unit cost:</p>
                                    <div class="col-12 col-md-10">
                                        <input type="number" id="requestUnitCost" class="p-2 form-control" step="0.1">
                                    </div>
                                </div>

                                <div class="row">
                                    <p class="col-12 col-md-2 fw-bold">Total:</p>
                                    <div class="col-12 col-md-10">
                                        <input type="text" id="requestTotal" class="p-2 form-control" readonly>
                                    </div>
                                </div>

                                <div class="row m-0 p-0">
                                    <div class="col-sm-12 col-md-6 mb-2 d-none p-0 pe-md-1" id="itemAttachment">
                                        <input id="requestItemImageInput" type="file" accept="image/*" multiple name="files[]" class="mt-2 h-100 w-100 p-2 border border-dark border-dashed" style="border-style: dashed !important; border-radius: 6px;">
                                    </div>

                                    <div class="col-sm-12 col-md-6 mb-2 d-none p-0 ps-md-1" id="itemAttachmentPreview">
                                        <div class="mt-2 h-100 w-100 p-2 border border-dark" id="image_container"
                                            style="display: flex; flex-direction: row; align-items: flex-start; gap: 5px; overflow: auto;">
                                            <!-- DYNAMIC -->
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-3 mb-2 p-0 pe-md-1" id="add_item">
                                        <button type="button" onclick="addItem()" class="btn btn-sm btn-success rounded-0 h-100 w-100 mt-2">ADD ITEM
                                        </button>
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-3 mb-2 p-0 ps-md-1 px-lg-1">
                                        <button type="button" name="update" onclick="updateItem()" class="btn btn-sm btn-warning rounded-0 h-100 w-100 mt-2">UPDATE
                                            ITEM
                                        </button>
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-3 mb-2 p-0 pe-md-1 px-lg-1">
                                        <button onclick="deleteItem()" type="button" name="delete" class="btn btn-sm btn-danger rounded-0 h-100 w-100 mt-2">DELETE
                                            ITEM
                                        </button>
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-3 mb-2 p-0 ps-md-1">
                                        <button type="button" name="unselect" onclick="unselectItem()" class="btn btn-sm btn-dark rounded-0 h-100 w-100 mt-2">UNSELECT ITEM
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="m-0 mb-3 p-3 border" style="border-radius: 7px;
                    background-color: rgba(255, 255, 255, 0.2);
                    box-shadow: 0 25px 45px rgba(0, 0, 0, 0.1);
                    border: 1px solid rgba(255, 255, 255, 0.5);
                    border-right: 1px solid rgba(255, 255, 255, 0.2);
                    border-bottom: 1px solid rgba(255, 255, 255, 0.2);">
                        <div class="d-flex flex-column p-4 gap-4" style="background-color: rgba(255, 255, 255, 0.3);
                        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
                        border: 1px solid rgba(255, 255, 255, 0.5);
                        border-right: 1px solid rgba(255, 255, 255, 0.2);
                        border-bottom: 1px solid rgba(255, 255, 255, 0.2);">
                            <table class="w-100 bg-white">
                                <tbody>
                                    <tr>
                                        <td colspan="9" class="text-center fw-bold py-2">ACCOUNTING DEPARTMENT</td>
                                        <td colspan="9" class="text-center fw-bold py-2">AUDITOR DEPARTMENT</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-center fw-bold bg-red small" style="width: 171px">Priority
                                            level
                                        </td>
                                        <td colspan="4" class="text-center fw-bold bg-blue small">Type</td>
                                        <td colspan="1" class="text-center fw-bold bg-blue small">BANK NAME</td>
                                        <td colspan="4" class="fw-bold small px-2">ITEMS DELIVERY</td>
                                        <td colspan="5" class="px-2 fw-bold small bg-blue" style="width: 268px">BOOK KEEPER</td>
                                    </tr>
                                    <tr>
                                        <td colspan="1" class="text-center" style="width: 32px">
                                            <input class="priorityLevel" value="" type="checkbox" name="LOW">
                                        </td>
                                        <td colspan="2" class="small px-2">Low</td>
                                        <td colspan="1" class="small px-2">5 days</td>
                                        <td colspan="1" class="text-center" style="width: 32px">
                                            <input type="checkbox">
                                        </td>
                                        <td colspan="3" class="small px-2" style="width: 146px">
                                            <select data-index="1" name="expenseCategory[]" class="w-100 border-0 outline-0">
                                                @foreach($expense_category as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td colspan="1">
                                            <select id="bankNameSelection" class="w-100 h-100 border-0 box outline-0 small">
                                                <option value="-1" selected>SELECT AN OPTION</option>
                                                @foreach($bank_names as $bankName)
                                                    <option class="text-dark" value="{{$bankName->id}}">{{$bankName->name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td colspan="1" class="text-center" style="width: 32px">
                                            <input value="1" class="deliveryStatus" name="requestDeliveryStatus"
                                                    id="requestDeliveryComplete"
                                                    type="checkbox">
            
                                        </td>
                                        <td colspan="3" class="px-2 bg-green small">Complete</td>
                                        <td colspan="5" class="px-2 small">
                                            Approved
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="1" class="text-center">
                                            <input class="priorityLevel" value="" type="checkbox" name="MEDIUM">
                                        </td>
                                        <td colspan="2" class="small px-2">Medium</td>
                                        <td colspan="1" class="small px-2">3 days</td>
                                        <td colspan="1" class="text-center">
                                            <input type="checkbox">
                                        </td>
                                        <td colspan="3" class="small px-2">
                                            <select data-index="2" name="expenseCategory[]" class="w-100 border-0 outline-0">
                                                @foreach($expense_category as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td colspan="1" class="text-center fw-bold bg-blue small">BANK CODE</td>
                                        <td colspan="1" class="text-center">
                                            <input value="0" class="deliveryStatus" name="requestDeliveryStatus" id="requestDeliveryIncomplete" type="checkbox">
                                        </td>
                                        <td colspan="3" class="px-2 bg-blue small">Incomplete</td>
                                        <td colspan="5" class="px-2 small">
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="1" class="text-center">
                                            <input class="priorityLevel" value="" type="checkbox" name="HIGH">
                                        </td>
                                        <td colspan="2" class="small px-2">High</td>
                                        <td colspan="1" class="small px-2">1 day</td>
                                        <td colspan="1" class="text-center">
                                            <input type="checkbox">
                                        </td>
                                        <td colspan="3" class="small px-2">
                                            <select data-index="3" name="expenseCategory[]" class="w-100 border-0 outline-0">
                                                @foreach($expense_category as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td colspan="1">
                                            <select id="bankCodeSelection" class="w-100 h-100 border-0 box outline-0 small">
                                                <option value="-1" selected>SELECT AN OPTON</option>
                                                @foreach($bank_codes as $bankCode)
                                                    <option class="text-dark" value="{{$bankCode->id}}">{{$bankCode->code}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td colspan="4" class="fw-bold small px-2"> SUPPLIER VERIFICATION</td>
                                        <td colspan="5" class="fw-bold px-2 small bg-blue">ACCOUNTANT</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="small px-2 fw-bold bg-red text-center">Attachment</td>
                                        <td colspan="1" class="text-center">
                                            <input type="checkbox">
                                        </td>
                                        <td colspan="3" class="small px-2">
                                            <select data-index="4" name="expenseCategory[]" class="w-100 border-0 outline-0">
                                                @foreach($expense_category as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td colspan="1" class="bg-blue fw-bold text-center small">CHECK NUMBER</td>
                                        <td colspan="1" class="text-center">
                                            <input value="1" class="deliverySupplier" type="checkbox">
                                        </td>
                                        <td colspan="3" class="small px-2">Yes</td>
                                        <td colspan="5" class="small px-2">
                                            Approved
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="1" class="text-center">
                                            <input value="\" class="attachment" type="checkbox">
                                        </td>
                                        <td colspan="3" class="small px-2">With</td>
                                        <td colspan="1" class="text-center">
                                            <input type="checkbox">
                                        </td>
                                        <td colspan="3" class="small px-2">
                                            <select data-index="5" name="expenseCategory[]" class="w-100 border-0 outline-0">
                                                @foreach($expense_category as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td colspan="1">
                                            <input id="checkNumberInput" class="w-100 border-0 outline-0">
                                        </td>
                                        <td colspan="1" class="text-center">
                                            <input value="0" class="deliverySupplier" type="checkbox">
                                        </td>
                                        <td colspan="3" class="small px-2">No</td>
                                        <td colspan="5" class="small px-2">
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="1" class="text-center">
                                            <input value="" class="attachment" type="checkbox">
                                        </td>
                                        <td colspan="3" class="small px-2">Without</td>
                                        <td colspan="1" class="text-center">
                                            <input type="checkbox">
                                        </td>
                                        <td colspan="3" class="small px-2">
                                            <select data-index="6" name="expenseCategory[]" class="w-100 border-0 outline-0">
                                                @foreach($expense_category as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td colspan="1" rowspan="7"></td>
                                        <td colspan="4" class="text-center fw-bold small">VAT INPUT AMOUNT</td>
                                        <td colspan="5" class="px-2 small fw-bold bg-blue">FINANCE</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="small px-2 text-center bg-red fw-bold">Type</td>
                                        <td colspan="1" class="text-center">
                                            <input type="checkbox">
                                        </td>
                                        <td colspan="3" class="small px-2">
                                            <select data-index="7" name="expenseCategory[]" class="w-100 border-0 outline-0">
                                                @foreach($expense_category as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td colspan="4" class="text-center small px-2">
                                            <input type="text" id="vatOption1" class="h-100 w-100 border-0 outline-0">
                                        </td>
                                        <td colspan="5" class="small px-2">
                                            Pending
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="1" class="text-center">
                                            <input value="" class="attachmentType" type="checkbox">
                                        </td>
                                        <td colspan="3" class="small px-2">OPEX</td>
                                        <td colspan="1" class="text-center">
                                            <input type="checkbox">
                                        </td>
                                        <td colspan="3" class="small px-2">
                                            <select data-index="8" name="expenseCategory[]" class="w-100 border-0 outline-0">
                                                @foreach($expense_category as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td colspan="4" class="text-center small px-2">
                                            <input type="text" id="vatOption2" class="h-100 w-100 border-0 outline-0">
                                        </td>
                                        <td colspan="5" class="small px-2">
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="1" class="text-center">
                                            <input value="" class="attachmentType" type="checkbox">
                                        </td>
                                        <td colspan="3" class="small px-2">NON OPEX</td>
                                        <td colspan="1" class="text-center">
                                            <input type="checkbox">
                                        </td>
                                        <td colspan="3" class="small px-2">
                                            <select data-index="9" name="expenseCategory[]" class="w-100 border-0 outline-0">
                                                @foreach($expense_category as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td colspan="2" class="small px-2 fw-bold">PO No.</td>
                                        <td colspan="2" class="small px-2">
                                            <input id="purchaseOrderInput" class="w-100 border-0 outline-0">
                                        </td>
                                        <td colspan="5" class="small px-2 fw-bold bg-blue">AUDITOR</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="small px-2 text-center bg-red fw-bold">Receipt</td>
                                        <td colspan="1" class="text-center">
                                            <input type="checkbox">
                                        </td>
                                        <td colspan="3" class="small px-2">
                                            <select data-index="10" name="expenseCategory[]" class="w-100 border-0 outline-0">
                                                @foreach($expense_category as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td colspan="2" class="small px-2 fw-bold">Invoice No</td>
                                        <td colspan="2" class="small px-2">
                                            <input id="invoiceNumberInput" class="w-100 border-0 outline-0">
                                        </td>
                                        <td colspan="5" class="small px-2">
                                            Approved
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="1" class="text-center">
                                            <input value="" class="attachmentReceipt" type="checkbox">
                                        </td>
                                        <td colspan="3" class="small px-2">Official Receipt VAT</td>
                                        <td colspan="1" class="text-center">
                                            <input type="checkbox">
                                        </td>
                                        <td colspan="3" class="small px-2">
                                            <select data-index="11" name="expenseCategory[]" class="w-100 border-0 outline-0">
                                                @foreach($expense_category as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td colspan="2" class="fw-bold small px-2">Bill No.</td>
                                        <td colspan="2" class="small px-2">
                                            <input id="billNumberInput" class="w-100 border-0 outline-0">
                                        </td>
                                        <td colspan="5" class="small px-2">
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="1" class="text-center">
                                            <input value="" class="attachmentReceipt" type="checkbox">
                                        </td>
                                        <td colspan="3" class="small px-2">Delivery Receipt</td>
                                        <td colspan="1" class="text-center">
                                            <input type="checkbox">
                                        </td>
                                        <td colspan="3" class="small px-2 selectable">
                                            <select data-index="12" name="expenseCategory[]" class="bg-transparent w-100 border-0 outline-0">
                                                @foreach($expense_category as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td colspan="2" class="fw-bold small px-2">OR No</td>
                                        <td colspan="2" class="small px-2">
                                            <input id="orNumberInput" class="w-100 border-0 outline-0">
                                        </td>
                                        <td colspan="4" rowspan="2" class="small px-2" style="width: 171px"></td>
                                        <td colspan="1" rowspan="2" class="text-center fw-bold align-middle">
                                            RCA
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="1" class="text-center">
                                            <input value="" class="attachmentReceipt" type="checkbox">
                                        </td>
                                        <td colspan="3" class="small px-2">None</td>
                                        <td colspan="1" class="text-center">
                                            <input type="checkbox">
                                        </td>
                                        <td colspan="4" class="px-2">
                                            <div class="d-flex gap-1 align-items-center mb-1">
                                                <label class="small">Others:</label>
                                                <input
                                                    class="small w-100 outline-0 border-1 border-top-0 border-start-0 border-end-0">
                                            </div>
                                        </td>
                                        <td colspan="2" class="fw-bold small px-2">Voucher No</td>
                                        <td colspan="2" class="small px-2">
                                            TBA
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="m-0 border p-3 mb-3" style="border-radius: 7px;
                    background-color: rgba(255, 255, 255, 0.2);
                    box-shadow: 0 25px 45px rgba(0, 0, 0, 0.1);
                    border: 1px solid rgba(255, 255, 255, 0.5);
                    border-right: 1px solid rgba(255, 255, 255, 0.2);
                    border-bottom: 1px solid rgba(255, 255, 255, 0.2);" id="final_request">
                        <div class="row m-0 gap-3 p-4" style="background-color: rgba(255, 255, 255, 0.3);
                            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
                            border: 1px solid rgba(255, 255, 255, 0.5);
                            border-right: 1px solid rgba(255, 255, 255, 0.2);
                            border-bottom: 1px solid rgba(255, 255, 255, 0.2);">
                            <div class="col-auto d-flex flex-row gap-2 align-items-center me-auto">
                                <label class="form-label text-nowrap m-0">TOTAL :</label>
                                <input id="itemTotal" type="text" class="form-control p-2" name="total" disabled>
                            </div>
                            <div class="col-auto me-auto">
                                <select class="form-control" name="priorityLevel" id="requestPriorityLevel">
                                    <option value="{{\App\Enums\RequestPriorityLevel::NONE->name}}">Pick a level</option>
                                    <option value="{{\App\Enums\RequestPriorityLevel::LOW->name}}">Low (5 Days)</option>
                                    <option value="{{\App\Enums\RequestPriorityLevel::MEDIUM->name}}">Medium (3 Days)</option>
                                    <option value="{{\App\Enums\RequestPriorityLevel::HIGH->name}}">High (1 Day)</option>
                                </select>
                            </div>
                            <div class="col-auto d-flex flex-row gap-2 align-items-center me-auto">
                                <input class="form-check-input mt-0" type="checkbox" name="priority" value="priority" id="requestPriority">
                                <label class="form-label mb-0">PRIORITY</label>
                            </div>
                            <div class="col-auto mx-auto">
                                <button type="submit" class="btn btn-success btn-md rounded-0 px-5 w-100 h-100">
                                    SUBMIT
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </form>
@endsection

@section('script')
    <script type="text/javascript" src="/js/expense/request.js"></script>
@endsection
