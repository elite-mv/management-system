@extends('layouts.expense-index')


@section('files')
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
@endsection

@section('title', 'View Request')

@section('style')
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


    </style>
@endsection

@section('body')

    <div class="bg-light p-2">
        <button class="btn btn-success">
            <i class="fas fa-download"></i>
            Download
        </button>
        <button class="btn btn-secondary">
            <i class="far fa-sticky-note"></i>
            Add Note
        </button>
        <button class="btn btn-secondary">
            <i class="fas fa-scroll"></i>
            View Logs
        </button>
    </div>

    <div class="container-fluid mx-auto bg-white">
        <div class="mx-auto px-4 py-2">

            <div class="d-flex mb-4">

                <div>
                    <div class="border border-dark"
                         style="width: 100px; height: 100px; display: flex; align-items: center; justify-content: center;">
                        <img src="./src/logos/PERSONAL_LOGO.png" class="img-fluid" alt="LOGO"
                             style="height: 100px; width: auto;">
                    </div>
                    <div class="bg-red text-center text-white border border-dark"
                         style="width: 100px; border-style: none solid none solid !important;">
                        <strong>{{$request->company->name}}</strong>
                    </div>
                </div>

                <div style="font-size: 70px;"
                     class="m-0 ms-5 px-5 border border-5 border-danger text-danger text-center">PENDING
                </div>

                <div class="ms-auto">
                    <div class="bg-red text-center text-white border border-dark px-2"
                         style="border-style: solid solid none solid !important;">
                        <b>PAYMENT STATUS</b>
                    </div>

                    <div class="border border-dark"
                         style="display: flex; align-items: center; justify-content: center; flex-direction: column;">
                        <div class="w-100" style="display: flex; flex-direction: row;">
                            <div class="w-25 text-center border border-dark"
                                 style="border-style: none solid solid none !important;">
                                <input type="checkbox" name="FUNDED" disabled="">
                            </div>
                            <div class="w-75 text-start border border-dark px-2"
                                 style="border-style: none none solid none !important;">
                                <small>FUNDED</small>
                            </div>
                        </div>

                        <div class="w-100" style="display: flex; flex-direction: row;">
                            <div class="w-25 text-center border border-dark"
                                 style="border-style: none solid none none !important;">
                                <input type="checkbox" name="DECLINED" disabled="">
                            </div>
                            <div class="w-75 text-start border border-dark px-2"
                                 style="border-style: none none none none !important;">
                                <small>DECLINED</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="ms-2" style="width: 150px;">
                    <div class="bg-red text-center text-white border border-dark px-2"
                         style="border-style: solid solid none solid !important;">
                        <b>STATUS</b>
                    </div>
                    <div class="border border-dark"
                         style="height: 100px; display: flex; align-items: center; justify-content: center;">

                        <h1 class="text-danger">CLOSE</h1>
                    </div>
                </div>

                <div class="ms-2">
                    <div class="bg-red text-center text-white border border-dark px-2"
                         style="border-style: solid solid none solid !important;">
                        <b>REQUEST FORM NUMBER</b>
                    </div>
                    <div class="border border-dark"
                         style="height: 100px; display: flex; align-items: center; justify-content: center;">
                        <h1><b>{{ $request->pad_id}}</b></h1>
                    </div>
                </div>

            </div>

            <table class="table table-bordered border-dark mx-auto">
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
                    <tr>
                        <td colspan="2" class="small px-2 bg-transparent">{{$item->quantity}}</td>
                        <td colspan="3" class="small px-2 bg-transparent">{{$item->measurement->name}}</td>
                        <td colspan="2" class="small px-2 bg-transparent">{{$item->jobOrder->name}}</td>
                        <td colspan="2" role="button" class="small px-2 pointer" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
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
                        <select id="paymentMethodInput" class="w-100 border-0 outline-0 ">
                            @foreach(App\Enums\PaymentMethod::modes() as $type)
                                @if($type == $request->payment_method)
                                    <option class="text-uppercase" value="{{ $type->name }}" selected>
                                        {{ str_replace('_', ' ',$type->name)  }}
                                    </option>
                                @else
                                    <option class="text-uppercase" value="{{ $type->name }}">
                                        {{ str_replace('_', ' ',$type->name)  }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
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
                    <td colspan="6" class="px-2 small text-center">
                        @if(isset($request->checkVoucher))
                            {{ $request->checkVoucher->create_at->format('Y-m-d H:m') }}
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
                    <td colspan="4" class="text-center align-bottom fw-bold small" style="height: 24px"></td>
                    <td colspan="6" class="text-center align-bottom fw-bold small" style="height: 24px"></td>
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
                        <select name="expenseCategory[]" class="w-100 border-0 outline-0">
                            <option value=""></option>
                            @foreach(\App\Enums\ExpenseCategory::cases() as $case)
                                <option value="{{$case->name}}">{{$case->value}}</option>
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
                        <select class="border-0 outline-0 w-100">
                            @foreach(\App\Enums\RequestApprovalStatus::status() as $case)
                                <option value="{{$case->name}}">{{$case->name}}</option>
                            @endforeach
                        </select>
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
                        <select name="expenseCategory[]" class="w-100 border-0 outline-0">
                            <option value=""></option>
                            @foreach(\App\Enums\ExpenseCategory::cases() as $case)
                                <option value="{{$case->name}}">{{$case->value}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td colspan="1" class="text-center fw-bold bg-blue small">BANK CODE</td>
                    <td colspan="1" class="text-center">
                        <input value="0" class="deliveryStatus" name="requestDeliveryStatus"
                               id="requestDeliveryIncomplete"
                               type="checkbox">
                    </td>
                    <td colspan="3" class="px-2 bg-blue small">Incomplete</td>
                    <td colspan="5" class="px-2 small">2024-08-12 16:08</td>
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
                        <select name="expenseCategory[]" class="w-100 border-0 outline-0">
                            <option value=""></option>
                            @foreach(\App\Enums\ExpenseCategory::cases() as $case)
                                <option value="{{$case->name}}">{{$case->value}}</option>
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
                        <select name="expenseCategory[]" class="w-100 border-0 outline-0">
                            <option value=""></option>
                            @foreach(\App\Enums\ExpenseCategory::cases() as $case)
                                <option value="{{$case->name}}">{{$case->value}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td colspan="1" class="bg-blue fw-bold text-center small">CHECK NUMBER</td>
                    <td colspan="1" class="text-center">
                        <input value="1" class="deliverySupplier" type="checkbox">
                    </td>
                    <td colspan="3" class="small px-2">Yes</td>
                    <td colspan="5" class="small px-2">
                        <select class="border-0 outline-0 w-100">
                            @foreach(\App\Enums\RequestApprovalStatus::status() as $case)
                                <option value="{{$case->name}}">{{$case->name}}</option>
                            @endforeach
                        </select>
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
                        <select name="expenseCategory[]" class="w-100 border-0 outline-0">
                            <option value=""></option>
                            @foreach(\App\Enums\ExpenseCategory::cases() as $case)
                                <option value="{{$case->name}}">{{$case->value}}</option>
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
                    <td colspan="5" class="small px-2">2024-08-12 16:08</td>
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
                        <select name="expenseCategory[]" class="w-100 border-0 outline-0">
                            <option value=""></option>
                            @foreach(\App\Enums\ExpenseCategory::cases() as $case)
                                <option value="{{$case->name}}">{{$case->value}}</option>
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
                        <select  name="expenseCategory[]" class="w-100 border-0 outline-0">
                            <option value=""></option>
                            @foreach(\App\Enums\ExpenseCategory::cases() as $case)
                                <option value="{{$case->name}}">{{$case->value}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td colspan="4" class="text-center fw-bold"></td>
                    <td colspan="5" class="small px-2">
                        <select class="border-0 outline-0 w-100">
                            @foreach(\App\Enums\RequestApprovalStatus::status() as $case)
                                <option value="{{$case->name}}">{{$case->name}}</option>
                            @endforeach
                        </select>
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
                        <select name="expenseCategory[]" class="w-100 border-0 outline-0">
                            <option value=""></option>
                            @foreach(\App\Enums\ExpenseCategory::cases() as $case)
                                <option value="{{$case->name}}">{{$case->value}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td colspan="4" class="text-center fw-bold"></td>
                    <td colspan="5" class="small px-2"></td>
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
                        <select name="expenseCategory[]" class="w-100 border-0 outline-0">
                            <option value=""></option>
                            @foreach(\App\Enums\ExpenseCategory::cases() as $case)
                                <option value="{{$case->name}}">{{$case->value}}</option>
                            @endforeach
                        </select></td>
                    <td colspan="2" class="small px-2 fw-bold">PO No.</td>
                    <td colspan="2" class="small px-2">
                        <input id="purchaseOrder" class="w-100 border-0 outline-0">
                    </td>
                    <td colspan="5" class="small px-2 fw-bold bg-blue">AUDITOR</td>
                </tr>
                <tr>
                    <td colspan="4" class="small px-2 text-center bg-red fw-bold">Receipt</td>
                    <td colspan="1" class="text-center">
                        <input type="checkbox">
                    </td>
                    <td colspan="3" class="small px-2">
                        <select  name="expenseCategory[]" class="w-100 border-0 outline-0">
                            <option value=""></option>
                            @foreach(\App\Enums\ExpenseCategory::cases() as $case)
                                <option value="{{$case->name}}">{{$case->value}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td colspan="2" class="small px-2 fw-bold">Invoice No</td>
                    <td colspan="2" class="small px-2">
                        <input id="invoiceNumber" class="w-100 border-0 outline-0">
                    </td>
                    <td colspan="5" class="small px-2">
                        <select class="border-0 outline-0 w-100">
                            @foreach(\App\Enums\RequestApprovalStatus::status() as $case)
                                <option value="{{$case->name}}">{{$case->name}}</option>
                            @endforeach
                        </select>
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
                        <select name="expenseCategory[]" class="w-100 border-0 outline-0">
                            <option value=""></option>
                            @foreach(\App\Enums\ExpenseCategory::cases() as $case)
                                <option value="{{$case->name}}">{{$case->value}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td colspan="2" class="fw-bold small px-2">Bill No.</td>
                    <td colspan="2" class="small px-2">
                        <input id="billNumber" class="w-100 border-0 outline-0">
                    </td>
                    <td colspan="5" class="small px-2"></td>
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
                    <td colspan="3" class="small px-2">
                        <select name="expenseCategory[]" class="w-100 border-0 outline-0">
                            <option value=""></option>
                            @foreach(\App\Enums\ExpenseCategory::cases() as $case)
                                <option value="{{$case->name}}">{{$case->value}}</option>
                            @endforeach
                        </select>
                    </td>
                    <td colspan="2" class="fw-bold small px-2">OR No</td>
                    <td colspan="2" class="small px-2">
                        <input id="orNumber" class="w-100 border-0 outline-0">
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
    </div>

    <!-- Toast Message For Errors -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="errorToast" class="toast text-danger" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Error</strong>
                <small>Just now</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">

            </div>
        </div>
    </div>

    <!-- Modal For Request Item -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Item</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>

                        <div class="form-group">
                            <label class="form-label text-secondary">Description</label>
                            <p>Lorem ipsum dolor sit amet.</p>
                        </div>

                        <div class="row">

                            <div class="col-4 form-group">
                                <label class="form-label">QTY</label>
                                <input type="number" class="form-control" name="qty" required>
                            </div>

                            <div class="col-4 form-group">
                                <label class="form-label">UNIT COST</label>
                                <input type="number" class="form-control" name="unit_cost" step="0.01" required>
                            </div>

                            <div class="col-4 form-group">
                                <label class="form-label">TOTAL</label>
                                <input type="number" class="form-control" name="total" step="0.01" readonly>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('script')
    <script>

        const toastErrorModal = new bootstrap.Toast(document.getElementById('errorToast'));
        const toastErrorBody = document.querySelector('.toast-body');

        const bankNameSelection = document.querySelector('#bankNameSelection');
        const bankCodeSelection = document.querySelector('#bankCodeSelection');
        const checkNumberInput = document.querySelector('#checkNumberInput');
        const requestPaymentMethodInput = document.querySelector('#paymentMethodInput');

        const expenseCategoryInput = document.querySelectorAll('select[name="expenseCategory[]"]');

        const selectedExpensesCategory = [];

        expenseCategoryInput.forEach((category, index) =>{
            category.addEventListener('change', ()=>{
                selectedExpensesCategory[index] = category.value;
                console.log(selectedExpensesCategory);
            });
        })

        bankNameSelection.addEventListener('change', updateBankDetails);
        bankCodeSelection.addEventListener('change', updateBankDetails);
        checkNumberInput.addEventListener('change', updateBankDetails);

        requestPaymentMethodInput.addEventListener('change', () => {

            const formData = new FormData();
            formData.append('mode', requestPaymentMethodInput.value);

            fetch('/expense/api/expense-request/payment-method/{{$request->id}}', {
                method: 'POST',
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                }
            }).then(response => {
                return response.json();
            }).then(data => {

                bankNameSelection.classList.add('bg-red')
                bankCodeSelection.classList.add('bg-red')
                checkNumberInput.classList.add('bg-red')

                if (data.status === 400) {
                    toastErrorBody.innerHTML = data.message;
                    toastErrorModal.show();
                    return;
                }

                if (data.status === 500) {
                    throw new Error(data.message);
                }

                bankNameSelection.classList.remove('bg-red')
                bankCodeSelection.classList.remove('bg-red')
                checkNumberInput.classList.remove('bg-red')
            }).catch(err => {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: err.message,
                });
            })
        })

        function groupCheck(groupId, cb = null, optional = null) {

            const g1 = document.querySelectorAll(`.${groupId}`);

            let gcheck = null;

            g1.forEach(item => {

                item.addEventListener('change', (e) => {

                    if (cb) {
                        if (e.target.checked) {
                            cb(e.target);
                        } else {
                            if (optional) {
                                optional(e.target);
                            }
                        }
                    }

                    if (gcheck === null) {
                        gcheck = e.target;
                        return;
                    }

                    if (gcheck !== e.target) {
                        gcheck.checked = false;
                        gcheck = e.target;
                    }
                });

                if (item.checked) {
                    gcheck = item;
                }
            })
        }

        groupCheck('deliverySupplier', verifyDelivery, removeDelivery);
        groupCheck('deliveryStatus', setDeliveryStatus, deleteDeliveryStatus);

        groupCheck('attachment', updateAttachment, removeAttachment);
        groupCheck('attachmentType', updateType, removeType);
        groupCheck('attachmentReceipt', updateReceipt, removeReceipt);
        groupCheck('priorityLevel', updatePriorityLevel, removePriorityLevel);

        function updateBankDetails() {

            if (parseInt(bankNameSelection.value) === -1 && parseInt(bankCodeSelection.value) === -1) {
                deleteBankDetails();
                return;
            }

            let formData = new FormData();
            let requestId = 1;

            formData.append('bankName', bankNameSelection.value);
            formData.append('bankNumber', bankCodeSelection.value);
            formData.append('checkNumber', checkNumberInput.value);
            formData.append('requestID', requestId);

            fetch('/expense/api/expense-request/bank-details', {
                method: 'POST',
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                }
            }).then(response => {
                return response.json();
            }).then(data => {

                console.log(data);

                bankNameSelection.classList.add('bg-red')
                bankCodeSelection.classList.add('bg-red')
                checkNumberInput.classList.add('bg-red')

                if (data.status === 400) {
                    toastErrorBody.innerHTML = data.message;
                    toastErrorModal.show();
                    return;
                }

                if (data.status === 500) {
                    throw new Error(data.message);
                }

                bankNameSelection.classList.remove('bg-red')
                bankCodeSelection.classList.remove('bg-red')
                checkNumberInput.classList.remove('bg-red')
            }).catch(err => {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: err.message,
                });
            })
        }

        function deleteBankDetails() {
            fetch('/expense/api/expense-request/bank-details/{{$request->id}}', {
                method: 'DELETE',
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                }
            }).then(response => {

                if (!response.ok) {
                    throw new Error("Something went wrong!");
                }

                return response.json();

            }).then(data => {
                bankNameSelection.classList.remove('bg-red')
                bankCodeSelection.classList.remove('bg-red')
                checkNumberInput.classList.remove('bg-red')
                checkNumberInput.value = '';
            }).catch(err => {
                bankNameSelection.classList.add('bg-red')
                bankCodeSelection.classList.add('bg-red')
                checkNumberInput.classList.add('bg-red')
            })

        }

        function setDeliveryStatus(target) {

            const formData = new FormData();

            formData.append('completed', target.value);

            fetch('/expense/api/expense-request/delivery/status/{{$request->id}}', {
                method: 'POST',
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                }
            }).then(response => {

                if (!response.ok) {
                    throw new Error("Something went wrong!");
                }

                return response.json();

            }).then(data => {

                console.log(data);

                bankNameSelection.classList.remove('bg-red')
                bankCodeSelection.classList.remove('bg-red')
                checkNumberInput.classList.remove('bg-red')
                checkNumberInput.value = '';
            }).catch(err => {

                console.log(err.message);

                bankNameSelection.classList.add('bg-red')
                bankCodeSelection.classList.add('bg-red')
                checkNumberInput.classList.add('bg-red')
            })
        }

        function deleteDeliveryStatus(target) {

            fetch('/expense/api/expense-request/delivery/status/{{$request->id}}', {
                method: 'DELETE',
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                }
            }).then(response => {

                if (!response.ok) {
                    throw new Error("Something went wrong!");
                }

                return response.json();

            }).then(data => {

                console.log(data);

                bankNameSelection.classList.remove('bg-red')
                bankCodeSelection.classList.remove('bg-red')
                checkNumberInput.classList.remove('bg-red')
                checkNumberInput.value = '';
            }).catch(err => {

                console.log(err.message);

                bankNameSelection.classList.add('bg-red')
                bankCodeSelection.classList.add('bg-red')
                checkNumberInput.classList.add('bg-red')
            })
        }

        function verifyDelivery(target) {

            const formData = new FormData();

            formData.append('verified', target.value);

            fetch('/expense/api/expense-request/delivery/supplier/{{$request->id}}', {
                method: 'POST',
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                }
            }).then(response => {

                if (!response.ok) {
                    throw new Error("Something went wrong!");
                }

                return response.json();

            }).then(data => {

                console.log(data);

                bankNameSelection.classList.remove('bg-red')
                bankCodeSelection.classList.remove('bg-red')
                checkNumberInput.classList.remove('bg-red')
                checkNumberInput.value = '';
            }).catch(err => {

                console.log(err.message);

                bankNameSelection.classList.add('bg-red')
                bankCodeSelection.classList.add('bg-red')
                checkNumberInput.classList.add('bg-red')
            })
        }

        function removeDelivery(target) {

            fetch('/expense/api/expense-request/delivery/supplier/{{$request->id}}', {
                method: 'DELETE',
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                }
            }).then(response => {

                if (!response.ok) {
                    throw new Error("Something went wrong!");
                }

                return response.json();

            }).then(data => {

                console.log(data);

                bankNameSelection.classList.remove('bg-red')
                bankCodeSelection.classList.remove('bg-red')
                checkNumberInput.classList.remove('bg-red')
                checkNumberInput.value = '';
            }).catch(err => {

                console.log(err.message);

                bankNameSelection.classList.add('bg-red')
                bankCodeSelection.classList.add('bg-red')
                checkNumberInput.classList.add('bg-red')
            })
        }

        function updateAttachment(target) {

            const formData = new FormData();

            formData.append('attachment', target.value);

            fetch('/expense/api/expense-request/attachment/{{$request->id}}', {
                method: 'POST',
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                }
            }).then(response => {

                if (!response.ok) {
                    throw new Error("Something went wrong!");
                }

                return response.json();

            }).then(data => {

                console.log(data.message);

                bankNameSelection.classList.remove('bg-red')
                bankCodeSelection.classList.remove('bg-red')
                checkNumberInput.classList.remove('bg-red')
                checkNumberInput.value = '';
            }).catch(err => {

                console.log(err.message);

                bankNameSelection.classList.add('bg-red')
                bankCodeSelection.classList.add('bg-red')
                checkNumberInput.classList.add('bg-red')
            })
        }

        function removeAttachment(target) {

            const formData = new FormData();
            formData.append('attachment', '{{\App\Enums\AccountingAttachment::DEFAULT->name}}');

            fetch('/expense/api/expense-request/attachment/{{$request->id}}', {
                method: 'POST',
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                }
            }).then(response => {

                if (!response.ok) {
                    throw new Error("Something went wrong!");
                }

                return response.json();

            }).then(data => {

                console.log(data);

                bankNameSelection.classList.remove('bg-red')
                bankCodeSelection.classList.remove('bg-red')
                checkNumberInput.classList.remove('bg-red')
                checkNumberInput.value = '';
            }).catch(err => {

                console.log(err.message);

                bankNameSelection.classList.add('bg-red')
                bankCodeSelection.classList.add('bg-red')
                checkNumberInput.classList.add('bg-red')
            })
        }

        function updateType(target) {

            const formData = new FormData();

            formData.append('type', target.value);

            fetch('/expense/api/expense-request/type/{{$request->id}}', {
                method: 'POST',
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                }
            }).then(response => {

                if (!response.ok) {
                    throw new Error("Something went wrong!");
                }

                return response.json();

            }).then(data => {

                console.log(data.message);

                bankNameSelection.classList.remove('bg-red')
                bankCodeSelection.classList.remove('bg-red')
                checkNumberInput.classList.remove('bg-red')
                checkNumberInput.value = '';
            }).catch(err => {

                console.log(err.message);

                bankNameSelection.classList.add('bg-red')
                bankCodeSelection.classList.add('bg-red')
                checkNumberInput.classList.add('bg-red')
            })
        }

        function removeType(target) {

            const formData = new FormData();
            formData.append('type', '{{\App\Enums\AccountingType::DEFAULT->name}}');

            fetch('/expense/api/expense-request/type/{{$request->id}}', {
                method: 'POST',
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                }
            }).then(response => {

                if (!response.ok) {
                    throw new Error("Something went wrong!");
                }

                return response.json();

            }).then(data => {

                console.log(data);

                bankNameSelection.classList.remove('bg-red')
                bankCodeSelection.classList.remove('bg-red')
                checkNumberInput.classList.remove('bg-red')
                checkNumberInput.value = '';
            }).catch(err => {

                console.log(err.message);

                bankNameSelection.classList.add('bg-red')
                bankCodeSelection.classList.add('bg-red')
                checkNumberInput.classList.add('bg-red')
            })
        }

        function updateReceipt(target) {

            const formData = new FormData();

            formData.append('receipt', target.value);

            fetch('/expense/api/expense-request/receipt/{{$request->id}}', {
                method: 'POST',
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                }
            }).then(response => {

                // if (!response.ok) {
                //     throw new Error("Something went wrong!");
                // }

                return response.json();

            }).then(data => {

                console.log(data.message);

                bankNameSelection.classList.remove('bg-red')
                bankCodeSelection.classList.remove('bg-red')
                checkNumberInput.classList.remove('bg-red')
                checkNumberInput.value = '';
            }).catch(err => {

                console.log(err.message);

                bankNameSelection.classList.add('bg-red')
                bankCodeSelection.classList.add('bg-red')
                checkNumberInput.classList.add('bg-red')
            })
        }

        function removeReceipt(target) {

            const formData = new FormData();
            formData.append('receipt', '{{\App\Enums\AccountingReceipt::DEFAULT->name}}');

            fetch('/expense/api/expense-request/receipt/{{$request->id}}', {
                method: 'POST',
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                }
            }).then(response => {

                if (!response.ok) {
                    throw new Error("Something went wrong!");
                }

                return response.json();

            }).then(data => {

                console.log(data);

                bankNameSelection.classList.remove('bg-red')
                bankCodeSelection.classList.remove('bg-red')
                checkNumberInput.classList.remove('bg-red')
                checkNumberInput.value = '';
            }).catch(err => {

                console.log(err.message);

                bankNameSelection.classList.add('bg-red')
                bankCodeSelection.classList.add('bg-red')
                checkNumberInput.classList.add('bg-red')
            })
        }

        function updatePriorityLevel(target) {

            const formData = new FormData();

            formData.append('priority_level', target.value);

            fetch('/expense/api/expense-request/priority-level/{{$request->id}}', {
                method: 'POST',
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                }
            }).then(response => {

                if (!response.ok) {
                    throw new Error("Something went wrong!");
                }

                return response.json();

            }).then(data => {

                console.log(data.message);

                bankNameSelection.classList.remove('bg-red')
                bankCodeSelection.classList.remove('bg-red')
                checkNumberInput.classList.remove('bg-red')
                checkNumberInput.value = '';
            }).catch(err => {

                console.log(err.message);

                bankNameSelection.classList.add('bg-red')
                bankCodeSelection.classList.add('bg-red')
                checkNumberInput.classList.add('bg-red')
            })
        }

        function removePriorityLevel(target) {

            const formData = new FormData();
            formData.append('priority_level', '{{\App\Enums\RequestPriorityLevel::NONE->name}}');

            fetch('/expense/api/expense-request/priority-level/{{$request->id}}', {
                method: 'POST',
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                }
            }).then(response => {

                if (!response.ok) {
                    throw new Error("Something went wrong!");
                }

                return response.json();

            }).then(data => {

                console.log(data);

                bankNameSelection.classList.remove('bg-red')
                bankCodeSelection.classList.remove('bg-red')
                checkNumberInput.classList.remove('bg-red')
                checkNumberInput.value = '';
            }).catch(err => {

                console.log(err.message);

                bankNameSelection.classList.add('bg-red')
                bankCodeSelection.classList.add('bg-red')
                checkNumberInput.classList.add('bg-red')
            })
        }

    </script>
@endsection
