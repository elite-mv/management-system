@extends('layouts.expense-index')

@section('title', 'Book Keeper')

@section('style')
    <style type="text/css">
        .book_keeper_nav {
            color: rgb(255, 255, 255, 1.0);
        }
    </style>
@endsection

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
                                        <input value="{{$app->request->from}}" name="from" class="form-control" type="date">
                                    </div>
                                    <div class="col-6">
                                        <label>To</label>
                                        <input  value="{{$app->request->to}}" name="to" class="form-control" type="date">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                            <div class="col-sm-12 col-md-6 text-start">
                                <i class="fas fa-table me-1"></i>
                                <b>Requests</b>
                            </div>
                            <div class="col-sm-12 col-md-6 text-end d-none" id="collapseLayout">
                                <button class="btn btn-sm btn-outline-danger rounded-0 px-4" onclick="console.log(window.localStorage.getItem('checkedStorage'));">[DO NOT CLICK]</button>
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

                if(!selection.checked){
                    checkedInputs.set(selection.value, selection.value);
                }else{
                    checkedInputs.delete(selection.value);
                }

                selection.checked =  requestAllInput.checked;
            })
        }

        filterForm.addEventListener('submit', (e) => {
            e.preventDefault();
            getData();
            filterModal.hide();
        })

        inputs.forEach(input => {
            input.addEventListener('change', () => {
                getData();
            })
        });

        window.addEventListener('load', () => {
            getData();
        })

        function saveMapToLocalStorage(map, key) {
            // Convert the Map to an array of [key, value] pairs
            const mapArray = Array.from(map.entries());
            // Serialize the array to a JSON string
            const mapString = JSON.stringify(mapArray);
            // Save the JSON string to localStorage
            localStorage.setItem(key, mapString);
        }

        function loadMapFromLocalStorage(key) {
            // Get the JSON string from localStorage
            const mapString = localStorage.getItem(key);
            // If there's no data, return an empty Map
            if (!mapString) return new Map();
            // Parse the JSON string to an array of [key, value] pairs
            const mapArray = JSON.parse(mapString);
            // Convert the array to a Map
            return new Map(mapArray);
        }

        function combineMaps(newMap, key) {
            // Load existing data
            const existingMap = loadMapFromLocalStorage(key);

            // Merge new data into existing data
            for (const [key, value] of newMap.entries()) {
                existingMap.set(key, value);
            }

            // Save the combined data back to localStorage
            saveMapToLocalStorage(existingMap, key);
        }

        function selectionEvent(e){

            if(e.target.checked){
                checkedInputs.set(e.target.value, e.target.value);
            }else{
                checkedInputs.delete(e.target.value);
            }

            if (window.localStorage.getItem('checkedStorage')) {
                combineMaps(checkedInputs, 'checkedStorage');
            } else {
                saveMapToLocalStorage(checkedInputs, 'checkedStorage');
            }
            const checkedStorage = loadMapFromLocalStorage('checkedStorage');

            if (checkedInputs instanceof Map ? checkedInputs.size === 0 : Object.keys(checkedInputs).length === 0) {
                $('#collapseLayout').addClass('d-none');
                window.localStorage.removeItem('checkedStorage')
            } else {
                $('#collapseLayout').removeClass('d-none');
            }

        }

        function clearForm(){
            filterForm.reset();
            getData();
        }

        function getData(cb = null) {

            let formData = new FormData(filterForm);

            if(cb){
                cb(formData);
            }

            const params = new URLSearchParams(formData);

            fetch(`/expense/api/book-keeper?${params.toString()}`, {
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                }
            })
                .then(data => data.text())
                .then(data => {

                    requestData.innerHTML = data;

                    requestInputSelections = document.querySelectorAll('.request-input-selection');

                    requestAllInput = document.querySelector('#requestAllInput')

                    requestAllInput.removeEventListener('change', addSelectionEvent)
                    requestAllInput.addEventListener('change', addSelectionEvent)


                    requestInputSelections.forEach(selection =>{

                        checkedInputs = loadMapFromLocalStorage('checkedStorage');
                        checkedInputs.forEach(([key, value]) => {
                            const targetId = `requestInput${key}`;
                            if (selection.id === targetId) {
                                selection.checked = true;
                                $('#collapseLayout').removeClass('d-none');
                            }
                        });

                        selection.removeEventListener('change', selectionEvent)
                        selection.addEventListener('change', selectionEvent)
                        document.querySelector('#requestAllInput').addEventListener('change', selectionEvent)
                    })

                    for (let key of checkedInputs.keys()) {

                        const target = document.querySelector(`#requestInput${key}`);

                        if(target){
                            target.checked = true;
                        }
                    }

                    setupPageLinks();
                }).catch(err => {
                console.error(err)
            })
        }

        function setupPageLinks(){

            const links = document.querySelectorAll('.page-link');

            links.forEach(link =>{
                link.addEventListener('click',(e)=>{

                    e.preventDefault();

                    const url = new URL(e.target.href);

                    getData(formData =>{
                        formData.append('page', url.searchParams.get("page") ?? 1);
                    });

                })
            })
        }
    </script>

    <script type="text/javascript" src="/js/sortable.js"></script>
@endsection
