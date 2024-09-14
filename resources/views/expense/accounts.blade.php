@php
    use Illuminate\Support\Facades\Storage;
@endphp

@extends('layouts.expense-index')

@section('title', 'Account')

@section('style')
    <style type="text/css">
        .accounts_nav {
            color: rgb(255, 255, 255, 1.0);
        }
    </style>
@endsection

@section('body')
    <div class="container p-3" style="position: relative;">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-2 d-flex align-items-center">
                                <i class="fas fa-table me-1"></i>
                                <p class="mb-0 fw-bold">Accounts</p>
                            </div>

                            <div class="col-10 ms-auto">
                                <form>
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
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body overflow-x-auto">
                        <div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">
                            <div class="datatable-top">
                                <table id="accounts_database" class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th class="sorttable_nosort">
                                            <div class="form-check d-flex align-items-center justify-content-center p-0 m-0">
                                                <input class="form-check-input p-0 m-0" type="checkbox" value="" id="requestAllInput">
                                            </div>
                                        </th>
                                        <th>EMAIL</th>
                                        <th>USERNAME</th>
                                        <th>ROLE</th>
                                        <th>PIN</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td class="text-center">
                                                <input data-id='{{$user->id}}' id="requestInput{{$user->id}}"
                                                       type="checkbox" class="form-check-input request-input-selection">
                                            </td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->name}}</td>
                                            <td>{{$user->role->name}}</td>
                                            <td>{{$user->pin}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="container-fluid">
                                    {{$users->links()}}
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
    <script type="text/javascript" src="/js/sortable.js"></script>

    <script>
        function password(id) {

            const target = document.querySelector(`#passwordInput${id}`);
            const element = document.querySelector(`#passwordEye${id}`);

            if (element.classList.contains('far') && element.classList.contains('fa-eye')) {
                element.classList.remove('far', 'fa-eye');
                element.classList.add('fas', 'fa-eye-slash');
                target.setAttribute('type', 'text');
            } else {
                element.classList.add('far', 'fa-eye');
                element.classList.remove('fas', 'fa-eye-slash');
                target.setAttribute('type', 'password');
            }
        }
    </script>
@endsection


