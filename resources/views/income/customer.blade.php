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

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row my-3">
                <div class="col-12">
                    <div class="card overflow-x-auto">
                        <div class="card-header d-flex align-items-center">
                            <div class="w-75 row">
                                <div class="col-3 d-flex align-items-center">
                                    <i class="fas fa-table me-1"></i>
                                    <b>List of Customers</b>
                                </div>
                                <form class="col-9">
                                    <input placeholder="Search ..." name="search" type="search" class="form-control" value="{{$app->request->search}}">
                                </form>
                            </div>
                            <div class="ms-auto">
                                <button type="button"
                                        class="btn btn-sm btn-danger rounded-0 px-3 d-flex align-items-center"
                                        data-bs-toggle="modal" data-bs-target="#customerModal">
                                    <i class="fas fa-plus-circle me-2"></i>CUSTOMER
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="customer" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Position</th>
                                    <th scope="col">Company</th>
                                    <th scope="col">Contact Number</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Currency</th>
                                    <th scope="col">Added By</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($customers as $customer)
                                    <tr>
                                        <th scope="row"><small
                                                onclick="open_customer({{ $customer->id }});">{{$customer->name}}</small>
                                        </th>
                                        <td><small
                                                onclick="open_customer({{ $customer->id }});">{{$customer->position}}</small>
                                        </td>
                                        <td><small
                                                onclick="open_customer({{ $customer->id }});">{{$customer->company}}</small>
                                        </td>
                                        <td><small
                                                onclick="open_customer({{ $customer->id }});">{{$customer->contact_number}}</small>
                                        </td>
                                        <td><small
                                                onclick="open_customer({{ $customer->id }});">{{$customer->address}}</small>
                                        </td>
                                        <td><small
                                                onclick="open_customer({{ $customer->id }});">{{$customer->currency->name}}</small>
                                        </td>
                                        <td><small onclick="open_customer({{ $customer->id }});">Sales Officer</small>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{$customers->links()}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade text-dark" id="customerModal" tabindex="-1" aria-labelledby="Customer Configuration"
                 aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <form id="customerForm" method="POST" action="/income/customer">
                            @csrf
                            <div class="modal-header">
                                <h1 class="modal-title fs-5">Customer Configuration</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="d-flex gap-3" style="flex-direction: column;">
                                    <div>
                                        <b>Customer Name</b>
                                        <div class="row">
                                            <div class="col-2">
                                                <select id="salutation" name="salutation" class="small form-control">
                                                    @foreach($salutations as $salutation)
                                                        <option
                                                            value="{{$salutation->id}}">{{$salutation->salutation}}</option>
                                                    @endforeach
                                                    <option value="0">Add New</option>
                                                </select>

                                                <input placeholder="Input ..." id="salutationOthers" type="text"
                                                       class="d-none form-control"
                                                       name="salutationOthers">
                                            </div>
                                            <div class="col-10 small">
                                                <input placeholder="ENTER FULL NAME" type="type" class="form-control"
                                                       name="name" required>
                                            </div>
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
                                        <select id="currency" name="currency" class="small form-control">
                                            @foreach($currencies as $currency)
                                                <option value="{{$currency->id}}">{{$currency->name}}</option>
                                            @endforeach
                                            <option value="0">Add New</option>
                                        </select>

                                        <input placeholder="Input ..." id="currencyOthers" type="text"
                                               class="d-none form-control text-capitalize"
                                               name="currencyOthers">
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

            <div class="modal fade text-dark" id="updateModal" tabindex="-2"
                 aria-labelledby="Update Customer Configuration" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <form id="customerForm" method="POST" action="/income/customer">
                            @csrf
                            @method('PATCH')
                            <div class="modal-header">
                                <h1 class="modal-title fs-5">Update Customer Configuration</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="d-flex gap-3" style="flex-direction: column;">
                                    <div>
                                        <b>Customer Name</b>
                                        <div class="row">
                                            <div class="col-2">
                                                <select id="editSalutation" name="salutation" class="small form-control">
                                                    @foreach($salutations as $salutation)
                                                        <option
                                                            value="{{$salutation->id}}">{{$salutation->salutation}}</option>
                                                    @endforeach
                                                    <option value="0">Add New</option>
                                                </select>

                                                <input placeholder="Input ..." id="editSalutationOthers" type="text"
                                                       class="d-none form-control"
                                                       name="salutationOthers">
                                            </div>
                                            <div class="col-10 small">
                                                <input placeholder="ENTER FULL NAME" type="type" class="form-control"
                                                       name="name" required>
                                            </div>
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
                                        <select id="editCurrency" name="currency" class="small form-control">
                                            @foreach($currencies as $currency)
                                                <option value="{{$currency->id}}">{{$currency->name}}</option>
                                            @endforeach
                                            <option value="0">Add New</option>
                                        </select>

                                        <input placeholder="Input ..." id="editCurrencyOthers" type="text"
                                               class="d-none form-control text-capitalize"
                                               name="currencyOthers">
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

