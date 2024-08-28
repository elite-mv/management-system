@php
    use Illuminate\Support\Facades\Storage;
@endphp

@extends('layouts.expense-index')

@section('title', 'Account')

@section('body')
    <div class="container p-3" style="position: relative;">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-12 text-start d-flex  align-items-center gap-2">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-table me-1"></i>
                                    <p class="mb-0 fw-bold">Accounts</p>
                                </div>
                                <form>
                                    <input value="{{$app->request->search}}" class="form-control"
                                           placeholder="Search..." type="search" name="search">
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
                                        <th>EMAIL</th>
                                        <th>PASSWORD</th>
                                        <th>USERNAME</th>
                                        <th>ROLE</th>
                                        <th>PIN</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{$user->email}}</td>
                                            <td>

                                                <div class="d-flex gap-1 align-items-center">

                                                    <input id="passwordInput{{$user->id}}" class="form-control"
                                                           type="password" value="{{$user->password}}" readonly>

                                                    <i  style="cursor: pointer" id="passwordEye{{$user->id}}" onclick="password({{$user->id}})" class="far fa-eye"></i>

                                                </div>

                                            </td>
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


