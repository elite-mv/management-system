<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Expense Request Form</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

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

        * {
            font-size: 12px;
        }

        td {
            padding: 0 5px 0 5px !important;
        }

        @page {
            margin: 20px 20px 20px 20px;
            padding: 0;
            size: A4;
        }

        table, table td {
            vertical-align: middle !important; /* Center vertically */
        }

        .text-nowrap {
            white-space: nowrap !important;
        }

    </style>
</head>
<body>
@foreach($requests as $request)
<div class="mx-auto" style="max-width: 780px; overflow: hidden">
    <div class="d-flex mb-4 gap-2">
        <div>
            <div class="border border-dark"
                 style="width: 100px; height: 100px; display: flex; align-items: center; justify-content: center;">
                <img src="{{\Illuminate\Support\Facades\Storage::url($request->company->logo)}}" class="img-fluid"
                     alt="LOGO"
                     style="height: 100px; width: auto;">
            </div>
            <div class="bg-red text-center text-white border border-dark"
                 style="width: 100px; border-style: none solid none solid !important;">
                <strong>{{$request->company->name}}</strong>
            </div>
        </div>

        <div style="font-size: 70px;" class="m-0 mr-auto px-5 border border-5 border-danger">
            <div class="w-100 h-100 border-0 outline-0 text-danger text-center" style="font-size: 60px">
                @if($request->status)
                    {{$request->status->value}}
                @endif
            </div>
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

        <div style="width: 150px;">
            <div class="bg-red text-center text-white border border-dark px-2"
                 style="border-style: solid solid none solid !important;">
                <b>STATUS</b>
            </div>
            <div class="border border-dark"
                 style="height: 100px; display: flex; align-items: center; justify-content: center;">
                <h1 class="text-danger">{{$request->requestStatus}}</h1>
            </div>
        </div>

        <div>
            <div class="bg-red text-center text-white border border-dark px-2"
                 style="border-style: solid solid none solid !important;">
                <b>REQUEST FORM NUMBER</b>
            </div>
            <div class="border border-dark"
                 style="height: 100px; display: flex; align-items: center; justify-content: center;">
                <h1 class="fw-bold">{{ $request->pad_id}}</h1>
            </div>
        </div>

    </div>
    <table class="table table-bordered border-dark w-100">
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
            <td colspan="2" class="small text-center fw-bold bg-gray text-uppercase text-nowrap">JOB ORDER</td>
            <td colspan="2" class="small text-center fw-bold bg-gray text-uppercase">DESCRIPTION</td>
            <td colspan="2" class="small text-center fw-bold bg-gray text-uppercase">UNIT COST</td>
            <td colspan="2" class="small text-center fw-bold bg-gray text-uppercase">TOTAL</td>
            <td colspan="3" class="small text-center fw-bold bg-gray text-uppercase">STATUS</td>
            <td colspan="2" class="small text-center fw-bold bg-gray text-uppercase">REMARKS</td>
        </tr>
        @foreach ($request->items as $item)
            <tr>
                <td colspan="2" class="small px-2 bg-transparent text-transparent">{{$item->quantity}}</td>
                <td colspan="3" class="small px-2 bg-transparent"
                    style="max-width: 10ch">{{$item->measurement->name}}</td>
                <td colspan="2" class="small px-2 bg-transparent">{{$item->jobOrder->name}}</td>
                <td colspan="2" class="small bg-transparent text-overflow">
                    <p class="m-0 p-0 text-truncate" style="max-width: 20ch">{{$item->description}}</p>
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
                @if( $request->payment_method)
                    {{ $request->payment_method->name}}
                @endif
            </td>
        </tr>

        <tr>
            <td colspan="4" class="small bg-yellow text-center fw-bold">QTY</td>
            <td colspan="4" class="small bg-yellow text-center fw-bold">UOM</td>
            <td colspan="1" class="small bg-yellow text-center fw-bold">JOB ORDER</td>
            <td colspan="3" class="small bg-yellow text-center fw-bold">DESCRIPTION</td>
            <td colspan="3" class="small bg-yellow text-center fw-bold">UNIT COST</td>
            <td colspan="3" class="small bg-yellow text-center fw-bold">TOTAL</td>
        </tr>

        @foreach ($request->fund_item as $item)
            <tr>
                <td colspan="4" class="small px-2 bg-transparent">{{$item->quantity}}</td>
                <td colspan="4" class="small px-2 bg-transparent">{{$item->measurement->name}}</td>
                <td colspan="1" class="small px-2 bg-transparent text-nowrap">{{$item->jobOrder->name}}</td>
                <td colspan="3" role="button" class="small px-2 pointer" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    <p class="m-0 p-0 text-truncate" style="max-width: 30ch">{{$item->description}}</p>
                </td>
                <td colspan="3"
                    class="small px-2 bg-transparent">{!! \App\Helper\Helper::formatPeso($item->cost) !!}</td>
                <td colspan="3"
                    class="small px-2 bg-transparent">{!! \App\Helper\Helper::formatPeso($item->cost) !!}</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="15" class="px-2 small bg-yellow text-end fw-bold">TOTAL</td>
            <td colspan="3"
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
            <td colspan="8" class="bg-yellow text-center small">RELEASED BY :</td>
            <td colspan="4" class="bg-red text-center small">RECEIVED BY :</td>
            <td colspan="6" class="bg-green text-center small">AUDITED BY :</td>
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
            <td colspan="4" class="text-center fw-bold bg-red small">Priority level</td>
            <td colspan="4" class="text-center fw-bold bg-blue small">Type</td>
            <td colspan="1" class="text-center fw-bold bg-blue small">BANK NAME</td>
            <td colspan="4" class="fw-bold small px-2">ITEMS DELIVERY</td>
            <td colspan="5" class="px-2 fw-bold small bg-blue">BOOK KEEPER</td>
        </tr>
        <tr>
            <td colspan="1" class="text-center" style="width: 10px">
                @if($request->priority_level === App\Enums\RequestPriorityLevel::LOW)
                    <input class="priorityLevel" value="{{App\Enums\RequestPriorityLevel::LOW->name}}"
                           type="checkbox" name="LOW" checked>
                @else
                    <input class="priorityLevel" value="{{App\Enums\RequestPriorityLevel::LOW->name}}"
                           type="checkbox" name="LOW">
                @endif
            </td>
            <td colspan="2" class="small px-2">Low</td>
            <td colspan="1" class="small px-2 text-nowrap">5 days</td>
            <td colspan="1" class="text-center">
                <input type="checkbox">
            </td>
            <td colspan="3" class="small px-2 text-nowrap">
                @if($request->expenseTypes->get(0))
                    {{$request->expenseTypes->get(0)->category->name}}
                @endif
            </td>
            <td colspan="1">
                @if($request->bankDetails && $request->bankDetails->bank)
                    {{$request->bankDetails->bank->name}}
                @endif
            </td>
            <td colspan="1" class="text-center" style="width: 10px">
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
                    {{$request->bookKeeper->status->name}}
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
            <td colspan="3" class="small px-2">
                @if($request->expenseTypes->get(2))
                    {{$request->expenseTypes->get(2)->category->name}}
                @endif
            </td>
            <td colspan="1">
                @if($request->bankDetails && $request->bankDetails->code)
                    {{$request->bankDetails->code->code}}
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
            <td colspan="3" class="small px-2">
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
            <td colspan="5" class="small px-2">
                @if($request->priority)
                    Priority
                @else
                    {{$request->accountant->status->name}}
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
                @if($request->expenseTypes->get(4))
                    {{$request->expenseTypes->get(4)->category->name}}
                @endif
            </td>
            <td colspan="1">
                @if($request->bankDetails)
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
            <td colspan="3" class="small px-2">
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
            <td colspan="3" class="small px-2">
                @if($request->expenseTypes->get(6))
                    {{$request->expenseTypes->get(6)->category->name}}
                @endif
            </td>
            <td colspan="4" class="text-center small px-2">
                @if($request->vat)
                    {{$request->vat->option_a}}
                @endif
            </td>
            <td colspan="5" class="small px-2">
                @if($request->finance)
                    {{  $request->finance->status->name}}
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
            <td colspan="3" class="small px-2">
                @if($request->expenseTypes->get(7))
                    {{$request->expenseTypes->get(7)->category->name}}
                @endif
            </td>
            <td colspan="4" class="text-center small px-2">
                @if($request->vat)
                    {{$request->vat->option_b}}
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
                @if($request->expenseTypes->get(8))
                    {{$request->expenseTypes->get(8)->category->name}}
                @endif
            </td>
            <td colspan="2" class="small px-2 fw-bold">PO No.</td>
            <td colspan="2" class="small px-2">
                @if($request->vat)
                    {{$request->vat->purchase_order}}
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
                @if($request->expenseTypes->get(9))
                    {{$request->expenseTypes->get(9)->category->name}}
                @endif
            </td>
            <td colspan="2" class="small px-2 fw-bold">Invoice No</td>
            <td colspan="2" class="small px-2">
                @if($request->vat)
                    {{$request->vat->invoice}}
                @endif
            </td>
            <td colspan="5" class="small px-2">
                @if($request->auditor)
                    {{  $request->auditor->status->name}}
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
            <td colspan="3" class="small px-2">
                @if($request->expenseTypes->get(10))
                    {{$request->expenseTypes->get(10)->category->name}}
                @endif
            </td>
            <td colspan="2" class="fw-bold small px-2">Bill No.</td>
            <td colspan="2" class="small px-2">
                @if($request->vat)
                    {{$request->vat->bill}}
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
                    {{$request->vat->official_receipt}}
                @endif
            </td>
            <td colspan="4" rowspan="2" class="small px-2"></td>
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
                    123
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

    @if(!$loop->last)
        <div style="page-break-before: always" class="page-break"></div>
    @endif

</div>
@endforeach

</body>
</html>
