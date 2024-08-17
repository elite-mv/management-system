
@extends('layouts.app')


@section('title', 'View Request')

@section('style')
<style>

:root {
  --blue: rgba(173, 216, 230, 1.0);
  --red: rgba(255, 0, 0, 0.4);
  --yellow: rgba(255, 255, 0, 0.4);
  --green: rgba(75, 200, 75, 0.5);
}

.bg-red{
    background-color: var(--red) !important;
}
.bg-green{
    background-color: var(--green) !important;
}
.bg-yellow{
    background-color: var(--yellow) !important;
}
.bg-blue{
    background-color: var(--blue) !important;
}

td{
    padding: 0 !important;
}

.box-shadow-none {
        -webkit-box-shadow: none;
        -moz-box-shadow: none;
        box-shadow: none;
}

.outline-0{
    outline: none
}

</style>
@endsection

@section('body')

<div class="container-fluid mx-auto" style="width: 13in;">
    <table class="table table-bordered border-dark">
        <tbody>
            <tr>
                <td colspan="4">Date: </td>
                <td colspan="8">123</td>
                <td colspan="2">CV NO:</td>
                <td colspan="4">123</td>
            </tr>
            <tr>
                <td colspan="4">Supplier: </td>
                <td colspan="8">123</td>
                <td colspan="2">CV NO:</td>
                <td colspan="4">123</td>
            </tr>
            <tr>
                <td colspan="4">Paid to: </td>
                <td colspan="14">123</td>
            </tr>
            <tr>
                <td colspan="4">Requested By: </td>
                <td colspan="14">123</td>
            </tr>
            <tr>
                <td colspan="4">Prepared By: </td>
                <td colspan="14">123</td>
            </tr>
            <tr>
                <td class="text-center bg-dark text-white" colspan="18">EXPENSE REQUEST</td>
            </tr>
            <tr>
                <td colspan="2" class="text-center fw-bold bg-secondary text-uppercase">QTY</td>
                <td colspan="3" class="text-center fw-bold bg-secondary text-uppercase">UOM</td>
                <td colspan="2" class="text-center fw-bold bg-secondary text-uppercase">JOB ORDER</td>
                <td colspan="2" class="text-center fw-bold bg-secondary text-uppercase">DESCRIPTION</td>
                <td colspan="2" class="text-center fw-bold bg-secondary text-uppercase">UNIT COST</td>
                <td colspan="2" class="text-center fw-bold bg-secondary text-uppercase">TOTAL</td>
                <td colspan="3" class="text-center fw-bold bg-secondary text-uppercase">STATUS</td>
                <td colspan="2" class="text-center fw-bold bg-secondary text-uppercase">REMARKS</td>
            </tr>
            <tr>
                <td colspan="9" class="text-end fw-bold bg-secondary text-uppercase">TOTAL</td>
                <td colspan="4" class="text-end">1200</td>
                <td colspan="5" class="text-center fw-bold bg-secondary text-uppercase">TOTAL</td>
            </tr>
            <tr>
                <td class="text-center bg-dark text-white" colspan="18">PURCHASE REQUEST</td>
            </tr>
            <tr>
                <td colspan="4" class="bg-secondary">Supplier</td>
                <td colspan="5">Supplier</td>
                <td colspan="3" class="bg-secondary">Payment Type</td>
                <td colspan="6">Payment Type</td>
            </tr>
            <tr>
                <td Colspan="4" class="bg-warning text-center fw-bold">QTY</td>
                <td Colspan="4" class="bg-warning text-center fw-bold">UOM</td>
                <td Colspan="1" class="bg-warning text-center fw-bold">JOB ORDER</td>
                <td Colspan="3" class="bg-warning text-center fw-bold">DESCRIPTION</td>
                <td Colspan="3" class="bg-warning text-center fw-bold">UNIT COST</td>
                <td Colspan="3" class="bg-warning text-center fw-bold">TOTAL</td>
            </tr>
            <tr>
                <td colspan="15" class="bg-warning text-end fw-bold">TOTAL</td>
                <td colspan="4" class="bg-warning text-center fw-bold">123</td>
            </tr>
            <tr>
                <td class="text-center bg-dark text-white" colspan="18">VOUCHER</td>
            </tr>
            <tr>
                <td colspan="4" class="fw-bold bg-secondary">Supplier:</td>
                <td colspan="5" class="text-center"></td>
                <td colspan="3" class="fw-bold bg-secondary">Date:</td>
                <td colspan="6" class="text-center" ></td>
            </tr>
            <tr>
                <td colspan="4" class="fw-bold bg-secondary">Paid to:</td>
                <td colspan="5" class="text-center"></td>
                <td colspan="3" class="fw-bold bg-secondary">Paid amount:</td>
                <td colspan="6" class="text-center" ></td>
            </tr>
            <tr>
                <td colspan="4" class="fw-bold bg-secondary">Payment Type:</td>
                <td colspan="5" class="text-center"></td>
                <td colspan="3" class="fw-bold bg-secondary">Amount in words:</td>
                <td colspan="6" class="text-center" ></td>
            </tr>
            <tr>
                <td colspan="8" class="fw-bold bg-warning text-center">RELEASED BY :</td>
                <td colspan="4" class="fw-bold bg-danger text-center">RECEIVED BY :</td>
                <td colspan="6" class="fw-bold bg-success text-center">AUDITED BY :</td>
            </tr>
            <tr style="height: 80px">
                <td colspan="8" class="text-center align-bottom">MR. RYLAN C. ALINGAROG</td>
                <td colspan="4" class="text-center align-bottom"></td>
                <td colspan="6" class="text-center align-bottom"></td>
            </tr>

            <tr>
                <td colspan="8" class="fw-bold bg-warning text-center">Signature Over Printed Name</td>
                <td colspan="4" class="fw-bold bg-danger text-center">Signature Over Printed Name</td>
                <td colspan="6" class="fw-bold bg-success text-center">Signature Over Printed Name</td>
            </tr>
            <tr>
                <td class="text-center bg-dark text-white" colspan="18"></td>
            </tr>
            <tr>
                <td colspan="9" class="text-center fw-bold">ACCOUNTING DEPARTMENT</td>
                <td colspan="9" class="text-center fw-bold">AUDITOR DEPARTMENT</td>
            </tr>
            <tr>
                <td colspan="4" class="text-center fw-bold bg-red">Priority level</td>
                <td colspan="4" class="text-center fw-bold">Type</td>
                <td colspan="1" class="text-center fw-bold bg-blue">BANK NAME</td>
                <td colspan="4" class="text-center fw-bold">ITEMS DELIVERY</td>
                <td colspan="5" class="text-center fw-bold">BOOK KEEPER</td>
            </tr>
            <tr>
                <td colspan="1" class="text-center" style="width: 32px">
                    @if($request->priority_level === App\Enums\RequestPriorityLevel::LOW)
                        <input type="checkbox" name="LOW" disabled="" checked>
                    @else
                        <input type="checkbox" name="LOW" disabled="">
                    @endif
                </td>
                <td colspan="2">Low</td>
                <td colspan="1">5 days</td>
                <td colspan="1" class="text-center" style="width: 32px">
                    <input type="checkbox">
                </td>
                <td colspan="3"></td>
                <td colspan="1">
                    <select id="bankNameSelection" class="w-100 h-100 border-0 box outline-0">
                        <option value="-1" selected>SELECT AN OPTION</option>
                        @foreach($bank_names as $bankName)
                            <option class="text-dark" value="{{$bankName->id}}">{{$bankName->name}}</option>
                        @endforeach
                    </select>
                </td>
                <td colspan="1" class="text-center" style="width: 32px">
                    <input type="checkbox">
                </td>
                <td colspan="3">Complete</td>
                <td colspan="5">APPROVED</td>
            </tr>
            <tr>
                <td colspan="1" class="text-center">
                    @if($request->priority_level === App\Enums\RequestPriorityLevel::MEDUIM)
                        <input type="checkbox" name="MEDIUM" disabled="" checked>
                    @else
                        <input type="checkbox" name="MEDIUM" disabled="">
                    @endif
                </td>
                <td colspan="2">Medium</td>
                <td colspan="1">3 days</td>
                <td colspan="1" class="text-center">
                    <input type="checkbox">
                </td>
                <td colspan="3"></td>
                <td colspan="1" class="text-center fw-bold bg-blue">BANK CODE</td>
                <td colspan="1" class="text-center">
                    <input type="checkbox">
                </td>
                <td colspan="3">Incomplete</td>
                <td colspan="5">2024-08-12 16:08</td>
            </tr>
            <tr>
                <td colspan="1" class="text-center">
                    @if($request->priority_level === App\Enums\RequestPriorityLevel::HIGH)
                        <input type="checkbox" name="HIGH" disabled="" checked>
                    @else
                        <input type="checkbox" name="HIGH" disabled="">
                    @endif
                </td>
                <td colspan="2">High</td>
                <td colspan="1">1 day</td>
                <td colspan="1" class="text-center">
                    <input type="checkbox">
                </td>
                <td colspan="3"></td>
                <td colspan="1">
                    <select id="bankCodeSelection" class="w-100 h-100 border-0 box outline-0">
                        <option value="-1" selected>SELECT AN OPTON</option>
                        @foreach($bank_codes as $bankCode)
                            <option class="text-dark" value="{{$bankCode->id}}">{{$bankCode->code}}</option>
                        @endforeach
                    </select>
                </td>
                <td colspan="4"> SUPPLIER VERIFICATION</td>
                <td colspan="5">ACCOUNTANT</td>
            </tr>
            <tr>
                <td colspan="4">ATTACHMENT</td>
                <td colspan="1" class="text-center">
                    <input type="checkbox">
                </td>
                <td colspan="3"></td>
                <td colspan="1" class="bg-blue fw-bold text-center">CHECK NUMBER</td>
                <td colspan="1" class="text-center">
                    <input type="checkbox">
                </td>
                <td colspan="3">Yes</td>
                <td colspan="5">Priority</td>
            </tr>
            <tr>
                <td colspan="1" class="text-center">
                    <input type="checkbox">
                </td>
                <td colspan="3">With</td>
                <td colspan="1" class="text-center">
                    <input type="checkbox">
                </td>
                <td colspan="3"></td>
                <td colspan="1">
                    <input id="checkNumberInput" class="w-100 border-0 outline-0">
                </td>
                <td colspan="1" class="text-center">
                    <input type="checkbox">
                </td>
                <td colspan="3">No</td>
                <td colspan="5">2024-08-12 16:08</td>
            </tr>
            <tr>
                <td colspan="1" class="text-center">
                    <input type="checkbox">
                </td>
                <td colspan="3">Without</td>
                <td colspan="1" class="text-center">
                    <input type="checkbox">
                </td>
                <td colspan="3"></td>
                <td colspan="1"></td>
                <td colspan="4" class="text-center fw-bold">VAT INPUT AMOUNT</td>
                <td colspan="5">FINANCE</td>
            </tr>
            <tr>
                <td colspan="4">Type</td>
                <td colspan="1" class="text-center">
                    <input type="checkbox">
                </td>
                <td colspan="3"></td>
                <td colspan="1"></td>
                <td colspan="4" class="text-center fw-bold"></td>
                <td colspan="5">Pending</td>
            </tr>
            <tr>
                <td colspan="1" class="text-center">
                    <input type="checkbox">
                </td>
                <td colspan="3">OPEX</td>
                <td colspan="1" class="text-center">
                    <input type="checkbox">
                </td>
                <td colspan="3"></td>
                <td colspan="1"></td>
                <td colspan="4" class="text-center fw-bold"></td>
                <td colspan="5"></td>
            </tr>
            <tr>
                <td colspan="1" class="text-center">
                    <input type="checkbox">
                </td>
                <td colspan="3">NON OPEX</td>
                <td colspan="1" class="text-center">
                    <input type="checkbox">
                </td>
                <td colspan="3"></td>
                <td colspan="1"></td>
                <td colspan="2" class="fw-bold">PO No.</td>
                <td colspan="2"></td>
                <td colspan="5">AUDITOR</td>
            </tr>
            <tr>
                <td colspan="4">Receipt</td>
                <td colspan="1" class="text-center">
                    <input type="checkbox">
                </td>
                <td colspan="3"></td>
                <td colspan="1"></td>
                <td colspan="2" class="fw-bold">Invoice No</td>
                <td colspan="2"></td>
                <td colspan="5"></td>
            </tr>
            <tr>
                <td colspan="1" class="text-center">
                    <input type="checkbox">
                </td>
                <td colspan="3">Official Receipt VAT</td>
                <td colspan="1" class="text-center">
                    <input type="checkbox">
                </td>
                <td colspan="3"></td>
                <td colspan="1"></td>
                <td colspan="2" class="fw-bold">Bill No.</td>
                <td colspan="2"></td>
                <td colspan="5">AUDITOR</td>
            </tr>
            <tr>
                <td colspan="1" class="text-center">
                    <input type="checkbox">
                </td>
                <td colspan="3">Delivery Receipt</td>
                <td colspan="1" class="text-center">
                    <input type="checkbox">
                </td>
                <td colspan="3"></td>
                <td colspan="1"></td>
                <td colspan="2" class="fw-bold">OR No</td>
                <td colspan="2"></td>
                <td colspan="4" rowspan="2"></td>
                <td colspan="1" rowspan="2" class="text-center fw-bold align-middle">
                        RCA
                </td>
            </tr>
            <tr>
                <td colspan="1" class="text-center">
                    <input type="checkbox">
                </td>
                <td colspan="3">None</td>
                <td colspan="1" class="text-center">
                    <input type="checkbox">
                </td>
                <td colspan="4">
                    <div class="d-flex">
                        <label>Others</label>
                        <input>
                    </div>
                </td>
                <td colspan="2" class="fw-bold">Voucher No</td>
                <td colspan="2"></td>
            </tr>
            <tr>
                <td class="text-center bg-dark text-white" colspan="18"></td>
            </tr>
        </tbody>
    </table>
