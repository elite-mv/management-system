@php
    use Illuminate\Support\Facades\Storage;
@endphp

@extends('layouts.expense-index')

@section('title', 'Downloadable Forms')

@section('style')
    <style type="text/css">
        .dl_forms_nav {
            color: rgb(255, 255, 255, 1.0);
        }
    </style>
@endsection

@section('body')
<div class="p-3 px-md-0 m-0">

    <div class="row m-0">
        <div class="col-sm-12 col-md-10 mx-auto">

            <div class="d-flex overflow-y-auto m-0 p-3 mb-3" style="gap: 0 30px; border-radius: 7px;
                background-color: rgba(255, 255, 255, 0.2);
                box-shadow: 0 25px 45px rgba(0, 0, 0, 0.1);
                border: 1px solid rgba(255, 255, 255, 0.5);
                border-right: 1px solid rgba(255, 255, 255, 0.2);
                border-bottom: 1px solid rgba(255, 255, 255, 0.2);">
                <div class="w-100 p-4" style="background-color: rgba(255, 255, 255, 0.75);
                box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
                border: 1px solid rgba(255, 255, 255, 0.3);
                border-right: 1px solid rgba(255, 255, 255, 0.2);
                border-bottom: 1px solid rgba(255, 255, 255, 0.2);">
                    <form id="searchForm">

                        <div class="d-flex mb-2 gap-2 align-items-center">
                            <div class="w-100 rounded-pill border d-flex align-items-start flex-direction-row gap-2 py-2 px-3" style="background-color: rgba(255, 255, 255, 0.4);
                            box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 15px;
                            border: 1px solid rgba(255, 255, 255, 0.5);
                            border-right: 1px solid rgba(255, 255, 255, 0.2);
                            border-bottom: 1px solid rgba(255, 255, 255, 0.2);">
                                <div>
                                    <button class="border-0 bg-transparent" style="border-radius: 50%;">
                                        <i class="fas fa-search text-secondary"></i>
                                    </button>
                                </div>
                                <div class="w-100 mx-1">
                                    <small>
                                        <input autocomplete="off" placeholder="Search ..." name="search" type="search" value="{{$app->request->search}}" class="rounded-0 border-0 w-100 bg-transparent">
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="row align-items-center">

                            <div class="col-6 col-md-4 form-group d-flex gap-2 align-items-center">
                                <label class="form-label">Entity</label>
                                <select name="company" class="form-select inputs" style="background-color: rgba(255, 255, 255, 0.4);
                                box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 15px;
                                border: 1px solid rgba(255, 255, 255, 0.5);
                                border-right: 1px solid rgba(255, 255, 255, 0.2);
                                border-bottom: 1px solid rgba(255, 255, 255, 0.2);">
                                    <option value="ALL">ALL</option>
                                    @foreach($companies as $company)
                                        <option value="{{$company->id}}" @selected($app->request->company == $company->id)>{{$company->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-6 col-md-4 form-group d-flex gap-2 align-items-center">
                                <label class="form-label mb-0" for="status">Fund Status</label>
                                <select name="fund_status" class="form-select inputs" style="background-color: rgba(255, 255, 255, 0.4);
                                box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 15px;
                                border: 1px solid rgba(255, 255, 255, 0.5);
                                border-right: 1px solid rgba(255, 255, 255, 0.2);
                                border-bottom: 1px solid rgba(255, 255, 255, 0.2);">
                                    <option value="ALL">All</option>
                                    <option @selected($app->request->fund_status == 'OPEN') value="OPEN">OPEN</option>
                                    <option @selected($app->request->fund_status == 'CLOSE')  value="CLOSE">CLOSE</option>
                                </select>
                            </div>

                            <div class="col-6 col-md-4 form-group d-flex gap-2 align-items-center">
                                <label class="form-label mb-0" for="status">Payment Status</label>
                                <select name="status" class="form-select inputs" style="background-color: rgba(255, 255, 255, 0.4);
                                box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 15px;
                                border: 1px solid rgba(255, 255, 255, 0.5);
                                border-right: 1px solid rgba(255, 255, 255, 0.2);
                                border-bottom: 1px solid rgba(255, 255, 255, 0.2);">
                                    <option value="ALL">All</option>
                                    @foreach(\App\Enums\RequestStatus::cases() as $status)
                                        <option value="{{$status->value}}" @selected($app->request->status == $status->value)>{{$status->value}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header row">
                            <div class="col-sm-12 col-md-6 d-flex align-items-center">
                                <div class="col-auto text-start">
                                    <i class="fas fa-table me-1"></i>
                                    <b>Requests</b>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="d-flex gap-2 justify-content-end">
                                    <form id="excelForm" method="POST" action="/expense/forms/excel">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-success rounded-0 px-3">Export to Excel</button>
                                    </form>
                                    <form id="pdfForm" method="POST" action="/expense/forms/pdf">
                                        @csrf
                                        <button type="submit" class="btn btn-outline-danger rounded-0 px-3">Export to PDF</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body overflow-x-auto">
                            <table class="table table-bordered table-responsive">
                                <thead>
                                <tr>
                                    <th class="text-nowrap">REFERENCE</th>
                                    <th class="text-nowrap">ENTITY</th>
                                    <th class="text-nowrap">PAID TO</th>
                                    <th class="text-nowrap">REQUESTED BY</th>
                                    <th class="text-nowrap">BOOK KEEPER</th>
                                    <th class="text-nowrap">ACCOUNTANT</th>
                                    <th class="text-nowrap">FINANCE</th>
                                    <th class="text-nowrap">AUDITOR</th>
                                    <th class="text-nowrap">PAYMENT STATUS</th>
                                    <th class="text-nowrap">REQUEST STATUS</th>
                                    <th class="text-nowrap">AMOUNT REQUEST</th>
                                    <th class="text-nowrap">APPROVED AMOUNT</th>
                                    <th class="text-nowrap">BALANCE</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($requests as $request)
                                    <tr>
                                        <td class="text-nowrap">{{$request->reference}}</td>
                                        <td>{{$request->company->name}}</td>
                                        <td class="text-capitalize text-nowrap">{{strtolower($request->paid_to)}}</td>
                                        <td class="text-capitalize text-nowrap">{{strtolower($request->request_by)}}</td>
                                        <td>
                                            @if($request->bookKeeper)
                                                {{$request->bookKeeper->created_at}}
                                            @else
                                                --
                                            @endif
                                        </td>
                                        <td>
                                            @if($request->accountant)
                                                {{$request->accountant->created_at}}
                                            @else
                                                --
                                            @endif
                                        </td>
                                        <td>
                                            @if($request->finance)
                                                {{$request->finance->created_at}}
                                            @else
                                                --
                                            @endif
                                        </td>
                                        <td>
                                            @if($request->auditor)
                                                {{$request->auditor->created_at}}
                                            @else
                                                --
                                            @endif
                                        </td>
                                        <td>
                                            {{$request->status}}
                                        </td>
                                        <td>
                                            @if($request->approvals_count == 4)
                                                CLOSE
                                            @else
                                                OPEN
                                            @endif
                                        </td>
                                        <td>{!! \App\Helper\Helper::formatPeso($request->items_sum_sub_total) !!}</td>
                                        <td>{!! \App\Helper\Helper::formatPeso($request->items_sum_approve_total) !!}</td>
                                        <td>{!! \App\Helper\Helper::formatPeso($request->items_sum_sub_total -  $request->items_sum_approve_total) !!}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="13">
                                        <div class="container-fluid">
                                            {{$requests->links()}}
                                        </div>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-around">
                                <div class="fw-bold text-end">Total Requested: {!! \App\Helper\Helper::formatPeso($total) !!}</div>
                                <div class="fw-bold text-end">Total Approved: {!! \App\Helper\Helper::formatPeso($approved) !!}</div>
                                <div class="fw-bold text-end">Total Balance: {!! \App\Helper\Helper::formatPeso($total - $approved) !!}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection

@section('script')
    <script>
        const searchForm = document.querySelector('#searchForm');
        const excelForm = document.querySelector('#excelForm');
        const pdfForm = document.querySelector('#pdfForm');

        searchForm.addEventListener('submit', async (e) => {
            e.preventDefault();

            const formData = new FormData(searchForm);

            const response = await fetch('/expense/forms/pdf', {
                method: 'POST',
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                }
            });

            console.log(response);

        })

        $('#searchForm').find('select[name="company"]').on('change', function() {
            $('#searchForm').submit();
        })

        $('#searchForm').find('select[name="fund_status"]').on('change', function() {
            $('#searchForm').submit();
        })

        $('#searchForm').find('select[name="status"]').on('change', function() {
            $('#searchForm').submit();
        })
    </script>
@endsection



