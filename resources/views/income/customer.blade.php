@extends('layouts.income-index')

@section('title', 'MS [ Income ] - Customer')

@section('style')
    <style>
        .income-with-nav > nav {
            .customer {
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
                                    <th scope="row"><small>{{$customer->name}}</small></th>
                                    <td><small>{{$customer->position}}</small></td>
                                    <td><small>{{$customer->company}}</small></td>
                                    <td><small>{{$customer->contact_number}}</small></td>
                                    <td><small>{{$customer->address}}</small></td>
                                    <td><small>{{$customer->currency}}</small></td>
                                    <input type="hidden" name="id" value="{{$customer->id}}">
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal fade text-dark" id="customerModal" tabindex="-1" aria-labelledby="Customer Configuration" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <form id="customerForm">
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
                                                <input list="customer_salutation" type="text" name="customer_salutation" placeholder="Type or select..." class="form-control" required>
                                                <datalist id="customer_salutation">
                                                    @foreach($salutations as $salutation)
                                                        <option value="{{$salutation->salutation}}">{{$salutation->salutation}}</option>
                                                    @endforeach
                                                    <option value="Add New">Add New</option>
                                                </datalist>
                                            </small>
                                            <small class="w-100 d-flex align-items-center" style="flex-direction: column;">
                                                <input type="type" class="form-control" name="customer_name" required>
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
                                            <input list="customer_currency" name="customer_currency" placeholder="Type or select..." class="form-control" required>
                                            <datalist id="customer_currency">
                                                @foreach($currencies as $currency)
                                                    <option value="{{$currency->name}}">{{$currency->name}}</option>
                                                @endforeach
                                                <option value="Add New">Add New</option>
                                            </datalist>
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

            <div class="modal fade text-dark" id="updateModal" tabindex="-2" aria-labelledby="Update Customer Configuration" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <form id="updateForm">
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
                                                <input list="update_salutation" type="text" name="update_salutation" placeholder="Type or select..." class="form-control" required>
                                                <datalist id="update_salutation">
                                                    @foreach($salutations as $salutation)
                                                        <option value="{{$salutation->salutation}}">{{$salutation->salutation}}</option>
                                                    @endforeach
                                                    <option value="Add New">Add New</option>
                                                </datalist>
                                            </small>
                                            <small class="w-100 d-flex align-items-center" style="flex-direction: column;">
                                                <input type="type" class="form-control" name="update_name" required>
                                                <span>Full Name</span>
                                            </small>
                                        </div>
                                    </div>

                                    <div>
                                        <b>Position</b>
                                        <small><input type="text" class="form-control" name="update_position"></small>
                                    </div>

                                    <div>
                                        <b>Company</b>
                                        <small><input type="text" class="form-control" name="update_company"></small>
                                    </div>

                                    <div>
                                        <b>Email</b>
                                        <small><input type="email" class="form-control" name="update_email" required></small>
                                    </div>

                                    <div>
                                        <b>Contact Number</b>
                                        <small><input type="tel" class="form-control" name="update_contact_number"></small>
                                    </div>

                                    <div>
                                        <b>Address</b>
                                        <small><textarea class="form-control" name="update_address"></textarea></small>
                                    </div>

                                    <div>
                                        <b>Currency</b>
                                        <small>
                                            <input list="update_currency" name="update_currency" placeholder="Type or select..." class="form-control" required>
                                            <datalist id="update_currency">
                                                @foreach($currencies as $currency)
                                                    <option value="{{$currency->name}}">{{$currency->name}}</option>
                                                @endforeach
                                                <option value="Add New">Add New</option>
                                            </datalist>
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

            <div class="modal fade text-dark" id="salutationModal" tabindex="-3" aria-labelledby="Salutation Configuration" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <form id="salutationForm">
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
                                                    <input type="text" class="form-control" name="salutation_salutation" required>
                                                </div>
                                                <div class="p-3 d-flex flex-column align-items-center justify-content-start overflow-y-auto w-100" style="height: 100px;" id="salutation_salutation">
                                                    @if($salutations->isNotEmpty())
                                                        @foreach($salutations as $salutation)
                                                            <div>
                                                                <b>{{$salutation->salutation}}</b>
                                                                <em class="ms-1 text-success">is already added
                                                                    <i class="fas fa-check-circle ms-2"></i>
                                                                </em>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <div>
                                                            <em class="text-muted fw-bold">No data is added yet.</em>
                                                        </div>
                                                    @endif
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

            <div class="modal fade text-dark" id="currencyModal" tabindex="-4" aria-labelledby="Currency Configuration" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <form id="currencyForm">
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
                                                    <input type="text" name="currency_currency" class="form-control" required>
                                                </div>
                                                <div class="p-3 d-flex flex-column align-items-center justify-content-start overflow-y-auto w-100" style="height: 100px;" id="currency_currency">
                                                    @if($currencies->isNotEmpty())
                                                        @foreach($currencies as $currency)
                                                            <div>
                                                                <b>{{$currency->name}}</b>
                                                                <em class="ms-1 text-success">is already added
                                                                    <i class="fas fa-check-circle ms-2"></i>
                                                                </em>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <div>
                                                            <em class="text-muted fw-bold">No data is added yet.</em>
                                                        </div>
                                                    @endif
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
        </div>
    </div>

@endsection

@section('script')

    <script>
        $('input[name="customer_salutation"]').on('input', function() {
            if ($(this).val() === 'Add New') {
                new bootstrap.Modal(document.getElementById('salutationModal')).show();
                $(this).val('');
            }
        })

        document.querySelector('#salutationForm').addEventListener('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: "/income/customer/salutation/add",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                },
                method: "POST",
                data: {
                    salutation: $(this).find('input[name="salutation_salutation"]').val()
                },
                success: function (data) {
                    $.ajax({
                        url: "/income/customer/salutation/get",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                        },
                        method: "GET",
                        success: function (data) {
                            $('#customerModal').find('#customer_salutation').html('');
                            $('#customerModal').find('#customer_salutation').html(data.options);
                            $('#customerModal').find('#customer_salutation').append('<option value="Add New">Add New</option>');

                            $('#customerModal').find('input[name="customer_salutation"]').val($('#salutationForm').find('input[name="salutation_salutation"]').val());
                            
                            $('#salutationModal').find('#salutation_salutation').append(
                                '<div>' +
                                    '<b>' + $('#salutationForm').find('input[name="salutation_salutation"]').val() + '</b>' +
                                    '<em class="ms-1 text-success">is already added' +
                                        '<i class="fas fa-check-circle ms-2"></i>' +
                                    '</em>' +
                                '</div>'
                            );
                             
                            $('#updateModal').find('#update_salutation').html('');
                            $('#updateModal').find('#update_salutation').html(data.options);
                            $('#updateModal').find('#update_salutation').append('<option value="Add New">Add New</option>');

                            bootstrap.Modal.getInstance(document.querySelector('#salutationModal')).hide();
                            $('#salutationForm')[0].reset();
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

        $('input[name="customer_currency"]').on('input', function() {
            if ($(this).val() === 'Add New') {
                new bootstrap.Modal(document.getElementById('currencyModal')).show();
                $(this).val('');
            }
        })

        document.querySelector('#currencyForm').addEventListener('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: "/income/customer/currency/add",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                },
                method: "POST",
                data: {
                    name: $(this).find('input[name="currency_currency"]').val()
                },
                success: function (data) {
                    $.ajax({
                        url: "/income/customer/currency/get",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                        },
                        method: "GET",
                        success: function (data) {
                            $(this).find('input[name="name"]').val('');
                            $('#customerModal').find('select[name="currency"]').html('');
                            $('#customerModal').find('select[name="currency"]').html(data.options);
                            $('#customerModal').find('select[name="currency"]').append('<option value="Add New">Add New</option>');

                            $('#UpdatecustomerModal').find('select[name="currency"]').html('');
                            $('#UpdatecustomerModal').find('select[name="currency"]').html(data.options);
                            $('#UpdatecustomerModal').find('select[name="currency"]').append('<option value="Add New">Add New</option>');

                            $('#customerModal').find('#customer_currency').html('');
                            $('#customerModal').find('#customer_currency').html(data.options);
                            $('#customerModal').find('#customer_currency').append('<option value="Add New">Add New</option>');

                            $('#customerModal').find('input[name="customer_currency"]').val($('#currencyForm').find('input[name="currency_currency"]').val());
                            
                            $('#currencyModal').find('#currency_currency').append(
                                '<div>' +
                                    '<b>' + $('#currencyForm').find('input[name="currency_currency"]').val() + '</b>' +
                                    '<em class="ms-1 text-success">is already added' +
                                        '<i class="fas fa-check-circle ms-2"></i>' +
                                    '</em>' +
                                '</div>'
                            );

                            $('#updateModal').find('#update_currency').html('');
                            $('#updateModal').find('#update_currency').html(data.options);
                            $('#updateModal').find('#update_currency').append('<option value="Add New">Add New</option>');

                            bootstrap.Modal.getInstance(document.querySelector('#currencyModal')).hide();
                            $('#currencyForm')[0].reset();
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

        document.querySelector('#customerForm').addEventListener('submit', function(event) {
            event.preventDefault();
            $.ajax({
                url: "/income/customer/add",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                },
                method: "POST",
                data: {
                    name: $(this).find('input[name="customer_salutation"]').val() + ' ' + $(this).find('input[name="customer_name"]').val(),
                    position: $(this).find('input[name="position"]').val(),
                    company: $(this).find('input[name="company"]').val(),
                    email: $(this).find('input[name="email"]').val(),
                    contact_number: $(this).find('input[name="contact_number"]').val(),
                    address: $(this).find('textarea[name="address"]').val(),
                    currency: $(this).find('input[name="customer_currency"]').val()
                },
                success: function (data) {
                    $.ajax({
                        url: "/income/customer/get",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                        },
                        method: "GET",
                        success: function (data) {
                            $('#customer tbody').html('');
                            $('#customer tbody').html(data.options);

                            document.querySelectorAll('#customer > tbody > tr > th, #customer > tbody > tr > td').forEach(function(element) {
                                element.addEventListener('click', function() {
                                    const parentRow = element.closest('tr');

                                    $.ajax({
                                        url: "/income/customer/select",
                                        headers: {
                                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                                        },
                                        data: {
                                            id: parentRow.querySelector('input[name="id"]').value
                                        },
                                        method: "GET",
                                        success: function (data) {
                                            $('#UpdatecustomerForm').find('input[name="id"]').val(data.id);
                                            let name = data.name;
                                            $('#UpdatecustomerForm').find('select[name="update_name"]').val(name.substring(0, name.indexOf(' ')));
                                            $('#UpdatecustomerForm').find('input[name="update_name"]').val(name.substring(name.indexOf(' ') + 1));
                                            $('#UpdatecustomerForm').find('input[name="update_position"]').val(data.position);
                                            $('#UpdatecustomerForm').find('input[name="update_company"]').val(data.company);
                                            $('#UpdatecustomerForm').find('input[name="update_email"]').val(data.email);
                                            $('#UpdatecustomerForm').find('input[name="update_contact_number"]').val(data.contact_number);
                                            $('#UpdatecustomerForm').find('textarea[name="update_address"]').val(data.address);
                                            $('#UpdatecustomerForm').find('select[name="update_currency"]').val(data.currency);
                                            new bootstrap.Modal(document.getElementById('updateModal')).show();
                                        },
                                        error: function (jqXHR, textStatus, errorThrown) {
                                            console.error('Error:', textStatus, errorThrown);
                                        }
                                    });

                                });
                            });

                            bootstrap.Modal.getInstance(document.querySelector('#customerModal')).hide();
                            $('#customerForm')[0].reset();
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
        })

        document.querySelectorAll('#customer > tbody > tr > th, #customer > tbody > tr > td').forEach(function(element) {
            element.addEventListener('click', function() {
                const parentRow = element.closest('tr');

                $.ajax({
                    url: "/income/customer/select",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        id: parentRow.querySelector('input[name="id"]').value
                    },
                    method: "GET",
                    success: function (data) {
                        $('#updateForm').find('input[name="id"]').val(data.id);
                        let name = data.name;
                        $('#updateForm').find('input[name="update_salutation"]').val(name.substring(0, name.indexOf(' ')));
                        $('#updateForm').find('input[name="update_name"]').val(name.substring(name.indexOf(' ') + 1));
                        $('#updateForm').find('input[name="update_position"]').val(data.position);
                        $('#updateForm').find('input[name="update_company"]').val(data.company);
                        $('#updateForm').find('input[name="update_email"]').val(data.email);
                        $('#updateForm').find('input[name="update_contact_number"]').val(data.contact_number);
                        $('#updateForm').find('textarea[name="update_address"]').val(data.address);
                        $('#updateForm').find('input[name="update_currency"]').val(data.currency);
                        new bootstrap.Modal(document.getElementById('updateModal')).show();
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.error('Error:', textStatus, errorThrown);
                    }
                });

            });
        });

        document.querySelector('#updateForm').addEventListener('submit', function(event) {
            event.preventDefault();

            $.ajax({
                url: "/income/customer/update",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                },
                method: "PUT",
                data: {
                    id: $(this).find('input[name="id"]').val(),
                    name: $(this).find('input[name="update_salutation"]').val() + ' ' + $(this).find('input[name="update_name"]').val(),
                    position: $(this).find('input[name="position"]').val(),
                    company: $(this).find('input[name="company"]').val(),
                    email: $(this).find('input[name="email"]').val(),
                    contact_number: $(this).find('input[name="contact_number"]').val(),
                    address: $(this).find('textarea[name="address"]').val(),
                    currency: $(this).find('input[name="currency"]').val()
                },
                success: function (data) {
                    $.ajax({
                        url: "/income/customer/get",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                        },
                        method: "GET",
                        success: function (data) {
                            $(this).trigger('reset');
                            $('#customer tbody').html('');
                            $('#customer tbody').html(data.options);

                            document.querySelectorAll('#customer > tbody > tr > th, #customer > tbody > tr > td').forEach(function(element) {
                                element.addEventListener('click', function() {
                                    const parentRow = element.closest('tr');

                                    $.ajax({
                                        url: "/income/customer/select",
                                        headers: {
                                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                                        },
                                        data: {
                                            id: parentRow.querySelector('input[name="id"]').value
                                        },
                                        method: "GET",
                                        success: function (data) {
                                            $('#UpdatecustomerForm').find('input[name="id"]').val(data.id);
                                            let name = data.name;
                                            $('#UpdatecustomerForm').find('select[name="pre_name"]').val(name.substring(0, name.indexOf(' ')));
                                            $('#UpdatecustomerForm').find('input[name="full_name"]').val(name.substring(name.indexOf(' ') + 1));
                                            $('#UpdatecustomerForm').find('input[name="position"]').val(data.position);
                                            $('#UpdatecustomerForm').find('input[name="company"]').val(data.company);
                                            $('#UpdatecustomerForm').find('input[name="email"]').val(data.email);
                                            $('#UpdatecustomerForm').find('input[name="contact_number"]').val(data.contact_number);
                                            $('#UpdatecustomerForm').find('textarea[name="address"]').val(data.address);
                                            $('#UpdatecustomerForm').find('select[name="currency"]').val(data.currency);
                                            new bootstrap.Modal(document.getElementById('UpdatecustomerModal')).show();
                                        },
                                        error: function (jqXHR, textStatus, errorThrown) {
                                            console.error('Error:', textStatus, errorThrown);
                                        }
                                    });

                                });
                            });

                            var UpdatecustomerModal = bootstrap.Modal.getInstance(document.querySelector('#UpdatecustomerModal'));
                            UpdatecustomerModal.hide();
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
    </script>

@endsection