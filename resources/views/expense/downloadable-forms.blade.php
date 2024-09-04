@php
    use Illuminate\Support\Facades\Storage;
@endphp

@extends('layouts.expense-index')

@section('title', 'Downloadable Forms')

@section('body')

    <div class="container-fluid mt-2">

        <div class="bg-white rounded mb-2 p-2 rounded">

            <form class="mb-2">
                <div>
                    <input class="form-control" type="search">
                </div>
            </form>

            <select class="form-control">
                <option value="-1">ALL</option>
                @foreach($companies as $company)
                    <option class="{{$company->id}}">{{$company->name}}</option>
                @endforeach
            </select>

            <select class="form-control">
                <option value="-1">ALL</option>
                @foreach(\App\Enums\RequestStatus::cases() as $case)
                    <option class="{{$case->name}}">{{$case->value}}</option>
                @endforeach
            </select>

            <div>
                <button class="btn btn-success">Export to Excel</button>
                <button class="btn btn-danger">Export to PDF</button>
            </div>

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
                    <td>{{$request->reference}}</td>
                    <td>{{$request->company->name}}</td>
                    <td>{{$request->paid_to}}</td>
                    <td>{{$request->request_by}}</td>
                    <td>
                        @if($request->bookKeeper)
                            {{$request->bookKeeper->created_at}}
                        @endif
                    </td>
                    <td>
                        @if($request->accountant)
                            {{$request->accountant->created_at}}
                        @endif
                    </td>
                    <td>
                        @if($request->finance)
                            {{$request->finance->created_at}}
                        @endif
                    </td>
                    <td>
                        @if($request->auditor)
                            {{$request->auditor->created_at}}
                        @endif
                    </td>
                    <td>{{$request->status}}</td>
                    <td><!-- Request Status Data --></td>
                    <td><!-- Amount Request Data --></td>
                    <td><!-- Approved Amount Data --></td>
                    <td><!-- Balance Data --></td>
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