</div>

<div>
    <div class="container p-3 mx-auto" style="position: relative; min-width: 13in;">

    <div class="row m-0 p-0 mb-3">
        <button class="btn btn-outline-success rounded-0 btn-sm w-25 mx-auto" type="button" onclick="download_print();">
            <small><b>Download</b></small>
            <i class="fas fa-download" style="margin-left: 5px;"></i>
        </button>
        <button class="btn btn-outline-dark rounded-0 btn-sm w-25 mx-auto" type="button" onclick="show_logs();">
            <small><b>Logs</b></small>
        </button>
    </div>

    <div class="row m-0 p-0 mb-3 bg-white" id="logs" style="display: none;">
        <div class="col-12 m-0 p-4" style="max-height: 250px; overflow-y: auto;" id="logs_container">
            <!-- DYNAMIC -->
        </div>
    </div>

    <div class="row m-0 p-0 mb-3" id="requested_item" style="display: none;">
        <div class="col-12 bg-white p-3">
            <div class="row">

                <div class="col-12">
                    <div class="row m-0 p-2" id="requested_item_container">
                        <!-- DYNAMIC SETTINGS -->
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="row m-0 py-4 px-2 bg-white w-100" id="printable">

    <div>

    <div class="d-flex">

    <div>
        <div class="border border-dark" style="width: 100px; height: 100px; display: flex; align-items: center; justify-content: center;">
            <img src="./src/logos/PERSONAL_LOGO.png" class="img-fluid" alt="LOGO" style="height: 100px; width: auto;">
        </div>
        <div class="bg-danger text-center text-white border border-dark" style="width: 100px; border-style: none solid none solid !important;">
            <strong>{{$request->company->name}}</strong>
        </div>
    </div>

    <div style="font-size: 70px;" class="m-0 ms-5 px-5 border border-5 border-danger text-danger text-center">PENDING</div>

    <div class="ms-auto">
        <div class="bg-danger text-center text-white border border-dark px-2" style="border-style: solid solid none solid !important;">
            <b>PAYMENT STATUS</b>
        </div>

        <div class="border border-dark" style="display: flex; align-items: center; justify-content: center; flex-direction: column;">
            <div class="w-100" style="display: flex; flex-direction: row;">
                <div class="w-25 text-center border border-dark" style="border-style: none solid solid none !important;">
                    <input type="checkbox" name="FUNDED" disabled="">
                </div>
                <div class="w-75 text-start border border-dark px-2" style="border-style: none none solid none !important;">
                    <small>FUNDED</small>
                </div>
            </div>

            <div class="w-100" style="display: flex; flex-direction: row;">
                <div class="w-25 text-center border border-dark" style="border-style: none solid none none !important;">
                    <input type="checkbox" name="DECLINED" disabled="">
                </div>
                <div class="w-75 text-start border border-dark px-2" style="border-style: none none none none !important;">
                    <small>DECLINED</small>
                </div>
            </div>
        </div>
    </div>

    <div class="ms-2" style="width: 150px;">
        <div class="bg-danger text-center text-white border border-dark px-2" style="border-style: solid solid none solid !important;">
            <b>STATUS</b>
        </div>
        <div class="border border-dark" style="height: 100px; display: flex; align-items: center; justify-content: center;">

        <h1 class="text-danger">CLOSE</h1>
        </div>
    </div>

    <div class="ms-2">
        <div class="bg-danger text-center text-white border border-dark px-2" style="border-style: solid solid none solid !important;">
            <b>REQUEST FORM NUMBER</b>
        </div>
        <div class="border border-dark" style="height: 100px; display: flex; align-items: center; justify-content: center;">
            <h1><b>{{ $request->id}}</b></h1>
        </div>
    </div>

    </div>

    <br>

    <div class="row m-0">
    <div class="col-8 border border-dark" style="border-style: solid solid none solid !important;">
        <div class="row m-0">
            <div class="col-3 border border-dark" style="border-style: none solid none none !important;">
                <b>Date :</b>
            </div>
            <div class="col-9">
                <small>{{$request->created_at->format('Y-m-d H:m')}}</small>
            </div>
        </div>
    </div>
    <div class="col-4 border border-dark" style="border-style: solid solid none none !important;">
        <div class="row m-0">
            <div class="col-4 border border-dark" style="border-style: none solid none none !important;">
                <b>CV NO :</b>
            </div>
            <div class="col-8">
                <small></small>
            </div>
        </div>
    </div>

    <div class="col-8 border border-dark" style="border-style: solid solid none solid !important;">
        <div class="row m-0">
            <div class="col-3 border border-dark" style="border-style: none solid none none !important;">
                <b>Supplier :</b>
            </div>
            <div class="col-9">

                @management
                    <small>{{$requst->supplier}}</small>
                @else
                    <small>[HIDDEN]</small>
                @endmanagement


            </div>
        </div>
    </div>
    <div class="col-4 border border-dark" style="border-style: solid solid none none !important;">
        <div class="row m-0">
            <div class="col-4 border border-dark" style="border-style: none solid none none !important;">
                <b>REF NO :</b>
            </div>
            <div class="col-8">
                <small>{{ $request->reference}}</small>
            </div>
        </div>
    </div>

    <div class="col-12 border border-dark" style="border-style: solid solid none solid !important;">
        <div class="row m-0">
            <div class="col-3 border border-dark" style="border-style: none solid none none !important;">
                <b>Paid to :</b>
            </div>
            <div class="col-9">
                @management
                    <small>{{$requst->paid_to}}</small>
                @else
                    <small>[HIDDEN]</small>
                @endmanagement
            </div>
        </div>
    </div>

    <div class="col-12 border border-dark" style="border-style: solid solid none solid !important;">
        <div class="row m-0">
            <div class="col-3 border border-dark" style="border-style: none solid none none !important;">
                <b>Requested by :</b>
            </div>
            <div class="col-9">
                <small class="text-capitalize">{{ $request->request_by}}</small>
            </div>
        </div>
    </div>

    <div class="col-12 border border-dark" style="border-style: solid solid none solid !important;">
        <div class="row m-0">
            <div class="col-3 border border-dark" style="border-style: none solid none none !important;">
                <b>Prepared by :</b>
            </div>
            <div class="col-9">
                <small class="text-capitalize">{{ $request->preparedBy->name}}</small>
            </div>
        </div>
    </div>

    <div class="bg-dark border border-dark m-0 p-0 text-center">
        <small class="text-white">EXPENSE REQUEST</small>
    </div>

    <div class="row p-0 m-0">
        <div class="col-12">
            <div class="row">
                <div class="col-9">
                    <div class="row">
                        <div class="col-1 text-center m-0 p-0 border border-dark px-2" style="border-style: none none solid solid !important; background: rgba(0, 0, 0, 0.2); word-wrap: break-word;">
                            <b>QTY</b>
                        </div>
                        <div class="col-2 text-center m-0 p-0 border border-dark px-2" style="border-style: none none solid solid !important; background: rgba(0, 0, 0, 0.2); word-wrap: break-word;">
                            <b>UOM</b>
                        </div>
                        <div class="col-2 text-center m-0 p-0 border border-dark px-2" style="border-style: none none solid solid !important; background: rgba(0, 0, 0, 0.2); word-wrap: break-word;">
                            <b>JOB ORDER</b>
                        </div>
                        <div class="col-3 text-center m-0 p-0 border border-dark px-2" style="border-style: none none solid solid !important; background: rgba(0, 0, 0, 0.2); word-wrap: break-word;">
                            <b>DESCRIPTION</b>
                        </div>
                        <div class="col-2 text-center m-0 p-0 border border-dark px-2" style="border-style: none none solid solid !important; background: rgba(0, 0, 0, 0.2); word-wrap: break-word;">
                            <b>UNIT COST</b>
                        </div>
                        <div class="col-2 text-center m-0 p-0 border border-dark px-2" style="border-style: none none solid solid !important; background: rgba(0, 0, 0, 0.2); word-wrap: break-word;">
                            <b>TOTAL</b>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="row">
                        <div class="col-6 text-center m-0 p-0 border border-dark px-2" style="border-style: none none solid solid !important; background: rgba(0, 0, 0, 0.2); word-wrap: break-word;">
                            <b>STATUS</b>
                        </div>
                        <div class="col-6 text-center m-0 p-0 border border-dark px-2" style="border-style: none solid solid solid !important; background: rgba(0, 0, 0, 0.2); word-wrap: break-word;">
                            <b>REMARKS</b>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row expense_item">
                @foreach ($request->items as $item)
                    <div class="col-9">
                        <div class="row">
                                <div class="col-1 text-center m-0 p-0 border border-dark px-2" style="border-style: none none solid solid !important; overflow: hidden; text-overflow: ellipsis;">
                                    <small style="text-wrap: nowrap;"> {{$item->quantity}}</small>
                                </div>
                                <div class="col-2 text-start m-0 p-0 border border-dark px-2" style="border-style: none none solid solid !important; overflow: hidden; text-overflow: ellipsis;">
                                    <small style="text-wrap: nowrap;">{{$item->measurement->name}}</small>
                                </div>
                                <div class="col-2 text-start m-0 p-0 border border-dark px-2" style="border-style: none none solid solid !important; overflow: hidden; text-overflow: ellipsis;">
                                    <small style="text-wrap: nowrap;">{{$item->jobOrder->name}}</small>
                                </div>
                                <div class="col-3 text-start m-0 p-0 border border-dark px-2 d-flex align-items-center" style="border-style: none none solid solid !important; overflow: hidden; text-overflow: ellipsis;">

                                    <div class="border m-0 p-0 d-flex align-items-center justify-content-center ms-2 me-3" style="height: 20px; width: 20px;">
                                        <img src="../temp/664ecc86248ca.jpg" style="height: 100%; width: auto;" name="thumbnail">
                                    </div>

                                    <small style="text-wrap: nowrap;">{{$item->description}}</small>
                                </div>
                                <div class="col-2 text-end m-0 p-0 border border-dark px-2" style="border-style: none none solid solid !important; overflow: hidden; text-overflow: ellipsis;">
                                    <small style="text-wrap: nowrap;">{{$item->cost}}</small>
                                </div>
                                <div class="col-2 text-end m-0 p-0 border border-dark px-2" style="border-style: none none solid solid !important; overflow: hidden; text-overflow: ellipsis;">
                                    <small style="text-wrap: nowrap;">{{$item->total}}</small>
                                </div>
                        </div>

                    </div>
                    <div class="col-3">
                        <div class="row">
                            <div class="col-6 text-start m-0 p-0 border border-dark px-2" style="border-style: none none solid solid !important; overflow: hidden; text-overflow: ellipsis;">
                                <small class="text-lowercase" style="text-wrap: nowrap;">{{$item->status}}</small>
                            </div>
                            <div class="col-6 text-start m-0 p-0 border border-dark px-2" style="border-style: none solid solid solid !important; overflow: hidden; text-overflow: ellipsis;">
                                <small style="text-wrap: nowrap;">{{$item->remarks}}</small>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row">
                <div class="col-9">
                    <div class="row">
                        <div class="text-end col-8 border border-dark" style="border-style: none none solid solid !important; background: rgba(0, 0, 0, 0.2);">
                            <b>TOTAL</b>
                        </div>
                        <div class="text-end col-4 border border-dark px-2" style="border-style: none none solid solid !important;">
                            <small>{{$request->total}}</small>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="row text-center">
                        <div class="text-center col-12 border border-dark" style="border-style: none solid solid solid !important; background: rgba(0, 0, 0, 0.2);">
                            <b>{{$request->fund}}</b>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="bg-dark border border-dark m-0 p-0 text-center">
        <small class="text-white">PURCHASE REQUEST</small>
    </div>

    <div class="row p-0 m-0">
        <div class="col-12">
            <div class="row">
                <div class="col-2 text-start m-0 p-0 border border-dark px-2" style="border-style: none none solid solid !important; background: rgba(0, 0, 0, 0.2);">
                    <b>Supplier:</b>
                </div>
                <div class="col-4 text-start m-0 p-0 border border-dark" style="border-style: none none solid solid !important;">
                    <small>
                        @management
                            <input type="text" class="w-100 rounded-0 border-0 px-2" value="{{$request->supplier}}" name="paid_to" disabled="">
                        @else
                            <input type="text" class="w-100 rounded-0 border-0 px-2" value="[HIDDEN]" name="paid_to" disabled="">
                        @endmanagement
                     </small>
                </div>
                <div class="col-2 text-start m-0 p-0 border border-dark px-2" style="border-style: none solid solid solid !important; background: rgba(0, 0, 0, 0.2);">
                    <b>Payment Type:</b>
                </div>
                <div class="col-4 text-start m-0 p-0 border border-dark" style="border-style: none solid solid none !important;">
                    <select class="w-100 rounded-0 border-0 px-2" name="payment_type" disabled="">
                        @if($request->payment_method != \App\Enums\PaymentMethod::NONE)
                            <option selected>{{$request->payment_method->name}}</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-2 text-start m-0 p-0 border border-dark px-2" style="border-style: none none solid solid !important; background: rgba(0, 0, 0, 0.2);">
                    <b>Paid to:</b>
                </div>
                <div class="col-4 text-start m-0 p-0 border border-dark" style="border-style: none none solid solid !important;">
                    <small>
                        @management
                            <input type="text" class="w-100 rounded-0 border-0 px-2" value="{{$request->paid_to}}" name="paid_to" disabled="">
                        @else
                            <input type="text" class="w-100 rounded-0 border-0 px-2" value="[HIDDEN]" name="paid_to" disabled="">
                        @endmanagement
                   </small>
                </div>
                <div class="col-2 text-start m-0 p-0 border border-dark px-2" style="border-style: none solid solid solid !important; background: rgba(0, 0, 0, 0.2);">
                    <b>Terms:</b>
                </div>
                <div class="col-4 text-start m-0 p-0 border border-dark" style="border-style: none solid solid none !important;">
                    <small><input type="text" class="w-100 rounded-0 border-0 px-2" value="" name="terms" disabled=""></small>
                </div>
            </div>
        </div>
    </div>

    <div class="row m-0 p-0">
        <div class="col-2 text-center m-0 p-0 border border-dark px-2" style="border-style: none none solid solid !important; background: rgba(255, 255, 0, 0.4); word-wrap: break-word;">
            <b>QTY</b>
        </div>
        <div class="col-2 text-center m-0 p-0 border border-dark px-2" style="border-style: none none solid solid !important; background: rgba(255, 255, 0, 0.4); word-wrap: break-word;">
            <b>UOM</b>
        </div>
        <div class="col-2 text-center m-0 p-0 border border-dark px-2" style="border-style: none none solid solid !important; background: rgba(255, 255, 0, 0.4); word-wrap: break-word;">
            <b>JOB ORDER</b>
        </div>
        <div class="col-2 text-center m-0 p-0 border border-dark px-2" style="border-style: none none solid solid !important; background: rgba(255, 255, 0, 0.4); word-wrap: break-word;">
            <b>DESCRIPTION</b>
        </div>
        <div class="col-2 text-center m-0 p-0 border border-dark px-2" style="border-style: none none solid solid !important; background: rgba(255, 255, 0, 0.4); word-wrap: break-word;">
            <b>UNIT COST</b>
        </div>
        <div class="col-2 text-center m-0 p-0 border border-dark px-2" style="border-style: none solid solid solid !important; background: rgba(255, 255, 0, 0.4); word-wrap: break-word;">
            <b>TOTAL</b>
        </div>
    </div>


    <div class="row m-0 p-0">

        @foreach($request->getForFundingItems() as $item)
            <div class="col-2 text-center m-0 p-0 border border-dark px-2" style="border-style: none none solid solid !important; word-wrap: break-word;">
                <small>{{$item->quantity}}</small>
            </div>
            <div class="col-2 text-start m-0 p-0 border border-dark px-2" style="border-style: none none solid solid !important; word-wrap: break-word;">
                <small>{{$item->measurement->name}}</small>
            </div>
            <div class="col-2 text-start m-0 p-0 border border-dark px-2" style="border-style: none none solid solid !important; word-wrap: break-word;">
                <small>{{$item->jobOrder->name}}</small>
            </div>
            <div class="col-2 text-start m-0 p-0 border border-dark px-2" style="border-style: none none solid solid !important; word-wrap: break-word;">
                <small>{{$item->description}}</small>
            </div>
            <div class="col-2 text-end m-0 p-0 border border-dark px-2" style="border-style: none none solid solid !important; word-wrap: break-word;">
                <small>{{$item->cost}}</small>
            </div>
            <div class="col-2 text-end m-0 p-0 border border-dark px-2" style="border-style: none solid solid solid !important; word-wrap: break-word;">
                <small>{{$item->total}}</small>
            </div>
        @endforeach
    </div>

    <div class="row m-0 p-0">
        <div class="col-10">
            <div class="row">
                <div class="text-end col-12 border border-dark" style="border-style: none none solid solid !important; background: rgba(255, 255, 0, 0.4);">
                    <b>TOTAL</b>
                </div>
            </div>
        </div>
        <div class="col-2">
            <div class="row text-center">
                <div class="text-center col-12 border border-dark" style="border-style: none solid solid solid !important; background: rgba(255, 255, 0, 0.4);">
                    <b>{{$request->fund}}</b>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-dark border border-dark m-0 p-0 text-center">
        <small class="text-white">VOUCHER</small>
    </div>

    <div class="row p-0 m-0">
        <div class="col-12">
            <div class="row">
                <div class="col-2 text-start m-0 p-0 border border-dark px-2" style="border-style: none none solid solid !important; background: rgba(0, 0, 0, 0.2);">
                    <b>Supplier:</b>
                </div>
                <div class="col-4 text-start m-0 p-0 border border-dark px-2" style="border-style: none none solid solid !important;">
                    @management
                        <small>{{$request->supplier}}</small>
                    @else
                        <small>[HIDDEN]</small>
                    @endmanagement
                </div>
                <div class="col-2 text-start m-0 p-0 border border-dark px-2" style="border-style: none solid solid solid !important; background: rgba(0, 0, 0, 0.2);">
                    <b>Date:</b>
                </div>
                <div class="col-4 text-start m-0 p-0 border border-dark px-2" style="border-style: none solid solid none !important;">
                    <small>{{$request->created_at->format('Y-m-d H:m')}}</small>
                </div>
            </div>


            <div class="row">
                <div class="col-2 text-start m-0 p-0 border border-dark px-2" style="border-style: none none solid solid !important; background: rgba(0, 0, 0, 0.2);">
                    <b>Paid to:</b>
                </div>
                <div class="col-4 text-start m-0 p-0 border border-dark px-2" style="border-style: none none solid solid !important;">
                    @management
                        <small>{{$request->paid_to}}</small>
                    @else
                        <small>[HIDDEN]</small>
                    @endmanagement
                </div>
                <div class="col-2 text-start m-0 p-0 border border-dark px-2" style="border-style: none solid solid solid !important; background: rgba(0, 0, 0, 0.2);">
                    <b>Paid Amount:</b>
                </div>
                <div class="col-4 text-start m-0 p-0 border border-dark px-2" style="border-style: none solid solid none !important;">
                    <small>{{$request->fund}}</small>
                </div>
            </div>

            <div class="row">
                <div class="col-2 text-start m-0 p-0 border border-dark px-2" style="border-style: none none solid solid !important; background: rgba(0, 0, 0, 0.2);">
                    <b>Payment type:</b>
                </div>
                <div class="col-4 text-start m-0 p-0 border border-dark px-2" style="border-style: none none solid solid !important;">
                    <small>{{$request->payment_type}}</small>
                </div>
                <div class="col-2 text-start m-0 p-0 border border-dark px-2" style="border-style: none solid solid solid !important; background: rgba(0, 0, 0, 0.2);">
                    <b>Amount in words:</b>
                </div>
                <div class="col-4 text-start m-0 p-0 border border-dark px-2" style="border-style: none solid solid none !important;">
                    <small>{!! Helper::amountToWords($request->fund) !!}</small>
                </div>
            </div>
        </div>
    </div>
        <div class="col-4 text-center border border-dark" style="border-style: none none solid solid !important; background: rgba(255, 255, 0, 0.4);">
            <small>RELEASED BY :</small>
        </div>
        <div class="col-4 text-center border border-dark" style="border-style: none none solid solid !important; background: rgba(255, 0, 0, 0.4);">
            <small>RECEIVED BY :</small>
        </div>
        <div class="col-4 text-center border border-dark" style="border-style: none solid solid solid !important; background: rgba(75, 200, 75, 0.5);">
            <small>AUDITED BY :</small>
        </div>
    </div>

    <div class="row m-0 p-0">
        <div class="col-4 border border-dark" style="border-style: none none solid solid !important; height: 60px; display: flex; align-items: end; justify-content: center;">
            <small><b>MR. RYLAN C. ALINGAROG</b></small>
        </div>
        <div class="col-4 border border-dark" style="border-style: none none solid solid !important; height: 60px; display: flex; align-items: end; justify-content: center;">
            <small><b>RCA</b></small>
        </div>
        <div class="col-4 border border-dark" style="border-style: none solid solid solid !important; height: 60px; display: flex; align-items: end; justify-content: center;">
            <small><input type="text" class="border-0 text-center" style="font-weight: bold;"></small>
        </div>
    </div>

    <div class="row m-0 p-0">
        <div class="col-4 text-center border border-dark" style="border-style: none none solid solid !important; background: rgba(255, 255, 0, 0.4);">
            <small>Signature Over Printed Name</small>
        </div>
        <div class="col-4 text-center border border-dark" style="border-style: none none solid solid !important; background: rgba(255, 0, 0, 0.4);">
            <small>Signature Over Printed Name</small>
        </div>
        <div class="col-4 text-center border border-dark" style="border-style: none solid solid solid !important; background: rgba(75, 200, 75, 0.5);">
            <small>Signature Over Printed Name</small>
        </div>
    </div>

    <div class="bg-dark border border-dark m-0 p-0 text-center">
        <small>20240523-031</small>
    </div>

    <div class="row m-0">
        <div class="col-6 p-0">
            <div class="text-center border-collapse border border-dark py-2 fw-bold">
                ACCOUNTING DEPARTMENT
            </div>
        </div>
        <div class="col-6 p-0">
            <div class="text-center border-collapse border border-dark py-2 fw-bold">
                AUDITOR DEPARTMENT
            </div>
        </div>
    </div>

    <div class="row m-0 p-0">
        <div class="col-6">
            <div class="row">
                <div class="col-4 border border-dark text-center" style="border-style: none none solid solid !important; background: rgba(255, 0, 0, 0.4);">
                    <small><b>Priority Level</b></small>
                </div>
                <div class="col-4 border border-dark text-center" style="border-style: none none solid solid !important; background: rgba(173, 216, 230, 1.0);">
                    <small><b>TYPE</b></small>
                </div>
                <div class="col-4 border border-dark text-center" style="border-style: none none solid solid !important; background: rgba(173, 216, 230, 1.0);">
                    <small><b>BANK NAME</b></small>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="row">
                <div class="col-6 border border-dark" style="border-style: none none solid solid !important;">
                    <small><b>ITEMS DELIVERY</b></small>
                </div>
                <div class="col-6 border border-dark" style="border-style: none solid solid solid !important; background: rgba(173, 216, 230, 1.0);">
                    <small><b>BOOK KEEPER</b></small>
                </div>
            </div>
        </div>
    </div>

    <div class="row m-0 p-0">
        <div class="col-6">
            <div class="row">
                <div class="col-4">
                    <div class="row">
                        <div class="col-2 p-0 text-center border border-dark" style="border-style: none none none solid !important;">
                            <small>
                                @if($request->priority_level === App\Enums\RequestPriorityLevel::LOW)
                                    <input type="checkbox" name="Low" disabled="" checked>
                                @else
                                    <input type="checkbox" name="Low" disabled="">
                                @endif
                            </small>
                        </div>
                        <div class="col-5 p-0 px-2 border border-dark" style="border-style: none none none solid !important;">
                            <small>Low</small>
                        </div>
                        <div class="col-5 p-0 px-2 border border-dark" style="border-style: none none none solid !important;">
                            <small>5 Days</small>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="row">
                        <div class="col-2 p-0 text-center border border-dark" style="border-style: none none none solid !important;">
                            <small><input type="checkbox" name="type_1l" disabled=""></small>
                        </div>
                        <div class="col-10 m-0 p-0 border border-dark" style="border-style: none none none solid !important;">
                            <small><select class="px-2 h-100 w-100 border-0" name="type_1r" disabled="">
                                <option value=""></option>
                                <option value="Cost of Sales">Cost of Sales</option>
                                <option value="Supplies and materials">Supplies and materials</option>
                                <option value="Cost of labour">Cost of labour</option>
                                <option value="Shipping, Freight and Delivery">Shipping, Freight and Delivery</option>
                                <option value="Freight and delivery">Freight and delivery</option>
                                <option value="Other costs of sales">Other costs of sales</option>
                                <option value="Amortisation expense">Amortisation expense</option>
                                <option value="Bad debts">Bad debts</option>
                                <option value="Bank charges">Bank charges</option>
                                <option value="Commissions and fees">Commissions and fees</option>
                                <option value="Other selling expenses">Other selling expenses</option>
                                <option value="Office/General Administrative Expenses">Office/General Administrative Expenses</option>
                                <option value="Payroll Expenses">Payroll Expenses</option>
                                <option value="Legal and professional fees">Legal and professional fees</option>
                                <option value="Advertising/Promotional">Advertising/Promotional</option>
                                <option value="Dues and Subscriptions">Dues and Subscriptions</option>
                                <option value="Rent or Lease of Buildings">Rent or Lease of Buildings</option>
                                <option value="Travel expenses">Travel expenses</option>
                                <option value="Shipping and delivery expense">Shipping and delivery expense</option>
                                <option value="Meals and entertainment">Meals and entertainment</option>
                                <option value="Repair and maintenance">Repair and maintenance</option>
                                <option value="Equipment rental">Equipment rental</option>
                                <option value="Other Miscellaneous Service Cost">Other Miscellaneous Service Cost</option>
                                <option value="Income tax expense">Income tax expense</option>
                                <option value="Insurance">Insurance</option>
                                <option value="Interest paid">Interest paid</option>
                                <option value="Loss on discontinued operations, net of tax">Loss on discontinued operations, net of tax</option>
                                <option value="Management compensation">Management compensation</option>
                                <option value="Unapplied Cash Bill Payment Expense">Unapplied Cash Bill Payment Expense</option>
                                <option value="Utilities">Utilities</option>
                                <option value="Exchange Gain or Loss">Exchange Gain or Loss</option>
                                <option value="Other Expense">Other Expense</option>
                                <option value="Penalties and settlements">Penalties and settlements</option>
                            </select></small>
                        </div>
                    </div>
                </div>
                <div class="col-4 m-0 p-0 border border-dark" style="border-style: none none solid solid !important;">
                    <small><select class="px-2 w-100 h-100 border-0" name="BANK_NAME" disabled="">
                        <option value="NONE">SELECT AN OPTION</option>
                        <option value="SECURITY BANK">SECURITY BANK</option>
                        <option value="BDO">BDO</option>
                        <option value="METRO BANK">METRO BANK</option>
                        <option value="BPI">BPI</option>
                        <option value="AUB">AUB</option>
                        <option value="CHINA BANK">CHINA BANK</option>
                        <option value="RCBC">RCBC</option>
                        <option value="UNION BANK">UNION BANK</option>
                    </select></small>
                </div>
            </div>
        </div>
        <div class="col-6" "="">
            <div class="row" "="">
                <div class="col-6">
                    <div class="row">
                        <div class="col-2 p-0 text-center border border-dark" style="border-style: none none none solid !important;">
                            <small><input type="checkbox" name="Complete" disabled=""></small>
                        </div>
                        <div class="col-10 p-0 px-2 border border-dark" style="border-style: none none none solid !important; background: rgba(75, 200, 75, 0.5);">
                            <small>Complete</small>
                        </div>
                    </div>
                </div>
                <div class="col-6 border border-dark m-0 p-0" style="border-style: none solid none solid !important;">
                    <small class="px-2">Priority</small>
                </div>
            </div>
        </div>
    </div>

    <div class="row m-0 p-0">
        <div class="col-6">
            <div class="row">
                <div class="col-4">
                    <div class="row">
                        <div class="col-2 p-0 text-center border border-dark" style="border-style: solid none none solid !important;">
                            @if($request->priority_level === App\Enums\RequestPriorityLevel::MEDUIM)
                                <input type="checkbox" name="Medium" disabled="" checked>
                            @else
                                <input type="checkbox" name="Medium" disabled="">
                            @endif
                        </div>
                        <div class="col-5 p-0 px-2 border border-dark" style="border-style: solid none none solid !important;">
                            <small>Medium</small>
                        </div>
                        <div class="col-5 p-0 px-2 border border-dark" style="border-style: solid none none solid !important;">
                            <small>3 Days</small>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="row">
                        <div class="col-2 p-0 text-center border border-dark" style="border-style: solid none none solid !important;">
                            <small><input type="checkbox" name="type_2l" disabled=""></small>
                        </div>
                        <div class="col-10 m-0 p-0 border border-dark" style="border-style: solid none none solid !important;">
                            <small><select class="px-2 h-100 w-100 border-0" name="type_2r" disabled="">
                                <option value=""></option>
                                <option value="Cost of Sales">Cost of Sales</option>
                                <option value="Supplies and materials">Supplies and materials</option>
                                <option value="Cost of labour">Cost of labour</option>
                                <option value="Shipping, Freight and Delivery">Shipping, Freight and Delivery</option>
                                <option value="Freight and delivery">Freight and delivery</option>
                                <option value="Other costs of sales">Other costs of sales</option>
                                <option value="Amortisation expense">Amortisation expense</option>
                                <option value="Bad debts">Bad debts</option>
                                <option value="Bank charges">Bank charges</option>
                                <option value="Commissions and fees">Commissions and fees</option>
                                <option value="Other selling expenses">Other selling expenses</option>
                                <option value="Office/General Administrative Expenses">Office/General Administrative Expenses</option>
                                <option value="Payroll Expenses">Payroll Expenses</option>
                                <option value="Legal and professional fees">Legal and professional fees</option>
                                <option value="Advertising/Promotional">Advertising/Promotional</option>
                                <option value="Dues and Subscriptions">Dues and Subscriptions</option>
                                <option value="Rent or Lease of Buildings">Rent or Lease of Buildings</option>
                                <option value="Travel expenses">Travel expenses</option>
                                <option value="Shipping and delivery expense">Shipping and delivery expense</option>
                                <option value="Meals and entertainment">Meals and entertainment</option>
                                <option value="Repair and maintenance">Repair and maintenance</option>
                                <option value="Equipment rental">Equipment rental</option>
                                <option value="Other Miscellaneous Service Cost">Other Miscellaneous Service Cost</option>
                                <option value="Income tax expense">Income tax expense</option>
                                <option value="Insurance">Insurance</option>
                                <option value="Interest paid">Interest paid</option>
                                <option value="Loss on discontinued operations, net of tax">Loss on discontinued operations, net of tax</option>
                                <option value="Management compensation">Management compensation</option>
                                <option value="Unapplied Cash Bill Payment Expense">Unapplied Cash Bill Payment Expense</option>
                                <option value="Utilities">Utilities</option>
                                <option value="Exchange Gain or Loss">Exchange Gain or Loss</option>
                                <option value="Other Expense">Other Expense</option>
                                <option value="Penalties and settlements">Penalties and settlements</option>
                            </select></small>
                        </div>
                    </div>
                </div>
                <div class="col-4 border border-dark text-center" style="border-style: solid none none solid !important; background: rgba(173, 216, 230, 1.0);">
                    <small><b>BANK CODE</b></small>
                </div>
            </div>
        </div>
        <div class="col-6" "="">
            <div class="row" "="">
                <div class="col-6">
                    <div class="row">
                        <div class="col-2 p-0 text-center border border-dark" style="border-style: solid none none solid !important;">
                            <small><input type="checkbox" name="Incomplete" disabled=""></small>
                        </div>
                        <div class="col-10 p-0 px-2 border border-dark" style="border-style: solid none none solid !important; background: rgba(173, 216, 230, 1.0);">
                            <small>Incomplete</small>
                        </div>
                    </div>
                </div>
                <div class="col-6 border border-dark m-0 px-2" style="border-style: solid solid none solid !important;">
                    <small>2024-05-23 12:56</small>
                </div>
            </div>
        </div>
    </div>

    <div class="row m-0 p-0">
        <div class="col-6">
            <div class="row">
                <div class="col-4">
                    <div class="row">
                        <div class="col-2 p-0 text-center border border-dark" style="border-style: solid none none solid !important;">
                            <small><input type="checkbox" name="High" disabled=""></small>
                        </div>
                        <div class="col-5 p-0 px-2 border border-dark" style="border-style: solid none none solid !important;">
                            <small>High</small>
                        </div>
                        <div class="col-5 p-0 px-2 border border-dark" style="border-style: solid none none solid !important;">
                            <small>1 Day</small>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="row">
                        <div class="col-2 p-0 text-center border border-dark" style="border-style: solid none none solid !important;">
                            <small><input type="checkbox" name="type_3l" disabled=""></small>
                        </div>
                        <div class="col-10 m-0 p-0 border border-dark" style="border-style: solid none none solid !important;">
                            <small><select class="px-2 h-100 w-100 border-0" name="type_3r" disabled="">
                                <option value=""></option>
                                <option value="Cost of Sales">Cost of Sales</option>
                                <option value="Supplies and materials">Supplies and materials</option>
                                <option value="Cost of labour">Cost of labour</option>
                                <option value="Shipping, Freight and Delivery">Shipping, Freight and Delivery</option>
                                <option value="Freight and delivery">Freight and delivery</option>
                                <option value="Other costs of sales">Other costs of sales</option>
                                <option value="Amortisation expense">Amortisation expense</option>
                                <option value="Bad debts">Bad debts</option>
                                <option value="Bank charges">Bank charges</option>
                                <option value="Commissions and fees">Commissions and fees</option>
                                <option value="Other selling expenses">Other selling expenses</option>
                                <option value="Office/General Administrative Expenses">Office/General Administrative Expenses</option>
                                <option value="Payroll Expenses">Payroll Expenses</option>
                                <option value="Legal and professional fees">Legal and professional fees</option>
                                <option value="Advertising/Promotional">Advertising/Promotional</option>
                                <option value="Dues and Subscriptions">Dues and Subscriptions</option>
                                <option value="Rent or Lease of Buildings">Rent or Lease of Buildings</option>
                                <option value="Travel expenses">Travel expenses</option>
                                <option value="Shipping and delivery expense">Shipping and delivery expense</option>
                                <option value="Meals and entertainment">Meals and entertainment</option>
                                <option value="Repair and maintenance">Repair and maintenance</option>
                                <option value="Equipment rental">Equipment rental</option>
                                <option value="Other Miscellaneous Service Cost">Other Miscellaneous Service Cost</option>
                                <option value="Income tax expense">Income tax expense</option>
                                <option value="Insurance">Insurance</option>
                                <option value="Interest paid">Interest paid</option>
                                <option value="Loss on discontinued operations, net of tax">Loss on discontinued operations, net of tax</option>
                                <option value="Management compensation">Management compensation</option>
                                <option value="Unapplied Cash Bill Payment Expense">Unapplied Cash Bill Payment Expense</option>
                                <option value="Utilities">Utilities</option>
                                <option value="Exchange Gain or Loss">Exchange Gain or Loss</option>
                                <option value="Other Expense">Other Expense</option>
                                <option value="Penalties and settlements">Penalties and settlements</option>
                            </select></small>
                        </div>
                    </div>
                </div>
                <div class="col-4 m-0 p-0 border border-dark text-center" style="border-style: solid none none solid !important;">
                    <small><select class="px-2 w-100 h-100 border-0" name="BANK_CODE" disabled="">
                        <option value="NONE">SELECT AN OPTION</option>
                        <option value="SB-GTI-9791">SB-GTI-9791</option>
                        <option value="SB-RCA-1810">SB-RCA-1810</option>
                        <option value="BDO-Guntech-0559">BDO-Guntech-0559</option>
                        <option value="BDO-GTI-3561">BDO-GTI-3561</option>
                        <option value="BDO-RCA-5143">BDO-RCA-5143</option>
                        <option value="BDO-NOV-2603">BDO-NOV-2603</option>
                        <option value="MTB-GTI-1579">MTB-GTI-1579</option>
                        <option value="MTB-GTIUSD-0619">MTB-GTIUSD-0619</option>
                        <option value="AUB-Ballistic-0494">AUB-Ballistic-0494</option>
                        <option value="AUB-RCA-7916">AUB-RCA-7916</option>
                    </select></small>
                </div>
            </div>
        </div>
        <div class="col-6" "="">
            <div class="row" "="">
                <div class="col-6 border border-dark" style="border-style: solid none none solid !important;">
                    <small><b>SUPPLIER VERIFICATION</b></small>
                </div>
                <div class="col-6 border border-dark" style="border-style: solid solid none solid !important; background: rgba(173, 216, 230, 1.0);">
                    <small><b>ACCOUNTANT</b></small>
                </div>
            </div>
        </div>
    </div>

    <div class="row m-0 p-0">
        <div class="col-6">
            <div class="row">
                <div class="col-4 border border-dark text-center" style="border-style: solid none none solid !important; background: rgba(255, 0, 0, 0.4);">
                    <small><b>Attachment</b></small>
                </div>
                <div class="col-4">
                    <div class="row">
                        <div class="col-2 p-0 text-center border border-dark" style="border-style: solid none none solid !important;">
                            <small><input type="checkbox" name="type_4l" disabled=""></small>
                        </div>
                        <div class="col-10 m-0 p-0 border border-dark" style="border-style: solid none none solid !important;">
                            <small><select class="px-2 h-100 w-100 border-0" name="type_4r" disabled="">
                                <option value=""></option>
                                <option value="Cost of Sales">Cost of Sales</option>
                                <option value="Supplies and materials">Supplies and materials</option>
                                <option value="Cost of labour">Cost of labour</option>
                                <option value="Shipping, Freight and Delivery">Shipping, Freight and Delivery</option>
                                <option value="Freight and delivery">Freight and delivery</option>
                                <option value="Other costs of sales">Other costs of sales</option>
                                <option value="Amortisation expense">Amortisation expense</option>
                                <option value="Bad debts">Bad debts</option>
                                <option value="Bank charges">Bank charges</option>
                                <option value="Commissions and fees">Commissions and fees</option>
                                <option value="Other selling expenses">Other selling expenses</option>
                                <option value="Office/General Administrative Expenses">Office/General Administrative Expenses</option>
                                <option value="Payroll Expenses">Payroll Expenses</option>
                                <option value="Legal and professional fees">Legal and professional fees</option>
                                <option value="Advertising/Promotional">Advertising/Promotional</option>
                                <option value="Dues and Subscriptions">Dues and Subscriptions</option>
                                <option value="Rent or Lease of Buildings">Rent or Lease of Buildings</option>
                                <option value="Travel expenses">Travel expenses</option>
                                <option value="Shipping and delivery expense">Shipping and delivery expense</option>
                                <option value="Meals and entertainment">Meals and entertainment</option>
                                <option value="Repair and maintenance">Repair and maintenance</option>
                                <option value="Equipment rental">Equipment rental</option>
                                <option value="Other Miscellaneous Service Cost">Other Miscellaneous Service Cost</option>
                                <option value="Income tax expense">Income tax expense</option>
                                <option value="Insurance">Insurance</option>
                                <option value="Interest paid">Interest paid</option>
                                <option value="Loss on discontinued operations, net of tax">Loss on discontinued operations, net of tax</option>
                                <option value="Management compensation">Management compensation</option>
                                <option value="Unapplied Cash Bill Payment Expense">Unapplied Cash Bill Payment Expense</option>
                                <option value="Utilities">Utilities</option>
                                <option value="Exchange Gain or Loss">Exchange Gain or Loss</option>
                                <option value="Other Expense">Other Expense</option>
                                <option value="Penalties and settlements">Penalties and settlements</option>
                            </select></small>
                        </div>
                    </div>
                </div>
                <div class="col-4 m-0 p-0 border border-dark text-center" style="border-style: solid none none solid !important; background: rgba(173, 216, 230, 1.0);">
                    <small><b>CHECK NUMBER</b></small>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="row">
                <div class="col-6">
                    <div class="row">
                        <div class="col-2 p-0 text-center border border-dark" style="border-style: solid none none solid !important;">
                            <small><input type="checkbox" name="Yes" disabled=""></small>
                        </div>
                        <div class="col-10 p-0 px-2 border border-dark" style="border-style: solid none none solid !important;">
                            <small>Yes</small>
                        </div>
                    </div>
                </div>
                <div class="col-6 border border-dark m-0 p-0" style="border-style: solid solid none solid !important;">
                    <small class="px-2">Priority</small>
                </div>
            </div>
        </div>
    </div>

    <div class="row m-0 p-0">
        <div class="col-6">
            <div class="row">
                <div class="col-4">
                    <div class="row">
                        <div class="col-2 p-0 text-center border border-dark" style="border-style: solid none none solid !important;">
                            <small><input type="checkbox" name="With" disabled=""></small>
                        </div>
                        <div class="col-10 m-0 px-2 border border-dark" style="border-style: solid none none solid !important;">
                            <small>With</small>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="row">
                        <div class="col-2 p-0 text-center border border-dark" style="border-style: solid none none solid !important;">
                            <small><input type="checkbox" name="type_5l" disabled=""></small>
                        </div>
                        <div class="col-10 m-0 p-0 border border-dark" style="border-style: solid none none solid !important;">
                            <small><select class="px-2 h-100 w-100 border-0" name="type_5r" disabled="">
                                <option value=""></option>
                                <option value="Cost of Sales">Cost of Sales</option>
                                <option value="Supplies and materials">Supplies and materials</option>
                                <option value="Cost of labour">Cost of labour</option>
                                <option value="Shipping, Freight and Delivery">Shipping, Freight and Delivery</option>
                                <option value="Freight and delivery">Freight and delivery</option>
                                <option value="Other costs of sales">Other costs of sales</option>
                                <option value="Amortisation expense">Amortisation expense</option>
                                <option value="Bad debts">Bad debts</option>
                                <option value="Bank charges">Bank charges</option>
                                <option value="Commissions and fees">Commissions and fees</option>
                                <option value="Other selling expenses">Other selling expenses</option>
                                <option value="Office/General Administrative Expenses">Office/General Administrative Expenses</option>
                                <option value="Payroll Expenses">Payroll Expenses</option>
                                <option value="Legal and professional fees">Legal and professional fees</option>
                                <option value="Advertising/Promotional">Advertising/Promotional</option>
                                <option value="Dues and Subscriptions">Dues and Subscriptions</option>
                                <option value="Rent or Lease of Buildings">Rent or Lease of Buildings</option>
                                <option value="Travel expenses">Travel expenses</option>
                                <option value="Shipping and delivery expense">Shipping and delivery expense</option>
                                <option value="Meals and entertainment">Meals and entertainment</option>
                                <option value="Repair and maintenance">Repair and maintenance</option>
                                <option value="Equipment rental">Equipment rental</option>
                                <option value="Other Miscellaneous Service Cost">Other Miscellaneous Service Cost</option>
                                <option value="Income tax expense">Income tax expense</option>
                                <option value="Insurance">Insurance</option>
                                <option value="Interest paid">Interest paid</option>
                                <option value="Loss on discontinued operations, net of tax">Loss on discontinued operations, net of tax</option>
                                <option value="Management compensation">Management compensation</option>
                                <option value="Unapplied Cash Bill Payment Expense">Unapplied Cash Bill Payment Expense</option>
                                <option value="Utilities">Utilities</option>
                                <option value="Exchange Gain or Loss">Exchange Gain or Loss</option>
                                <option value="Other Expense">Other Expense</option>
                                <option value="Penalties and settlements">Penalties and settlements</option>
                            </select></small>
                        </div>
                    </div>
                </div>
                <div class="col-4 m-0 p-0 border border-dark text-center" style="border-style: solid none none solid !important;">
                    <input type="text" class="px-2 w-100 h-100 border-0" name="CHECK_NUMBER" disabled="">
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="row">
                <div class="col-6">
                    <div class="row">
                        <div class="col-2 p-0 text-center border border-dark" style="border-style: solid none none solid !important;">
                            <small><input type="checkbox" name="No" disabled=""></small>
                        </div>
                        <div class="col-10 p-0 px-2 border border-dark" style="border-style: solid none none solid !important;">
                            <small>No</small>
                        </div>
                    </div>
                </div>
                <div class="col-6 border border-dark m-0 px-2" style="border-style: solid solid none solid !important;">
                    <small>2024-05-23 12:56</small>
                </div>
            </div>
        </div>
    </div>

    <div class="row m-0 p-0">
        <div class="col-6">
            <div class="row">
                <div class="col-4">
                    <div class="row">
                        <div class="col-2 p-0 text-center border border-dark" style="border-style: solid none none solid !important;">
                            <small><input type="checkbox" name="Without" disabled=""></small>
                        </div>
                        <div class="col-10 p-0 px-2 border border-dark" style="border-style: solid none none solid !important;">
                            <small>Without</small>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="row">
                        <div class="col-2 p-0 text-center border border-dark" style="border-style: solid none none solid !important;">
                            <small><input type="checkbox" name="type_6l" disabled=""></small>
                        </div>
                        <div class="col-10 m-0 p-0 border border-dark" style="border-style: solid none none solid !important;">
                            <small><select class="px-2 h-100 w-100 border-0" name="type_6r" disabled="">
                                <option value=""></option>
                                <option value="Cost of Sales">Cost of Sales</option>
                                <option value="Supplies and materials">Supplies and materials</option>
                                <option value="Cost of labour">Cost of labour</option>
                                <option value="Shipping, Freight and Delivery">Shipping, Freight and Delivery</option>
                                <option value="Freight and delivery">Freight and delivery</option>
                                <option value="Other costs of sales">Other costs of sales</option>
                                <option value="Amortisation expense">Amortisation expense</option>
                                <option value="Bad debts">Bad debts</option>
                                <option value="Bank charges">Bank charges</option>
                                <option value="Commissions and fees">Commissions and fees</option>
                                <option value="Other selling expenses">Other selling expenses</option>
                                <option value="Office/General Administrative Expenses">Office/General Administrative Expenses</option>
                                <option value="Payroll Expenses">Payroll Expenses</option>
                                <option value="Legal and professional fees">Legal and professional fees</option>
                                <option value="Advertising/Promotional">Advertising/Promotional</option>
                                <option value="Dues and Subscriptions">Dues and Subscriptions</option>
                                <option value="Rent or Lease of Buildings">Rent or Lease of Buildings</option>
                                <option value="Travel expenses">Travel expenses</option>
                                <option value="Shipping and delivery expense">Shipping and delivery expense</option>
                                <option value="Meals and entertainment">Meals and entertainment</option>
                                <option value="Repair and maintenance">Repair and maintenance</option>
                                <option value="Equipment rental">Equipment rental</option>
                                <option value="Other Miscellaneous Service Cost">Other Miscellaneous Service Cost</option>
                                <option value="Income tax expense">Income tax expense</option>
                                <option value="Insurance">Insurance</option>
                                <option value="Interest paid">Interest paid</option>
                                <option value="Loss on discontinued operations, net of tax">Loss on discontinued operations, net of tax</option>
                                <option value="Management compensation">Management compensation</option>
                                <option value="Unapplied Cash Bill Payment Expense">Unapplied Cash Bill Payment Expense</option>
                                <option value="Utilities">Utilities</option>
                                <option value="Exchange Gain or Loss">Exchange Gain or Loss</option>
                                <option value="Other Expense">Other Expense</option>
                                <option value="Penalties and settlements">Penalties and settlements</option>
                            </select></small>
                        </div>
                    </div>
                </div>
                <div class="col-4 m-0 p-0 border border-dark text-center" style="border-style: solid none none solid !important;">

                </div>
            </div>
        </div>
        <div class="col-6" "="">
            <div class="row" "="">
                <div class="col-6  p-0 text-center border border-dark" style="border-style: solid none none solid !important;">
                    <small><b>VAT INPUT AMOUNT</b></small>
                </div>
                <div class="col-6 border border-dark" style="border-style: solid solid none solid !important; background: rgba(173, 216, 230, 1.0);">
                    <small><b>FINANCE</b></small>
                </div>
            </div>
        </div>
    </div>

    <div class="row m-0 p-0">
        <div class="col-6">
            <div class="row">
                <div class="col-4 border border-dark text-center" style="border-style: solid none none solid !important; background: rgba(255, 0, 0, 0.4);">
                    <small><b>Type</b></small>
                </div>
                <div class="col-4">
                    <div class="row">
                        <div class="col-2 p-0 text-center border border-dark" style="border-style: solid none none solid !important;">
                            <input type="checkbox" name="type_7l" disabled="">
                        </div>
                        <div class="col-10 m-0 p-0 border border-dark" style="border-style: solid none none solid !important;">
                            <small><select class="px-2 h-100 w-100 border-0" name="type_7r" disabled="">
                                <option value=""></option>
                                <option value="Cost of Sales">Cost of Sales</option>
                                <option value="Supplies and materials">Supplies and materials</option>
                                <option value="Cost of labour">Cost of labour</option>
                                <option value="Shipping, Freight and Delivery">Shipping, Freight and Delivery</option>
                                <option value="Freight and delivery">Freight and delivery</option>
                                <option value="Other costs of sales">Other costs of sales</option>
                                <option value="Amortisation expense">Amortisation expense</option>
                                <option value="Bad debts">Bad debts</option>
                                <option value="Bank charges">Bank charges</option>
                                <option value="Commissions and fees">Commissions and fees</option>
                                <option value="Other selling expenses">Other selling expenses</option>
                                <option value="Office/General Administrative Expenses">Office/General Administrative Expenses</option>
                                <option value="Payroll Expenses">Payroll Expenses</option>
                                <option value="Legal and professional fees">Legal and professional fees</option>
                                <option value="Advertising/Promotional">Advertising/Promotional</option>
                                <option value="Dues and Subscriptions">Dues and Subscriptions</option>
                                <option value="Rent or Lease of Buildings">Rent or Lease of Buildings</option>
                                <option value="Travel expenses">Travel expenses</option>
                                <option value="Shipping and delivery expense">Shipping and delivery expense</option>
                                <option value="Meals and entertainment">Meals and entertainment</option>
                                <option value="Repair and maintenance">Repair and maintenance</option>
                                <option value="Equipment rental">Equipment rental</option>
                                <option value="Other Miscellaneous Service Cost">Other Miscellaneous Service Cost</option>
                                <option value="Income tax expense">Income tax expense</option>
                                <option value="Insurance">Insurance</option>
                                <option value="Interest paid">Interest paid</option>
                                <option value="Loss on discontinued operations, net of tax">Loss on discontinued operations, net of tax</option>
                                <option value="Management compensation">Management compensation</option>
                                <option value="Unapplied Cash Bill Payment Expense">Unapplied Cash Bill Payment Expense</option>
                                <option value="Utilities">Utilities</option>
                                <option value="Exchange Gain or Loss">Exchange Gain or Loss</option>
                                <option value="Other Expense">Other Expense</option>
                                <option value="Penalties and settlements">Penalties and settlements</option>
                            </select></small>
                        </div>
                    </div>
                </div>
                <div class="col-4 m-0 p-0 border border-dark text-center" style="border-style: none none none solid !important;">

                </div>
            </div>
        </div>
        <div class="col-6" "="">
            <div class="row" "="">
                <div class="col-6 m-0 p-0 border border-dark" style="border-style: solid none none solid !important;">
                    <small><input type="text" class="px-2 h-100 w-100 border-0" name="vat_1" disabled=""></small>
                </div>
                <div class="col-6 border border-dark m-0 p-0" style="border-style: solid solid none solid !important;">
                    <small class="px-2">Approve</small>
                </div>
            </div>
        </div>
    </div>

    <div class="row m-0 p-0">
        <div class="col-6">
            <div class="row">
                <div class="col-4">
                    <div class="row">
                        <div class="col-2 p-0 text-center border border-dark" style="border-style: solid none none solid !important;">
                            <small><input type="checkbox" name="OPEX" disabled=""></small>
                        </div>
                        <div class="col-10 p-0 px-2 border border-dark" style="border-style: solid none none solid !important;">
                            <small>OPEX</small>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="row">
                        <div class="col-2 p-0 text-center border border-dark" style="border-style: solid none none solid !important;">
                            <small><input type="checkbox" name="type_8l" disabled=""></small>
                        </div>
                        <div class="col-10 m-0 p-0 border border-dark" style="border-style: solid none none solid !important;">
                            <small><select class="px-2 h-100 w-100 border-0" name="type_8r" disabled="">
                                <option value=""></option>
                                <option value="Cost of Sales">Cost of Sales</option>
                                <option value="Supplies and materials">Supplies and materials</option>
                                <option value="Cost of labour">Cost of labour</option>
                                <option value="Shipping, Freight and Delivery">Shipping, Freight and Delivery</option>
                                <option value="Freight and delivery">Freight and delivery</option>
                                <option value="Other costs of sales">Other costs of sales</option>
                                <option value="Amortisation expense">Amortisation expense</option>
                                <option value="Bad debts">Bad debts</option>
                                <option value="Bank charges">Bank charges</option>
                                <option value="Commissions and fees">Commissions and fees</option>
                                <option value="Other selling expenses">Other selling expenses</option>
                                <option value="Office/General Administrative Expenses">Office/General Administrative Expenses</option>
                                <option value="Payroll Expenses">Payroll Expenses</option>
                                <option value="Legal and professional fees">Legal and professional fees</option>
                                <option value="Advertising/Promotional">Advertising/Promotional</option>
                                <option value="Dues and Subscriptions">Dues and Subscriptions</option>
                                <option value="Rent or Lease of Buildings">Rent or Lease of Buildings</option>
                                <option value="Travel expenses">Travel expenses</option>
                                <option value="Shipping and delivery expense">Shipping and delivery expense</option>
                                <option value="Meals and entertainment">Meals and entertainment</option>
                                <option value="Repair and maintenance">Repair and maintenance</option>
                                <option value="Equipment rental">Equipment rental</option>
                                <option value="Other Miscellaneous Service Cost">Other Miscellaneous Service Cost</option>
                                <option value="Income tax expense">Income tax expense</option>
                                <option value="Insurance">Insurance</option>
                                <option value="Interest paid">Interest paid</option>
                                <option value="Loss on discontinued operations, net of tax">Loss on discontinued operations, net of tax</option>
                                <option value="Management compensation">Management compensation</option>
                                <option value="Unapplied Cash Bill Payment Expense">Unapplied Cash Bill Payment Expense</option>
                                <option value="Utilities">Utilities</option>
                                <option value="Exchange Gain or Loss">Exchange Gain or Loss</option>
                                <option value="Other Expense">Other Expense</option>
                                <option value="Penalties and settlements">Penalties and settlements</option>
                            </select></small>
                        </div>
                    </div>
                </div>
                <div class="col-4 m-0 p-0 border border-dark text-center" style="border-style: none none none solid !important;">

                </div>
            </div>
        </div>
        <div class="col-6" "="">
            <div class="row" "="">
                <div class="col-6 m-0 p-0 border border-dark" style="border-style: solid none none solid !important;">
                    <small><input type="text" class="px-2 h-100 w-100 border-0" name="vat_2" disabled=""></small>
                </div>
                <div class="col-6 border border-dark m-0 px-2" style="border-style: solid solid none solid !important;">
                    <small>2024-05-23 13:06</small>
                </div>
            </div>
        </div>
    </div>

    <div class="row m-0 p-0">
        <div class="col-6">
            <div class="row">
                <div class="col-4">
                    <div class="row">
                        <div class="col-2 p-0 text-center border border-dark" style="border-style: solid none none solid !important;">
                            <small><input type="checkbox" name="NON OPEX" disabled=""></small>
                        </div>
                        <div class="col-10 p-0 px-2 border border-dark" style="border-style: solid none none solid !important;">
                            <small>NON OPEX</small>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="row">
                        <div class="col-2 p-0 text-center border border-dark" style="border-style: solid none none solid !important;">
                            <small><input type="checkbox" name="type_9l" disabled=""></small>
                        </div>
                        <div class="col-10 m-0 p-0 border border-dark" style="border-style: solid none none solid !important;">
                            <small><select class="px-2 h-100 w-100 border-0" name="type_9r" disabled="">
                                <option value=""></option>
                                <option value="Cost of Sales">Cost of Sales</option>
                                <option value="Supplies and materials">Supplies and materials</option>
                                <option value="Cost of labour">Cost of labour</option>
                                <option value="Shipping, Freight and Delivery">Shipping, Freight and Delivery</option>
                                <option value="Freight and delivery">Freight and delivery</option>
                                <option value="Other costs of sales">Other costs of sales</option>
                                <option value="Amortisation expense">Amortisation expense</option>
                                <option value="Bad debts">Bad debts</option>
                                <option value="Bank charges">Bank charges</option>
                                <option value="Commissions and fees">Commissions and fees</option>
                                <option value="Other selling expenses">Other selling expenses</option>
                                <option value="Office/General Administrative Expenses">Office/General Administrative Expenses</option>
                                <option value="Payroll Expenses">Payroll Expenses</option>
                                <option value="Legal and professional fees">Legal and professional fees</option>
                                <option value="Advertising/Promotional">Advertising/Promotional</option>
                                <option value="Dues and Subscriptions">Dues and Subscriptions</option>
                                <option value="Rent or Lease of Buildings">Rent or Lease of Buildings</option>
                                <option value="Travel expenses">Travel expenses</option>
                                <option value="Shipping and delivery expense">Shipping and delivery expense</option>
                                <option value="Meals and entertainment">Meals and entertainment</option>
                                <option value="Repair and maintenance">Repair and maintenance</option>
                                <option value="Equipment rental">Equipment rental</option>
                                <option value="Other Miscellaneous Service Cost">Other Miscellaneous Service Cost</option>
                                <option value="Income tax expense">Income tax expense</option>
                                <option value="Insurance">Insurance</option>
                                <option value="Interest paid">Interest paid</option>
                                <option value="Loss on discontinued operations, net of tax">Loss on discontinued operations, net of tax</option>
                                <option value="Management compensation">Management compensation</option>
                                <option value="Unapplied Cash Bill Payment Expense">Unapplied Cash Bill Payment Expense</option>
                                <option value="Utilities">Utilities</option>
                                <option value="Exchange Gain or Loss">Exchange Gain or Loss</option>
                                <option value="Other Expense">Other Expense</option>
                                <option value="Penalties and settlements">Penalties and settlements</option>
                            </select></small>
                        </div>
                    </div>
                </div>
                <div class="col-4 m-0 p-0 border border-dark text-center" style="border-style: none none none solid !important;">

                </div>
            </div>
        </div>
        <div class="col-6" "="">
            <div class="row" "="">
                <div class="col-6">
                    <div class="row">
                        <div class="col-6 border border-dark" style="border-style: solid none none solid !important;">
                            <small><b>PO No</b></small>
                        </div>
                        <div class="col-6 m-0 p-0 border border-dark" style="border-style: solid none none solid !important;">
                            <small><input type="text" class="px-2 h-100 w-100 border-0" name="po" disabled=""></small>
                        </div>
                    </div>
                </div>
                <div class="col-6 border border-dark" style="border-style: solid solid none solid !important; background: rgba(173, 216, 230, 1.0);">
                    <small><b>AUDITOR</b></small>
                </div>
            </div>
        </div>
    </div>

    <div class="row m-0 p-0">
        <div class="col-6">
            <div class="row">
                <div class="col-4 border border-dark text-center" style="border-style: solid none none solid !important; background: rgba(255, 0, 0, 0.4);">
                    <small><b>Receipt</b></small>
                </div>
                <div class="col-4">
                    <div class="row">
                        <div class="col-2 p-0 text-center border border-dark" style="border-style: solid none none solid !important;">
                            <input type="checkbox" name="type_10l" disabled="">
                        </div>
                        <div class="col-10 m-0 p-0 border border-dark" style="border-style: solid none none solid !important;">
                            <small><select class="px-2 h-100 w-100 border-0" name="type_10r" disabled="">
                                <option value=""></option>
                                <option value="Cost of Sales">Cost of Sales</option>
                                <option value="Supplies and materials">Supplies and materials</option>
                                <option value="Cost of labour">Cost of labour</option>
                                <option value="Shipping, Freight and Delivery">Shipping, Freight and Delivery</option>
                                <option value="Freight and delivery">Freight and delivery</option>
                                <option value="Other costs of sales">Other costs of sales</option>
                                <option value="Amortisation expense">Amortisation expense</option>
                                <option value="Bad debts">Bad debts</option>
                                <option value="Bank charges">Bank charges</option>
                                <option value="Commissions and fees">Commissions and fees</option>
                                <option value="Other selling expenses">Other selling expenses</option>
                                <option value="Office/General Administrative Expenses">Office/General Administrative Expenses</option>
                                <option value="Payroll Expenses">Payroll Expenses</option>
                                <option value="Legal and professional fees">Legal and professional fees</option>
                                <option value="Advertising/Promotional">Advertising/Promotional</option>
                                <option value="Dues and Subscriptions">Dues and Subscriptions</option>
                                <option value="Rent or Lease of Buildings">Rent or Lease of Buildings</option>
                                <option value="Travel expenses">Travel expenses</option>
                                <option value="Shipping and delivery expense">Shipping and delivery expense</option>
                                <option value="Meals and entertainment">Meals and entertainment</option>
                                <option value="Repair and maintenance">Repair and maintenance</option>
                                <option value="Equipment rental">Equipment rental</option>
                                <option value="Other Miscellaneous Service Cost">Other Miscellaneous Service Cost</option>
                                <option value="Income tax expense">Income tax expense</option>
                                <option value="Insurance">Insurance</option>
                                <option value="Interest paid">Interest paid</option>
                                <option value="Loss on discontinued operations, net of tax">Loss on discontinued operations, net of tax</option>
                                <option value="Management compensation">Management compensation</option>
                                <option value="Unapplied Cash Bill Payment Expense">Unapplied Cash Bill Payment Expense</option>
                                <option value="Utilities">Utilities</option>
                                <option value="Exchange Gain or Loss">Exchange Gain or Loss</option>
                                <option value="Other Expense">Other Expense</option>
                                <option value="Penalties and settlements">Penalties and settlements</option>
                            </select></small>
                        </div>
                    </div>
                </div>
                <div class="col-4 border border-dark text-center" style="border-style: none none none solid !important;">

                </div>
            </div>
        </div>
        <div class="col-6" "="">
            <div class="row" "="">
                <div class="col-6">
                    <div class="row">
                        <div class="col-6 border border-dark" style="border-style: solid none none solid !important;">
                            <small><b>Invoice No</b></small>
                        </div>
                        <div class="col-6 m-0 p-0 border border-dark" style="border-style: solid none none solid !important;">
                            <small><input type="text" class="px-2 h-100 w-100 border-0" name="invoice" disabled=""></small>
                        </div>
                    </div>
                </div>
                <div class="col-6 border border-dark m-0 p-0" style="border-style: solid solid none solid !important;">
                    <small class="px-2">Approve</small>
                </div>
            </div>
        </div>
    </div>

    <div class="row m-0 p-0">
        <div class="col-6">
            <div class="row">
                <div class="col-4">
                    <div class="row">
                        <div class="col-2 p-0 text-center border border-dark" style="border-style: solid none none solid !important;">
                            <small><input type="checkbox" name="Official Receipt VAT" disabled=""></small>
                        </div>
                        <div class="col-10 p-0 px-2 border border-dark" style="border-style: solid none none solid !important;">
                            <small>Official Receipt VAT</small>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="row">
                        <div class="col-2 p-0 text-center border border-dark" style="border-style: solid none none solid !important;">
                            <small><input type="checkbox" name="type_11l" disabled=""></small>
                        </div>
                        <div class="col-10 m-0 p-0 border border-dark" style="border-style: solid none none solid !important;">
                            <small><select class="px-2 h-100 w-100 border-0" name="type_11r" disabled="">
                                <option value=""></option>
                                <option value="Cost of Sales">Cost of Sales</option>
                                <option value="Supplies and materials">Supplies and materials</option>
                                <option value="Cost of labour">Cost of labour</option>
                                <option value="Shipping, Freight and Delivery">Shipping, Freight and Delivery</option>
                                <option value="Freight and delivery">Freight and delivery</option>
                                <option value="Other costs of sales">Other costs of sales</option>
                                <option value="Amortisation expense">Amortisation expense</option>
                                <option value="Bad debts">Bad debts</option>
                                <option value="Bank charges">Bank charges</option>
                                <option value="Commissions and fees">Commissions and fees</option>
                                <option value="Other selling expenses">Other selling expenses</option>
                                <option value="Office/General Administrative Expenses">Office/General Administrative Expenses</option>
                                <option value="Payroll Expenses">Payroll Expenses</option>
                                <option value="Legal and professional fees">Legal and professional fees</option>
                                <option value="Advertising/Promotional">Advertising/Promotional</option>
                                <option value="Dues and Subscriptions">Dues and Subscriptions</option>
                                <option value="Rent or Lease of Buildings">Rent or Lease of Buildings</option>
                                <option value="Travel expenses">Travel expenses</option>
                                <option value="Shipping and delivery expense">Shipping and delivery expense</option>
                                <option value="Meals and entertainment">Meals and entertainment</option>
                                <option value="Repair and maintenance">Repair and maintenance</option>
                                <option value="Equipment rental">Equipment rental</option>
                                <option value="Other Miscellaneous Service Cost">Other Miscellaneous Service Cost</option>
                                <option value="Income tax expense">Income tax expense</option>
                                <option value="Insurance">Insurance</option>
                                <option value="Interest paid">Interest paid</option>
                                <option value="Loss on discontinued operations, net of tax">Loss on discontinued operations, net of tax</option>
                                <option value="Management compensation">Management compensation</option>
                                <option value="Unapplied Cash Bill Payment Expense">Unapplied Cash Bill Payment Expense</option>
                                <option value="Utilities">Utilities</option>
                                <option value="Exchange Gain or Loss">Exchange Gain or Loss</option>
                                <option value="Other Expense">Other Expense</option>
                                <option value="Penalties and settlements">Penalties and settlements</option>
                            </select></small>
                        </div>
                    </div>
                </div>
                <div class="col-4 border border-dark text-center" style="border-style: none none none solid !important;">

                </div>
            </div>
        </div>
        <div class="col-6" "="">
            <div class="row" "="">
                <div class="col-6">
                    <div class="row">
                        <div class="col-6 border border-dark" style="border-style: solid none none solid !important;">
                            <small><b>Bill No</b></small>
                        </div>
                        <div class="col-6 m-0 p-0 border border-dark" style="border-style: solid none none solid !important;">
                            <small><input type="text" class="px-2 h-100 w-100 border-0" name="bill" disabled=""></small>
                        </div>
                    </div>
                </div>
                <div class="col-6 border border-dark m-0 px-2" style="border-style: solid solid none solid !important;">
                    <small>2024-06-06 20:32</small>
                </div>
            </div>
        </div>
    </div>

    <div class="row m-0 p-0">
        <div class="col-6">
            <div class="row">
                <div class="col-4">
                    <div class="row">
                        <div class="col-2 p-0 text-center border border-dark" style="border-style: solid none none solid !important;">
                            <small><input type="checkbox" name="Delivery Receipt" disabled=""></small>
                        </div>
                        <div class="col-10 p-0 px-2 border border-dark" style="border-style: solid none none solid !important;">
                            <small>Delivery Receipt</small>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="row">
                        <div class="col-2 p-0 text-center border border-dark" style="border-style: solid none none solid !important;">
                            <small><input type="checkbox" name="type_12l" disabled=""></small>
                        </div>
                        <div class="col-10 m-0 p-0 border border-dark" style="border-style: solid none none solid !important;">
                            <small><select class="px-2 h-100 w-100 border-0" name="type_12r" disabled="">
                                <option value=""></option>
                                <option value="Cost of Sales">Cost of Sales</option>
                                <option value="Supplies and materials">Supplies and materials</option>
                                <option value="Cost of labour">Cost of labour</option>
                                <option value="Shipping, Freight and Delivery">Shipping, Freight and Delivery</option>
                                <option value="Freight and delivery">Freight and delivery</option>
                                <option value="Other costs of sales">Other costs of sales</option>
                                <option value="Amortisation expense">Amortisation expense</option>
                                <option value="Bad debts">Bad debts</option>
                                <option value="Bank charges">Bank charges</option>
                                <option value="Commissions and fees">Commissions and fees</option>
                                <option value="Other selling expenses">Other selling expenses</option>
                                <option value="Office/General Administrative Expenses">Office/General Administrative Expenses</option>
                                <option value="Payroll Expenses">Payroll Expenses</option>
                                <option value="Legal and professional fees">Legal and professional fees</option>
                                <option value="Advertising/Promotional">Advertising/Promotional</option>
                                <option value="Dues and Subscriptions">Dues and Subscriptions</option>
                                <option value="Rent or Lease of Buildings">Rent or Lease of Buildings</option>
                                <option value="Travel expenses">Travel expenses</option>
                                <option value="Shipping and delivery expense">Shipping and delivery expense</option>
                                <option value="Meals and entertainment">Meals and entertainment</option>
                                <option value="Repair and maintenance">Repair and maintenance</option>
                                <option value="Equipment rental">Equipment rental</option>
                                <option value="Other Miscellaneous Service Cost">Other Miscellaneous Service Cost</option>
                                <option value="Income tax expense">Income tax expense</option>
                                <option value="Insurance">Insurance</option>
                                <option value="Interest paid">Interest paid</option>
                                <option value="Loss on discontinued operations, net of tax">Loss on discontinued operations, net of tax</option>
                                <option value="Management compensation">Management compensation</option>
                                <option value="Unapplied Cash Bill Payment Expense">Unapplied Cash Bill Payment Expense</option>
                                <option value="Utilities">Utilities</option>
                                <option value="Exchange Gain or Loss">Exchange Gain or Loss</option>
                                <option value="Other Expense">Other Expense</option>
                                <option value="Penalties and settlements">Penalties and settlements</option>
                            </select></small>
                        </div>
                    </div>
                </div>
                <div class="col-4 border border-dark text-center" style="border-style: none none none solid !important;">

                </div>
            </div>
        </div>
        <div class="col-6" "="">
            <div class="row" "="">
                <div class="col-6">
                    <div class="row">
                        <div class="col-6 border border-dark" style="border-style: solid none none solid !important;">
                            <small><b>OR No</b></small>
                        </div>
                        <div class="col-6 m-0 p-0 border border-dark" style="border-style: solid none none solid !important;">
                            <small><input type="text" class="px-2 h-100 w-100 border-0" name="or" disabled=""></small>
                        </div>
                    </div>
                </div>
                <div class="col-4 border border-dark" style="border-style: solid none none solid !important;">

                </div>
                <div class="col-2 border border-dark" style="border-style: solid solid none solid !important;">

                </div>
            </div>
        </div>
    </div>

    <div class="row m-0 p-0">
        <div class="col-6">
            <div class="row">
                <div class="col-4">
                    <div class="row">
                        <div class="col-2 p-0 text-center border border-dark" style="border-style: solid none none solid !important;">
                            <small><input type="checkbox" name="None" disabled=""></small>
                        </div>
                        <div class="col-10 p-0 px-2 border border-dark" style="border-style: solid none none solid !important;">
                            <small>None</small>
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <div class="row">
                        <div class="col-1 p-0 text-center border border-dark" style="border-style: solid none none solid !important;">
                            <small><input type="checkbox" name="type_13l" disabled=""></small>
                        </div>
                        <div class="col-11 m-0 p-0 border border-dark" style="border-style: solid none none solid !important;">
                            <small><input type="text" class="px-2 h-100 w-100 border-0" value="Others: ____________________________________________________" name="type_13r" disabled=""></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="row">
                <div class="col-6">
                    <div class="row" "="">
                        <div class="col-6 border border-dark" style="border-style: solid none solid solid !important;">
                            <small><b>Voucher No</b></small>
                        </div>
                        <div class="col-6 m-0 p-0 border border-dark px-2" style="border-style: solid none solid solid !important;">
                            <small></small>
                        </div>
                    </div>
                </div>
                <div class="col-4 border border-dark" style="border-style: none none none solid !important;">

                </div>
                <div class="col-2 border border-dark text-center" style="border-style: none solid none solid !important; position: relative;">
                    <small style="position: absolute; top: -10px; left: 50%; transform: translateX(-50%);"><b>RCA</b></small>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-dark border border-dark m-0 p-0 text-center">
        <small>20240523-031</small>
    </div>
    </div>


    <input type="hidden" id="VALUE" value="">
    <input type="hidden" id="VALUE2" value="">
    <input type="hidden" id="CHECK" value="">
    <input type="hidden" id="CHECK2" value="High">
    <input type="hidden" id="BANK_NAME" value="">
    <input type="hidden" id="BANK_CODE" value="">
    <input type="hidden" id="CHECK_NUMBER" value="">
    <input type="hidden" id="REFERENCE" value="20240523-031">
    </div>

    <div class="row m-0 mt-3 py-4 px-2 bg-white w-100" id="comment"><div class="container px-4">
    <div class="row border border-dark text-start" style="display: flex; flex-direction: column; height: 300px;">
    <div class="bg-dark text-center text-white py-2">COMMENT SECTION</div>
    <div style="overflow-x:hidden; overflow-y:auto; flex: 1; transform: scaleY(-1);" id="comment_window">
    <div class="card p-3" style="width: 95%; margin: 20px auto; transform: scaleY(-1);"><div class="d-flex justify-content-between align-items-center"><div class="d-flex flex-row align-items-center"><span><small class="font-weight-bold text-danger">[Developer]</small><small class="font-weight-bold">: Be the first one to leave a comment.</small></span></div><small class="text-warning">Verified</small></div></div>
    </div>
    <div class="p-0">
    <form id="comment-form">
        <input type="hidden" name="reference" value="20240523-031">
        <div class="comment-area">
            <div class="bg-dark" style="display: flex; justify-content: center; align-items: center; flex-direction: row; margin: 0; padding: 0;">
                <div class="w-100 p-1">
                    <textarea class="form-control rounded-pill" placeholder="Type your message here." rows="1" name="message" required=""></textarea>
                </div>
                <div class="w-50 p-1 d-flex align-items-center">
                    <button type="submit" class="btn btn-sm btn-danger py-1 w-100 rounded-pill">Send</button>
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
@endsection


