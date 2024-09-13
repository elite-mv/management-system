@extends('layouts.expense-index')


@section('title', 'Request')


@section('style')
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

        .request_nav {
            color: rgb(255, 255, 255, 1.0);
        }
    </style>
@endsection


@section('body')


    <div class="container-fluid">
        @if($errors->any())
            <div class="alert alert-danger" role="alert">
               {{$errors->first()}}
            </div>
        @endif
    </div>

    <form id="requestForm" method="POST" action="/expense/request">
        @csrf
        <div class="p-3 px-md-0 m-0">

            <div class="row m-0">
                <div class="col-sm-12 col-md-10 mx-auto">

                    <div class="d-flex overflow-y-auto m-0 p-3 mb-3" style="gap: 0 30px; border-radius: 7px;
                    background-color: rgba(255, 255, 255, 0.2);
                    box-shadow: 0 25px 45px rgba(0, 0, 0, 0.1);
                    border: 1px solid rgba(255, 255, 255, 0.5);
                    border-right: 1px solid rgba(255, 255, 255, 0.2);
                    border-bottom: 1px solid rgba(255, 255, 255, 0.2);" id="show_entity">
                        @foreach ($companies as $company)
                            <div class="col-auto p-0" style="display: flex; flex-direction: column; margin-inline: auto; min-width: 130px;
                            background-color: rgba(255, 255, 255, 0.3);
                            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
                            border: 1px solid rgba(255, 255, 255, 0.5);
                            border-right: 1px solid rgba(255, 255, 255, 0.2);
                            border-bottom: 1px solid rgba(255, 255, 255, 0.2);">
                                <div style="width: 100px; height:100px;" class="mx-auto">
                                    <img style="object-fit: contain; height: 100px;" src="/././images/logos/{{ $company->logo }}" class="d-block mx-auto img-fluid" alt="{{ $company->name }}">
                                </div>

                                <div class="bg-danger bg-gradient px-3 rounded-0 m-1 mt-0 border">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="company" value="{{ $company->id }}" id="companySupplier{{$company->id}}">
                                        <label class="form-check-label text-white" for="companySupplier{{$company->id}}">
                                            {{ $company->name }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="m-0 border p-3 mb-3" style="border-radius: 7px;
                    background-color: rgba(255, 255, 255, 0.2);
                    box-shadow: 0 25px 45px rgba(0, 0, 0, 0.1);
                    border: 1px solid rgba(255, 255, 255, 0.5);
                    border-right: 1px solid rgba(255, 255, 255, 0.2);
                    border-bottom: 1px solid rgba(255, 255, 255, 0.2);" id="request_details">
                        <div class="d-flex flex-column gap-2 p-4" style="background-color: rgba(255, 255, 255, 0.3);
                            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
                            border: 1px solid rgba(255, 255, 255, 0.5);
                            border-right: 1px solid rgba(255, 255, 255, 0.2);
                            border-bottom: 1px solid rgba(255, 255, 255, 0.2);">
                            <label class="text-center text-white bg-dark bg-gradient fw-bold py-1 mb-2">REQUEST DETAILS</label>
                            <div class="row">
                                <p class="col-12 col-md-2 fw-bold">Supplier:</p>
                                <div class="col-12 col-md-10">
                                    <input type="text" class="p-2 form-control" name="supplier">
                                </div>
                            </div>
                            <div class="row">
                                <p class="col-12 col-md-2 fw-bold">Paid to:</p>
                                <div class="col-12 col-md-10">
                                    <input type="text" class="p-2 form-control" name="paidTo">
                                </div>
                            </div>
                            <div class="row">
                                <p class="col-12 col-md-2 fw-bold">Requested by:</p>
                                <div class="col-sm-12 col-md-10">
                                    <input type="text" class="p-2 form-control" name="requestedBy" required>
                                </div>
                            </div>
                            <div class="row">
                                <p class="col-12 col-md-2 fw-bold">Prepared by</p>
                                <div class="col-sm-12 col-md-10">
                                    <input type="text" class="p-2 form-control" name="preparedBy" value="{{auth()->user()->name}}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="m-0 border p-3 mb-3" style="border-radius: 7px;
                    background-color: rgba(255, 255, 255, 0.2);
                    box-shadow: 0 25px 45px rgba(0, 0, 0, 0.1);
                    border: 1px solid rgba(255, 255, 255, 0.5);
                    border-right: 1px solid rgba(255, 255, 255, 0.2);
                    border-bottom: 1px solid rgba(255, 255, 255, 0.2);" id="request_items">
                        <div class="d-flex flex-column p-4" style="background-color: rgba(255, 255, 255, 0.3);
                            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
                            border: 1px solid rgba(255, 255, 255, 0.5);
                            border-right: 1px solid rgba(255, 255, 255, 0.2);
                            border-bottom: 1px solid rgba(255, 255, 255, 0.2);">

                            <div class="d-flex flex-column justify-content-start overflow-x-auto p-4">
                                <table class="table table-bordered table-responsive table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th scope="col" class="text-center">QTY</th>
                                            <th scope="col" class="text-center">UOM</th>
                                            <th scope="col" class="text-center">JOB ORDER</th>
                                            <th scope="col" class="text-center">DESCRIPTION</th>
                                            <th scope="col" class="text-center">UNIT COST</th>
                                            <th scope="col" class="text-center">TOTAL</th>
                                        </tr>
                                    </thead>
                                    <tbody id="request_cart"></tbody>
                                </table>
                            </div>

                            <div class="d-flex flex-column justify-content-start overflow-x-auto p-4 gap-2">
                                <label class="text-center text-white bg-dark bg-gradient fw-bold py-1 mb-2">REQUEST ITEMS</label>

                                <input type="hidden" id="requestId" class="d-none">

                                <div class="row">
                                    <p class="col-12 col-md-2 fw-bold">Quantity:</p>
                                    <div class="col-12 col-md-10">
                                        <input type="number" id="requestQuantity" min="1" class="p-2 form-control" autocomplete="off">
                                    </div>
                                </div>

                                <div class="row">
                                    <p class="col-12 col-md-2 fw-bold">Units of measurement:</p>
                                    <div class="col-12 col-md-10">
                                        <select id="requestUnitOfMeasure" class="p-2 form-control">
                                            <option disabled selected>--</option>
                                            @foreach($measurements as $measurement)
                                                <option value="{{$measurement->id}}">{{$measurement->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <p class="col-12 col-md-2 fw-bold">Job Order:</p>
                                    <div class="col-12 col-md-10">
                                        <select id="requestJobOrder" class="form-control p-2">
                                            <option disabled selected>--</option>
                                            @foreach($jobOrders as $jobOrder)
                                                <option value="{{$jobOrder->id}}">{{$jobOrder->reference}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <p class="col-12 col-md-2 fw-bold">Description:</p>
                                    <div class="col-12 col-md-10">
                                        <input type="text" id="requestDescription" class="p-2 form-control" autocomplete="off">
                                    </div>
                                </div>

                                <div class="row">
                                    <p class="col-12 col-md-2 fw-bold">Unit cost:</p>
                                    <div class="col-12 col-md-10">
                                        <input type="number" id="requestUnitCost" class="p-2 form-control" step="0.1">
                                    </div>
                                </div>

                                <div class="row">
                                    <p class="col-12 col-md-2 fw-bold">Total:</p>
                                    <div class="col-12 col-md-10">
                                        <input type="text" id="requestTotal" class="p-2 form-control" readonly>
                                    </div>
                                </div>

                                <div class="row m-0 p-0">
                                    <div class="col-sm-12 col-md-6 mb-2 d-none p-0 pe-md-1" id="itemAttachment">
                                        <input id="requestItemImageInput" type="file" accept="image/*" multiple name="files[]" class="mt-2 h-100 w-100 p-2 border border-dark border-dashed" style="border-style: dashed !important; border-radius: 6px;">
                                    </div>

                                    <div class="col-sm-12 col-md-6 mb-2 d-none p-0 ps-md-1" id="itemAttachmentPreview">
                                        <div class="mt-2 h-100 w-100 p-2 border border-dark" id="image_container"
                                            style="display: flex; flex-direction: row; align-items: flex-start; gap: 5px; overflow: auto;">
                                            <!-- DYNAMIC -->
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-3 mb-2 p-0 pe-md-1" id="add_item">
                                        <button type="button" onclick="addItem()" class="btn btn-sm btn-success rounded-0 h-100 w-100 mt-2">ADD ITEM
                                        </button>
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-3 mb-2 p-0 ps-md-1 px-lg-1">
                                        <button type="button" name="update" onclick="updateItem()" class="btn btn-sm btn-warning rounded-0 h-100 w-100 mt-2">UPDATE
                                            ITEM
                                        </button>
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-3 mb-2 p-0 pe-md-1 px-lg-1">
                                        <button onclick="deleteItem()" type="button" name="delete" class="btn btn-sm btn-danger rounded-0 h-100 w-100 mt-2">DELETE
                                            ITEM
                                        </button>
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-3 mb-2 p-0 ps-md-1">
                                        <button type="button" name="unselect" onclick="unselectItem()" class="btn btn-sm btn-dark rounded-0 h-100 w-100 mt-2">UNSELECT ITEM
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="m-0 border p-3 mb-3" style="border-radius: 7px;
                    background-color: rgba(255, 255, 255, 0.2);
                    box-shadow: 0 25px 45px rgba(0, 0, 0, 0.1);
                    border: 1px solid rgba(255, 255, 255, 0.5);
                    border-right: 1px solid rgba(255, 255, 255, 0.2);
                    border-bottom: 1px solid rgba(255, 255, 255, 0.2);" id="final_request">
                        <div class="row m-0 gap-3 p-4" style="background-color: rgba(255, 255, 255, 0.3);
                            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
                            border: 1px solid rgba(255, 255, 255, 0.5);
                            border-right: 1px solid rgba(255, 255, 255, 0.2);
                            border-bottom: 1px solid rgba(255, 255, 255, 0.2);">
                            <div class="col-auto d-flex flex-row gap-2 align-items-center me-auto">
                                <label class="form-label text-nowrap m-0">TOTAL :</label>
                                <input id="itemTotal" type="text" class="form-control p-2" name="total" disabled>
                            </div>
                            <div class="col-auto me-auto">
                                <select class="form-control" name="priorityLevel" id="requestPriorityLevel">
                                    <option value="{{\App\Enums\RequestPriorityLevel::NONE->name}}">Pick a level</option>
                                    <option value="{{\App\Enums\RequestPriorityLevel::LOW->name}}">Low (5 Days)</option>
                                    <option value="{{\App\Enums\RequestPriorityLevel::MEDIUM->name}}">Medium (3 Days)</option>
                                    <option value="{{\App\Enums\RequestPriorityLevel::HIGH->name}}">High (1 Day)</option>
                                </select>
                            </div>
                            <div class="col-auto d-flex flex-row gap-2 align-items-center me-auto">
                                <input class="form-check-input mt-0" type="checkbox" name="priority" value="priority" id="requestPriority">
                                <label class="form-label mb-0">PRIORITY</label>
                            </div>
                            <div class="col-auto mx-auto">
                                <button type="submit" class="btn btn-success btn-md rounded-0 px-5 w-100 h-100">
                                    SUBMIT
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </form>

@endsection

@section('script')
    <script>
        const uploadImageInput = document.querySelector('#requestItemImageInput');

        const requestForm = document.querySelector('#requestForm');
        const requestPriorityLevel = document.querySelector('#requestPriorityLevel');
        const requestPriority = document.querySelector('#requestPriority');
        const itemTotal = document.querySelector('#itemTotal');

        const requestItemId = document.querySelector('#requestId');
        const requestItemQuantity = document.querySelector('#requestQuantity');
        const requestItemUnitOfMeasure = document.querySelector('#requestUnitOfMeasure');
        const requestItemJobOrder = document.querySelector('#requestJobOrder');
        const requestItemDescription = document.querySelector('#requestDescription');
        const requestItemUnitCost = document.querySelector('#requestUnitCost');
        const requestItemTotal = document.querySelector('#requestTotal');

        const requestItemAttachment = document.querySelector('#itemAttachment');
        const requestItemAttachmentPreview = document.querySelector('#itemAttachmentPreview');

        let selectedIndex = null;

        window.addEventListener("load", ()=>{
            viewCart();
            calculateTotal();
        });


        const formatter = new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'PHP',
        });

        requestItemQuantity.addEventListener('change',calculateSubtotal)
        requestItemUnitCost.addEventListener('change',calculateSubtotal)

        requestForm.addEventListener('submit',(e)=>{

            e.preventDefault();

            const requestCompany =  document.querySelector('input[name="company"]:checked');

            if(!requestCompany){
                Swal.fire({
                    icon: "warning",
                    title: "Oops...",
                    text: "Please select a company first",
                });

                return;
            }

            requestForm.submit();
        })

        function calculateSubtotal(){
            let total =   Number(requestItemQuantity.value) *  Number(requestItemUnitCost.value);
            requestItemTotal.value = formatter.format(total);
        }

        // Called when an expense request is click
        async function onSelectExpenseRequest(requestId) {

            try {

                unselectRow(selectedIndex);
                selectedIndex = requestId;
                selectRow(selectedIndex);

                let result = await fetch(`/expense/api/request-item/${requestId}`)

                if (!result.ok) {

                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "An error occurred while fetching selected item",
                    });

                    unselectRow(selectedIndex);
                    selectedIndex = null;
                    return;
                }

                let data = await result.json();

                console.log(data);

                requestItemId.value = data.id;
                requestItemUnitOfMeasure.value = data.measurement_id;
                requestItemJobOrder.value = data.job_order_id;
                requestItemQuantity.value = data.quantity;
                requestItemDescription.value = data.description;
                requestItemUnitCost.value = data.cost;
                requestItemTotal.value = formatter.format(data.total);

            } catch (error) {
                console.error(error.message);
            }
        }

        function selectRow(id) {

            const row = document.querySelector(`#requestItem${id}`);

            if (!row) {
                console.warn('Selecting a null index row');
                return;
            }

            row.classList
                .add('bg-secondary', 'text-white');

            requestItemAttachment
                .classList
                .remove('d-none');

            requestItemAttachmentPreview
                .classList
                .remove('d-none');

        }

        function unselectRow(id) {

            const row = document.querySelector(`#requestItem${id}`);

            if (!row) {
                console.warn('Unselecting a null index row');
                return;
            }

            row.classList
                .remove('bg-secondary', 'text-white');

            requestItemAttachment
                .classList
                .add('d-none');

            requestItemAttachmentPreview
                .classList
                .add('d-none');
        }

        function unselectItem() {
            requestItemId.value = null; // Setting requestItemId to null
            requestItemUnitOfMeasure.value = null; // Setting Unit of Measure to null
            requestItemJobOrder.value = null; // Setting Job Order to null
            requestItemQuantity.value = null; // Setting Quantity to null
            requestItemDescription.value = null; // Setting Description to null
            requestItemUnitCost.value = null; // Setting Unit Cost to null
            requestItemTotal.value = null; // Setting Total to null

            unselectRow(selectedIndex)
            selectedIndex = null;
        }

        async function deleteItem() {

            try {
                let result = await fetch(`/expense/api/request-item/delete/${selectedIndex}`, {
                    method: 'POST',
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                    }
                })

                const data = await  result.json();

                if (!result.ok) {

                    console.log(data);

                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "An error occurred while deleting item selected item",
                    });

                    return;
                }

                unselectItem();
                selectedIndex = null;
                viewCart();
                calculateTotal();


            } catch (error) {
                console.error(error.message);
            }
        }

        async function updateItem() {

            try {
                let formData = new FormData();

                formData.append('quantity', requestItemQuantity.value);
                formData.append('measurement', requestItemUnitOfMeasure.value);
                formData.append('jobOrder', requestItemJobOrder.value);
                formData.append('description', requestItemDescription.value);
                formData.append('cost', requestItemUnitCost.value);

                let result = await fetch(`/expense/api/request-item/${selectedIndex}`, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                    }
                })

                if (!result.ok) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "An error occurred while updating a request item",
                    });

                    return;
                }

                await viewCart();
                selectRow(selectedIndex);
                calculateTotal();

                speek('Item has been updated!');

            } catch (error) {
                console.error(error.message);
            }
        }

        async function addItem() {

            try {

                if (selectedIndex) {
                    throw Error('Cannot add item, please unselect the item first');
                }

                let formData = new FormData();

                formData.append('quantity', requestItemQuantity.value);
                formData.append('measurement', requestItemUnitOfMeasure.value);
                formData.append('jobOrder', requestItemJobOrder.value);
                formData.append('description', requestItemDescription.value);
                formData.append('cost', requestItemUnitCost.value);

                let result = await fetch(`/expense/api/request-item`, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                    }
                })

                if (!result.ok) {
                    throw Error('An error occurred while updating a request item')
                }

                await viewCart();
                unselectItem();
                calculateTotal();

            } catch (error) {
                console.error(error.message);
            }
        }

        async function viewCart() {
            try {

                let response = await fetch(`/expense/api/request-item`)

                if (!response.ok) {

                    console.log(response);

                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: 'An error occurred while retrieving items',
                    });

                    return;
                }

                let data = await response.text();

                $('#request_cart').html(data);

            } catch (error) {
                console.error(error.message);
            }
        }

        async function calculateTotal() {

            try {
                let result = await fetch(`/expense/api/request-item/total`, {
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                    }
                })

                if (!result.ok) {
                    throw Error('An error occurred while getting total')
                }

                let data = await result.json();

                itemTotal.value = formatter.format(data.total);

            } catch (error) {
                console.error(error.message);
            }
        }

        uploadImageInput.addEventListener('change', async () => {

            let formData = new FormData();

            const files = uploadImageInput.files;

            Array.from(files).forEach(file => {
                formData.append('files[]', file);
            });


            try {

                let result = await fetch(`/expense/api/request-item/file/${selectedIndex}`, {
                    method: "POST",
                    body: formData,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                    }
                })

                if (!result.ok) {

                    let data = await result.json();

                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: 'An error occurred while uploading attachment',
                    });

                    console.log(data);

                    return;
                }

                let files = await result.json();

                files.images.forEach(src => {

                    let imageSrc = (src.split('/'))[1];

                    const thumbnail = $('<div>').append($('<img>').attr('src', '/storage/' + imageSrc).addClass('uploaded-img imageModal'));
                    $('#image_container').append(thumbnail);
                });

                reloadImageModal();
            } catch (error) {
                Swal.fire({
                    icon: "error",
                    title: "Oops...",
                    text: error.message,
                })

            } finally {
                uploadImageInput.value = null;
            }
        })
    </script>
@endsection
