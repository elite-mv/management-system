@extends('layouts.expense-index')

@section('title', 'Daily Request')

@section('style')
    <style type="text/css">
        .daily_request_nav {
            color: rgb(255, 255, 255, 1.0);
        }
    </style>
@endsection

@section('body')
    <div class="container p-3" style="position: relative;">
        <div class="mb-2">
            <form class="mx-0 row gap-2 bg-white py-2 rounded">

                <div class="col-12">
                    <input type="search" class="form-control">
                </div>
                <div class="col-2 d-flex gap-2 align-items-center">
                    <label class="text-nowrap">Job Order</label>
                    <select class="form-select">
                        <option value="ALL">All</option>
                        @foreach($jobOrders as $jobOrder)
                            <option value="{{$jobOrder->id}}">{{$jobOrder->reference}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-2 d-flex gap-2 align-items-center">
                    <label class="text-nowrap">Bank Code</label>
                    <select class="form-select">
                        <option value="ALL">All</option>
                        @foreach($bankCodes as $bankCode)
                            <option value="{{$bankCode->id}}">{{$bankCode->code}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-2 d-flex gap-2 align-items-center">
                    <label>Entity</label>
                    <select class="form-select">
                        <option value="ALL">All</option>
                        @foreach($companies as $company)
                            <option value="{{$company->id}}">{{$company->name}}</option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>
        <div class="mb-2">
            <a type="button" class="btn btn-success">Download Excel</a>
        </div>
        <div class="row mb-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="text-start">
                                <i class="fas fa-table me-1"></i>
                                <b>Daily Requests</b>
                            </div>
                            <div class="text-start">
                                <form id="searchForm" class="d-flex gap-2 align-items-center">
                                    <label class="form-label text-nowrap mb-0">Payment Status</label>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body overflow-x-auto">
                        <table class="table sortable" id="sortableTable">

                            <thead>
                            <tr>
                                <th>PR Number</th>
                                <th>DATE</th>
                                <th>JOB ORDER</th>
                                <th>COMPANY</th>
                                <th>PARTICULARS</th>
                                <th>CLASS</th>
                                <th>BANK CODE</th>
                                <th>CHECK NUMBER</th>
                                <th>TOTAL</th>
                            </tr>
                            </thead>
                            <tbody id="requestData">
                            @foreach($items as $item)
                                <tr>
                                    <td>{!! \App\Helper\Helper::padID($item->request->id) !!}</td>
                                    <td>{{$item->request->created_at->format('Y-m-d')}}</td>
                                    <td>{{$item->jobOrder->reference}}</td>
                                    <td class="text-capitalize">{{ strtolower($item->request->supplier)}}</td>
                                    <td class="text-capitalize">{{ strtolower($item->description)}}</td>
                                    <td class="text-uppercase">{{$item->request->company->name}}</td>
                                    <td>
                                        @if($item->request->bankDetails && $item->request->bankDetails->code)
                                            {{$item->request->bankDetails->code->code}}
                                        @else
                                            <span class="text-secondary">--</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->request->bankDetails && $item->request->bankDetails->check_number)
                                            {{$item->request->bankDetails->check_number}}
                                        @else
                                            <span class="text-secondary">--</span>
                                        @endif
                                    </td>
                                    <td>{{\App\Helper\Helper::formatPeso($item->sub_total)}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr class="fw-bold">
                                <td  colspan="8">Total</td>
                                <td>{!! \App\Helper\Helper::formatPeso($total) !!}</td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    {{$items->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        const searchForm = document.querySelector('#searchForm');
        const searchStatus = document.querySelector('#searchStatus');

        searchStatus.addEventListener('change', () => {
            searchForm.submit();
        })

    </script>
@endsection

