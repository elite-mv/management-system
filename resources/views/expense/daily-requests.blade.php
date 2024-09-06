@extends('layouts.expense-index')


@section('title', 'Daily Request')

@section('body')
    <div class="container p-3" style="position: relative;">
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
                                <th class="sorttable_nosort">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="requestAllInput">
                                    </div>
                                </th>
                                <th>REFERENCE</th>
                                <th>DURATION</th>
                                <th>ENTITY</th>
                                <th>REQUESTED BY</th>
                                <th>STATUS</th>
                                <th>BANK</th>
                                <th>BANK CODE</th>
                                <th>CHECK NUMBER</th>
                                <th>TOTAL</th>
                                <th>ACTION</th>
                            </tr>
                            </thead>
                            <tbody id="requestData">
                            @forelse ($requests as $request)
                                <tr>
                                    <th>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="{{$request->id}}"
                                                   id="requestAllInput{{$request->id}}">
                                        </div>
                                    </th>
                                    <td>{{ $request->reference}}</td>
                                    <td>{{$request->created_at->diffForHumans()}}</td>
                                    <td>{{ $request->company->name}}</td>
                                    <td>{{ $request->request_by}}</td>
                                    <td>{{ $request->status}}</td>
                                    <td>
                                        @if($request->bankDetails)
                                            {{ $request->bankDetails->bank->name}}
                                        @else
                                            --
                                        @endif
                                    </td>
                                    <td>
                                        @if($request->bankDetails)
                                            {{ $request->bankDetails->code->code}}
                                        @else
                                            --
                                        @endif
                                    </td>
                                    <td>
                                        @if($request->bankDetails)
                                            {{ $request->bankDetails->check_number}}
                                        @else
                                            --
                                        @endif
                                    </td>
                                    <td>{!! \App\Helper\Helper::formatPeso( $request->items->first()->total_cost ) !!}</td>
                                    <td>
                                        <a target="_blank" role="button" href="/expense/request/{{$request->id}}"
                                           class="btn btn-primary">View</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan='8'>
                                        <p class="text-secondary">
                                            EMPTY TABLE
                                        </p>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{$requests->links()}}
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

