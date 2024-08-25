@extends('layouts.income-index')

@section('title', 'MS [ Income ] - Invoices')

@section('style')
    <style>
        .income-with-nav > nav {
            .invoice {
                background-color: rgb(24, 28, 46);
            }
        }
    </style>
@endsection

@section('body')

    <div class="w-100 d-flex align-items-start border">
        <div class="container-fluid p-3">
            <div class="row">
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
            </div>
        </div>
    </div>

@endsection

@section('script')

    <script>
        
    </script>

@endsection