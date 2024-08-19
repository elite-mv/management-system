@extends('layouts.income-index')

@section('title', 'MS [ Income ] - Customer')

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
                            <div class="collapse" id="Collapse1">
                                <div class="card card-body rounded-0 gap-3 overflow-x-auto" style="display: flex; flex-direction: row;">
                                    <div class="d-flex align-items-center justify-content-center gap-3 border p-3 bg-light">
                                        <div>
                                            <input type="radio" name="filters" class="me-2"><small>A-Z</small>
                                        </div>
                                        <div>
                                            <input type="radio" name="filters" class="me-2"><small>Z-A</small>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-center gap-3 border p-3 bg-light">
                                        <div>
                                            <input type="radio" name="filters" class="me-2"><small>0-9</small>
                                        </div>
                                        <div>
                                            <input type="radio" name="filters" class="me-2"><small>9-0</small>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-start justify-content-center gap-3 border p-3 bg-light">
                                        <div>
                                            <input type="radio" name="filters" class="me-2"><small>By Name</small>
                                        </div>
                                        <div>
                                            <input type="radio" name="filters" class="me-2"><small>By Position</small>
                                        </div>
                                        <div>
                                            <input type="radio" name="filters" class="me-2"><small>By Company</small>
                                        </div>
                                        <div>
                                            <input type="radio" name="filters" class="me-2"><small>By Address</small>
                                        </div>
                                        <div>
                                            <input type="radio" name="filters" class="me-2"><small>By Currency</small>
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
                                    <form>
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
                                                        <small class="w-25 d-flex align-items-center" style="flex-direction: column;">
                                                            <input type="text" name="salutation" list="datalist_customer" class="form-control">
                                                            <datalist id="datalist_customer">
                                                                @foreach($salutations as $salutation)
                                                                <option value="{{$salutation->salutation}}">{{$salutation->salutation}}</option>
                                                                @endforeach
                                                                <option value="Add New">Add New</option>
                                                            </datalist>
                                                            <span>Salutation</span>
                                                        </small>
                                                        <small class="w-75 d-flex align-items-center" style="flex-direction: column;">
                                                            <input type="type" class="form-control" name="full_name" >
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
                                                    <small><input type="email" class="form-control" name="email" ></small>
                                                </div>

                                                <div>
                                                    <b>Contact Number</b>
                                                    <small><input type="number" class="form-control" name="contact_number"></small>
                                                </div>

                                                <div>
                                                    <b>Address</b>
                                                    <small><textarea class="form-control" name="address"></textarea></small>
                                                </div>

                                                <div>
                                                    <b>Currency</b>
                                                    <small>
                                                        <select class="form-control" name="currency">
                                                            <option value="PHP">PHP</option>
                                                            <option value="USD">USD</option>
                                                            <option value="EUR">EUR</option>
                                                            <option value="Others">Others</option>
                                                        </select>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-outline-danger rounded-pill w-50 mx-auto">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade text-dark" id="salutationModal" tabindex="-1" aria-labelledby="Salutation Configuration" aria-hidden="true">
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
                                                            <input type="text" name="salutation" list="datalist_salutation" class="form-control" required>
                                                            <datalist id="datalist_salutation">
                                                                @foreach($salutations as $salutation)
                                                                <option value="{{$salutation->salutation}}">{{$salutation->salutation}}</option>
                                                                @endforeach
                                                            </datalist>
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-outline-primary rounded-pill w-50 mx-auto">Add</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
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
                            @foreach($customers as $customer)
                            <tr>
                                <th scope="row"><small>{{$customer->name}}</small><input type="hidden" name="customer_id" value="{{$customer->id}}"></th>
                                <td><small>{{$customer->position}}</small></td>
                                <td><small>{{$customer->company}}</small></td>
                                <td><small>{{$customer->contact_number}}</small></td>
                                <td><small>{{$customer->address}}</small></td>
                                <td><small>{{$customer->currency}}</small></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')

    <script>

        $('input[name="salutation"]').on('change', function() {
            if ($(this).val() === 'Add New') {
                new bootstrap.Modal(document.getElementById('salutationModal')).show();
                $(this).val('');
            }
        })

        document.querySelector('#salutationForm').addEventListener('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: "/income/salutation",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                },
                method: "POST",
                data: {
                    salutation: $(this).find('input[name="salutation"]').val()
                },
                success: function (data) {
                    var salutationModal = bootstrap.Modal.getInstance(document.querySelector('#salutationModal'));
                    salutationModal.hide();

                    $.ajax({
                        url: "/income/salutation",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                        },
                        method: "GET",
                        success: function (data) {
                            $('#datalist_customer').html(data.options);
                            $('#datalist_customer').append('<option value="Add New">Add New</option>');
                            $('#datalist_salutation').html(data.options);
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.error('Error:', textStatus, errorThrown);
                        }
                    });
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error('Error:', textStatus, errorThrown);
                }
            });
        });

        document.querySelectorAll('#customer > tbody > tr > th, #customer > tbody > tr > td').forEach(function(element) {
            element.addEventListener('click', function() {
                const parentRow = element.closest('tr');
                const customer_id = parentRow.querySelector('th > input[name="customer_id"]').value;
                if (customer_id) {
                    alert(customer_id);
                }
            });
        });
    </script>

@endsection