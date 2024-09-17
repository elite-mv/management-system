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
                <form method="GET" id="filterForm">
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

                    <div class="row align-items-center justify-content-around">
                        <div class="col-6 col-md-3 form-group d-flex gap-2 align-items-center">
                            <label class="form-label mb-0 text-nowrap" for="status">Job Order</label>
                            <select name="jobOrder" class="form-select inputs" style="background-color: rgba(255, 255, 255, 0.4);
                            box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 15px;
                            border: 1px solid rgba(255, 255, 255, 0.5);
                            border-right: 1px solid rgba(255, 255, 255, 0.2);
                            border-bottom: 1px solid rgba(255, 255, 255, 0.2);">
                                <option value="ALL">All</option>
                                @foreach($jobOrders as $jobOrder)
                                    <option @selected($app->request->jobOrder == $jobOrder->id) value="{{$jobOrder->id}}">{{$jobOrder->reference}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-6 col-md-3 form-group d-flex gap-2 align-items-center">
                            <label class="form-label mb-0 text-nowrap" for="status">Bank Code</label>
                            <select name="bankCode" class="form-select inputs" style="background-color: rgba(255, 255, 255, 0.4);
                            box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 15px;
                            border: 1px solid rgba(255, 255, 255, 0.5);
                            border-right: 1px solid rgba(255, 255, 255, 0.2);
                            border-bottom: 1px solid rgba(255, 255, 255, 0.2);">
                                <option value="ALL">All</option>
                                @foreach($bankCodes as $bankCode)
                                    <option @selected($app->request->bankCode == $bankCode->id) value="{{$bankCode->id}}">{{$bankCode->code}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-6 col-md-3 form-group d-flex gap-2 align-items-center">
                            <label class="form-label mb-0 text-nowrap" for="status">Entity</label>
                            <select name="company" class="form-select inputs" style="background-color: rgba(255, 255, 255, 0.4);
                            box-shadow: rgba(0, 0, 0, 0.1) 0px 1px 15px;
                            border: 1px solid rgba(255, 255, 255, 0.5);
                            border-right: 1px solid rgba(255, 255, 255, 0.2);
                            border-bottom: 1px solid rgba(255, 255, 255, 0.2);">
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
        </div>
        <div class="row mb-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header row">
                        <div class="col-sm-12 col-md-6 d-flex text-start align-items-center">
                            <div class="text-start">
                                <i class="fas fa-table me-1"></i>
                                <b>Daily Requests</b>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 text-end">
                            <form method="POST" action="/expense/excel-items" id="auditItemForm">
                                @csrf
                                <input class="d-none" type="hidden" id="auditItemInput" name="id[]">
                                <button class="btn btn-sm btn-outline-success rounded-0 px-4"
                                        type="submit">
                                    Download Excel
                                </button>
                            </form>
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

