@extends('layouts.app')


@section('title', 'Request')


@section('title')
<style type="text/css">
    .cart-items {
        cursor: pointer;
    }
    .cart-items:hover {
        background: rgba(0, 0, 0, 0.2);
        border: 1px solid rgba(0, 0, 0, 0.1) !important;
    }
    .uploaded-img {
        height: 250px;
        width: auto;
        max-width: none;
        max-height: none;
    }
</style>
@endsection


@section('body')
<div class="py-3 px-3 px-md-0">
    <div class="col">
    <div class="col-sm-12 col-md-10 mx-auto">

        <div class="d-flex overflow-y-auto m-0 border p-3 bg-white mb-3" style="gap: 0 25px; border-radius: 7px;" id="show_entity">
            @foreach ($companies as $company)
                <div class="col-auto p-0" style="display: flex; flex-direction: column; margin-inline: auto;">
                    <div style="width: 100px; height:100px">
                        <img style="object-fit:contain;" src="images/logos/{{ $company->logo }}" class="w-100 h-100 d-block mx-auto img-fluid" alt="{{ $company->name }}">
                    </div>

                    <div class="bg-danger px-2 rounded">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="checkbox" value="{{ $company->id }}" id="companySupplier{{$company->id}}">
                            <label class="form-check-label text-white" for="companySupplier{{$company->id}}">
                                {{ $company->name }}
                            </label>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row m-0">

            <div class="col-12 p-3 bg-white mb-3 border" id="request_details" style="display: flex; flex-direction: column; gap: 10px 0; border-radius: 7px;">
                    <label class="text-center text-white bg-dark fw-bold">REQUEST DETAILS</label>
                    <div class="row">
                        <p class="col-12 col-md-2 fw-bold">Supplier:</p>
                        <div class="col-12 col-md-10">
                            <input type="text" class="p-2 form-control" name="supplier">
                        </div>
                    </div>
                    <div class="row">
                        <p class="col-12 col-md-2 fw-bold">Paid to:</p>
                        <div class="col-12 col-md-10">
                            <input type="text" class="p-2 form-control" name="paid_to">
                        </div>
                    </div>
                    <div class="row">
                        <p class="col-12 col-md-2 fw-bold">Requested by:</p>
                        <div class="col-sm-12 col-md-10">
                            <input type="text" class="p-2 form-control" name="requested_by" required>
                        </div>
                    </div>
                    <div class="row">
                        <p class="col-12 col-md-2 fw-bold">Prepared by</p>
                        <div class="col-sm-12 col-md-10">
                            <input type="text" class="p-2 form-control" name="prepared_by" value="" disabled>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div id="request_items" class="mb-3 p-3 bg-white border" style="display: flex; flex-direction: column; border-radius: 7px;">
                    <label class="text-center text-white bg-dark fw-bold">REQUEST ITEMS</label>
                    <div id="request_cart">
                        <!-- DYNAMIC -->
                    </div>
                    <div class="row m-0 px-3 mb-1 bg-secondary">
                        <div class="col-1 text-center text-white">
                            QTY
                        </div>
                        <div class="col-2 text-center text-white">
                            UOM
                        </div>
                        <div class="col-2 text-center text-white">
                            JOB ORDER
                        </div>
                        <div class="col-3 text-center text-white">
                            DESCRIPTION
                        </div>
                        <div class="col-2 text-center text-white">
                            UNIT COST
                        </div>
                        <div class="col-2 text-center text-white">
                            TOTAL
                        </div>
                    </div>
                    <div class="row m-0 px-3">
                        <input type="hidden" name="id" class="request-item d-none p-2 form-control" autocomplete="off" required>
                        <div class="col-1">
                            <input type="number" value="1" min="1" name="qty" class="request-item p-2 form-control" autocomplete="off" required>
                        </div>
                        <div class="col-2">
                            <select name="uom" id="uom" class="request-item p-2 form-control">
                                @foreach($measurements as $measurement)
                                    <option value="{{$measurement->id}}">{{$measurement->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-2">
                            <select name="job_order" id="job_order" class="request-item form-control p-2">
                                @foreach($jobOrders as $jobOrder)
                                    <option value="{{$jobOrder->id}}">{{$jobOrder->reference}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-3">
                            <input type="text" name="description" class="request-item p-2 form-control" autocomplete="off">
                        </div>
                        <div class="col-2">
                            <input type="number" name="unit_cost" class="request-item p-2 form-control" step="0.1">
                        </div>
                        <div class="col-2">
                            <input type="number" name="total" disabled class="request-item p-2 form-control">
                        </div>
                    </div>
                    <div class="row m-0 px-3">

                        <div class="col-sm-12 col-md-6 col-lg-6 mb-2 d-none" id="add_image">
                            <form action="/api/request-item/file" method="POST" id="requestItemImageForm" enctype="multipart/form-data">
                                @csrf
                                <input id="requestItemImageInput" type="file" accept="image/*" multiple name="files[]" class="mt-2 h-100 w-100 p-2 border border-dark"  style="border-style: dashed !important; border-radius: 6px;">
                                <input id="requestItemImageId" type="hidden" name="requestId" class="d-none">
                            </form>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6 mb-2" id="uploaded_image" style="display: none;">
                            <div class="mt-2 h-100 w-100 p-2 border border-dark" id="image_container" style="display: flex; flex-direction: row; align-items: flex-start; gap: 5px; overflow: auto;">
                                <!-- DYNAMIC -->
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-3 mb-2" id="add_item">
                            <button type="button" name="add" class="btn btn-sm btn-success rounded-0 h-100 w-100 mt-2" disabled>ADD ITEM</button>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
                            <button type="button" name="update" class="btn btn-sm btn-warning rounded-0 h-100 w-100 mt-2" disabled>UPDATE ITEM</button>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
                            <button type="button" name="delete" class="btn btn-sm btn-danger rounded-0 h-100 w-100 mt-2" disabled>DELETE ITEM</button>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-3 mb-2">
                            <button type="button" name="unselect" class="btn btn-sm btn-dark rounded-0 h-100 w-100 mt-2">UNSELECT ITEM</button>
                        </div>
                        
                    </div>
                </div>
            </div>

            <div class="col-12 border" id="final_request">
                <div class="row m-0 bg-white">
                    <div class="col-12 col-md-5 p-3 d-flex align-items-center gap-2">
                            <label class="form-label text-nowrap">TOTAL :</label>
                            <input type="text" class="form-control p-2" name="total" disabled>
                    </div>
                    <div class="col-12 col-md-3 p-3">
                        <div class="d-flex align-items-center justify-content-between gap-1">
                            <label class="form-label">PRIORITY LEVEL</label>
                            <select class="form-control" name="check2">
                                <option value="None">Pick a level</option>
                                <option value="Low">Low (5 Days)</option>
                                <option value="Medium">Medium (3 Days)</option>
                                <option value="High">High (1 Day)</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-2 p-3 d-flex align-items-center gap-1">
                            <input class="form-check-input mt-0" type="checkbox" name="priority" value="priority">
                            <label class="form-label mb-0">PRIORITY</label>
                    </div>
                    <div class="col-sm-12 col-md-2 m-0 p-0">
                        <button type="button" name="submit" class="btn btn-success btn-md rounded-0 w-100 h-100">SUBMIT</button>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>
</div>

<input type="text" id="text-input" placeholder="Type your text here">
<button id="speak-button">Speak</button>

@endsection


@section('script')

<script type="text/javascript" src="./js/request.js"></script>
<script type="text/javascript" src="./js/header.js"></script>
@endsection