@php
    use Illuminate\Support\Facades\Storage;
@endphp

@extends('layouts.expense-index')

@section('title', 'Account')

@section('style')
    <style type="text/css">
        .my_profile_nav {
            color: rgb(255, 255, 255, 1.0);
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .profile-image {
            width: 150px;
            height: 150px;www
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
        }
        .profile-info {
            text-align: center;
        }
        .profile-info h1 {
            margin-top: 0;
        }
        .profile-info p {
            margin-bottom: 0;
        }
    </style>
@endsection

@section('style')
<style>
    .wraper {
        position: relative;
        height: 50px;
        overflow: hidden;
        mask-image: linear-gradient(
            to right,
            rgba(0, 0, 0, 0),
            rgba(0, 0, 0, 1) 20%,
            rgba(0, 0, 0, 1) 80%,
            rgba(0, 0, 0, 0)
        );
    }

    @keyframes scroll {
        to {
            left: -200px;
        }
    }

    .item {
        height: 50px;
        width: 200px;
        overflow: hidden;
        position: absolute;
        left: max(calc(150px * 5), 100%);
        animation-name: scroll;
        animation-duration: 20s;
        animation-timing-function: linear;
        animation-iteration-count: infinite;
    }

    .item0 {
        animation-delay: calc(20s / 5 * (5 - 1) * -1);
    }

    .item1 {
        animation-delay: calc(20s / 5 * (5 - 2) * -1);
    }

    .item2 {
        animation-delay: calc(20s / 5 * (5 - 3) * -1);
    }

    .item3 {
        animation-delay: calc(20s / 5 * (5 - 4) * -1);
    }

    .item4 {
        animation-delay: calc(20s / 5 * (5 - 5) * -1);
    }

</style>
@endsection

@section('body')
    <div class="container-fluid p-0" style="position: relative;">
        <img style="width: 100%;" src="/././images/bg.png">
        <div class="border border-5 border-danger rounded-circle bg-white d-flex align-items-center justify-content-center" style="position: absolute; top: 85%; left: 5%; overflow: hidden; height: 200px; width: 200px;">
            @php
                if (isset(auth()->user()->company_id)) {
                    foreach ($companies as $index => $company) {
                        if ($company->id == auth()->user()->company_id) {
                            echo '
                                <img src="/././images/logos/'. $company->logo . '" class="img-fluid" style="object-fit: cover;">
                            ';
                            break;
                        }
                    }
                } else {
                    echo '
                        <img src="/././images/ELITE_ACES_LOGO.png" class="img-fluid" style="object-fit: cover;">
                    ';
                }
            @endphp
        </div>
    </div>
    <div class="container-fluid p-0 bg-white h-100 px-5 py-2">
        <div class="d-flex flex-direction-row align-items-end">
            <h1 style="margin-left: 250px;"><b>{{auth()->user()->name}}</b></h1><h3><b class="ms-2 text-secondary">({{auth()->user()->email}})</b></h3>
        </div>
        <h3 class="text-primary text-uppercase" style="margin-left: 250px;"><b>{{auth()->user()->role->name}}</b></h3>
        <hr class="my-5">
        <div class="row">
            <div class="col-4" id="profile_container">
                <div class="w-100 bg-white p-3 border border-dark rounded border-2 mx-auto">
                    <p class="fw-bold">MY PROFILE</p>
                    <form id="accountForm">
                        <div class="mb-3 small form-group">
                            <label CLASS="fw-bold text-danger form-label">USERNAME</label>
                            <input class="p-2 form-control" type="text" value="{{auth()->user()->name}}" name="name">
                        </div>
                        <div class="mb-3 small form-group">
                            <label CLASS="fw-bold text-danger form-label">5 SECRET PIN</label>
                            <input class="p-2 form-control" type="password" name="secret_pin" minlength="5" maxlength="5">
                        </div>
                        <div class="mb-3 small form-group">
                            <label CLASS="fw-bold text-danger form-label">Password</label>
                            <input class="p-2 form-control" type="password" minlength="8" maxlength="16" name="password" id="password">
                        </div>

                        <div class="mb-3 small form-group d-none" id="confirmPasswordHolder">
                            <label CLASS="fw-bold text-danger form-label">Confirm Password</label>
                            <input class="p-2 form-control" type="password" minlength="8" maxlength="16" name="confirmPassword" id="confirmPassword">
                        </div>

                        <button type="submit" class="d-block mx-auto btn btn-success w-50 rounded-pill">
                            UPDATE
                        </button>
                        <input type="hidden" name="current_id" value="{{auth()->user()->id}}">
                        <input type="hidden" name="current_name" value="{{auth()->user()->name}}">
                        <input type="hidden" name="current_secret_pin" value="{{auth()->user()->pin}}">
                        <input type="hidden" name="current_password" value="{{auth()->user()->password}}">
                    </form>
                </div>
            </div>
            <div class="col-8">
                <p>
                    <button class="btn btn-primary rounded-0" id="collapseRequest">
                        REQUEST [
                            @php
                                $counter = 0;
                                foreach ($requests as $index => $request) {
                                    $counter++;
                                }
                                echo $counter;
                            @endphp
                        ]
                    </button>
                </p>
                <div class="collapse" id="Request">
                    <div class="card card-body">
                        <div class="d-flex flex-direction-row gap-5">
                            @php
                                foreach ($requests as $index => $request) {
                                    echo"
                                        <div>
                                            <a target='_blank' href='https://ralima.biz/expense/request/{{$request->id}}'>$request->reference</a>
                                        </div>
                                    ";
                                }
                            @endphp
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
@endsection

@section('script')

    <script>

        const accountForm = document.querySelector('#accountForm');
        const passwordField = document.querySelector('#password');
        const confirmPassword = document.querySelector('#confirmPassword');
        const confirmPasswordHolder = document.querySelector('#confirmPasswordHolder');

        passwordField.addEventListener('input', () => {

            if (passwordField.value.length > 0) {
                confirmPasswordHolder.classList.remove('d-none');
                confirmPassword.setAttribute('required', 'required'); // Add 'required' attribute
            } else {
                confirmPassword.value = null;
                confirmPasswordHolder.classList.add('d-none');
                confirmPassword.removeAttribute('required'); // Remove 'required' attribute
            }

        })

        accountForm.addEventListener('submit', (e) => {

            e.preventDefault();

            const name = $('#accountForm').find('input[name="name"]').val();
            const current_name = $('#accountForm').find('input[name="current_name"]').val();
            const secret_pin = $('#accountForm').find('input[name="secret_pin"]').val();
            const current_secret_pin = $('#accountForm').find('input[name="current_secret_pin"]').val();
            const password = $('#accountForm').find('input[name="password"]').val();
            const confirmPassword = $('#accountForm').find('input[name="confirmPassword"]').val();
            const current_password = $('#accountForm').find('input[name="current_password"]').val();
            const current_id = $('#accountForm').find('input[name="current_id"]').val();

            if (name !== current_name) {
                $.ajax({
                    url: "/expense/account/update/name",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                    },
                    method: "POST",
                    data: {
                        name: name,
                        current_id: current_id
                    },
                    success: function (data) {

                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.error('Error:', textStatus, errorThrown);
                    }
                });
            }

            if (secret_pin) {
                if (secret_pin !== current_secret_pin) {
                    $.ajax({
                        url: "/expense/account/update/secret_pin",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                        },
                        method: "POST",
                        data: {
                            secret_pin: secret_pin,
                            current_id: current_id
                        },
                        success: function (data) {

                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.error('Error:', textStatus, errorThrown);
                        }
                    });
                } else {
                    window.location.href = '/expense/account';
                }
            }

            if (password) {
                if (password !== current_password) {
                    if (password === confirmPassword) {
                        $.ajax({
                            url: "/expense/account/update/password",
                            headers: {
                                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                            },
                            method: "POST",
                            data: {
                                password: password,
                                current_id: current_id
                            },
                            success: function (data) {

                            },
                            error: function (jqXHR, textStatus, errorThrown) {
                                console.error('Error:', textStatus, errorThrown);
                            }
                        });
                    } else {
                        alert('The password and confirm password doesn`t match.');
                        $('#accountForm').find('input[name="password"]').val('');
                        $('#accountForm').find('input[name="confirmPassword"]').val('');
                        $('#accountForm').find('input[name="password"]').focus();
                    }
                } else {
                    window.location.href = '/expense/account';
                }
            }

            window.location.href = '/expense/account';

        })

        $('#collapseRequest').on('click', function() {
            $('#Request').toggleClass('show');
        });


    </script>
@endsection
