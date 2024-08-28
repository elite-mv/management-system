@php
    use Illuminate\Support\Facades\Storage;
@endphp

@extends('layouts.expense-index')

@section('title', 'Account')

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
    <div class="container p-3" style="position: relative;">

        <div class="row">

            <div class="col-sm-12 col-md-5 col-lg-5 mb-3">
                <div class="mx-auto border border-dark border-2 bg-light p-3 text-center"
                     style="border-radius: 10px; height: 600px; max-height: 100svh; max-height: 100vh; max-width: 100%; width: 375px;">
                    <b>RCA GROUP OF COMPANIES</b>
                    <div class="my-3 wraper">
                         @foreach($companies as $index => $company)
                            <div class="item item{{$index}}">
                                <img src="{{Storage::url($company->logo)}}" style="height: 50px; width: auto;">
                            </div>
                        @endforeach
                    </div>

                    <div class="border border-dark border-2 mx-auto mb-2 bg-white"
                         style="width: 100px; height: 100px;">
                    </div>

                    <div class="mb-2">
                        <p class="mb-0">{{auth()->user()->name}}</p>
                        <hr class="p-0 m-0">
                        <small class="fw-bold">NAME</small>
                    </div>

                    <div class="mb-2">
                        <p class="mb-0 text-uppercase">{{auth()->user()->role->name}} </p>
                        <hr class="p-0 m-0">
                        <small class="fw-bold">ROLE</small>
                    </div>

                    <div class="mb-2">
                        <p class="mb-0">{{auth()->user()->email}}</p>
                        <hr class="p-0 m-0">
                        <small class="fw-bold">EMAIL</small>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-7 col-lg-7" id="profile_container">
                <div class="w-100 bg-white p-3 border border-dark rounded border-2 mx-auto">
                    <p class="fw-bold">MY PROFILE</p>
                    <form method="POST" action="/expense/account" id="accountForm">
                        @csrf
                        <div class="mb-3 small form-group">
                            <label CLASS="fw-bold text-danger form-label">USERNAME</label>
                            <input class="p-2 form-control" type="text" value="{{auth()->user()->name}}"
                                   name="name">
                        </div>
                        <div class="mb-3 small form-group">
                            <label CLASS="fw-bold text-danger form-label">5 SECRET PIN</label>
                            <input class="p-2 form-control" type="text" name="pin" minlength="5" maxlength="5">
                        </div>
                        <div class="mb-3 small form-group">
                            <label CLASS="fw-bold text-danger form-label">Password</label>
                            <input class="p-2 form-control" type="text" name="password" id="password">
                        </div>

                        <div class="mb-3 small form-group d-none" id="confirmPasswordHolder">
                            <label CLASS="fw-bold text-danger form-label">Confirm Password</label>
                            <input class="p-2 form-control" type="text" name="confirmPassword" id="confirmPassword">
                        </div>

                        <button type="submit" class="d-block mx-auto btn btn-outline-success w-75 rounded-pill">
                            UPDATE
                        </button>
                    </form>
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
            } else {
                confirmPassword.value = null;
                confirmPasswordHolder.classList.add('d-none');
            }
        })

        accountForm.addEventListener('submit', (e) => {

            e.preventDefault();

        })

    </script>
@endsection
