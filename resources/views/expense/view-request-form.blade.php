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

    </style>
@endsection

@section('body')

    @if($errors->any())

        @dd($errors)
        {{--        <h4>{{$errors->first()}}</h4>--}}
    @endif

    <div class="d-flex gap-2">

        <div>
            <div class="bg-light p-2">
                <button class="btn btn-success" onclick="generatePDF()">
                    <i class="fas fa-download"></i>
                    Download
                </button>
                <button onclick="viewHistory()" class="btn btn-secondary">
                    <i class="fas fa-scroll"></i>
                    View Logs
                </button>
                <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#checkwriterModal">
                    <i class="fas fa-plus-circle me-2"></i>Check Writer
                </button>
            </div>

            <div class="modal fade text-dark" id="checkwriterModal" tabindex="-1" aria-labelledby="Check Writer"
                 aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <form id="checkwriterForm">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5">Check Writer</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body d-flex align-items-center justify-content-around">
                                <div style="width: 7.95in; height: 2.9in; position: relative;" class="my-auto"
                                     id="printable_check">
                                    <img src="https://html.scribdassets.com/5xqh18575sa7ssqi/images/1-f2cc24c5d0.jpg"
                                         class="img-fluid h-100" alt="check-writer">

                                    <div style="position: absolute; top: 0.23in; right: 0.35in; width: 2in;">
                                        <input type="text"
                                               class="form-control rounded-0 bg-transparent border-0 text-end fw-bold"
                                               style="line-height: 8px;" name="date"
                                               placeholder="0  0    0  0    0  0  0  0">
                                    </div>
                                    <div style="position: absolute; top: 0.6in; left: 0.95in; width: 4.43in;">
                                        <input type="text"
                                               class="form-control rounded-0 bg-transparent border-0 fw-bold"
                                               style="line-height: 8px;" name="paid_to"
                                               placeholder="*** JOHN CASTILLO ***">
                                    </div>
                                    <div style="position: absolute; top: 0.6in; left: 5.5in; width: 2in;">
                                        <input type="text"
                                               class="form-control rounded-0 bg-transparent border-0 fw-bold"
                                               style="line-height: 8px;" name="amount_words"
                                               placeholder="*** 1,000,000 ***">
                                    </div>
                                    <div style="position: absolute; top: 0.92in; left: 0.695in; width: 6.8in;">
                                        <input type="text"
                                               class="form-control rounded-0 bg-transparent border-0 fw-bold"
                                               style="line-height: 8px;" name="amount_value"
                                               placeholder="*** ONE MILLION ONLY ***">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success rounded-pill w-50 mx-auto">Print</button>
                            </div>
                        </form>
                    </div>
                </div>
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
                            <tr class="selectable" role="button">
                                <td colspan="2"
                                    class="small px-2 bg-transparent text-transparent">{{$item->quantity}}</td>
                                <td colspan="3" class="small px-2 bg-transparent">{{$item->measurement->name}}</td>
                                <td colspan="2" class="small px-2 bg-transparent">{{$item->jobOrder->name}}</td>
                                <td colspan="2" class="small bg-transparent">
                                    <div class="d-flex align-items-center bg-transparent">
                                        <p class="m-0 p-0 text-ellipsis"
                                           style="max-width: 45ch">{{$item->description}}</p>
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
                                @if($request->payment_method)
                                    {{$request->payment_method->name}}
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
                                @if($request->expenseTypes->get(0))
                                    {{$request->expenseTypes->get(0)->category->name}}
                                @endif
                            </td>
                            <td colspan="1">
                                @if($request->bankDetails)
                                    {{  $request->bankDetails->bank->name}}
                                @endif
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
                                @elseif($request->bookKeeper)
                                    {{$request->bookKeeper->status->name}}
                                @else

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
                                @if($request->expenseTypes->get(1))
                                    {{$request->expenseTypes->get(1)->category->name}}
                                @endif
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
                            <td colspan="3" class="small px-2 selectable">
                                @if($request->expenseTypes->get(2))
                                    {{$request->expenseTypes->get(2)->category->name}}
                                @endif
                            </td>
                            <td colspan="1">
                                @if($request->bankDetails)
                                    {{  $request->bankDetails->code->code}}
                                @endif
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
                                @if($request->expenseTypes->get(3))
                                    {{$request->expenseTypes->get(3)->category->name}}
                                @endif
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
                                @elseif($request->accountant)
                                    {{$request->accountant->status->name}}
                                @else

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
                                @if($request->expenseTypes->get(4))
                                    {{$request->expenseTypes->get(4)->category->name}}
                                @endif
                            </td>
                            <td colspan="1">
                                @if($request->bankDetails && $request->bankDetails->check_number)
                                    {{$request->bankDetails->check_number}}
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
                            <td colspan="3" class="small px-2 selectable">
                                @if($request->expenseTypes->get(5))
                                    {{$request->expenseTypes->get(5)->category->name}}
                                @endif
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
                            <td colspan="3" class="small px-2 selectable">
                                @if($request->expenseTypes->get(6))
                                    {{$request->expenseTypes->get(6)->category->name}}
                                @endif
                            </td>
                            <td colspan="4" class="text-center small px-2">
                                @if($request->vat)
                                    <input value="{{$request->vat->option_a}}" type="text" id="vatOption1"
                                           class="h-100 w-100 border-0 outline-0">
                                @else
                                    <input type="text" id="vatOption1" class="h-100 w-100 border-0 outline-0">
                                @endif
                            </td>
                            <td colspan="5" class="small px-2 selectable">
                                @if($request->finance)
                                    {{$request->finance->status->name}}
                                @endif
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
                                @if($request->expenseTypes->get(7))
                                    {{$request->expenseTypes->get(7)->category->name}}
                                @endif
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
                            <td colspan="3" class="small px-2 selectable">
                            @if($request->expenseTypes->get(8))
                                {{$request->expenseTypes->get(8)->category->name}}
                            @endif
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
                                @if($request->expenseTypes->get(9))
                                    {{$request->expenseTypes->get(9)->category->name}}
                                @endif
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
                                @if($request->auditor)
                                    {{$request->auditor->status->name}}
                                @endif
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
                                @if($request->expenseTypes->get(10))
                                    {{$request->expenseTypes->get(10)->category->name}}
                                @endif
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
                                @if($request->expenseTypes->get(11))
                                    {{$request->expenseTypes->get(11)->category->name}}
                                @endif
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

        <div id="requestHistory" class="d-none h-100 flex-shrink-0">
            <div class="bg-white position-relative" style="width: 380px;">
                <div
                    class="bg-white sticky-top d-flex align-items-center gap-2 flex-shrink-0 p-3 border-bottom"
                    style="z-index:100">
                    <i class="fas fa-times mt-1"></i>
                    <span class="fs-5 fw-semibold">Logs</span>
                </div>
                <div class="list-group list-group-flush border-bottom scroll-area">
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

        const commentForm = document.querySelector('#commentForm');
        const commentHolder = document.querySelector('#commentsHolder');
        let initialLoad = true;

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

    </script>

    <script>
        document.getElementById('checkwriterForm').addEventListener('submit', function (event) {
            event.preventDefault();
            var element = document.getElementById('printable_check');
            html2pdf(element, {
                margin: 0,
                filename: 'CHECK_BDO.pdf',
                image: {type: 'jpg', quality: 1.0},
                html2canvas: {scale: 1},
                jsPDF: {
                    unit: 'in',
                    format: [6.25, 2.75],
                    orientation: 'landscape',
                }
            });
        });
    </script>

    <script>

        const historyHolder = document.querySelector('#requestHistory');

        function viewHistory() {
            historyHolder.classList.toggle('d-none')
        }

    </script>
@endsection
