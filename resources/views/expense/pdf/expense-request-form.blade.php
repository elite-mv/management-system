<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Expense Request Form</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

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
            padding: 2px;
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

        .selectable:hover{
            cursor: pointer !important;
            background-color: var(--gray);
        }

        select{
            cursor: pointer;
        }

    </style>
</head>
<body>
    <div id="parent" class="mx-auto px-4 py-2" style="width: 8in">
        <table  class="table table-bordered border-dark mx-auto">
            <tbody>
            <tr>
                <td colspan="4" class="small px-2">Date:</td>
                <td colspan="8" class="small px-2">{{$request->created_at->format('Y-m-d H:m')}}</td>
                <td colspan="2" class="small px-2">CV NO:</td>
                <td colspan="4" class="small px-2">
                    @if(isset($request->checkVoucher))
                        {{ $request->checkVoucher->reference }}
                    @endif
                </td>
            </tr>
            <tr>
                <td colspan="4" class="small px-2">Supplier:</td>
                <td colspan="8" class="small px-2 text-capitalize">
                    @management
                    <small>{{$request->supplier}}</small>
                    @else
                        <small>[HIDDEN]</small>
                        @endmanagement
                </td>
                <td colspan="2" class="small px-2">REF NO:</td>
                <td colspan="4" class="small px-2">{{ $request->reference }}</td>
            </tr>
            <tr>
                <td colspan="4" class="small px-2">Paid to:</td>
                <td colspan="14" class="small px-2 text-capitalize">{{$request->paid_to}}</td>
            </tr>
            <tr>
                <td colspan="4" class="small px-2">Requested By:</td>
                <td colspan="14" class="small px-2 text-capitalize">{{$request->request_by}}</td>
            </tr>
            <tr>
                <td colspan="4" class="small px-2">Prepared By:</td>
                <td colspan="14" class="small px-2 text-capitalize">{{$request->preparedBy->name}}</td>
            </tr>
            <tr>
                <td class="small text-center bg-dark text-white" colspan="18">EXPENSE REQUEST</td>
            </tr>
            <tr>
                <td colspan="2" class="small text-center fw-bold bg-gray text-uppercase">QTY</td>
                <td colspan="3" class="small text-center fw-bold bg-gray text-uppercase">UOM</td>
                <td colspan="2" class="small text-center fw-bold bg-gray text-uppercase">JOB ORDER</td>
                <td colspan="2" class="small text-center fw-bold bg-gray text-uppercase">DESCRIPTION</td>
                <td colspan="2" class="small text-center fw-bold bg-gray text-uppercase">UNIT COST</td>
                <td colspan="2" class="small text-center fw-bold bg-gray text-uppercase">TOTAL</td>
                <td colspan="3" class="small text-center fw-bold bg-gray text-uppercase">STATUS</td>
                <td colspan="2" class="small text-center fw-bold bg-gray text-uppercase">REMARKS</td>
            </tr>
            @foreach ($request->items as $item)
                <tr class="selectable" role="button" onclick="viewItem('{{$item->id}}')">
                    <td colspan="2" class="small px-2 bg-transparent text-transparent">{{$item->quantity}}</td>
                    <td colspan="3" class="small px-2 bg-transparent">{{$item->measurement->name}}</td>
                    <td colspan="2" class="small px-2 bg-transparent">{{$item->jobOrder->name}}</td>
                    <td colspan="2" class="small bg-transparent">
                        <div class="d-flex align-items-center bg-transparent">
                            <p class="m-0 p-0" style="max-width: 200px">{{$item->description}}</p>
                            <i class="ms-auto fas fa-images"></i>
                        </div>
                    </td>
                    <td colspan="2"
                        class="small px-2 bg-transparent">{!! \App\Helper\Helper::formatPeso($item->cost) !!}</td>
                    <td colspan="2"
                        class="small px-2 bg-transparent">{!! \App\Helper\Helper::formatPeso($item->total) !!}</td>
                    <td colspan="3" class="small px-2 bg-transparent">{{$item->status}}</td>
                    <td colspan="2" class="small px-2 bg-transparent">{{$item->remarks}}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="9" class="px-2 small text-end fw-bold bg-gray text-uppercase">TOTAL</td>
                <td colspan="4"
                    class="px-2 small text-end">{!! \App\Helper\Helper::formatPeso($request->total) !!}</td>
                <td colspan="5"
                    class="px-2 small text-center fw-bold bg-gray text-uppercase">{!! \App\Helper\Helper::formatPeso($request->fund) !!}</td>
            </tr>
            <tr>
                <td class="small text-center bg-dark text-white" colspan="18">PURCHASE REQUEST</td>
            </tr>
            <tr>
                <td colspan="4" class="px-2 small bg-gray">Supplier</td>
                <td colspan="5" class="px-2 small">
                    @management
                    <small>{{$request->supplier}}</small>
                    @else
                        <small>[HIDDEN]</small>
                        @endmanagement
                </td>
                <td colspan="3" class="px-2 small bg-gray">Payment Type</td>
                <td colspan="6" class="px-2 small">
                    @if($request->payment_method != \App\Enums\PaymentMethod::NONE)
                        {{ $request->payment_method->name}}
                    @endif
                </td>
            </tr>

            <tr>
                <td colspan="4" class="small bg-yellow text-center fw-bold" style="width: 179px">QTY</td>
                <td colspan="4" class="small bg-yellow text-center fw-bold" style="width: 179px">UOM</td>
                <td colspan="1" class="small bg-yellow text-center fw-bold" style="width: 179px">JOB ORDER</td>
                <td colspan="3" class="small bg-yellow text-center fw-bold" style="width: 179px">DESCRIPTION</td>
                <td colspan="3" class="small bg-yellow text-center fw-bold" style="width: 179px">UNIT COST</td>
                <td colspan="3" class="small bg-yellow text-center fw-bold" style="width: 179px">TOTAL</td>
            </tr>

            @foreach ($request->fund_item as $item)
                <tr>
                    <td colspan="4" class="small px-2 bg-transparent">{{$item->quantity}}</td>
                    <td colspan="4" class="small px-2 bg-transparent">{{$item->measurement->name}}</td>
                    <td colspan="1" class="small px-2 bg-transparent">{{$item->jobOrder->name}}</td>
                    <td colspan="3" role="button" class="small px-2 pointer" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">
                        <div class="d-flex align-items-center bg-transparent">
                            <p class="m-0 p-0 text-truncate">{{$item->description}}</p>
                            <i class="ms-auto fas fa-images"></i>
                        </div>
                    </td>
                    <td colspan="3"
                        class="small px-2 bg-transparent">{!! \App\Helper\Helper::formatPeso($item->cost) !!}</td>
                    <td colspan="3"
                        class="small px-2 bg-transparent">{!! \App\Helper\Helper::formatPeso($item->cost) !!}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="15" class="px-2 small bg-yellow text-end fw-bold">TOTAL</td>
                <td colspan="4"
                    class="px-2 small bg-yellow text-center fw-bold">{!! \App\Helper\Helper::formatPeso($request->fund) !!}</td>
            </tr>
            <tr>
                <td class="small text-center bg-dark text-white" colspan="18">VOUCHER</td>
            </tr>
            <tr>
                <td colspan="4" class="px-2 small fw-bold bg-gray">Supplier:</td>
                <td colspan="5" class="px-2 small">
                    @if(isset($request->checkVoucher))
                        @management
                        <small>{{$request->supplier}}</small>
                    @else
                        <small>[HIDDEN]</small>
                        @endmanagement
                    @endif
                </td>
                <td colspan="3" class="px-2 small fw-bold bg-gray">Date:</td>
                <td colspan="6" class="px-2 small">
                    @if(isset($request->checkVoucher))
                        {{ $request->checkVoucher->created_at->format('Y-m-d H:m') }}
                    @endif
                </td>
            </tr>
            <tr>
                <td colspan="4" class="px-2 small fw-bold bg-gray">Paid to:</td>
                <td colspan="5" class="px-2 small">
                    @if(isset($request->checkVoucher))
                        @management
                        <small>{{$request->paid_to}}</small>
                    @else
                        <small>[HIDDEN]</small>
                        @endmanagement
                    @endif
                </td>
                <td colspan="3" class="px-2 small fw-bold bg-gray">Paid amount:</td>
                <td colspan="6" class="px-2 small">
                    @if(isset($request->checkVoucher))
                        {!! \App\Helper\Helper::formatPeso($request->fund) !!}
                    @endif
                </td>
            </tr>
            <tr>
                <td colspan="4" class="px-2 small fw-bold bg-gray">Payment Type:</td>
                <td colspan="5" class="px-2 small">
                    @if(isset($request->checkVoucher))
                        {{str_replace('_', ' ', $request->payment_method->name) }}
                    @endif
                </td>
                <td colspan="3" class="px-2 small fw-bold bg-gray">Amount in words:</td>
                <td colspan="6" class="px-2 small">
                    @if(isset($request->checkVoucher))
                        {!! \App\Helper\Helper::amountToWords($request->fund) !!}
                    @endif
                </td>
            </tr>
            <tr>
                <td colspan="8" class="bg-yellow text-center small" style="width: 367px">RELEASED BY :</td>
                <td colspan="4" class="bg-red text-center small" style="width: 367px">RECEIVED BY :</td>
                <td colspan="6" class="bg-green text-center small" style="width: 367px">AUDITED BY :</td>
            </tr>
            <tr style="height: 80px">
                <td colspan="8" class="text-center align-bottom fw-bold small" style="height: 24px">
                    MR. RYLAN C. ALINGAROG
                </td>
                <td colspan="4" class="text-center align-bottom fw-bold small" style="height: 24px">
                </td>
                <td colspan="6" class="text-center align-bottom fw-bold small" style="height: 24px">
                </td>
            </tr>

            <tr>
                <td colspan="8" class="small bg-yellow text-center">Signature Over Printed Name</td>
                <td colspan="4" class="small bg-red text-center">Signature Over Printed Name</td>
                <td colspan="6" class="small bg-green text-center">Signature Over Printed Name</td>
            </tr>
            <tr>
                <td class="text-center bg-dark text-white" colspan="18" style="height: 24px">
                </td>
            </tr>
            <tr>
                <td colspan="9" class="text-center fw-bold py-2">ACCOUNTING DEPARTMENT</td>
                <td colspan="9" class="text-center fw-bold py-2">AUDITOR DEPARTMENT</td>
            </tr>
            <tr>
                <td colspan="4" class="text-center fw-bold bg-red small" style="width: 171px">Priority level</td>
                <td colspan="4" class="text-center fw-bold bg-blue small">Type</td>
                <td colspan="1" class="text-center fw-bold bg-blue small">BANK NAME</td>
                <td colspan="4" class="fw-bold small px-2">ITEMS DELIVERY</td>
                <td colspan="5" class="px-2 fw-bold small bg-blue" style="width: 268px">BOOK KEEPER</td>
            </tr>
            <tr>
                <td colspan="1" class="text-center" style="width: 32px">
                    @if($request->priority_level === App\Enums\RequestPriorityLevel::LOW)
                        <input class="priorityLevel" value="{{App\Enums\RequestPriorityLevel::LOW->name}}"
                               type="checkbox" name="LOW" checked>
                    @else
                        <input class="priorityLevel" value="{{App\Enums\RequestPriorityLevel::LOW->name}}"
                               type="checkbox" name="LOW">
                    @endif
                </td>
                <td colspan="2" class="small px-2">Low</td>
                <td colspan="1" class="small px-2">5 days</td>
                <td colspan="1" class="text-center" style="width: 32px">
                    <input type="checkbox">
                </td>
                <td colspan="3" class="small px-2" style="width: 146px">
                    <select data-index="1" name="expenseCategory[]" class="w-100 border-0 outline-0">
                        @foreach($expense_category as $case)
                            @if($request->expenseTypes->get(0) && $request->expenseTypes->get(0)->expense_category_id == $case->id)
                                <option value="{{$case->id}}" selected>{{$case->name}}</option>
                            @else
                                <option value="{{$case->id}}">{{$case->name}}</option>
                            @endif
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
                    @if($request->delivery && $request->delivery->completed)
                        <input value="1" class="deliveryStatus" name="requestDeliveryStatus"
                               id="requestDeliveryComplete"
                               type="checkbox" checked>
                    @else
                        <input value="1" class="deliveryStatus" name="requestDeliveryStatus"
                               id="requestDeliveryComplete"
                               type="checkbox">
                    @endif

                </td>
                <td colspan="3" class="px-2 bg-green small">Complete</td>
                <td colspan="5" class="px-2 small">

                    @if($request->priority)
                        Priority
                    @else
                        <form id="bookerKeeperForm" method="POST" action="/expense/expense-request/book-keeper/approval/{{$request->id}}">
                            @csrf
                            <select id="bookerKeeperStatus" name="status" class="border-0 outline-0 w-100">
                                @foreach(\App\Enums\RequestApprovalStatus::status() as $case)
                                    @if($request->bookKeeper && $request->bookKeeper->status == $case)
                                        <option value="{{$case->name}}" selected>{{$case->name}}</option>
                                    @else
                                        <option value="{{$case->name}}">{{$case->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </form>
                    @endif
                </td>
            </tr>
            <tr>
                <td colspan="1" class="text-center">
                    @if($request->priority_level === App\Enums\RequestPriorityLevel::MEDIUM)
                        <input class="priorityLevel" value="{{App\Enums\RequestPriorityLevel::MEDIUM->name}}"
                               type="checkbox" name="MEDIUM" checked>
                    @else
                        <input class="priorityLevel" value="{{App\Enums\RequestPriorityLevel::MEDIUM->name}}"
                               type="checkbox" name="MEDIUM">
                    @endif
                </td>
                <td colspan="2" class="small px-2">Medium</td>
                <td colspan="1" class="small px-2">3 days</td>
                <td colspan="1" class="text-center">
                    <input type="checkbox">
                </td>
                <td colspan="3" class="small px-2">
                    <select data-index="2"  name="expenseCategory[]" class="w-100 border-0 outline-0">
                        @foreach($expense_category as $case)
                            @if($request->expenseTypes->get(1) && $request->expenseTypes->get(1)->expense_category_id == $case->id)
                                <option value="{{$case->id}}" selected>{{$case->name}}</option>
                            @else
                                <option value="{{$case->id}}">{{$case->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </td>
                <td colspan="1" class="text-center fw-bold bg-blue small">BANK CODE</td>
                <td colspan="1" class="text-center">
                    @if($request->delivery && !$request->delivery->completed)
                        <input value="0" class="deliveryStatus" name="requestDeliveryStatus"
                               id="requestDeliveryIncomplete"
                               type="checkbox" checked>
                    @else
                        <input value="0" class="deliveryStatus" name="requestDeliveryStatus"
                               id="requestDeliveryIncomplete"
                               type="checkbox">
                    @endif
                </td>
                <td colspan="3" class="px-2 bg-blue small">Incomplete</td>
                <td colspan="5" class="px-2 small">
                    @if($request->priority)
                        {{  $request->created_at->format('Y-m-d H:m')}}
                    @else
                        @if($request->bookKeeper)
                            {{  $request->bookKeeper->created_at->format('Y-m-d H:m')}}
                        @endif
                    @endif
                </td>
            </tr>
            <tr>
                <td colspan="1" class="text-center">
                    @if($request->priority_level === App\Enums\RequestPriorityLevel::HIGH)
                        <input class="priorityLevel" value="{{App\Enums\RequestPriorityLevel::HIGH->name}}"
                               type="checkbox" name="HIGH" checked>
                    @else
                        <input class="priorityLevel" value="{{App\Enums\RequestPriorityLevel::HIGH->name}}"
                               type="checkbox" name="HIGH">
                    @endif
                </td>
                <td colspan="2" class="small px-2">High</td>
                <td colspan="1" class="small px-2">1 day</td>
                <td colspan="1" class="text-center">
                    <input type="checkbox">
                </td>
                <td colspan="3" class="small px-2">
                    <select data-index="3"  name="expenseCategory[]" class="w-100 border-0 outline-0">
                        @foreach($expense_category as $case)
                            @if($request->expenseTypes->get(2) && $request->expenseTypes->get(2)->expense_category_id == $case->id)
                                <option value="{{$case->id}}" selected>{{$case->name}}</option>
                            @else
                                <option value="{{$case->id}}">{{$case->name}}</option>
                            @endif
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
                    <select data-index="4"  name="expenseCategory[]" class="w-100 border-0 outline-0">
                        @foreach($expense_category as $case)
                            @if($request->expenseTypes->get(3) && $request->expenseTypes->get(3)->expense_category_id == $case->id)
                                <option value="{{$case->id}}" selected>{{$case->name}}</option>
                            @else
                                <option value="{{$case->id}}">{{$case->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </td>
                <td colspan="1" class="bg-blue fw-bold text-center small">CHECK NUMBER</td>
                <td colspan="1" class="text-center">
                    @if($request->delivery && $request->delivery->supplier_verified)
                        <input value="1" class="deliverySupplier" type="checkbox" checked>
                    @else
                        <input value="1" class="deliverySupplier" type="checkbox">
                    @endif
                </td>
                <td colspan="3" class="small px-2">Yes</td>
                <td colspan="5" class="small px-2">
                    @if($request->priority)
                        Priority
                    @else
                        <form id="accountantForm" method="POST" action="/expense/expense-request/accountant/approval/{{$request->id}}">
                            @csrf
                            <select id="accountantStatus" name="status" class="border-0 outline-0 w-100">
                                @foreach(\App\Enums\RequestApprovalStatus::status() as $case)
                                    @if($request->accountant && $request->accountant->status == $case)
                                        <option value="{{$case->name}}" selected>{{$case->name}}</option>
                                    @else
                                        <option value="{{$case->name}}">{{$case->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </form>
                    @endif
                </td>
            </tr>
            <tr>
                <td colspan="1" class="text-center">
                    @if($request->attachment == \App\Enums\AccountingAttachment::WITH)
                        <input value="{{\App\Enums\AccountingAttachment::WITH->name}}" class="attachment"
                               type="checkbox" checked>
                    @else
                        <input value="{{\App\Enums\AccountingAttachment::WITH->name}}" class="attachment"
                               type="checkbox">
                    @endif
                </td>
                <td colspan="3" class="small px-2">With</td>
                <td colspan="1" class="text-center">
                    <input type="checkbox">
                </td>
                <td colspan="3" class="small px-2">
                    <select  data-index="5"  name="expenseCategory[]" class="w-100 border-0 outline-0">
                        @foreach($expense_category as $case)
                            @if($request->expenseTypes->get(4) && $request->expenseTypes->get(4)->expense_category_id == $case->id)
                                <option value="{{$case->id}}" selected>{{$case->name}}</option>
                            @else
                                <option value="{{$case->id}}">{{$case->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </td>
                <td colspan="1">
                    <input id="checkNumberInput" class="w-100 border-0 outline-0">
                </td>
                <td colspan="1" class="text-center">
                    @if($request->delivery && !$request->delivery->supplier_verified)
                        <input value="0" class="deliverySupplier" type="checkbox" checked>
                    @else
                        <input value="0" class="deliverySupplier" type="checkbox">
                    @endif
                </td>
                <td colspan="3" class="small px-2">No</td>
                <td colspan="5" class="small px-2">
                    @if($request->priority)
                        {{  $request->created_at->format('Y-m-d H:m')}}
                    @else
                        @if($request->accountant)
                            {{$request->accountant->created_at->format('y-m-d H:m')}}
                        @endif
                    @endif
                </td>
            </tr>
            <tr>
                <td colspan="1" class="text-center">
                    @if($request->attachment == \App\Enums\AccountingAttachment::WITHOUT)
                        <input value="{{\App\Enums\AccountingAttachment::WITHOUT->name}}" class="attachment"
                               type="checkbox" checked>
                    @else
                        <input value="{{\App\Enums\AccountingAttachment::WITHOUT->name}}" class="attachment"
                               type="checkbox">
                    @endif
                </td>
                <td colspan="3" class="small px-2">Without</td>
                <td colspan="1" class="text-center">
                    <input type="checkbox">
                </td>
                <td colspan="3" class="small px-2">
                    <select  data-index="6"  name="expenseCategory[]" class="w-100 border-0 outline-0">
                        @foreach($expense_category as $case)
                            @if($request->expenseTypes->get(5) && $request->expenseTypes->get(5)->expense_category_id == $case->id)
                                <option value="{{$case->id}}" selected>{{$case->name}}</option>
                            @else
                                <option value="{{$case->id}}">{{$case->name}}</option>
                            @endif
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
                    <select  data-index="7"   name="expenseCategory[]" class="w-100 border-0 outline-0">
                        @foreach($expense_category as $case)
                            @if($request->expenseTypes->get(6) && $request->expenseTypes->get(6)->expense_category_id == $case->id)
                                <option value="{{$case->id}}" selected>{{$case->name}}</option>
                            @else
                                <option value="{{$case->id}}">{{$case->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </td>
                <td colspan="4" class="text-center small px-2">
                    @if($request->vat)
                        <input value="{{$request->vat->option_a}}" type="text" id="vatOption1" class="h-100 w-100 border-0 outline-0">
                    @else
                        <input type="text" id="vatOption1" class="h-100 w-100 border-0 outline-0">
                    @endif
                </td>
                <td colspan="5" class="small px-2">
                    <form id="financeForm" method="POST" action="/expense/expense-request/finance/approval/{{$request->id}}">
                        @csrf
                        <select id="financeStatus" name="status" class="border-0 outline-0 w-100">
                            @foreach(\App\Enums\RequestApprovalStatus::status() as $case)
                                @if($request->finance && $request->finance->status == $case)
                                    <option value="{{$case->name}}" selected>{{$case->name}}</option>
                                @else
                                    <option value="{{$case->name}}">{{$case->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </form>
                </td>
            </tr>
            <tr>
                <td colspan="1" class="text-center">
                    @if($request->type == \App\Enums\AccountingType::OPEX)
                        <input value="{{App\Enums\AccountingType::OPEX->name}}" class="attachmentType"
                               type="checkbox" checked>
                    @else
                        <input value="{{App\Enums\AccountingType::OPEX->name}}" class="attachmentType"
                               type="checkbox">
                    @endif
                </td>
                <td colspan="3" class="small px-2">OPEX</td>
                <td colspan="1" class="text-center">
                    <input type="checkbox">
                </td>
                <td colspan="3" class="small px-2">
                    <select data-index="8"  name="expenseCategory[]" class="w-100 border-0 outline-0">
                        @foreach($expense_category as $case)
                            @if($request->expenseTypes->get(7) && $request->expenseTypes->get(7)->expense_category_id == $case->id)
                                <option value="{{$case->id}}" selected>{{$case->name}}</option>
                            @else
                                <option value="{{$case->id}}">{{$case->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </td>
                <td colspan="4" class="text-center small px-2">
                    @if($request->vat)
                        <input value="{{$request->vat->option_b}}" type="text" id="vatOption2" class="h-100 w-100 border-0 outline-0">
                    @else
                        <input type="text" id="vatOption2" class="h-100 w-100 border-0 outline-0">
                    @endif
                </td>
                <td colspan="5" class="small px-2">
                    @if($request->finance)
                        {{$request->finance->created_at->format('y-m-d H:m')}}
                    @endif
                </td>
            </tr>
            <tr>
                <td colspan="1" class="text-center">
                    @if($request->type == \App\Enums\AccountingType::NON_OPEX)
                        <input value="{{App\Enums\AccountingType::NON_OPEX->name}}" class="attachmentType"
                               type="checkbox" checked>
                    @else
                        <input value="{{App\Enums\AccountingType::NON_OPEX->name}}" class="attachmentType"
                               type="checkbox">
                    @endif
                </td>
                <td colspan="3" class="small px-2">NON OPEX</td>
                <td colspan="1" class="text-center">
                    <input type="checkbox">
                </td>
                <td colspan="3" class="small px-2">
                    <select data-index="9"  name="expenseCategory[]" class="w-100 border-0 outline-0">
                        @foreach($expense_category as $case)
                            @if($request->expenseTypes->get(8) && $request->expenseTypes->get(8)->expense_category_id == $case->id)
                                <option value="{{$case->id}}" selected>{{$case->name}}</option>
                            @else
                                <option value="{{$case->id}}">{{$case->name}}</option>
                            @endif
                        @endforeach
                    </select></td>
                <td colspan="2" class="small px-2 fw-bold">PO No.</td>
                <td colspan="2" class="small px-2">
                    @if($request->vat)
                        <input value="{{$request->vat->purchase_order}}" id="purchaseOrderInput" class="w-100 border-0 outline-0">
                    @else
                        <input id="purchaseOrderInput" class="w-100 border-0 outline-0">
                    @endif
                </td>
                <td colspan="5" class="small px-2 fw-bold bg-blue">AUDITOR</td>
            </tr>
            <tr>
                <td colspan="4" class="small px-2 text-center bg-red fw-bold">Receipt</td>
                <td colspan="1" class="text-center">
                    <input type="checkbox">
                </td>
                <td colspan="3" class="small px-2">
                    <select data-index="10"   name="expenseCategory[]" class="w-100 border-0 outline-0">
                        @foreach($expense_category as $case)
                            @if($request->expenseTypes->get(9) && $request->expenseTypes->get(9)->expense_category_id == $case->id)
                                <option value="{{$case->id}}" selected>{{$case->name}}</option>
                            @else
                                <option value="{{$case->id}}">{{$case->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </td>
                <td colspan="2" class="small px-2 fw-bold">Invoice No</td>
                <td colspan="2" class="small px-2">
                    @if($request->vat)
                        <input value="{{$request->vat->invoice}}" id="invoiceNumberInput" class="w-100 border-0 outline-0">
                    @else
                        <input id="invoiceNumberInput" class="w-100 border-0 outline-0">
                    @endif
                </td>
                <td colspan="5" class="small px-2">
                    <form id="auditorForm" method="POST" action="/expense/expense-request/auditor/approval/{{$request->id}}">
                        @csrf
                        <select id="auditorStatus" name="status" class="border-0 outline-0 w-100">
                            @foreach(\App\Enums\RequestApprovalStatus::status() as $case)
                                @if($request->auditor && $request->auditor->status == $case)
                                    <option value="{{$case->name}}" selected>{{$case->name}}</option>
                                @else
                                    <option value="{{$case->name}}">{{$case->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </form>
                </td>
            </tr>
            <tr>
                <td colspan="1" class="text-center">
                    @if($request->receipt == \App\Enums\AccountingReceipt::OFFICIAL_RECEIPT_VAT)
                        <input value="{{\App\Enums\AccountingReceipt::OFFICIAL_RECEIPT_VAT->name}}"
                               class="attachmentReceipt" type="checkbox" checked>
                    @else
                        <input value="{{\App\Enums\AccountingReceipt::OFFICIAL_RECEIPT_VAT->name}}"
                               class="attachmentReceipt" type="checkbox">
                    @endif
                </td>
                <td colspan="3" class="small px-2">Official Receipt VAT</td>
                <td colspan="1" class="text-center">
                    <input type="checkbox">
                </td>
                <td colspan="3" class="small px-2">
                    <select data-index="11"  name="expenseCategory[]" class="w-100 border-0 outline-0">
                        @foreach($expense_category as $case)
                            @if($request->expenseTypes->get(10) && $request->expenseTypes->get(10)->expense_category_id == $case->id)
                                <option value="{{$case->id}}" selected>{{$case->name}}</option>
                            @else
                                <option value="{{$case->id}}">{{$case->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </td>
                <td colspan="2" class="fw-bold small px-2">Bill No.</td>
                <td colspan="2" class="small px-2">
                    @if($request->vat)
                        <input value="{{$request->vat->bill}}" id="billNumberInput" class="w-100 border-0 outline-0">
                    @else
                        <input id="billNumberInput" class="w-100 border-0 outline-0">
                    @endif
                </td>
                <td colspan="5" class="small px-2">
                    @if($request->auditor)
                        {{ $request->auditor->created_at->format('Y-m-d H:m')}}
                    @endif
                </td>
            </tr>
            <tr>
                <td colspan="1" class="text-center">
                    @if($request->receipt == \App\Enums\AccountingReceipt::DELIVERY_RECEIPT)
                        <input value="{{\App\Enums\AccountingReceipt::DELIVERY_RECEIPT->name}}"
                               class="attachmentReceipt" type="checkbox" checked>
                    @else
                        <input value="{{\App\Enums\AccountingReceipt::DELIVERY_RECEIPT->name}}"
                               class="attachmentReceipt" type="checkbox">
                    @endif
                </td>
                <td colspan="3" class="small px-2">Delivery Receipt</td>
                <td colspan="1" class="text-center">
                    <input type="checkbox">
                </td>
                <td colspan="3" class="small px-2 selectable">
                    <select data-index="12"  name="expenseCategory[]" class="bg-transparent w-100 border-0 outline-0">
                        @foreach($expense_category as $case)
                            @if($request->expenseTypes->get(11) && $request->expenseTypes->get(11)->expense_category_id == $case->id)
                                <option value="{{$case->id}}" selected>{{$case->name}}</option>
                            @else
                                <option value="{{$case->id}}">{{$case->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </td>
                <td colspan="2" class="fw-bold small px-2">OR No</td>
                <td colspan="2" class="small px-2">
                    @if($request->vat)
                        <input value="{{$request->vat->official_receipt}}" id="orNumberInput" class="w-100 border-0 outline-0">
                    @else
                        <input id="orNumberInput" class="w-100 border-0 outline-0">
                    @endif
                </td>
                <td colspan="4" rowspan="2" class="small px-2" style="width: 171px"></td>
                <td colspan="1" rowspan="2" class="text-center fw-bold align-middle">
                    RCA
                </td>
            </tr>
            <tr>
                <td colspan="1" class="text-center">
                    @if($request->receipt == \App\Enums\AccountingReceipt::NONE)
                        <input value="{{\App\Enums\AccountingReceipt::NONE->name}}" class="attachmentReceipt"
                               type="checkbox" checked>
                    @else
                        <input value="{{\App\Enums\AccountingReceipt::NONE->name}}" class="attachmentReceipt"
                               type="checkbox">
                    @endif
                </td>
                <td colspan="3" class="small px-2">None</td>
                <td colspan="1" class="text-center">
                    <input type="checkbox">
                </td>
                <td colspan="4" class="px-2">
                    <div class="d-flex gap-1 align-items-center mb-1">
                        <label class="small">Others:</label>
                        <input class="small w-100 outline-0 border-1 border-top-0 border-start-0 border-end-0">
                    </div>
                </td>
                <td colspan="2" class="fw-bold small px-2">Voucher No</td>
                <td colspan="2" class="small px-2">
                    @if(isset($request->checkVoucher))
                        {{$request->checkVoucher->padId}}
                    @endif
                </td>
            </tr>
            <tr>
                <td class="text-center bg-dark text-white" colspan="18" style="height: 24px"></td>
            </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
