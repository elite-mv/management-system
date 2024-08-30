@extends('layouts.income-index')

@section('title', 'MS [ Income ] - Invoices')

@section('style')
    <style>
        .income-with-nav > nav {
            .invoice {
                background-color: rgb(24, 28, 46);
            }
        }

        .star {
            font-size: 1.25rem;
            transition: color 0.3s;
        }

        .star:hover, .star.filled {
            color: gold;
        }

        .star.empty {
            color: black;
        }

        .file-input-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            border: 2px dashed #007bff;
            border-radius: 4px;
            padding: 40px 0;
            background-color: #f8f9fa;
            cursor: pointer;
            color: #007bff;
            text-align: center;
        }

        .file-input-wrapper input[type="file"] {
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .file-input-wrapper.dragover {
            border-color: #0056b3;
            background-color: #e9ecef;
        }

        .file-name {
            margin-top: 10px;
            color: #343a40;
        }
    </style>
@endsection

@section('body')

    <div class="w-100 d-flex align-items-start border">
        <div class="container-fluid p-3">
            {{-- <div class="row">
                <div class="col-12 text-start">
                    <p class="d-inline-flex gap-1">
                        <a class="btn btn-outline-primary rounded-0" data-bs-toggle="collapse" href="#Collapse1" role="button" aria-expanded="false" aria-controls="Collapse1">FILTER</a>
                    </p>
                    <div class="row pb-3">
                        <div class="col">
                          <div class="collapse overflow-hidden" id="Collapse1">
                                <div class="card card-body rounded-0 container-fluid">
                                    <div class="gap-3 px-3 row">
                                        <div class="col-auto d-flex align-items-center justify-content-center gap-3 border px-3 py-1 bg-light">
                                            <div>
                                                  <input type="radio" name="filters" class="me-2"><small>A-Z</small>
                                            </div>
                                            <div>
                                                  <input type="radio" name="filters" class="me-2"><small>Z-A</small>
                                            </div>
                                        </div>
                                        <div class="col-auto d-flex align-items-center justify-content-center gap-3 border px-3 py-1 bg-light">
                                            <div>
                                                  <input type="radio" name="filters" class="me-2"><small>0-9</small>
                                            </div>
                                            <div>
                                                  <input type="radio" name="filters" class="me-2"><small>9-0</small>
                                            </div>
                                        </div>
                                        <div class="col-auto d-flex align-items-center justify-content-center gap-3 border px-3 py-1 bg-light">
                                            <div>
                                                <input type="radio" name="filters" class="me-2"><small>By Customer</small>
                                            </div>
                                            <div>
                                                <input type="radio" name="filters" class="me-2"><small>By Sales Officer</small>
                                            </div>
                                            <div>
                                                <input type="radio" name="filters" class="me-2"><small>By Company</small>
                                            </div>
                                            <div>
                                                <input type="radio" name="filters" class="me-2"><small>By Unit</small>
                                            </div>
                                        </div>
                                        <div class="col-auto d-flex align-items-center justify-content-center gap-3 border px-3 py-1 bg-light">
                                            <div class="d-flex align-items-center flex-direction-row gap-3 w-100" style="justify-content: space-around;">
                                                <div class="p-3" style="border: 1px solid #000; border-style: none solid none none;">
                                                    <div class="d-flex flex-direction-row gap-3 w-100" style="justify-content: space-around;">
                                                        <div class="d-flex align-items-center">
                                                            <input type="radio" name="filters" class="me-2"><small><</small>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <input type="radio" name="filters" class="me-2"><small>=</small>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <input type="radio" name="filters" class="me-2"><small>></small>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="p-3 overflow-auto">
                                                    <div class="d-flex align-items-center gap-3">
                                                        <div>
                                                            <small><input type="number" placeholder="Enter desired amount." class="form-control"></small>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12" style="display: flex; justify-content: center; align-items: center;">
                    <div class="w-50 rounded-pill border d-flex align-items-start flex-direction-row gap-2 py-2 px-3">
                        <div>
                            <button class="border-0 bg-transparent" style="border-radius: 50%;">
                                <i class="fas fa-search text-secondary"></i>
                            </button>
                        </div>
                        <div class="w-100 mx-1">
                            <small>
                                <input type="search" name="search" class="rounded-0 border-0 w-100">
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row p-3">
                <div class="border border-dark bg-dark text-white row m-0 p-1 d-flex align-items-center">
                    <div class="col-auto">
                        <b>List of Customers</b>
                    </div>

                    <div class="col-auto p-0 ms-auto" style="display: flex; justify-content: center; align-items: center;">

                        <button type="button" class="btn btn-sm btn-danger rounded-0 d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#customerModal">
                            <i class="fas fa-plus-circle me-2"></i>CUSTOMER
                        </button>

                        <div class="modal fade text-dark" id="customerModal" tabindex="-1" aria-labelledby="Customer Configuration" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <form action="/income/customer/add" method="POST">
                                        @csrf
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5">Customer Configuration</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="d-flex gap-3" style="flex-direction: column;">
                                                <div>
                                                    <b>Customer Name</b>
                                                    <div class="d-flex flex-direction-row gap-3">
                                                        <small>
                                                            <select class="form-control" name="pre_name" required>
                                                                
                                                                <option value="Add New">Add New</option>
                                                            </select>
                                                        </small>
                                                        <small class="w-75 d-flex align-items-center" style="flex-direction: column;">
                                                            <input type="type" class="form-control" name="full_name" required>
                                                            <span>Full Name</span>
                                                        </small>
                                                    </div>
                                                </div>

                                                <div>
                                                    <b>Position</b>
                                                    <small><input type="text" class="form-control" name="position"></small>
                                                </div>

                                                <div>
                                                    <b>Company</b>
                                                    <small><input type="text" class="form-control" name="company"></small>
                                                </div>

                                                <div>
                                                    <b>Email</b>
                                                    <small><input type="email" class="form-control" name="email" required></small>
                                                </div>

                                                <div>
                                                    <b>Contact Number</b>
                                                    <small><input type="tel" class="form-control" name="contact_number"></small>
                                                </div>

                                                <div>
                                                    <b>Address</b>
                                                    <small><textarea class="form-control" name="address"></textarea></small>
                                                </div>

                                                <div>
                                                    <b>Currency</b>
                                                    <small>
                                                        <select class="form-control" name="currency">
                                                            
                                                            <option value="Add New">Add New</option>
                                                        </select>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success rounded-pill w-50 mx-auto">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade text-dark" id="UpdatecustomerModal" tabindex="-1" aria-labelledby="Update Customer Configuration" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <form id="UpdatecustomerForm">
                                @csrf
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5">Update Customer Configuration</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="d-flex gap-3" style="flex-direction: column;">

                                        <input type="hidden" name="id">

                                        <div>
                                            <b>Customer Name</b>
                                            <div class="d-flex flex-direction-row gap-3">
                                                <small>
                                                    <select class="form-control" name="pre_name">
                                                        
                                                        <option value="Add New">Add New</option>
                                                    </select>
                                                </small>
                                                <small class="w-75 d-flex align-items-center" style="flex-direction: column;">
                                                    <input type="type" class="form-control" name="full_name" required>
                                                    <span>Full Name</span>
                                                </small>
                                            </div>
                                        </div>

                                        <div>
                                            <b>Position</b>
                                            <small><input type="text" class="form-control" name="position"></small>
                                        </div>

                                        <div>
                                            <b>Company</b>
                                            <small><input type="text" class="form-control" name="company"></small>
                                        </div>

                                        <div>
                                            <b>Email</b>
                                            <small><input type="email" class="form-control" name="email" required></small>
                                        </div>

                                        <div>
                                            <b>Contact Number</b>
                                            <small><input type="tel" class="form-control" name="contact_number"></small>
                                        </div>

                                        <div>
                                            <b>Address</b>
                                            <small><textarea class="form-control" name="address"></textarea></small>
                                        </div>

                                        <div>
                                            <b>Currency</b>
                                            <small>
                                                <select class="form-control" name="currency">
                                                    
                                                    <option value="Add New">Add New</option>
                                                </select>
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success rounded-pill w-50 mx-auto">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="modal fade text-dark" id="salutationModal" tabindex="-2" aria-labelledby="Salutation Configuration" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <form id="salutationForm">
                                @csrf
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5">Salutation Configuration</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="d-flex gap-3" style="flex-direction: column;">
                                        <div>
                                            <b>Salutation</b>
                                            <div>
                                                <small class="d-flex align-items-center" style="flex-direction: column;">
                                                    <div class="p-3 h-50 w-100">
                                                        <input type="text" name="salutation" class="form-control" required>
                                                    </div>
                                                    <div class="p-3 d-flex flex-column align-items-center justify-content-start overflow-y-auto w-100" style="height: 100px;">
                                                        
                                                    </div>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success rounded-pill w-50 mx-auto">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="modal fade text-dark" id="currencyModal" tabindex="-3" aria-labelledby="Currency Configuration" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <form id="currencyForm">
                                @csrf
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5">Currency Configuration</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="d-flex gap-3" style="flex-direction: column;">
                                        <div>
                                            <b>Currency</b>
                                            <div>
                                                <small class="d-flex align-items-center" style="flex-direction: column;">
                                                    <div class="p-3 h-50 w-100">
                                                        <input type="text" name="name" class="form-control" required>
                                                    </div>
                                                    <div class="p-3 d-flex flex-column align-items-center justify-content-start overflow-y-auto w-100" style="height: 100px;">
                                                        
                                                    </div>
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success rounded-pill w-50 mx-auto">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="table table-border table-hover" id="customer">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Position</th>
                                <th scope="col">Company</th>
                                <th scope="col">Contact Number</th>
                                <th scope="col">Address</th>
                                <th scope="col">Currency</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div> --}}

            <div class="row my-3">
                <div class="col-12">
                    <div class="card overflow-x-auto">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-table me-1"></i>
                                <b>List of Invoices</b>
                            </div>
                            <div>
                                <button type="button" class="btn btn-sm btn-danger rounded-0 px-3 d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#createModal">
                                    <i class="fas fa-plus-circle me-2"></i>INVOICE
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="table">
                                <thead>
                                    <tr>
                                        <th scope="col">IV#</th>
                                        <th scope="col">Sales Officer</th>
                                        <th scope="col">Customer</th>
                                        <th scope="col">Unit</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row"><small onclick="open_data();">IN-20241231</small></th>
                                        <td><small onclick="open_data();">MHEL VOI BERNABE</small></td>
                                        <td><small onclick="open_data();">JOHN CASTILLO</small></td>
                                        <td><small onclick="open_data();">MANOK NA PULA</small></td>
                                        <td><small onclick="open_data();">PHP 1,000,000.00</small></td>
                                        <td>
                                            <small class="d-flex justify-content-around">
                                                {{-- Add Class .star .filled if accepted by customer  --}}
                                                <div class="star" onclick="toggleStar(this);" title="Not yet accepted by the customer.">★</div>

                                                {{-- Add Class .star .filled if accepted by accountant  --}}
                                                <div class="star" onclick="toggleStar(this);" title="Not yet accepted by the accountant.">★</div>

                                                {{-- Add Class .star .filled if accepted by finance or president  --}}
                                                <div class="star" onclick="toggleStar(this);" title="Not yet accepted by the finance or president.">★</div>

                                                {{-- Add Class .star .filled if accepted by auditor  --}}
                                                <div class="star" onclick="toggleStar(this);" title="Not yet accepted by the auditor.">★</div>
                                            </small>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="invoiceModal" tabindex="-1" aria-labelledby="Invoice Configuration" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5">Invoice Configuration</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="p-0 d-flex gap-2">

                                <div class="w-25 border overflow-y-auto p-1 d-flex flex-column gap-1 bg-white" id="view_navigation">
                                    {{-- DYNAMIC --}}
                                </div>

                                <div class="w-75 mx-auto d-flex flex-column gap-2">
                                    
                                    <div class="bg-white border border-1 p-3">
                                        <nav>
                                            <div class="nav nav-tabs justify-content-center" id="nav-tab" role="tablist">
                                                <button class="nav-link active" id="nav-log-tab" data-bs-toggle="tab" data-bs-target="#nav-log" type="button" role="tab" aria-controls="nav-log" aria-selected="true">Log</button>
                                                <button class="nav-link" id="nav-comment-tab" data-bs-toggle="tab" data-bs-target="#nav-comment" type="button" role="tab" aria-controls="nav-comment" aria-selected="false">Comment</button>
                                                <button class="nav-link" id="nav-payment-tab" data-bs-toggle="tab" data-bs-target="#nav-payment" type="button" role="tab" aria-controls="nav-payment" aria-selected="false">Payment</button>
                                            </div>
                                        </nav>
                                        <div class="tab-content" id="nav-tabContent">
                                            <div class="tab-pane fade py-1 show active" id="nav-log" role="tabpanel" aria-labelledby="nav-log-tab">
                                                <div class="d-flex flex-column p-2 overflow-y-auto" style="max-height: 2000px;">
                                                    <small>This is a sample logs created on 8/28/2024 2:43PM.</small>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade py-1" id="nav-comment" role="tabpanel" aria-labelledby="nav-comment-tab">
                                                <div class="d-flex flex-column p-2 gap-1" style="max-height: 500px;">
                                                    <div class="rounded-0 d-flex flex-column gap-1 overflow-auto" style="max-height: 400px;">
                                                        <div class="d-flex flex-direction-row gap-2">
                                                            <div class="bg-light bg-gradient border rounded-circle fw-bold d-flex align-items-center justify-content-center" style="width: 35px;">
                                                                JC
                                                            </div>
                                                            <div class="bg-light bg-gradient border rounded-pill py-1 px-3 me-auto">
                                                                sample left
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="d-flex flex-direction-row gap-2">
                                                            <div class="bg-primary bg-gradient border rounded-pill text-end py-1 px-3 ms-auto text-white">
                                                                sample right
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="rounded-0 d-flex flex-direction-row align-items-center gap-2">
                                                        <div style="width: 80%;">
                                                            <textarea class="form-control rounded-0" rows="1" style="resize: none;"></textarea>
                                                        </div>
                                                        <div style="width: 20%;">
                                                            <button class="btn btn-danger rounded-pill w-100">SEND</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade py-1" id="nav-payment" role="tabpanel" aria-labelledby="nav-payment-tab">
                                                <div class="mb-1 text-end">
                                                    <button type="button" class="btn btn-sm btn-outline-success rounded-0" data-bs-toggle="modal" data-bs-target="#paymentModal">
                                                        <i class="fas fa-plus-circle me-2"></i>UPLOAD PROOF OF PAYMENT
                                                    </button>
                                                </div>
                                                <table class="table table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Ref#</th>
                                                            <th scope="col">Date</th>
                                                            <th scope="col">Customer</th>
                                                            <th scope="col">Payment Type</th>
                                                            <th scope="col">Amount</th>
                                                            <th scope="col">Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row"><small>20241231001</small></th>
                                                            <td><small>DATE</small></td>
                                                            <td><small>JOHN CASTILLO</small></td>
                                                            <td><small>CHECK</small></td>
                                                            <td><small>PHP 1,000,000.00</small></td>
                                                            <td>
                                                                <small class="d-flex justify-content-around">
                                                                    {{-- Add Class .star .filled if accepted by accountant  --}}
                                                                    <div class="star" onclick="toggleStar(this);" title="Not yet accepted by the accountant.">★</div>
                    
                                                                    {{-- Add Class .star .filled if accepted by finance or president  --}}
                                                                    <div class="star" onclick="toggleStar(this);" title="Not yet accepted by the finance or president.">★</div>
                    
                                                                    {{-- Add Class .star .filled if accepted by auditor  --}}
                                                                    <div class="star" onclick="toggleStar(this);" title="Not yet accepted by the auditor.">★</div>
                                                                </small>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="bg-white border border-1 d-flex flex-column position-relative overflow-hidden p-5">

                                        <div style="position: absolute; top: 30px; left: -200px; transform: rotate(-45deg); transform-origin: center center; width: 500px;" class="bg-warning px-3 rounded-0 py-1 text-center">
                                            <b class="text-white" name="status">PENDING</b>
                                        </div>
                                        
                                        <div style="display:flex; justify-content: space-between; align-items: end;">
                                            <div>
                                                <img src="https://bulletproofcarsph.com/wp-content/uploads/2021/04/cropped-Logo-without-background-1-600x586.png" style="height: 100px; object-fit: contain;" alt="LOGO">
                                            </div>
                                            <div>
                                                <b><h2>INVOICE</h2></b>
                                            </div>
                                        </div>
                                        <div style="display:flex; justify-content: space-between; align-items: start;">
                                            <div class="d-flex flex-column">
                                                <b name="company_name">BALLISTIC SHIELD MINDANAO ARMORING CORP.</b>
                                                <div name="company_address" class="d-flex flex-column">
                                                    {{-- APPEND THIS --}}
                                                    <small>Municipality of Noveleta,</small>
                                                    <small>Province of Cavite,</small>
                                                    <small>Republic of the Philippines</small>
                                                    {{-- APPEND THIS --}}
                                                </div>
                                            </div>
                                            <div>
                                                <b name="reference">IN-20241231</b>
                                            </div>
                                        </div>
                                        <div class="mt-3 d-flex" style="flex-direction: column;">
                                            <b>BILL TO</b>
                                            <b name="customer_name" class="text-primary">JOHN CASTILLO</b>
                                        </div>
                                        <div style="display:flex; justify-content: right;">
                                            <div class="d-flex w-50 ps-5" style="flex-direction: column;">
                                                <div style="display:flex; justify-content: space-between;">
                                                    <div>
                                                        <small>Invoice Date:</small>
                                                    </div>
                                                    <div>
                                                        <small name="created_at">-</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <div class="overflow-x-auto">
                                                <table class="table table-border" id="view">
                                                    <thead>
                                                        {{-- DYNAMIC CONTENT DISCOUNT MUST BE HIDDEN IF ZERO --}}
                                                        <tr>
                                                            <th scope="col">Unit Description</th>
                                                            <th scope="col" class="text-end">Quantity</th>
                                                            <th scope="col" class="text-end">Unit Cost</th>
                                                            <th scope="col" class="text-end">Discount</th>
                                                            <th scope="col" class="text-end">Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        {{-- DYNAMIC CONTENT DISCOUNT MUST BE HIDDEN IF ZERO --}}
                                                        <tr>
                                                            <th scope="row" class="p-2 rounded-0"><small>MANOK NA PULA</small></th>
                                                            <td class="p-2 rounded-0 text-end"><small>1</small></td>
                                                            <td class="p-2 rounded-0 text-end"><small>1,000,000.00</small></td>
                                                            <td class="p-2 rounded-0 text-end"><small>0%</small></td>
                                                            <td class="p-2 rounded-0 text-end"><small>1,000,000.00</small></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div style="display:flex; justify-content: right;">
                                            <div class="d-flex w-50 ps-5" style="flex-direction: column;">
                                                <div style="display:flex; justify-content: space-between;">
                                                    <div>
                                                        <b>Sub Total:</b>
                                                    </div>
                                                    <div>
                                                        <b name="sub_total">1,000,000.00</b>
                                                    </div>
                                                </div>
                                                {{-- TARGET ID DISCOUNT TO HIDE --}}
                                                <div style="display:flex; justify-content: space-between;" id="discount">
                                                    <div>
                                                        <small>Discount:</small>
                                                    </div>
                                                    <div>
                                                        <small name="discount">0%</small>
                                                    </div>
                                                </div>
                                                {{-- TARGET ID DISCOUNT TO HIDE --}}
                                                <div style="display:flex; justify-content: space-between;">
                                                    <div>
                                                        <small>Shipping Charges:</small>
                                                    </div>
                                                    <div>
                                                        <small name="shipping_charges">0.00</small>
                                                    </div>
                                                </div>
                                                <div style="display:flex; justify-content: space-between;">
                                                    <div>
                                                        <b>Total:</b>
                                                    </div>
                                                    <div>
                                                        <b name="total">1,000,000.00</b>
                                                    </div>
                                                </div>
                                                <div style="display:flex; justify-content: space-between;">
                                                    <div>
                                                        <b>Paid:</b>
                                                    </div>
                                                    <div>
                                                        <b type="button" name="paid" title="Ref#20241231001">1,000,000.00</b>
                                                    </div>
                                                </div>
                                                <div style="display:flex; justify-content: space-between;">
                                                    <div>
                                                        <b>Balance Due:</b>
                                                    </div>
                                                    <div>
                                                        <b name="balance">0.00</b>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-2 mb-3 d-flex" style="flex-direction: column;">
                                            <b>SALES OFFICER</b>
                                            <b class="text-primary" name="sales_officer">MHEL VOI BERNABE</b>
                                        </div>
                                        <div class="d-flex flex-column" name="company_details">
                                            <b>PAYMENT DETAILS</b>
                                            <small>Please make check payable to:</small>
                                            <b name="company_name">BALLISTIC SHIELD MINDANAO ARMORING CORP.</b>
                                            <b class="mt-3">BANK DETAILS</b>
                                            <div class="row">
                                                <div class="col-3">
                                                    <small>Bank Name:</small>
                                                </div>
                                                <div class="col-9">
                                                    <b>AUB</b>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-3">
                                                    <small>Account Name:</small>
                                                </div>
                                                <div class="col-9">
                                                    <b>BALLISTIC SHIELD MINDANAO ARMORING CORP.</b>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-3">
                                                    <small>Account Number:</small>
                                                </div>
                                                <div class="col-9">
                                                    <b>3180 1000 0494</b>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="paymentModal" tabindex="-2" aria-labelledby="Payment Configuration" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5">Payment Configuration</h1>
                            <button type="button" class="btn-close" data-bs-toggle="modal" data-bs-target="#invoiceModal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="p-0 d-flex gap-2">

                                <div class="w-50 mx-auto">
                                    <div class="w-100 file-input-wrapper" id="fileInputWrapper">
                                        <input type="file" id="fileInput" accept="image/*"/>
                                        <span>Drag & Drop an image here or click to select</span>
                                    </div>
                                    <p class="file-name" id="fileName">No image chosen</p>
                                    <img id="imagePreview" style="display:none; max-width: 100%; margin-top: 10px;"/>
                                </div>

                                <div class="w-50 mx-auto">
                                    <div class="bg-white border border-1 d-flex flex-column position-relative overflow-hidden p-5">

                                        <div style="position: absolute; top: 30px; left: -200px; transform: rotate(-45deg); transform-origin: center center; width: 500px;" class="bg-warning px-3 rounded-0 py-1 text-center">
                                            <b class="text-white" name="status">PENDING</b>
                                        </div>
                                        
                                        <div style="display:flex; justify-content: space-between; align-items: end;">
                                            <div>
                                                <img src="https://bulletproofcarsph.com/wp-content/uploads/2021/04/cropped-Logo-without-background-1-600x586.png" style="height: 100px; object-fit: contain;" alt="LOGO">
                                            </div>
                                        </div>
                                        <div style="display:flex; justify-content: space-between; align-items: start;">
                                            <div class="d-flex flex-column">
                                                <b name="company_name">BALLISTIC SHIELD MINDANAO ARMORING CORP.</b>
                                                <div name="company_address" class="d-flex flex-column">
                                                    {{-- APPEND THIS --}}
                                                    <small>Municipality of Noveleta,</small>
                                                    <small>Province of Cavite,</small>
                                                    <small>Republic of the Philippines</small>
                                                    {{-- APPEND THIS --}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="my-3 text-center">
                                            <b>PAYMENT RECEIPT</b>
                                        </div>
                                        <div class="row">
                                            <div class="col-9">
                                                <div class="row">
                                                    <div class="col-5">
                                                        <small>Payment Date</small>
                                                    </div>
                                                    <div class="col-7">
                                                        <b>Today</b>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-5">
                                                        <small>Payment Reference</small>
                                                    </div>
                                                    <div class="col-7">
                                                        <b>20243121001</b>
                                                    </div>
                                                </div><div class="row">
                                                    <div class="col-5">
                                                        <small>Payment Type</small>
                                                    </div>
                                                    <div class="col-7">
                                                        <b>Check</b>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3 bg-success rounded-0 text-white d-flex justify-content-center align-items-center flex-column text-center">
                                                <small>Amount</small>
                                                <b>100,000.00</b>
                                            </div>
                                        </div>
                                        <div class="mt-3 d-flex" style="flex-direction: column;">
                                            <b>RECEIVED FROM</b>
                                            <b name="customer_name" class="text-primary">JOHN CASTILLO</b>
                                        </div>
                                    </div>
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
        $(window).on('load', function() {
            get_table();
        })

        function get_table() {
            const datatablesSimple = document.getElementById('table');
            if (datatablesSimple) {
                datatablesSimple.SimpleDataTable = new simpleDatatables.DataTable(datatablesSimple);

                const columnWidths = ['20%', '20%', '20%', '15%', '15%', '10%'];
                const headers = datatablesSimple.querySelectorAll('th');

                headers.forEach((header, index) => {
                    header.style.width = columnWidths[index];
                    header.style.fontWeight =
                        ['IV#', 'Sales Officer', 'Customer', 'Unit', 'Amount', 'Status'].includes(header.textContent.trim())
                        ? 'bold'
                        : 'normal';
                });
            }
        }

        function toggleStar(element) {
            if (element.classList.contains('filled')) {
                element.classList.remove('filled');
                element.classList.add('empty');
            } else {
                element.classList.remove('empty');
                element.classList.add('filled');
            }
        }

        function open_data() {
            new bootstrap.Modal(document.getElementById('invoiceModal')).show();
        }

        const fileInputWrapper = document.getElementById('fileInputWrapper');
        const fileInput = document.getElementById('fileInput');
        const fileNameDisplay = document.getElementById('fileName');
        const imagePreview = document.getElementById('imagePreview');

        // Handle file selection via the input element
        fileInput.addEventListener('change', function(event) {
            updateFilePreview(event.target.files);
        });

        // Handle dragover event
        fileInputWrapper.addEventListener('dragover', function(event) {
            event.preventDefault();
            event.stopPropagation();
            fileInputWrapper.classList.add('dragover');
        });

        // Handle dragleave event
        fileInputWrapper.addEventListener('dragleave', function(event) {
            event.preventDefault();
            event.stopPropagation();
            fileInputWrapper.classList.remove('dragover');
        });

        // Handle drop event
        fileInputWrapper.addEventListener('drop', function(event) {
            event.preventDefault();
            event.stopPropagation();
            fileInputWrapper.classList.remove('dragover');
            const files = event.dataTransfer.files;
            updateFilePreview(files);
            // Optionally, set files directly to the input (if needed)
            // fileInput.files = files; // This won't work due to security reasons, but you can process the files directly
        });

        function updateFilePreview(files) {
            if (files.length === 0) {
                fileNameDisplay.textContent = 'No image chosen';
                imagePreview.style.display = 'none'; // Hide the image preview
                return;
            }
            
            const file = files[0];
            if (file && file.type.startsWith('image/')) {
                fileNameDisplay.textContent = file.name;

                // Create a FileReader to read the image file
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block'; // Show the image preview
                };
                reader.readAsDataURL(file);
            } else {
                fileNameDisplay.textContent = 'No valid image file chosen';
                imagePreview.style.display = 'none'; // Hide the image preview if the file is not a valid image
            }
        }

    </script>

@endsection