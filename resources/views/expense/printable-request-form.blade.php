@extends('layouts.expense-index')


@section('files')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
            integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.6/viewer.js"
            integrity="sha512-MdZwHb4u4qCy6kVoTLL8JxgPnARtbNCUIjTCihWcgWhCsLfDaQJib4+OV0O8IS+ea+3Xv/6pH3vYY4LWpU/gbQ=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/viewerjs/1.11.6/viewer.css"
          integrity="sha512-eG8C/4QWvW9MQKJNw2Xzr0KW7IcfBSxljko82RuSs613uOAg/jHEeuez4dfFgto1u6SRI/nXmTr9YPCjs1ozBg=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
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

    @if($errors->any())

        @dd($errors)
{{--        <h4>{{$errors->first()}}</h4>--}}
    @endif

    <div class="row m-0">

        <div class="col">
            <div class="bg-light p-2">
                <button class="btn btn-success" onclick="generatePDF()">
                    <i class="fas fa-download"></i>
                    Download
                </button>
                <button onclick="viewHistory()" class="btn btn-secondary">
                    <i class="fas fa-scroll"></i>
                    View Logs
                </button>
                <button class="btn btn-secondary" id="check_writer">
                    <i class="fas fa-plus-circle me-2"></i>Check Writer
                    <input type="hidden" id="hidden_paid_to" value=" {{$request->paid_to}}">
                    <input type="hidden" id="hidden_amount" value="{{$request->approvedItems->sum('total_cost')}}">
                </button>
            </div>

            <div class="container-fluid mx-auto bg-white">
                <div class="mx-auto px-4 py-2" id="printable">

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
                             class="m-0 ms-2 px-5 border border-5 border-danger">
                            <select id="requestStatus" class="w-100 h-100 border-0 outline-0 text-danger text-center">
                                @foreach(\App\Enums\RequestStatus::cases() as $status)
                                    @if($status == $request->status)
                                        <option style="font-size: 20px" value="{{$status->name}}"
                                                selected>{{$status->value}}</option>
                                    @else
                                        <option style="font-size: 20px"
                                                value="{{$status->name}}">{{$status->value}}</option>
                                    @endif
                                @endforeach
                            </select>
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
                                        <input
                                            @checked($request->fund_status == \App\Enums\RequestFundStatus::FUNDED )  value="{{\App\Enums\RequestFundStatus::FUNDED->value}}"
                                            class="fundStatus" type="checkbox" name="FUNDED">
                                    </div>
                                    <div class="w-75 text-start border border-dark px-2"
                                         style="border-style: none none solid none !important;">
                                        <small>FUNDED</small>
                                    </div>
                                </div>

                                <div class="w-100" style="display: flex; flex-direction: row;">
                                    <div class="w-25 text-center border border-dark"
                                         style="border-style: none solid none none !important;">
                                        <input
                                            @checked($request->fund_status == \App\Enums\RequestFundStatus::DECLINED ) value="{{\App\Enums\RequestFundStatus::DECLINED->value}}"
                                            class="fundStatus" type="checkbox" name="FUNDED">
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

                    <div class="mb-2 btn-group rounded w-100" role="group" aria-label="Basic outlined example">
                        <a href="/expense/prev-request/{{$request->id}}" role="button" class="btn btn-outline-dark">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        <button type="button" class="btn btn-outline-dark"
                                style="flex-basis:60%">{{$request->reference}}</button>
                        <a href="/expense/next-request/{{$request->id}}" role="button" class="btn btn-outline-dark">
                            <i class="fas fa-arrow-right"></i>
                        </a>
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
                            <tr class="selectable" role="button" onclick="viewItem('{{$item->id}}')">
                                <td colspan="2"
                                    class="small px-2 bg-transparent text-transparent">{{$item->quantity}}</td>
                                <td colspan="3" class="small px-2 bg-transparent">{{$item->measurement->name}}</td>
                                <td colspan="2" class="small px-2 bg-transparent">{{$item->jobOrder->name}}</td>
                                <td colspan="2" class="small bg-transparent">
                                    <div class="d-flex align-items-center bg-transparent">
                                        <p class="m-0 p-0 text-ellipsis"
                                           style="max-width: 45ch">{{$item->description}}</p>
                                        <i class="ms-auto fas fa-images"></i>
                                    </div>
                                </td>
                                <td colspan="2"
                                    class="small px-2 bg-transparent">{!! \App\Helper\Helper::formatPeso($item->cost) !!}</td>
                                <td colspan="2"
                                    class="small px-2 bg-transparent">{!! \App\Helper\Helper::formatPeso($item->total_cost) !!}</td>
                                <td colspan="3" class="small px-2 bg-transparent">{{$item->status}}</td>
                                <td colspan="2" class="small px-2 bg-transparent">{{$item->remarks}}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="9" class="px-2 small text-end fw-bold bg-gray text-uppercase">TOTAL</td>
                            <td colspan="4"
                                class="px-2 small text-end">{!! \App\Helper\Helper::formatPeso($request->total) !!}</td>
                            <td colspan="5"
                                class="px-2 small text-center fw-bold bg-gray text-uppercase">{!! \App\Helper\Helper::formatPeso($request->approvedItems->sum('total_cost')) !!}</td>
                            
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

                                    @if(\App\Enums\PaymentMethod::NONE == $request->payment_method)
                                        <option selected disabled></option>
                                    @endif

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
                            <td colspan="1" class="small bg-yellow text-center fw-bold" style="width: 179px">JOB ORDER
                            </td>
                            <td colspan="3" class="small bg-yellow text-center fw-bold" style="width: 179px">
                                DESCRIPTION
                            </td>
                            <td colspan="3" class="small bg-yellow text-center fw-bold" style="width: 179px">UNIT COST
                            </td>
                            <td colspan="3" class="small bg-yellow text-center fw-bold" style="width: 179px">TOTAL</td>
                        </tr>

                        @foreach ($request->approvedItems as $item)
                            <tr>
                                <td colspan="4" class="small px-2 bg-transparent">{{$item->quantity}}</td>
                                <td colspan="4" class="small px-2 bg-transparent">{{$item->measurement->name}}</td>
                                <td colspan="1" class="small px-2 bg-transparent">{{$item->jobOrder->name}}</td>
                                <td colspan="3" class="small px-2 pointer" style="max-width: 45ch">
                                    <p class="m-0 p-0 text-truncate">{{$item->description}}</p>
                                </td>
                                <td colspan="3"
                                    class="small px-2 bg-transparent">{!! \App\Helper\Helper::formatPeso($item->cost) !!}</td>
                                <td colspan="3"
                                    class="small px-2 bg-transparent">{!! \App\Helper\Helper::formatPeso($item->total_cost) !!}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="15" class="px-2 small bg-yellow text-end fw-bold">TOTAL</td>
                            <td colspan="3"
                                class="px-2 small bg-yellow text-center fw-bold">{!! \App\Helper\Helper::formatPeso($request->approvedItems->sum('total_cost')) !!}</td>
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
                                    {!! \App\Helper\Helper::formatPeso($request->approvedItems->sum('total_cost')) !!}
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
                                    {!! \App\Helper\Helper::amountToWords($request->approvedItems->sum('total_cost')) !!}
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
                                <input readonly value="MR. RYLAN C. ALINGAROG"
                                       class="border-0 outline-0 w-100 small fw-bold text-uppercase text-center">

                            </td>
                            <td colspan="4" class="text-center align-bottom fw-bold small" style="height: 24px">
                                <input class="border-0 outline-0 w-100 small fw-bold text-uppercase text-center">
                            </td>
                            <td colspan="6" class="text-center align-bottom fw-bold small" style="height: 24px">
                                <input class="border-0 outline-0 w-100 small fw-bold text-uppercase text-center">
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
                                    <form id="bookerKeeperForm" method="POST"
                                          action="/expense/expense-request/book-keeper/approval/{{$request->id}}">
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
                                    <input class="priorityLevel"
                                           value="{{App\Enums\RequestPriorityLevel::MEDIUM->name}}"
                                           type="checkbox" name="MEDIUM" checked>
                                @else
                                    <input class="priorityLevel"
                                           value="{{App\Enums\RequestPriorityLevel::MEDIUM->name}}"
                                           type="checkbox" name="MEDIUM">
                                @endif
                            </td>
                            <td colspan="2" class="small px-2">Medium</td>
                            <td colspan="1" class="small px-2">3 days</td>
                            <td colspan="1" class="text-center">
                                <input type="checkbox">
                            </td>
                            <td colspan="3" class="small px-2">
                                <select data-index="2" name="expenseCategory[]" class="w-100 border-0 outline-0">
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
                                <select data-index="3" name="expenseCategory[]" class="w-100 border-0 outline-0">
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
                                <select data-index="4" name="expenseCategory[]" class="w-100 border-0 outline-0">
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
                                    <form id="accountantForm" method="POST"
                                          action="/expense/expense-request/accountant/approval/{{$request->id}}">
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
                                <select data-index="5" name="expenseCategory[]" class="w-100 border-0 outline-0">
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
                                <select data-index="6" name="expenseCategory[]" class="w-100 border-0 outline-0">
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
                                <select data-index="7" name="expenseCategory[]" class="w-100 border-0 outline-0">
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
                                    <input value="{{$request->vat->option_a}}" type="text" id="vatOption1"
                                           class="h-100 w-100 border-0 outline-0">
                                @else
                                    <input type="text" id="vatOption1" class="h-100 w-100 border-0 outline-0">
                                @endif
                            </td>
                            <td colspan="5" class="small px-2">
                                <form id="financeForm" method="POST"
                                      action="/expense/expense-request/finance/approval/{{$request->id}}">
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
                                <select data-index="8" name="expenseCategory[]" class="w-100 border-0 outline-0">
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
                                    <input value="{{$request->vat->option_b}}" type="text" id="vatOption2"
                                           class="h-100 w-100 border-0 outline-0">
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
                                <select data-index="9" name="expenseCategory[]" class="w-100 border-0 outline-0">
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
                                    <input value="{{$request->vat->purchase_order}}" id="purchaseOrderInput"
                                           class="w-100 border-0 outline-0">
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
                                <select data-index="10" name="expenseCategory[]" class="w-100 border-0 outline-0">
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
                                    <input value="{{$request->vat->invoice}}" id="invoiceNumberInput"
                                           class="w-100 border-0 outline-0">
                                @else
                                    <input id="invoiceNumberInput" class="w-100 border-0 outline-0">
                                @endif
                            </td>
                            <td colspan="5" class="small px-2">
                                <form id="auditorForm" method="POST"
                                      action="/expense/expense-request/auditor/approval/{{$request->id}}">
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
                                <select data-index="11" name="expenseCategory[]" class="w-100 border-0 outline-0">
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
                                    <input value="{{$request->vat->bill}}" id="billNumberInput"
                                           class="w-100 border-0 outline-0">
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
                                <select data-index="12" name="expenseCategory[]"
                                        class="bg-transparent w-100 border-0 outline-0">
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
                                    <input value="{{$request->vat->official_receipt}}" id="orNumberInput"
                                           class="w-100 border-0 outline-0">
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
                                    <input value="{{\App\Enums\AccountingReceipt::NONE->name}}"
                                           class="attachmentReceipt"
                                           type="checkbox" checked>
                                @else
                                    <input value="{{\App\Enums\AccountingReceipt::NONE->name}}"
                                           class="attachmentReceipt"
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
                                    <input
                                        class="small w-100 outline-0 border-1 border-top-0 border-start-0 border-end-0">
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

                <!-- COMMENTS -->

                <div class="row m-0 mt-3 py-4 px-2 bg-white w-100" id="comment">
                    <div class="container px-4">
                        <div class="row border border-dark text-start"
                             style="display: flex; flex-direction: column; height: 600px;">
                            <div
                                class="overflow-y-auto d-flex flex-column justify-content-end bg-dark text-center text-white py-2">
                                COMMENT SECTION
                            </div>
                            <div class="p-2" style="overflow-x:hidden; overflow-y:auto; flex: 1;" id="commentsHolder">
                                <!-- COMMENTS ARE GENERATED HERE! -->
                            </div>
                            <div class="p-0">
                                <form id="commentForm">
                                    <div class="comment-area">
                                        <div class="bg-dark"
                                             style="display: flex; justify-content: center; align-items: center; flex-direction: row; margin: 0; padding: 0;">
                                            <div class="w-100 p-1">
                                            <textarea class="form-control rounded-pill"
                                                      placeholder="Type your message here."
                                                      rows="1" name="message" required=""></textarea>
                                            </div>
                                            <div class="w-50 p-1 d-flex align-items-center">
                                                <button type="submit"
                                                        class="btn btn-sm btn-danger py-1 w-100 rounded-pill">Send
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="requestHistory" class="d-none col-2 d-flex flex-column align-items-stretch flex-shrink-0 bg-white" style="width: 380px; transition: 0.5s linear !important;">
            <a href="/"
               class="d-flex align-items-center flex-shrink-0 p-3 link-dark text-decoration-none border-bottom">
                <svg class="bi me-2" width="30" height="24">
                    <use xlink:href="#bootstrap"></use>
                </svg>
                <span class="fs-5 fw-semibold">Logs</span>
            </a>
            <div class="list-group list-group-flush border-bottom scrollarea">
                @foreach($logs as $log)
                    <a href="#" class="list-group-item list-group-item-action py-3 lh-tight">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                            <strong class="mb-1">{{$log->user->name}}</strong>
                            <small class="text-muted">{{$log->created_at->format('Y-m-d h:m A')}}</small>
                        </div>
                        <div class="col-10 mb-1 small">{{$log->description}}</div>
                    </a>
                @endforeach
            </div>
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
    <div class="modal fade" id="editItemModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="POST" id="editItemForm" class="container-fluid">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Item</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <input id="editItemId" type="hidden" class="d-none">

                        <div class="col-12">
                            <div class="row">
                                <div class="col-2 text-center border border-dark"
                                     style="border-style: solid none none solid !important; background: rgba(0, 0, 0, 0.2); word-wrap: break-word;">
                                    <b>QTY</b>
                                </div>
                                <div class="col-2 text-center border border-dark"
                                     style="border-style: solid none none solid !important; background: rgba(0, 0, 0, 0.2); word-wrap: break-word;">
                                    <b>UOM</b>
                                </div>
                                <div class="col-2 text-center border border-dark"
                                     style="border-style: solid none none solid !important; background: rgba(0, 0, 0, 0.2); word-wrap: break-word;">
                                    <b>JOB ORDER</b>
                                </div>
                                <div class="col-2 text-center border border-dark"
                                     style="border-style: solid none none solid !important; background: rgba(0, 0, 0, 0.2); word-wrap: break-word;">
                                    <b>DESCRIPTION</b>
                                </div>
                                <div class="col-2 text-center border border-dark"
                                     style="border-style: solid none none solid !important; background: rgba(0, 0, 0, 0.2); word-wrap: break-word;">
                                    <b>UNIT COST</b>
                                </div>
                                <div class="col-2 text-center border border-dark"
                                     style="border-style: solid solid none solid !important; background: rgba(0, 0, 0, 0.2); word-wrap: break-word;">
                                    <b>TOTAL</b>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-2 m-0 p-0 small border-0">
                                    <input id="editItemQuantity" type="text" class="p-2 h-100 w-100" name="quantity">
                                </div>
                                <div class="col-2 m-0 p-0 small border-0">
                                    <select name="measurement" id="editItemUnitOfMeasurement" class="p-2 h-100 w-100">
                                        @foreach($measurements as $measurement)
                                            <option value="{{$measurement->id}}">{{$measurement->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-2 m-0 p-0 small border-0">
                                    <select name="jobOrder" id="editItemJobOrder" class="p-2 h-100 w-100">
                                        @foreach($jobOrders as $jobOrder)
                                            <option value="{{$jobOrder->id}}">{{$jobOrder->reference}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-2 m-0 p-0 small border-0">
                                    <input name="description" id="editItemDescription" type="text"
                                           class="p-2 h-100 w-100">
                                </div>
                                <div class="col-2 small border-0 m-0 p-0">
                                    <input name="cost" id="editItemCost" type="text" class="p-2 h-100 w-100">
                                </div>
                                <div class="col-2 small border-0 m-0 p-0">
                                    <input id="editItemTotal" type="text" class="p-2 h-100 w-100" name="total">
                                </div>
                            </div>

                            <div class="row mt-3 py-3 px-2 border border-dark">
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <input data-id="0" id="fileUpload" type="file" accept="image/*" multiple=""
                                           name="files[]" class="px-4 py-2 border border-dark w-100"
                                           style="border: 1px dashed !important; border-radius: 6px;">
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-6 p-2 border border-dark"
                                     style="display: flex; flex-direction: row; align-items: flex-start; gap: 5px; overflow: auto;"
                                     id="uploads">
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-4 text-center border border-dark"
                                     style="border-style: solid none none solid !important; background: rgba(0, 0, 0, 0.2); word-wrap: break-word;">
                                    <b>CURRENT STATUS</b>
                                </div>
                                <div class="col-4 text-center border border-dark"
                                     style="border-style: solid none none solid !important; background: rgba(0, 0, 0, 0.2); word-wrap: break-word;">
                                    <b>STATUS</b>
                                </div>
                                <div class="col-4 text-center border border-dark"
                                     style="border-style: solid solid none solid !important; background: rgba(0, 0, 0, 0.2); word-wrap: break-word;">
                                    <b>REMARKS</b>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4 text-center border border-dark"
                                     style="border-style: solid none solid solid !important; word-wrap: break-word; display: flex; align-items: center; justify-content: center;">
                                    <small> Pending</small>
                                </div>
                                <div class="col-4 text-center border border-dark small "
                                     style="border-style: solid none solid solid !important; word-wrap: break-word; display: flex; align-items: center; justify-content: center;">
                                    <select id="editItemStatus" class="p-2" name="status">
                                        @foreach(App\Enums\RequestItemStatus::status() as $requestStatus)
                                            <option value="{{$requestStatus->name}}">{{$requestStatus->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-4 text-center p-0" style="word-wrap: break-word;">
                                    <textarea id="editItemRemarks" rows="5" placeholder="Type here..."
                                              style="resize: none;" class="p-2 w-100 h-100 small"
                                              name="remarks"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection


@section('script')
    <script>

        const editItemModal = new bootstrap.Modal(document.getElementById('editItemModal'), {
            keyboard: false
        })


        const viewer = new Viewer(document.getElementById('uploads'));

        const fileUpload = document.querySelector('#fileUpload');

        const editItemForm = document.querySelector('#editItemForm');
        const editItemId = document.querySelector('#editItemId');
        const editItemQuantity = document.querySelector('#editItemQuantity');
        const editItemDescription = document.querySelector('#editItemDescription');
        const editItemJobOrder = document.querySelector('#editItemJobOrder');
        const editItemUnitOfMeasurement = document.querySelector('#editItemUnitOfMeasurement');
        const editItemCost = document.querySelector('#editItemCost');
        const editItemTotal = document.querySelector('#editItemTotal');
        const editItemStatus = document.querySelector('#editItemStatus');
        const editItemRemarks = document.querySelector('#editItemRemarks');

        const toastErrorModal = new bootstrap.Toast(document.getElementById('errorToast'));
        const toastErrorBody = document.querySelector('.toast-body');

        const bankNameSelection = document.querySelector('#bankNameSelection');
        const bankCodeSelection = document.querySelector('#bankCodeSelection');
        const checkNumberInput = document.querySelector('#checkNumberInput');
        const requestPaymentMethodInput = document.querySelector('#paymentMethodInput');

        const expenseCategoryInput = document.querySelectorAll('select[name="expenseCategory[]"]');

        const selectedExpensesCategory = [];

        const bookerKeeperStatus = document.querySelector('#bookerKeeperStatus');
        const bookerKeeperForm = document.querySelector('#bookerKeeperForm');

        const accountantStatus = document.querySelector('#accountantStatus');
        const accountantForm = document.querySelector('#accountantForm');

        const financeStatus = document.querySelector('#financeStatus');
        const financeForm = document.querySelector('#financeForm');

        const auditorStatus = document.querySelector('#auditorStatus');
        const auditorForm = document.querySelector('#auditorForm');

        const purchaseOrderInput = document.querySelector('#purchaseOrderInput');
        const invoiceNumberInput = document.querySelector('#invoiceNumberInput');
        const billNumberInput = document.querySelector('#billNumberInput');
        const orNumberInput = document.querySelector('#orNumberInput');

        const vatOptionA = document.querySelector('#vatOption1');
        const vatOptionB = document.querySelector('#vatOption2');

        const requestStatus = document.querySelector('#requestStatus');

        const commentForm = document.querySelector('#commentForm');
        const commentHolder = document.querySelector('#commentsHolder');
        let initialLoad = true;

        purchaseOrderInput.addEventListener('change', () => {

            let formData = new FormData();

            formData.append('purchaseOrder', purchaseOrderInput.value);

            fetch('/expense/expense-request/expense/vat/purchase-order/{{$request->id}}', {
                method: 'POST',
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                }
            }).then(response => {
                return response.json();
            }).then(data => {
                if (data.status !== 200) {
                    throw new Error(data.message)
                }
            }).catch(err => {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: err.message,
                });
            });
        })

        invoiceNumberInput.addEventListener('change', () => {

            let formData = new FormData();

            formData.append('invoice', invoiceNumberInput.value);

            fetch('/expense/expense-request/expense/vat/invoice/{{$request->id}}', {
                method: 'POST',
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                }
            }).then(response => {
                return response.json();
            }).then(data => {
                if (data.status !== 200) {
                    throw new Error(data.message)
                }
            }).catch(err => {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: err.message,
                });
            });
        })

        billNumberInput.addEventListener('change', () => {

            let formData = new FormData();

            formData.append('bill', billNumberInput.value);

            fetch('/expense/expense-request/expense/vat/bill/{{$request->id}}', {
                method: 'POST',
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                }
            }).then(response => {
                return response.json();
            }).then(data => {
                if (data.status !== 200) {
                    throw new Error(data.message)
                }
            }).catch(err => {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: err.message,
                });
            });
        })

        orNumberInput.addEventListener('change', () => {

            let formData = new FormData();

            formData.append('receipt', orNumberInput.value);

            fetch('/expense/expense-request/expense/vat/official-receipt/{{$request->id}}', {
                method: 'POST',
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                }
            }).then(response => {
                return response.json();
            }).then(data => {
                if (data.status !== 200) {
                    throw new Error(data.message)
                }
            }).catch(err => {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: err.message,
                });
            });
        })

        vatOptionA.addEventListener('change', () => {

            let formData = new FormData();

            formData.append('option', vatOptionA.value);

            fetch('/expense/expense-request/expense/vat/option-a/{{$request->id}}', {
                method: 'POST',
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                }
            }).then(response => {
                return response.json();
            }).then(data => {
                if (data.status !== 200) {
                    throw new Error(data.message)
                }
            }).catch(err => {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: err.message,
                });
            });
        })

        vatOptionB.addEventListener('change', () => {

            let formData = new FormData();

            formData.append('option', vatOptionB.value);

            fetch('/expense/expense-request/expense/vat/option-b/{{$request->id}}', {
                method: 'POST',
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                }
            }).then(response => {
                return response.json();
            }).then(data => {
                if (data.status !== 200) {
                    throw new Error(data.message)
                }
            }).catch(err => {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: err.message,
                });
            });
        })

        if (bookerKeeperStatus) {
            bookerKeeperStatus.addEventListener('change', () => {
                bookerKeeperForm.submit();
            })
        }

        if (accountantStatus) {
            accountantStatus.addEventListener('change', () => {
                accountantForm.submit();
            })
        }

        financeStatus.addEventListener('change', () => {
            financeForm.submit();
        })

        auditorStatus.addEventListener('change', () => {
            auditorForm.submit();
        })

        expenseCategoryInput.forEach((category, index) => {

            if (category.value) {
                selectedExpensesCategory[index] = category.value;
            }

            category.addEventListener('input', async () => {

                selectedExpensesCategory[index] = category.value;

                const formData = new FormData();

                selectedExpensesCategory.forEach(category => {
                    formData.append('category[]', category);
                })

                fetch('/expense/api/expense-request/expense-type/{{$request->id}}', {
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

            });

        })

        bankNameSelection.addEventListener('change', updateBankDetails);
        bankCodeSelection.addEventListener('change', updateBankDetails);
        checkNumberInput.addEventListener('change', updateBankDetails);

        requestPaymentMethodInput.addEventListener('change', async () => {
            try {

                const formData = new FormData();
                formData.append('mode', requestPaymentMethodInput.value);

                const result = await fetch('/expense/api/expense-request/payment-method/{{$request->id}}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                    }
                });

                const data = await result.json();

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

                await generateVoucher();

            } catch (error) {

                console.error(error);

                // Swal.fire({
                //     icon: "error",
                //     title: "Oops...",
                //     text: error.message,
                // });
            }
        })

        commentForm.addEventListener('submit', async (e) => {

            e.preventDefault();

            const formData = new FormData(commentForm);

            try {

                commentForm.reset();

                const result = await fetch('/expense/expense-request/comment/{{$request->id}}', {
                    body: formData,
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                    }
                })

                if (!result.ok) {
                    throw new Error('Message not sent!');
                }

                initialLoad = true;

            } catch (error) {
                console.error(error)
            }
        })

        async function generateVoucher() {
            try {

                const result = await fetch('/expense/api/request/voucher/{{$request->id}}', {
                    method: 'POST',
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                    }
                });

                const data = await result.json();

                console.log(data);

                if (!result.ok) {
                    throw new Error('something went wrong');
                }

                Swal.fire({
                    title: "Voucher",
                    html: "Generating Voucher",
                    timer: 1000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading();
                    },
                    willClose: () => {
                        location.reload()
                    }
                }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        console.log("I was closed by the timer");
                    }
                });


            } catch (error) {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: error.message,
                });
            }
        }

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
        groupCheck('fundStatus', updateFundStatus, removeFundStatus);

        requestStatus.addEventListener('change', async () => {

            try {

                const formData = new FormData();

                formData.append('status', requestStatus.value);

                const result = await fetch(`/expense/api/request/status/{{$request->id}}`, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                    }
                });

                const data = await result.json();

                if (!result.ok) {
                    throw new Error(data.message);
                }

                console.info(data);
            } catch (error) {
                console.error(error)
            }
        })

        async function viewItem(id) {

            try {
                const result = await fetch(`/expense/api/request-item/${id}`);

                const response = await result.json();

                const data = response.item;


                if (!result.ok) {
                    throw new Error(data.message);
                }


                fileUpload.setAttribute("data-id", id);

                editItemForm.action = `/expense/api/request-item/update/${data.id}`;

                editItemQuantity.value = data.quantity;
                editItemDescription.value = data.description;
                editItemJobOrder.value = data.job_order_id;
                editItemUnitOfMeasurement.value = data.measurement_id;
                editItemCost.value = data.cost;
                editItemTotal.value = data.total;
                editItemStatus.value = data.status;
                editItemRemarks.value = data.remarks;

                $('#uploads').html('');


                data.attachments.forEach(attachment => {

                    let imageSrc = (attachment.file.split('/'))[1];

                    const thumbnail = $('<img>').attr('src', '/storage/' + imageSrc).addClass('uploaded-img');

                    $('#uploads').append(thumbnail);


                });

                editItemModal.show();

                viewer.update();

                console.info(response);

            } catch (error) {
                console.error(error)
            }

        }

        function updateBankDetails() {

            if (parseInt(bankNameSelection.value) === -1 && parseInt(bankCodeSelection.value) === -1) {
                deleteBankDetails();
                return;
            }

            let formData = new FormData();

            formData.append('bankName', bankNameSelection.value);
            formData.append('bankNumber', bankCodeSelection.value);
            formData.append('checkNumber', checkNumberInput.value);
            formData.append('requestID', {{$request->id}});

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


        function updateFundStatus(target) {

            const formData = new FormData();

            formData.append('status', target.value);

            fetch('/expense/api/expense-request/fund-status/{{$request->id}}', {
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

        function removeFundStatus(target) {

            const formData = new FormData();

            formData.append('status', '{{\App\Enums\RequestFundStatus::NONE}}');


            fetch('/expense/api/expense-request/fund-status/{{$request->id}}', {
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

        function loadComments() {
            fetch('/expense/expense-request/comments/{{$request->id}}', {
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                }
            }).then(response => {

                if (!response.ok) {
                    throw new Error("Something went wrong!");
                }

                return response.text();

            }).then(data => {

                commentHolder.innerHTML = data;

                if (initialLoad) {
                    commentHolder.scrollTop = commentHolder.scrollHeight - commentHolder.clientHeight;
                    initialLoad = false;
                }

            }).catch(err => {

                console.log(err.message);

                bankNameSelection.classList.add('bg-red')
                bankCodeSelection.classList.add('bg-red')
                checkNumberInput.classList.add('bg-red')
            })
        }

        window.addEventListener('load', () => {

            loadComments();

            setInterval(loadComments, 1000);
        })

        const expenseRequestPrintable = document.getElementById('printable');

        const expenseRequestPrintableOption = {
            margin: 0,
            filename: '{{$request->reference}}.pdf',
            image: {type: 'jpeg', quality: 1},
            html2canvas: {scale: 2},
            jsPDF: {unit: 'in', format: 'A3', orientation: 'portrait'}
        };

        function generatePDF() {
            html2pdf().set(expenseRequestPrintableOption).from(expenseRequestPrintable).save();
        }


        fileUpload.addEventListener('change', async () => {

            let formData = new FormData();

            const files = fileUpload.files;
            const itemId = fileUpload.dataset.id;

            Array.from(files).forEach(file => {
                formData.append('files[]', file);
            });

            try {

                let result = await fetch(`/expense/api/request-item/file/${itemId}`, {
                    method: "POST",
                    body: formData,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                    }
                })

                if (!result.ok) {

                    let data = await result.json();

                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: 'An error occurred while uploading attachment',
                    });

                    console.log(data);

                    return;
                }

                let files = await result.json();

                files.images.forEach(attachment => {

                    let imageSrc = (attachment.split('/'))[1];

                    const thumbnail = $('<img>').attr('src', '/storage/' + imageSrc).addClass('uploaded-img');

                    $('#uploads').append(thumbnail);

                });

                console.log(files.images);

                viewer.update();

            } catch (error) {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: error.message,
                })

            } finally {
                fileUpload.value = null;
            }
        })
    </script>

    <script>
        document.getElementById('check_writer').addEventListener('click', function (event) {
            event.preventDefault();
            const date = new Date();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            const year = date.getFullYear().toString();
            const formattedDate = `${month.split('').join('   ')}     ${day.split('').join('   ')}     ${year.split('').join('   ')}`;

            var number = parseFloat($('#hidden_amount').val());
            var formattedNumber = number.toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }) + '***';

            const formattedPaidTo = '***' + $('#hidden_paid_to').val() + '***';

            const fileUrl = '/excel/Check Writer-2024.xlsx';
            fetch(fileUrl)
                .then(response => response.arrayBuffer())
                .then(async (data) => {
                    const workbook = new ExcelJS.Workbook();
                    await workbook.xlsx.load(data);
                    const worksheet = workbook.worksheets[0];

                    worksheet.getCell('C3').value = formattedPaidTo;
                    worksheet.getCell('C4').value = formattedNumber;
                    worksheet.getCell('C5').value = 'SAMPLE AMOUNT TO WORDS';
                    worksheet.getCell('C6').value = formattedDate;

                    const buffer = await workbook.xlsx.writeBuffer();
                    const blob = new Blob([buffer], { type: 'application/octet-stream' });

                    saveAs(blob, 'Check Writer-2024.xlsx');
                })
                .catch(error => console.error('Error fetching or processing the file:', error));
        });
    </script>

    <script>

        const historyHolder = document.querySelector('#requestHistory');

        function viewHistory(){
            historyHolder.classList.toggle('d-none')
        }

    </script>
@endsection
