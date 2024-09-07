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
                        <form id="filterForm">

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

                                <!-- Button trigger modal -->
                                <button type="button" class="mt-2 mt-md-0  btn" data-bs-toggle="modal"
                                        data-bs-target="#filterModal"  data-bs-placement="top"
                                        title="Advance filter">
                                    <i class="fas fa-filter"></i>
                                </button>

                                <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Advance Filter</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                                <button type="button" onclick="clearForm()" class="btn btn-secondary" data-bs-dismiss="modal">Clear Filter</button>
                                                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Filter</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row align-items-center">
                                <div class="col-6 col-md-3 form-group d-flex gap-2 align-items-center">
                                    <label class="form-label mb-0" for="status">Payment Status</label>
                                    <select name="paymentStatus" class="form-select inputs" id="status" style="background-color: rgba(255, 255, 255, 0.4);
                                    box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 15px;
                                    border: 1px solid rgba(255, 255, 255, 0.5);
                                    border-right: 1px solid rgba(255, 255, 255, 0.2);
                                    border-bottom: 1px solid rgba(255, 255, 255, 0.2);">
                                        <option value="ALL">All</option>
                                        @foreach(\App\Enums\RequestStatus::cases() as $status)
                                            <option value="{{$status->value}}">{{$status->value}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-6 col-md-3 form-group d-flex gap-2 align-items-center">
                                    <label class="form-label mb-0" for="status">Book Keeper</label>
                                    <select name="status" class="form-select inputs" id="status" style="background-color: rgba(255, 255, 255, 0.4);
                                    box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 15px;
                                    border: 1px solid rgba(255, 255, 255, 0.5);
                                    border-right: 1px solid rgba(255, 255, 255, 0.2);
                                    border-bottom: 1px solid rgba(255, 255, 255, 0.2);">
                                        <option value="ALL">All</option>
                                        @foreach(\App\Enums\RequestApprovalStatus::status() as $status)
                                            <option value="{{$status->name}}">{{$status->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-6 col-md-3 form-group d-flex gap-2 align-items-center">
                                    <label class="form-label">Entries</label>
                                    <select name="entries" class="form-select inputs" style="background-color: rgba(255, 255, 255, 0.4);
                                    box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 15px;
                                    border: 1px solid rgba(255, 255, 255, 0.5);
                                    border-right: 1px solid rgba(255, 255, 255, 0.2);
                                    border-bottom: 1px solid rgba(255, 255, 255, 0.2);">
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                        <option value="15">15</option>
                                        <option value="20">20</option>
                                        <option value="25">30</option>
                                        <option value="25">50</option>
                                        <option value="25">100</option>
                                    </select>
                                </div>

                                <div class="col-6 col-md-3 form-group d-flex gap-2 align-items-center">
                                    <label class="form-label">Entity</label>
                                    <select name="entity" class="form-select inputs" style="background-color: rgba(255, 255, 255, 0.4);
                                    box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 15px;
                                    border: 1px solid rgba(255, 255, 255, 0.5);
                                    border-right: 1px solid rgba(255, 255, 255, 0.2);
                                    border-bottom: 1px solid rgba(255, 255, 255, 0.2);">
                                        <option value="ALL">ALL</option>
                                        @foreach($companies as $company)
                                            <option value="{{$company->id}}">{{$company->name}}</option>
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