@endsection

@section('script')

    <script>

        const customerModal = new bootstrap.Modal(document.getElementById('updateModal'));

        function othersSelection(selection, other) {

            const salutation = document.querySelector(selection);
            const salutationOthers = document.querySelector(other);

            salutation.addEventListener('change', () => {
                if (parseInt(salutation.value) === 0) {
                    salutationOthers.classList.remove('d-none')
                    salutation.classList.add('d-none')
                    salutationOthers.focus();
                } else {
                    salutationOthers.classList.add('d-none')
                    salutation.classList.remove('d-none')
                    salutation.focus();
                }
            })

            salutation.addEventListener('focusin', () => {
                if (parseInt(salutation.value) === 0) {
                    salutation.value = 1;
                }
            })

            salutationOthers.addEventListener('input', () => {
                if (salutationOthers.value.length <= 0) {
                    salutationOthers.classList.add('d-none')
                    salutation.classList.remove('d-none')
                    salutation.focus();
                }
            })

            salutationOthers.addEventListener('focusout', () => {
                if (salutationOthers.value.length <= 0) {
                    salutationOthers.classList.add('d-none')
                    salutation.classList.remove('d-none')
                    salutation.focus();
                }
            })

        }

        othersSelection('#salutation', '#salutationOthers');
        othersSelection('#currency', '#currencyOthers');
        othersSelection('#editCurrency', '#editCurrencyOthers');
        othersSelection('#editSalutation', '#editSalutationOthers');

        // $('input[name="customer_salutation"], input[name="update_salutation"]').on('input', function () {
        //     if ($(this).val() === 'Add New') {
        //         new bootstrap.Modal(document.getElementById('salutationModal')).show();
        //         $(this).val('');
        //     }
        // })
        //
        // document.querySelector('#salutationForm').addEventListener('submit', function (event) {
        //     event.preventDefault();
        //     $.ajax({
        //         url: "/income/customer/salutation/add",
        //         headers: {
        //             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
        //         },
        //         method: "POST",
        //         data: {
        //             salutation: $(this).find('input[name="salutation_salutation"]').val()
        //         },
        //         success: function (data) {
        //             $.ajax({
        //                 url: "/income/customer/salutation/get",
        //                 headers: {
        //                     "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
        //                 },
        //                 method: "GET",
        //                 success: function (data) {
        //                     $('#customerModal').find('#customer_salutation').html('');
        //                     $('#customerModal').find('#customer_salutation').html(data.options);
        //                     $('#customerModal').find('#customer_salutation').append('<option value="Add New">Add New</option>');
        //
        //                     $('#customerModal').find('input[name="customer_salutation"]').val($('#salutationForm').find('input[name="salutation_salutation"]').val());
        //                     $('#updateModal').find('input[name="update_salutation"]').val($('#salutationForm').find('input[name="salutation_salutation"]').val());
        //
        //                     $('#salutationModal').find('#salutation_salutation').append(
        //                         '<div>' +
        //                         '<b>' + $('#salutationForm').find('input[name="salutation_salutation"]').val() + '</b>' +
        //                         '<em class="ms-1 text-success">is already added' +
        //                         '<i class="fas fa-check-circle ms-2"></i>' +
        //                         '</em>' +
        //                         '</div>'
        //                     );
        //
        //                     $('#updateModal').find('#update_salutation').html('');
        //                     $('#updateModal').find('#update_salutation').html(data.options);
        //                     $('#updateModal').find('#update_salutation').append('<option value="Add New">Add New</option>');
        //
        //                     bootstrap.Modal.getInstance(document.querySelector('#salutationModal')).hide();
        //                     $('#salutationForm')[0].reset();
        //                 },
        //                 error: function (jqXHR, textStatus, errorThrown) {
        //                     console.error('Error:', textStatus, errorThrown);
        //                 }
        //             });
        //         },
        //         error: function (jqXHR, textStatus, errorThrown) {
        //             console.error('Error:', textStatus, errorThrown);
        //         }
        //     });
        // });
        //
        // $('input[name="customer_currency"], input[name="update_currency"]').on('input', function () {
        //     if ($(this).val() === 'Add New') {
        //         new bootstrap.Modal(document.getElementById('currencyModal')).show();
        //         $(this).val('');
        //     }
        // })
        //
        // document.querySelector('#currencyForm').addEventListener('submit', function (event) {
        //     event.preventDefault();
        //     $.ajax({
        //         url: "/income/customer/currency/add",
        //         headers: {
        //             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
        //         },
        //         method: "POST",
        //         data: {
        //             name: $(this).find('input[name="currency_currency"]').val()
        //         },
        //         success: function (data) {
        //             $.ajax({
        //                 url: "/income/customer/currency/get",
        //                 headers: {
        //                     "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
        //                 },
        //                 method: "GET",
        //                 success: function (data) {
        //                     $(this).find('input[name="name"]').val('');
        //                     $('#customerModal').find('select[name="currency"]').html('');
        //                     $('#customerModal').find('select[name="currency"]').html(data.options);
        //                     $('#customerModal').find('select[name="currency"]').append('<option value="Add New">Add New</option>');
        //
        //                     $('#UpdatecustomerModal').find('select[name="currency"]').html('');
        //                     $('#UpdatecustomerModal').find('select[name="currency"]').html(data.options);
        //                     $('#UpdatecustomerModal').find('select[name="currency"]').append('<option value="Add New">Add New</option>');
        //
        //                     $('#customerModal').find('#customer_currency').html('');
        //                     $('#customerModal').find('#customer_currency').html(data.options);
        //                     $('#customerModal').find('#customer_currency').append('<option value="Add New">Add New</option>');
        //
        //                     $('#customerModal').find('input[name="customer_currency"]').val($('#currencyForm').find('input[name="currency_currency"]').val());
        //                     $('#updateModal').find('input[name="update_currency"]').val($('#currencyForm').find('input[name="currency_currency"]').val());
        //
        //                     $('#currencyModal').find('#currency_currency').append(
        //                         '<div>' +
        //                         '<b>' + $('#currencyForm').find('input[name="currency_currency"]').val() + '</b>' +
        //                         '<em class="ms-1 text-success">is already added' +
        //                         '<i class="fas fa-check-circle ms-2"></i>' +
        //                         '</em>' +
        //                         '</div>'
        //                     );
        //
        //                     $('#updateModal').find('#update_currency').html('');
        //                     $('#updateModal').find('#update_currency').html(data.options);
        //                     $('#updateModal').find('#update_currency').append('<option value="Add New">Add New</option>');
        //
        //                     bootstrap.Modal.getInstance(document.querySelector('#currencyModal')).hide();
        //                     $('#currencyForm')[0].reset();
        //                 },
        //                 error: function (jqXHR, textStatus, errorThrown) {
        //                     console.error('Error:', textStatus, errorThrown);
        //                 }
        //             });
        //         },
        //         error: function (jqXHR, textStatus, errorThrown) {
        //             console.error('Error:', textStatus, errorThrown);
        //         }
        //     });
        // });
        //
        // document.querySelector('#customerForm').addEventListener('submit', function (event) {
        //     event.preventDefault();
        //     $.ajax({
        //         url: "/income/customer/add",
        //         headers: {
        //             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
        //         },
        //         method: "POST",
        //         data: {
        //             name: $(this).find('input[name="customer_salutation"]').val() + ' ' + $(this).find('input[name="customer_name"]').val(),
        //             position: $(this).find('input[name="position"]').val(),
        //             company: $(this).find('input[name="company"]').val(),
        //             email: $(this).find('input[name="email"]').val(),
        //             contact_number: $(this).find('input[name="contact_number"]').val(),
        //             address: $(this).find('textarea[name="address"]').val(),
        //             currency: $(this).find('input[name="customer_currency"]').val()
        //         },
        //         success: function (data) {
        //             $.ajax({
        //                 url: "/income/customer/get",
        //                 headers: {
        //                     "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
        //                 },
        //                 method: "GET",
        //                 success: function (data) {
        //                     $('#customer tbody').html('');
        //                     $('#customer tbody').html(data.options);
        //                     Get_Customer();
        //                     bootstrap.Modal.getInstance(document.querySelector('#customerModal')).hide();
        //                     $('#customerForm')[0].reset();
        //                 },
        //                 error: function (jqXHR, textStatus, errorThrown) {
        //                     console.error('Error:', textStatus, errorThrown);
        //                 }
        //             });
        //         },
        //         error: function (jqXHR, textStatus, errorThrown) {
        //             console.error('Error:', textStatus, errorThrown);
        //         }
        //     });
        // })
        //
        // document.querySelector('#updateForm').addEventListener('submit', function (event) {
        //     event.preventDefault();
        //     $.ajax({
        //         url: "/income/customer/update",
        //         headers: {
        //             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
        //         },
        //         method: "PUT",
        //         data: {
        //             id: $(this).find('input[name="update_id"]').val(),
        //             name: $(this).find('input[name="update_salutation"]').val() + ' ' + $(this).find('input[name="update_name"]').val(),
        //             position: $(this).find('input[name="update_position"]').val(),
        //             company: $(this).find('input[name="update_company"]').val(),
        //             email: $(this).find('input[name="update_email"]').val(),
        //             contact_number: $(this).find('input[name="update_contact_number"]').val(),
        //             address: $(this).find('textarea[name="update_address"]').val(),
        //             currency: $(this).find('input[name="update_currency"]').val()
        //         },
        //         success: function (data) {
        //             $.ajax({
        //                 url: "/income/customer/get",
        //                 headers: {
        //                     "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
        //                 },
        //                 method: "GET",
        //                 success: function (data) {
        //                     $(this).trigger('reset');
        //                     $('#customer tbody').html('');
        //                     $('#customer tbody').html(data.options);
        //                     Get_Customer();
        //                     bootstrap.Modal.getInstance(document.querySelector('#updateModal')).hide();
        //                     $('#updateForm')[0].reset();
        //                 },
        //                 error: function (jqXHR, textStatus, errorThrown) {
        //                     console.error('Error:', textStatus, errorThrown);
        //                 }
        //             });
        //         },
        //         error: function (jqXHR, textStatus, errorThrown) {
        //             console.error('Error:', textStatus, errorThrown);
        //         }
        //     });
        // });
        //

        async function open_customer(id) {

            const response = await fetch(`/income/customer/${id}`);

            const data = await response.json();

            if (response.ok) {

                console.log(data);

                // $('#updateForm').find('input[name="update_salutation"]').val(name.substring(0, name.indexOf(' ')));


                // $('#updateForm').find('input[name="update_id"]').val(data.id);
                // $('#updateForm').find('input[name="update_name"]').val(name.substring(name.indexOf(' ') + 1));
                // $('#updateForm').find('input[name="update_position"]').val(data.position);
                // $('#updateForm').find('input[name="update_company"]').val(data.company);
                // $('#updateForm').find('input[name="update_email"]').val(data.email);
                // $('#updateForm').find('input[name="update_contact_number"]').val(data.contact_number);
                // $('#updateForm').find('textarea[name="update_address"]').val(data.address);
                // $('#updateForm').find('input[name="update_currency"]').val(data.currency);

                customerModal.show();
            }
        }

    </script>

@endsection