@section('script')
    <script>

        let bankNameSelection = document.querySelector('#bankNameSelection');
        let bankCodeSelection = document.querySelector('#bankCodeSelection');
        let checkNumberInput = document.querySelector('#checkNumberInput');

        bankNameSelection.addEventListener('change', updateBankDetails);
        bankCodeSelection.addEventListener('change', updateBankDetails);
        checkNumberInput.addEventListener('change', updateBankDetails);

        function updateBankDetails(){

            if(parseInt(bankNameSelection.value) === -1 && parseInt(bankCodeSelection.value) === -1){
               console.log('called')
                fetch('/api/expense-request/bank-details/{{$request->id}}', {
                    method: 'DELETE',
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                    }
                }).then(response =>{

                    if(!response.ok){
                        throw new Error("Something went wrong!");
                    }

                    return response.json();

                }).then(data => {
                    bankNameSelection.classList.remove('bg-danger')
                    bankCodeSelection.classList.remove('bg-danger')
                    checkNumberInput.classList.remove('bg-danger')
                    checkNumberInput.value = '';
                }).catch(err => {
                    bankNameSelection.classList.add('bg-danger')
                    bankCodeSelection.classList.add('bg-danger')
                    checkNumberInput.classList.add('bg-danger')
                })

                return;
            }

            if(!(bankNameSelection.value && bankCodeSelection.value && checkNumberInput.value)){
                return;
            }

            let formData = new FormData();
            let requestId = 1;

            formData.append('bankName', bankNameSelection.value);
            formData.append('bankNumber', bankCodeSelection.value);
            formData.append('checkNumber', checkNumberInput.value);
            formData.append('requestID', requestId);

            fetch('/api/expense-request/bank-details', {
                method: 'POST',
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                }
            }).then(response =>{

                if(!response.ok){
                    throw new Error("Something went wrong!");
                }

                return response.json();

            }).then(data => {
                console.log(data);
                bankNameSelection.classList.remove('bg-danger')
                bankCodeSelection.classList.remove('bg-danger')
                checkNumberInput.classList.remove('bg-danger')
            }).catch(err => {
                bankNameSelection.classList.add('bg-danger')
                bankCodeSelection.classList.add('bg-danger')
                checkNumberInput.classList.add('bg-danger')
            })
        }
    </script>
@endsection
