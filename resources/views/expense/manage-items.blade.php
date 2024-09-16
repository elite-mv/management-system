@extends('layouts.expense-index')

@section('title', 'Audit Items')

@section('body')


    <div class="container p-3" style="position: relative;">


        @if($errors->any())
            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    {{$errors->first()}}
                </div>
            @endif
        @endif

        <div class="mb-2">
            <form method="GET" class="mx-0 row gap-2 bg-white py-2 rounded" id="filterForm">

                <div class="col-12">
                    <input autocomplete="off" value="{{$app->request->search}}" name="search" type="search" class="form-control">
                </div>
                <div class="d-flex align-items-center gap-2">

                    <div class="d-flex gap-2 align-items-center">
                        <label class="text-nowrap">Job Order</label>
                        <select name="jobOrder" class="form-select">
                            <option value="ALL">All</option>
                            @foreach($jobOrders as $jobOrder)
                                <option @selected($app->request->jobOrder == $jobOrder->id) value="{{$jobOrder->id}}">{{$jobOrder->reference}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="d-flex gap-2 align-items-center">
                        <label class="text-nowrap">Bank Code</label>
                        <select name="bankCode" class="form-select">
                            <option value="ALL">All</option>
                            @foreach($bankCodes as $bankCode)
                                <option @selected($app->request->bankCode == $bankCode->id) value="{{$bankCode->id}}">{{$bankCode->code}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="d-flex gap-2 align-items-center">
                        <label>Entity</label>
                        <select name="company" class="form-select">
                            <option value="ALL">All</option>
                            @foreach($companies as $company)
                                <option  @selected($app->request->company == $company->id)  value="{{$company->id}}">{{$company->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <input class="d-none" type="hidden" id="filterInputId" name="id[]">

            </form>
        </div>
        <div class="mb-2">
            <form method="POST" action="/expense/excel-items" id="auditItemForm">
                @csrf
                <input class="d-none" type="hidden" id="auditItemInput" name="id[]">
                <button type="submit" class="btn btn-success">Download Excel</button>
            </form>
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
                        @include('expense.partials.manage-items-table')
                    </div>
                    {{$items->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        const filterForm = document.querySelector('#filterForm');
        const filterInputId = document.querySelector('#filterInputId');

        const auditItemForm = document.querySelector('#auditItemForm');
        const auditItemInput = document.querySelector('#auditItemInput');

        if(auditItemForm){

            auditItemForm.addEventListener('submit', (e) => {
                e.preventDefault();

                auditItemInput.value = JSON.parse(localStorage.getItem('checkedInputs'));

                auditItemForm.submit();
            })
        }

        function submitFilterForm(){
            filterInputId.value = JSON.parse(localStorage.getItem('checkedInputs'));
            filterForm.submit();
        }

        filterForm.addEventListener('submit',(e)=>{
            e.preventDefault();
            submitFilterForm();
        })

        document.querySelector('#filterForm select[name="jobOrder"]').addEventListener('change', function() {
            submitFilterForm();
        })

        document.querySelector('#filterForm select[name="bankCode"]').addEventListener('change', function() {
            submitFilterForm();
        })

        document.querySelector('#filterForm select[name="company"]').addEventListener('change', function() {
            submitFilterForm();
        })
    </script>
@endsection

