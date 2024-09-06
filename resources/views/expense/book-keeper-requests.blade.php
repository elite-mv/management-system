@extends('layouts.expense-index')


@section('title', 'Book Keeper')

@section('body')
    <div class="container p-3" style="position: relative;">
        <form id="filterForm" class="mb-2">

            <div class="d-flex mb-2 gap-2 align-items-center">
                <div class="w-100 mt-2 mt-md-0 form-group d-flex gap-2 align-items-center">
                    <i class="fas fa-search"></i>
                    <input autocomplete="off" name="search" type="search" class="form-control inputs"
                           placeholder="Search..." value="{{$app->request->search}}">
                </div>

                <!-- Button trigger modal -->
                <button type="button" class="mt-2 mt-md-0  btn" data-bs-toggle="modal"
                        data-bs-target="#filterModal" data-bs-placement="top"
                        title="Advance filter">
                    <i class="fas fa-filter"></i>
                </button>

                <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Advance Filter</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group row mb-2">
                                    <div class="col-6">
                                        <label>From</label>
                                        <input name="from" class="form-control" type="date">
                                    </div>
                                    <div class="col-6">
                                        <label>To</label>
                                        <input name="to" class="form-control" type="date">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" onclick="clearForm()" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Clear Filter
                                </button>
                                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Filter</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row align-items-center">
                <div class="col-6 col-md-3 form-group d-flex gap-2 align-items-center">
                    <label class="form-label mb-0" for="status">Payment Status</label>
                    <select name="paymentStatus" class="form-control inputs" id="status">
                        <option value="ALL">All</option>
                        @foreach(\App\Enums\RequestStatus::cases() as $status)
                            <option @selected($app->request->paymentStatus == $status->value) value="{{$status->value}}">{{$status->value}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-6 col-md-3 form-group d-flex gap-2 align-items-center">
                    <label class="form-label mb-0" for="status">Book Keeper</label>
                    <select name="status" class="form-control inputs" id="status">
                        <option value="ALL">All</option>
                        @foreach(\App\Enums\RequestApprovalStatus::status() as $status)
                            <option  @selected($app->request->status == $status->name)  value="{{$status->name}}">{{$status->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-6 col-md-3 form-group d-flex gap-2 align-items-center">
                    <label class="form-label">Entries</label>
                    <select name="entries" class="form-control inputs">
                        <option @selected($app->request->entries == 20) value="20">20</option>
                        <option @selected($app->request->entries == 30) value="30">30</option>
                        <option @selected($app->request->entries == 40) value="40">40</option>
                        <option @selected($app->request->entries == 50) value="50">50</option>
                        <option @selected($app->request->entries == 100) value="100">100</option>
                    </select>
                </div>

                <div class="col-6 col-md-3 form-group d-flex gap-2 align-items-center">
                    <label class="form-label">Entity</label>
                    <select name="entity" class="form-control inputs">
                        <option value="ALL">ALL</option>
                        @foreach($companies as $company)
                            <option @selected($app->request->entity == $company->id) value="{{$company->id}}">{{$company->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>

        <div class="row mb-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6 text-start">
                                <i class="fas fa-table me-1"></i>
                                <b>Requests</b>
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
                                <th>TOTAL</th>
                                <th>ACTION</th>
                            </tr>
                            </thead>
                            <tbody id="requestData">
                            @forelse ($requests as $request)
                                <tr>
                                    <td>
                                        <input id="requestInput{{$request->id}}" type="checkbox"
                                               class="form-check-input request-input-selection">
                                    </td>
                                    <td>{{ $request->reference}}</td>
                                    <td>{{$request->created_at->diffForHumans()}}</td>
                                    <td class="text-uppercase">{{ $request->company->name}}</td>
                                    <td class="text-capitalize">{{ $request->request_by}}</td>
                                    <td class="text-uppercase">{{ $request->status}}</td>
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
                        <div class="container-fluid">
                            {{ $requests->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script>

        const filterModal = new bootstrap.Modal('#filterModal');
        const checkedInputs = new Map();

        const requestData = document.querySelector('#requestData');
        const filterForm = document.querySelector('#filterForm');
        const inputs = document.querySelectorAll('.inputs');

        let requestAllInput;
        let requestInputSelections = [];

        inputs.forEach(input => {
            input.addEventListener('change', () => {
                filterForm.submit();
            })
        });

        function addSelectionEvent() {
            requestInputSelections.forEach(selection => {

                if (!selection.checked) {
                    checkedInputs.set(selection.value, selection.value);
                } else {
                    checkedInputs.delete(selection.value);
                }

                selection.checked = requestAllInput.checked;

                console.log(checkedInputs);
            })
        }

        function selectionEvent(e) {

            if (e.target.checked) {
                checkedInputs.set(e.target.value, e.target.value);
            } else {
                checkedInputs.delete(e.target.value);
            }

            console.log(checkedInputs);
        }

        function clearForm() {
            filterForm.reset();
            filterForm.submit();
        }

    </script>

    <script type="text/javascript" src="/js/sortable.js"></script>
@endsection
