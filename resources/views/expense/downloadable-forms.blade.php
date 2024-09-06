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

    <div class="container-fluid mt-2">

        <div class="bg-white rounded mb-2 p-2 rounded">

            <form class="mb-2" id="searchForm">
                <div>
                    <input name="search" class="form-control" type="search">
                </div>

                <select name="company" class="form-control">
                    <option value="ALL">ALL</option>
                    @foreach($companies as $company)
                        <option value="{{$company->id}}">{{$company->name}}</option>
                    @endforeach
                </select>

                <select name="fund_status" class="form-control">
                    <option value="ALL">ALL</option>
                    <option @selected($app->request->fund_status == 'OPEN') value="OPEN">OPEN</option>
                    <option @selected($app->request->fund_status == 'CLOSE')  value="CLOSE">CLOSE</option>
                </select>

                <select name="status" class="form-control">
                    <option value="ALL">ALL</option>
                    @foreach(\App\Enums\RequestStatus::cases() as $case)
                        <option class="{{$case->name}}">{{$case->value}}</option>
                    @endforeach
                </select>
            </form>

            <div>
                <form id="excelForm" method="POST" action="/expense/forms/excel">
                    @csrf
                    <button type="submit" class="btn btn-success">Export to Excel</button>
                </form>
                <form id="pdfForm" method="POST" action="/expense/forms/pdf">
                    @csrf
                    <button type="submit" class="btn btn-danger">Export to PDF</button>
                </form>
            </div>
        </div>

        <div class="container-fluid">
            <div>Total Requested: {!! \App\Helper\Helper::formatPeso($total) !!}</div>
            <div>Total Approved: {!! \App\Helper\Helper::formatPeso($approved) !!}</div>
            <div>Total Balance: {!! \App\Helper\Helper::formatPeso($total - $approved) !!}</div>
        </div>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>REFERENCE</th>
                <th>ENTITY</th>
                <th>PAID TO</th>
                <th>REQUESTED BY</th>
                <th>BOOK KEEPER</th>
                <th>ACCOUNTANT</th>
                <th>FINANCE</th>
                <th>AUDITOR</th>
                <th>PAYMENT STATUS</th>
                <th>REQUEST STATUS</th>
                <th>AMOUNT REQUEST</th>
                <th>APPROVED AMOUNT</th>
                <th>BALANCE</th>
            </tr>
            </thead>
            <tbody>
            @foreach($requests as $request)
                <tr>
                    <td class="text-nowrap">{{$request->reference}}</td>
                    <td>{{$request->company->name}}</td>
                    <td class="text-capitalize">{{$request->paid_to}}</td>
                    <td class="text-capitalize">{{$request->request_by}}</td>
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
                    {{$requests->links()}}
                </td>
            </tr>
            </tfoot>
        </table>
    </div>
@endsection

@section('script')
    <script>
        const searchForm = document.querySelector('#searchForm');
        const excelForm = document.querySelector('#excelForm');
        const pdfForm = document.querySelector('#pdfForm');

        excelForm.addEventListener('submit', async (e) => {
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

    </script>
@endsection



