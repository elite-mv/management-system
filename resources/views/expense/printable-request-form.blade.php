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

        .selectable > * {
            background-color: transparent;
        }


        .selectable > form > select {
            background-color: transparent;
        }

        select {
            cursor: pointer;
        }

        input[type=checkbox]:hover {
            cursor: pointer;
        }

        .uploaded-img {
            height: 100%;
            width: auto;
            object-fit: contain;
        }

    </style>
@endsection

@section('body')

    @if($errors->any())
        @if($errors->any())
            <div class="alert alert-danger" role="alert">
                {{$errors->first()}}
            </div>
        @endif
    @endif

    <div class="row m-0">

        <div class="col">
            <div class="bg-light p-2">
                {{-- <a type="button" href="/expense/pdf/request/{{$request->id}}" class="btn btn-success"> --}}
                <a type="button" onclick="alert('This is temporary unavailable, thank you.')" class="btn btn-success">
                    <i class="fas fa-download"></i>
                    Download
                </a>

                <button onclick="viewHistory()" class="btn btn-secondary">
                    <i class="fas fa-scroll"></i>
                    View Logs
                </button>

                @can('finance-president',auth()->user())
                    <a class="btn btn-secondary" type="button" href="/check-excel/{{$request->id}}">
                        <i class="fas fa-plus-circle me-2"></i>Check Writer
                    </a>
                @endcan
            </div>

            <div class="container-fluid mx-auto bg-white">
                <div class="mx-auto px-4 py-2" id="printable">

                    <div class="d-flex mb-4">
                        <div>
                            <div class="border border-dark"
                                 style="width: 100px; height: 100px; display: flex; align-items: center; justify-content: center;">
                                <img src="{{\Illuminate\Support\Facades\Storage::url($request->company->logo)}}"
                                     class="img-fluid" alt="FIXING"
                                     style="height: 100px; width: auto;">
                            </div>
                            <div class="bg-red text-center text-white border border-dark"
                                 style="width: 100px; border-style: none solid none solid !important;">
                                <strong>{{$request->company->name}}</strong>
                            </div>
                        </div>

                        <div style="font-size: 70px;"
                             class="m-0 ms-2 px-5 border border-5 border-danger">
                            @can('finance-president',auth()->user())

                                <select id="requestStatus"
                                        class="w-100 h-100 border-0 outline-0 text-danger text-center">
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
                            @else
                                <p class="w-100 h-100 border-0 outline-0 text-danger text-center">{{ $request->status}}</p>
                            @endif
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
                                            class="fundStatus" type="checkbox" name="FUNDED" id="fundedStatus">
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
                                            class="fundStatus" type="checkbox" name="FUNDED" id="declinedStatus">
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
                                <h1 class="text-danger">{{$request->requestStatus}}</h1>
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
                            <td colspan="8" class="small px-2">{{$request->created_at->format('Y-m-d H:i')}}</td>
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
                                @can('managing-role')
                                    <small>{{$request->supplier}}</small>
                                @else
                                    <small>[HIDDEN]</small>
                                @endcan
                            </td>
                            <td colspan="2" class="small px-2">REF NO:</td>
                            <td colspan="4" class="small px-2">{{ $request->reference }}</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="small px-2">Paid to:</td>
                            <td colspan="14" class="small px-2 text-capitalize">
                                @can('managing-role')
                                    <small>{{$request->paid_to}}</small>
                                @else
                                    <small>[HIDDEN]</small>
                                @endcan
                            </td>
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
                                <td colspan="2" class="small px-2 bg-transparent">{{$item->jobOrder->reference}}</td>
                                <td colspan="2" class="small bg-transparent">
                                    <div class="d-flex align-items-center bg-transparent px-2">
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
                                @can('managing-role')
                                    <input id="supplierInput" value="{{$request->supplier}}" class="border-0 outline-0 w-100 small  text-capitalize">
                                @else
                                    <small>[HIDDEN]</small>
                                @endcan
                            </td>
                            <td colspan="3" class="px-2 small bg-gray">Payment Type</td>
                            <td colspan="6" class="px-2 small">
                                <select id="paymentMethodInput" class="w-100 border-0 outline-0 ">

                                    @if(\App\Enums\PaymentMethod::NONE == $request->payment_method)
                                        <option selected disabled>SELECT AN OPTION</option>
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
                            <td colspan="4" class="px-2 small bg-gray">Paid to</td>
                            <td colspan="5" class="px-2 small">
                                @can('managing-role')
                                    <input id="paidToInput" value="{{$request->paid_to}}" class="border-0 outline-0 w-100 small  text-capitalize">
                                @else
                                    <small>[HIDDEN]</small>
                                @endcan
                            </td>
                            <td colspan="3" class="px-2 small bg-gray">Terms</td>
                            <td colspan="6" class="px-2 small">
                                @if($request->terms)
                                    <input id="termsInput" value="{{$request->terms}}" class="border-0 outline-0 w-100 small text-capitalize">
                                @else
                                    <input id="termsInput" class="border-0 outline-0 w-100 small text-capitalize">
                                @endif
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
                                <td colspan="1" class="small px-2 bg-transparent">{{$item->jobOrder->reference}}</td>
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
                                    @can('managing-role')
                                        <small>{{$request->supplier}}</small>
                                    @else
                                        <small>[HIDDEN]</small>
                                    @endcan
                                @endif
                            </td>
                            <td colspan="3" class="px-2 small fw-bold bg-gray">Date:</td>
                            <td colspan="6" class="px-2 small">
                                @if(isset($request->checkVoucher))
                                    {{ $request->checkVoucher->created_at->format('Y-m-d H:i') }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4" class="px-2 small fw-bold bg-gray">Paid to:</td>
                            <td colspan="5" class="px-2 small">
                                @if(isset($request->checkVoucher))
                                    @can('managing-role')
                                        <small>{{$request->paid_to}}</small>
                                    @else
                                        <small>[HIDDEN]</small>
                                    @endcan
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
                                <input readonly value="{{$request->released_by}}"
                                       class="border-0 outline-0 w-100 small fw-bold text-uppercase text-center">

                            </td>
                            <td colspan="4" class="text-center align-bottom fw-bold small" style="height: 24px">
                                <input value="{{$request->received_by}}" id="receivedBy"
                                       class="border-0 outline-0 w-100 small fw-bold text-uppercase text-center">
                            </td>
                            <td colspan="6" class="text-center align-bottom fw-bold small" style="height: 24px">
                                <input value="{{$request->audited_by}}" id="auditedBy"
                                       class="border-0 outline-0 w-100 small fw-bold text-uppercase text-center">
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
                            <td colspan="3" class="small px-2 selectable" style="width: 146px">
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
                                        <option
                                            @selected($request->bankDetails && $request->bankDetails->bank_name_id == $bankName->id) class="text-dark"
                                            value="{{$bankName->id}}">{{$bankName->name}}</option>
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
                            <td colspan="5" class="px-2 small selectable">

                                @if($request->priority)
                                    Priority
                                @else
                                    @can('book-keeper',auth()->user())
                                        <form id="bookerKeeperForm" method="POST"
                                              action="/expense/expense-request/book-keeper/approval/{{$request->id}}">
                                            @csrf
                                            <select id="bookerKeeperStatus" name="status"
                                                    class="border-0 outline-0 w-100">
                                                @foreach(\App\Enums\RequestApprovalStatus::status() as $case)
                                                    @if($request->bookKeeper && $request->bookKeeper->status == $case)
                                                        <option value="{{$case->name}}"
                                                                selected>{{$case->name}}</option>
                                                    @else
                                                        <option value="{{$case->name}}">{{$case->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </form>
                                    @else
                                        {{ $request->bookKeeper->status->name}}
                                    @endcan()
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
                            <td colspan="3" class="small px-2 selectable">
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
                                    {{  $request->created_at->format('Y-m-d H:i')}}
                                @else
                                    @if($request->bookKeeper)
                                        {{  $request->bookKeeper->created_at->format('Y-m-d H:i')}}
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
                            <td colspan="3" class="small px-2 selectable">
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
                                        <option
                                            @selected($request->bankDetails && $request->bankDetails->bank_code_id == $bankCode->id) class="text-dark"
                                            value="{{$bankCode->id}}">{{$bankCode->code}}</option>
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
                            <td colspan="3" class="small px-2 selectable">
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
                            <td colspan="5" class="small px-2 selectable">
                                @if($request->priority)
                                    Priority
                                @else
                                    @can('accountant',auth()->user())
                                        <form id="accountantForm" method="POST"
                                              action="/expense/expense-request/accountant/approval/{{$request->id}}">
                                            @csrf
                                            <select id="accountantStatus" name="status"
                                                    class="border-0 outline-0 w-100">
                                                @foreach(\App\Enums\RequestApprovalStatus::status() as $case)
                                                    @if($request->accountant && $request->accountant->status == $case)
                                                        <option value="{{$case->name}}"
                                                                selected>{{$case->name}}</option>
                                                    @else
                                                        <option value="{{$case->name}}">{{$case->name}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </form>
                                    @else
                                        @if($request->accountant)
                                            {{ $request->accountant->status->name}}
                                        @endif
                                    @endcan
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
                            <td colspan="3" class="small px-2 selectable">
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
                                @if($request->bankDetails && $request->bankDetails->check_number)
                                    <input value="{{ $request->bankDetails->check_number}}" id="checkNumberInput"
                                           class="w-100 border-0 outline-0">
                                @else
                                    <input id="checkNumberInput" class="w-100 border-0 outline-0">
                                @endif
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
                                    {{  $request->created_at->format('Y-m-d H:i')}}
                                @else
                                    @if($request->accountant)
                                        {{$request->accountant->created_at->format('y-m-d H:i')}}
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
                            <td colspan="3" class="small px-2 selectable">
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
                            @can('managing-role')
                                <td colspan="1" class="px-2 text-center small fw-bold bg-blue">ATTACHMENT</td>
                            @else
                                <td colspan="1" rowspan="7"></td>
                            @endcan
                            <td colspan="4" class="text-center fw-bold small">VAT INPUT AMOUNT</td>
                            <td colspan="5" class="px-2 small fw-bold bg-blue">FINANCE</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="small px-2 text-center bg-red fw-bold">Type</td>
                            <td colspan="1" class="text-center">
                                <input type="checkbox">
                            </td>
                            <td colspan="3" class="small px-2 selectable">
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
                            @can('managing-role')
                                <td colspan="1" rowspan="5" style="position:relative;">
                                    <div style="position: absolute; height: 100%; width: 100%; display: flex; align-items: center;">
                                        <div class="d-flex p-1 overflow-hidden gap-1" id="payment_images">
                                            @foreach ($images as $index => $image)
                                                <img class="uploaded-img" src="{{$image->public_image}}">
                                            @endforeach
                                        </div>
                                    </div>
                                </td>
                            @endcan
                            <td colspan="4" class="text-center small px-2">
                                @if($request->vat)
                                    <input value="{{$request->vat->option_a}}" type="text" id="vatOption1"
                                           class="h-100 w-100 border-0 outline-0">
                                @else
                                    <input type="text" id="vatOption1" class="h-100 w-100 border-0 outline-0">
                                @endif
                            </td>
                            <td colspan="5" class="small px-2 selectable">
                                @can('finance-president',auth()->user())
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
                                @else
                                    @if($request->auditor)
                                        {{$request->finance->status->name}}
                                    @endif
                                @endcan
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
                            <td colspan="3" class="small px-2 selectable">
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
                                    {{$request->finance->created_at->format('y-m-d H:i')}}
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
                            <td colspan="3" class="small px-2 selectable">
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
                            <td colspan="3" class="small px-2 selectable">
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
                            <td colspan="5" class="small px-2 selectable">
                                @can('auditor',auth()->user())
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
                                @else

                                    @if($request->auditor)
                                        {{ $request->auditor->status->name}}
                                    @endif

                                @endcan

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
                            <td colspan="3" class="small px-2 selectable">
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
                                    {{ $request->auditor->created_at->format('Y-m-d H:i')}}
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
                            @can('managing-role')
                                <td colspan="1" class="text-center">
                                    <input id="payment_upload" type="file" accept="image/jpeg, image/png, application/pdf" multiple="" name="files[]" class="d-none">
                                    <label for="payment_upload" class="btn btn-sm w-100 rounded-0 btn-outline-danger border-0">UPLOAD IMAGES</label>
                                </td>
                            @endcan
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
                                    <input value="{{$request->others}}" id="othersInput" class="small w-100 outline-0 border-1 border-top-0 border-start-0 border-end-0">
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

        <div id="requestHistory" class="d-none h-100 col-3 flex-shrink-0">
            <div class="bg-white position-relative" style="width: 380px;">
                <div class="bg-white sticky-top d-flex align-items-center gap-2 flex-shrink-0 p-3 border-bottom" style="z-index:100">
                    <button onclick="viewHistory()" class="btn btn-sm btn-outline-danger">
                        <i class="fas fa-times mt-1"></i>
                    </button>
                    <span class="fs-5 fw-semibold">Logs</span>
                </div>
                <div class="list-group list-group-flush border-bottom scroll-area">
                    @foreach($logs as $log)
                        <a href="#" class="list-group-item list-group-item-action py-3 lh-tight d-flex align-items-center">
                            <div class="w-100">
                                <div class="d-flex w-100 align-items-center justify-content-between">
                                    <strong class="mb-1">{{$log->user->name}}</strong>
                                    <small class="text-muted">{{$log->created_at->format('Y-m-d h:i A')}}</small>
                                </div>
                                <div class="col-10 mb-1 small">{{$log->description}}</div>
                            </div>
                            @can('developer', auth()->user())
                                <button class="btn btn-sm btn-close bg-transparent ms-3" data-id="{{$log->id}}" onclick="console.log('{{$log->id}}');"></button>
                            @endcan
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Message For Errors -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="errorToast" class="toast text-danger" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-danger text-white">
                <strong class="me-auto">Error</strong>
                <small>Just now</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body" id="toastErrorBody">

            </div>
        </div>
    </div>

    <!-- Toast Message For Errors -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="successToast" class="toast text-success" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-success text-white">
                <strong class="me-auto">Success</strong>
                <small>Just now</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body" id="toastSuccessBody">

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
                                    @can('manage')
                                        <input id="editItemQuantity" type="text" class="p-2 h-100 w-100" name="quantity">
                                    @else
                                        <input id="editItemQuantity" type="text" class="p-2 h-100 w-100" name="quantity" disabled>
                                    @endcan
                                </div>
                                <div class="col-2 m-0 p-0 small border-0">
                                    @can('manage')
                                        <select name="measurement" id="editItemUnitOfMeasurement" class="p-2 h-100 w-100">
                                            @foreach($measurements as $measurement)
                                                <option value="{{$measurement->id}}">{{$measurement->name}}</option>
                                            @endforeach
                                        </select>
                                    @else
                                        <select disabled name="measurement" id="editItemUnitOfMeasurement" class="p-2 h-100 w-100">
                                            @foreach($measurements as $measurement)
                                                <option value="{{$measurement->id}}">{{$measurement->name}}</option>
                                            @endforeach
                                        </select>
                                    @endcan
                                </div>
                                <div class="col-2 m-0 p-0 small border-0">
                                    @can('manage')
                                        <select name="jobOrder" id="editItemJobOrder" class="p-2 h-100 w-100">
                                            @foreach($jobOrders as $jobOrder)
                                                <option value="{{$jobOrder->id}}">{{$jobOrder->reference}}</option>
                                            @endforeach
                                        </select>
                                    @else
                                        <select disabled name="jobOrder" id="editItemJobOrder" class="p-2 h-100 w-100">
                                            @foreach($jobOrders as $jobOrder)
                                                <option value="{{$jobOrder->id}}">{{$jobOrder->reference}}</option>
                                            @endforeach
                                        </select>
                                    @endcan
                                </div>
                                <div class="col-2 m-0 p-0 small border-0">
                                    @can('manage')
                                        <input name="description" id="editItemDescription" type="text"
                                               class="p-2 h-100 w-100">
                                    @else
                                        <input name="description" id="editItemDescription" type="text"
                                               class="p-2 h-100 w-100" disabled>
                                    @endcan
                                </div>
                                <div class="col-2 small border-0 m-0 p-0">
                                    @can('manage')
                                        <input name="cost" id="editItemCost" type="text" class="p-2 h-100 w-100">
                                    @else
                                        <input name="cost" id="editItemCost" type="text" class="p-2 h-100 w-100" disabled>
                                    @endcan
                                </div>
                                <div class="col-2 small border-0 m-0 p-0">
                                    @can('manage')
                                        <input id="editItemTotal" type="text" class="p-2 h-100 w-100" name="total">
                                    @else
                                        <input id="editItemTotal" type="text" class="p-2 h-100 w-100" name="total" disabled>
                                    @endcan
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

                                    @can('manage')
                                        <select id="editItemStatus" class="p-2" name="status">
                                            @foreach(App\Enums\RequestItemStatus::status() as $requestStatus)
                                                <option value="{{$requestStatus->name}}">{{$requestStatus->name}}</option>
                                            @endforeach
                                        </select>
                                    @else
                                        <select id="editItemStatus" class="p-2" name="status" disabled>
                                            @foreach(App\Enums\RequestItemStatus::status() as $requestStatus)
                                                <option value="{{$requestStatus->name}}">{{$requestStatus->name}}</option>
                                            @endforeach
                                        </select>
                                    @endcan
                                </div>
                                <div class="col-4 text-center p-0" style="word-wrap: break-word;">

                                    @can('manage')
                                        <textarea id="editItemRemarks" rows="5" placeholder="Type here..."
                                                  style="resize: none;" class="p-2 w-100 h-100 small"
                                                  name="remarks"></textarea>
                                    @else
                                        <textarea disabled id="editItemRemarks" rows="5" placeholder="Type here..."
                                                  style="resize: none;" class="p-2 w-100 h-100 small"
                                                  name="remarks"></textarea>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        @can('manage')
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        @endcan
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
        const viewer2 = new Viewer(document.getElementById('payment_images'));

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
        const toastErrorBody = document.querySelector('#toastErrorBody');

        const toastSuccessModal = new bootstrap.Toast(document.getElementById('successToast'));
        const toastSuccessBody = document.querySelector('#toastSuccessBody');

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
        const receivedBy = document.querySelector('#receivedBy');
        const auditedBy = document.querySelector('#auditedBy');

        const fundedStatus = document.querySelector('#fundedStatus');
        const declinedStatus = document.querySelector('#declinedStatus');

        const paidToInput = document.querySelector('#paidToInput');
        const supplierInput = document.querySelector('#supplierInput');
        const termsInput = document.querySelector('#termsInput');

        const commentForm = document.querySelector('#commentForm');
        const commentHolder = document.querySelector('#commentsHolder');

        const othersInput = document.querySelector('#othersInput');

        let initialLoad = true;


        if (receivedBy) {
            receivedBy.addEventListener('change', async () => {

                try {

                    const formData = new FormData();

                    formData.append('received_by', receivedBy.value);

                    const response = await fetch('/expense/expense-request/received-by/{{$request->id}}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    if (!response.ok) {
                        throw new Error('Received by updated failed!');
                    }

                    showSuccessMessage('Received by updated');

                } catch (error) {
                    receivedBy.value = null;
                    showErrorMessage(error.message);
                }
            });
        }

        if (auditedBy) {
            auditedBy.addEventListener('change', async () => {
                try {

                    const formData = new FormData();

                    formData.append('audited_by', auditedBy.value);

                    const response = await fetch('/expense/expense-request/audited-by/{{$request->id}}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    if (!response.ok) {
                        throw new Error('Audited by updated failed!');
                    }

                    showSuccessMessage('Audited by updated');

                } catch (error) {
                    auditedBy.value = null;
                    showErrorMessage(error.message);
                }
            });
        }

        if (purchaseOrderInput) {
            purchaseOrderInput.addEventListener('change', async () => {

                try {

                    const formData = new FormData();

                    formData.append('purchaseOrder', purchaseOrderInput.value);

                    const response = await fetch('/expense/expense-request/expense/vat/purchase-order/{{$request->id}}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                        }
                    })

                    if (!response.ok) {
                        throw new Error('Purchase Order update failed!')
                    }

                    showSuccessMessage('Purchase Order updated!')
                } catch (error) {
                    purchaseOrderInput.value = null;
                    showErrorMessage(error.message)
                }
            })
        }

        if (invoiceNumberInput) {
            invoiceNumberInput.addEventListener('change', async () => {

                try {

                    let formData = new FormData();

                    formData.append('invoice', invoiceNumberInput.value);

                    const response = await fetch('/expense/expense-request/expense/vat/invoice/{{$request->id}}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    if (!response.ok) {
                        throw new Error('Invoice number update failed!');
                    }

                    showSuccessMessage('Invoice number updated!')

                } catch (error) {
                    invoiceNumberInput.value = null
                    showErrorMessage(error.message)
                }
            })
        }

        if (billNumberInput) {
            billNumberInput.addEventListener('change', async () => {

                try {

                    const formData = new FormData();

                    formData.append('bill', billNumberInput.value);

                    const response = await fetch('/expense/expense-request/expense/vat/bill/{{$request->id}}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    if (!response.ok) {
                        throw new Error('Bill number updated failed!')
                    }

                    showSuccessMessage('Bill number updated!');
                } catch (error) {
                    billNumberInput.value = null
                    showErrorMessage(error.message)
                }
            })
        }

        if (paidToInput) {
            paidToInput.addEventListener('change', async () => {

                try {

                    const formData = new FormData();

                    formData.append('paid_to', paidToInput.value);

                    const response = await fetch('/expense/expense-request/paid-to/{{$request->id}}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    if (!response.ok) {
                        throw new Error('Something went wrong!')
                    }

                    showSuccessMessage('Paid to updated!');

                    window.location.reload();
                } catch (error) {
                    paidToInput.value = null
                    showErrorMessage(error.message)
                }
            })
        }

        if (supplierInput) {
            supplierInput.addEventListener('change', async () => {

                try {

                    const formData = new FormData();

                    formData.append('supplier', supplierInput.value);

                    const response = await fetch('/expense/expense-request/supplier/{{$request->id}}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    if (!response.ok) {
                        throw new Error('Something went wrong!')
                    }

                    showSuccessMessage('Supplier is updated!');

                    window.location.reload();
                } catch (error) {
                    supplierInput.value = null
                    showErrorMessage(error.message)
                }
            })
        }

        if (termsInput) {
            termsInput.addEventListener('change', async () => {

                try {

                    const formData = new FormData();

                    formData.append('terms', termsInput.value);

                    const response = await fetch('/expense/expense-request/terms/{{$request->id}}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                        }
                    });


                    const data = await  response.json();

                    if (!response.ok) {
                        throw new Error(data.message)
                    }


                    // if (!response.ok) {
                    //     throw new Error('Terms updated failed!')
                    // }

                    showSuccessMessage('Terms to updated!');
                } catch (error) {
                    termsInput.value = null
                    showErrorMessage(error.message)
                }
            })
        }


        if (orNumberInput) {
            orNumberInput.addEventListener('change', async () => {

                try {

                    const formData = new FormData();

                    formData.append('receipt', orNumberInput.value);

                    const response = await fetch('/expense/expense-request/expense/vat/official-receipt/{{$request->id}}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                        }
                    })

                    if (!response.ok) {
                        throw new Error('Official receipt number update failed')
                    }

                    showSuccessMessage('Official receipt number updated!');

                } catch (error) {
                    orNumberInput.check = null;
                    showErrorMessage(error.message);
                }
            })
        }

        if (vatOptionA) {
            vatOptionA.addEventListener('change', async () => {

                try {

                    const formData = new FormData();

                    formData.append('option', vatOptionA.value);

                    const response = await fetch('/expense/expense-request/expense/vat/option-a/{{$request->id}}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    if (!response.ok) {
                        throw new Error('Vat input amount update failed!');
                    }

                    showSuccessMessage('Vat input amount updated!');

                } catch (error) {
                    showErrorMessage(error.message)
                    vatOptionA.value = null;
                }
            })
        }

        if (vatOptionB) {
            vatOptionB.addEventListener('change', async () => {

                try {

                    const formData = new FormData();

                    formData.append('option', vatOptionB.value);

                    const response = await fetch('/expense/expense-request/expense/vat/option-b/{{$request->id}}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    if (!response.ok) {
                        throw new Error('Vat input amount update failed!');
                    }

                    showSuccessMessage('Vat input amount updated!');

                } catch (error) {
                    showErrorMessage(error.message)
                    vatOptionB.value = null;
                }
            })
        }

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

        if (financeStatus) {
            financeStatus.addEventListener('change', () => {
                financeForm.submit();
            })
        }

        if (auditorStatus) {
            auditorStatus.addEventListener('change', () => {
                auditorForm.submit();
            })
        }

        if (expenseCategoryInput) {
            expenseCategoryInput.forEach((category, index) => {

                if (category.value) {
                    selectedExpensesCategory[index] = category.value;
                }

                category.addEventListener('input', async () => {

                    try {

                        selectedExpensesCategory[index] = category.value;

                        const formData = new FormData();

                        selectedExpensesCategory.forEach(category => {
                            formData.append('category[]', category);
                        })

                        const response = await fetch('/expense/api/expense-request/expense-type/{{$request->id}}', {
                            method: 'POST',
                            body: formData,
                            headers: {
                                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        if (!response.ok) {
                            throw new Error('Update expense type failed!');
                        }

                        showSuccessMessage('Expense type updated!');

                    } catch (error) {
                        category.value = 1;
                        showErrorMessage(error.message);
                    }
                });
            })
        }
        if (bankNameSelection) {
            bankNameSelection.addEventListener('change', updateBankDetails);
        }

        if (bankCodeSelection) {
            bankCodeSelection.addEventListener('change', updateBankDetails);
        }

        if (checkNumberInput) {
            checkNumberInput.addEventListener('change', updateBankDetails);
        }

        if (requestPaymentMethodInput) {
            requestPaymentMethodInput.addEventListener('change', async () => {
                try {

                    const formData = new FormData();
                    formData.append('mode', requestPaymentMethodInput.value);

                    const response = await fetch('/expense/api/expense-request/payment-method/{{$request->id}}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    const data = await response.json();

                    if (!response.ok) {
                        throw new Error('Unable to update payment method!');
                    }

                    await generateVoucher();

                } catch (error) {
                    requestPaymentMethodInput.value = 0;
                    showErrorMessage(error.message)
                }
            })
        }

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
                showErrorMessage(error.message);
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

            if (!g1) {
                return;
            }

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

        if (requestStatus) {
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

                    if (!result.ok) {
                        throw new Error('Something went wrong');
                    }

                    showSuccessMessage('Status updated!');

                } catch (error) {
                    requestStatus.value = null;
                    showErrorMessage('Status updated failed!');
                }
            })
        }

        async function viewItem(id) {

            try {

                const result = await fetch(`/expense/api/request-item/${id}`);

                const data = await result.json();

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

                    console.log(attachment);

                    let imageSrc =   attachment.public_image;

                    const thumbnail = $('<img>').attr('src', imageSrc).addClass('uploaded-img');

                    $('#uploads').append(thumbnail);

                });

                editItemModal.show();

                viewer.update();

            } catch (error) {
                showErrorMessage('Unable to view item');
            }

        }

        async function updateBankDetails() {

            try {

                let formData = new FormData();

                formData.append('bank_name_id', bankNameSelection.value);
                formData.append('bank_code_id', bankCodeSelection.value);
                formData.append('check_number', checkNumberInput.value);
                formData.append('request_id', {{$request->id}});

                const response = await fetch('/expense/api/expense-request/bank-details', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                    }
                })

                const data = await response.json();

                if (!response.ok) {
                    // throw new Error('Bank details update failed!');
                    throw new Error(data.message);
                }

                showSuccessMessage('Bank details updated!');

            } catch (error) {
                showErrorMessage(error.message)
            }
        }

        async function deleteBankDetails() {

            try {

                const response = await fetch('/expense/api/expense-request/bank-details/{{$request->id}}', {
                    method: 'DELETE',
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                    }
                });

                if (!response.ok) {
                    throw new Error('Unable to deselect bank details');
                }

            } catch (error) {
                showErrorMessage(error.message)
            }
        }

        async function setDeliveryStatus(target) {

            try {

                const formData = new FormData();

                formData.append('completed', target.value);

                const response = await fetch('/expense/api/expense-request/delivery/status/{{$request->id}}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                    }
                });

                if (!response.ok) {
                    throw new Error('Delivery status updated failed!');
                }

                showSuccessMessage('Delivery status updated');

            } catch (error) {
                showErrorMessage(error.message)
            }
        }

        async function deleteDeliveryStatus(target) {

            try {
                const response = await fetch('/expense/api/expense-request/delivery/status/{{$request->id}}', {
                    method: 'DELETE',
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                    }
                });

                if (!response.ok) {
                    throw new Error('Delivery status updated failed!')
                }

                showSuccessMessage('Delivery status updated!')

            } catch (error) {
                showErrorMessage(error.message)
            }
        }

        async function verifyDelivery(target) {

            try {

                const formData = new FormData();

                formData.append('verified', target.value);

                const response = await fetch('/expense/api/expense-request/delivery/supplier/{{$request->id}}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                    }
                });

                if (!response.ok) {
                    throw new Error('Supplier verification update failed!')
                }

                showSuccessMessage('Supplier verification updated')

            } catch (error) {
                showErrorMessage(error.message)
            }
        }

        async function removeDelivery(target) {

            try {

                const response = await fetch('/expense/api/expense-request/delivery/supplier/{{$request->id}}', {
                    method: 'DELETE',
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                    }
                });

                if (!response.ok) {
                    throw new Error('Supplier verification update failed!')
                }

                showSuccessMessage('Supplier verification updated')

            } catch (error) {
                showErrorMessage(error.message)
            }
        }

        async function updateAttachment(target) {

            try {

                const formData = new FormData();

                formData.append('attachment', target.value);

                const response = await fetch('/expense/api/expense-request/attachment/{{$request->id}}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                    }
                });

                if (!response.ok) {
                    throw new Error('Request updated attachment failed!');
                }

                showSuccessMessage('Request attachment updated!');

            } catch (error) {
                target.checked = false;
                showErrorMessage(error.message)
            }
        }

        async function removeAttachment(target) {

            try {

                const formData = new FormData();

                formData.append('attachment', '{{\App\Enums\AccountingAttachment::DEFAULT->name}}');

                const response = await fetch('/expense/api/expense-request/attachment/{{$request->id}}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                    }
                });

                if (!response.ok) {
                    throw new Error('Request updated attachment failed!');
                }

                showSuccessMessage('Request attachment updated!');

            } catch (error) {
                target.checked = false;
                showErrorMessage(error.message)
            }
        }

        async function updateType(target) {

            try {

                const formData = new FormData();
                formData.append('type', target.value);

                const response = await fetch('/expense/api/expense-request/type/{{$request->id}}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                    }
                });

                if (!response.ok) {
                    throw new Error('Request update type failed!');
                }

                showSuccessMessage('Request type updated!');

            } catch (error) {
                target.checked = false;
                showErrorMessage(error.message)
            }
        }

        async function removeType(target) {

            try {

                const formData = new FormData();
                formData.append('type', '{{\App\Enums\AccountingType::DEFAULT->name}}');

                const response = await fetch('/expense/api/expense-request/type/{{$request->id}}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                    }
                });

                if (!response.ok) {
                    throw new Error('Request update type failed!');
                }

                showSuccessMessage('Request type updated!');

            } catch (error) {
                target.checked = false;
                showErrorMessage(error.message)
            }
        }

        async function updateReceipt(target) {

            try {

                const formData = new FormData();
                formData.append('receipt', target.value);

                const response = await fetch('/expense/api/expense-request/receipt/{{$request->id}}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                    }
                })

                if (!response.ok) {
                    throw new Error('Request receipt update failed!');
                }

                showSuccessMessage('Request receipt updated!');

            } catch (error) {
                target.checked = false;
                showErrorMessage(error.message)
            }
        }

        async function removeReceipt(target) {

            try {

                const formData = new FormData();
                formData.append('receipt', '{{\App\Enums\AccountingReceipt::DEFAULT->name}}');

                const response = await fetch('/expense/api/expense-request/receipt/{{$request->id}}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                    }
                })

                if (!response.ok) {
                    throw new Error('Request receipt update failed!');
                }

                showSuccessMessage('Request receipt updated!');

            } catch (error) {
                target.checked = false;
                showErrorMessage(error.message)
            }
        }

        async function updatePriorityLevel(target) {

            try {

                const formData = new FormData();
                formData.append('priority_level', target.value);

                const response = await fetch('/expense/api/expense-request/priority-level/{{$request->id}}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                    }
                })

                if (!response.ok) {
                    throw new Error('Request priority level update failed!');
                }

                showSuccessMessage('Request priority level updated!');

            } catch (error) {
                target.checked = false;
                showErrorMessage(error.message)
            }
        }

        async function removePriorityLevel(target) {

            try {

                const formData = new FormData();
                formData.append('priority_level', '{{\App\Enums\RequestPriorityLevel::NONE->name}}');

                const response = await fetch('/expense/api/expense-request/priority-level/{{$request->id}}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                    }
                })

                if (!response.ok) {
                    throw new Error('Request priority level update failed!');
                }

                showSuccessMessage('Request priority level updated!');

            } catch (error) {
                target.checked = false;
                showErrorMessage(error.message)
            }
        }

        async function updateFundStatus(target) {

            try {

                const formData = new FormData();

                formData.append('status', target.value);

                const response = await fetch('/expense/api/expense-request/fund-status/{{$request->id}}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                    }
                })

                if (!response.ok) {
                    throw new Error('Unable to update fund status!');
                }

                showSuccessMessage('Fund status updated!');

            } catch (error) {
                target.checked = false;
                showErrorMessage('Fund status updated failed!');
            }
        }

        async function removeFundStatus(target) {

            try {

                const formData = new FormData();

                formData.append('status', '{{\App\Enums\RequestFundStatus::NONE}}');

                const response = await fetch('/expense/api/expense-request/fund-status/{{$request->id}}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                    }
                })

                if (!response.ok) {
                    throw new Error('Unable to update fund status!');
                }

                showSuccessMessage('Fund status updated!');

            } catch (error) {
                target.checked = false;
                showErrorMessage('Fund status updated failed!');
            }
        }

        async function loadComments() {

            try {
                const response = await fetch('/expense/expense-request/comments/{{$request->id}}', {
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                    }
                });

                if (!response.ok) {
                    throw new Error('Unable to load comments! please contact developer');
                }

                commentHolder.innerHTML = await response.text();

                if (initialLoad) {
                    commentHolder.scrollTop = commentHolder.scrollHeight - commentHolder.clientHeight;
                    initialLoad = false;
                }

            } catch (error) {

                let p = document.createElement('p');
                p.classList.add('h-100', 'text-danger', 'd-flex', 'align-items-center', 'justify-content-center', 'text-center');
                p.innerText = error.message;

                commentsHolder.innerHTML = '';
                commentsHolder.appendChild(p);
            }
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

        if (fileUpload) {
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

                        return;
                    }

                    let files = await result.json();

                    files.images.forEach(attachment => {

                        let imageSrc = (attachment.split('/'))[1];

                        const thumbnail = $('<img>').attr('src', '/storage/' + imageSrc).addClass('uploaded-img');

                        $('#uploads').append(thumbnail);

                    });

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
        }

        const paymentUpload = document.querySelector('#payment_upload');

        if (paymentUpload) {
            paymentUpload.addEventListener('change', async () => {

                let formData = new FormData();

                const files = paymentUpload.files;

                Array.from(files).forEach(file => {
                    formData.append('files[]', file);
                });

                try {

                    let result = await fetch(`/expense/api/request-item/payment-upload/{{$request->id}}`, {
                        method: "POST",
                        body: formData,
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                        }
                    })

                    if (!result.ok) {

                        let data = await result.json();

                        console.log(data)

                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: 'An error occurred while uploading attachment',
                        });

                        return;
                    }

                    let file = await result.json();

                    let imageSrc = file.public_image;

                    const thumbnail = $('<img>').attr('src', imageSrc).addClass('uploaded-img');

                    $('#payment_images').append(thumbnail);

                    viewer2.update();

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
        }

        if (othersInput) {
            othersInput.addEventListener('change', async () => {

                try {

                    const formData = new FormData();

                    formData.append('others', othersInput.value);

                    const response = await fetch('/expense/expense-request/others/{{$request->id}}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    if (!response.ok) {
                        throw new Error('Others updated failed!');
                    }

                    showSuccessMessage('Others updated');

                } catch (error) {
                    othersInput.value = null;
                    showErrorMessage(error.message);
                }
            });
        }

        function showSuccessMessage(message) {
            toastSuccessBody.innerHTML = message;
            toastSuccessModal.show();
        }

        function showErrorMessage(message) {
            toastErrorBody.innerHTML = message;
            toastErrorModal.show();
        }

        const historyHolder = document.querySelector('#requestHistory');

        function viewHistory() {
            historyHolder.classList.toggle('d-none')
        }

    </script>
@endsection

