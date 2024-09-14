@php
    use Illuminate\Support\Facades\Storage;
@endphp

@extends('layouts.expense-index')

@section('title', 'Logs')

@section('style')
    <style type="text/css">
        .exp_nav {
            color: rgb(255, 255, 255, 1.0);
        }
    </style>
@endsection

@section('body')

    @if($errors->any())
        {{ implode('', $errors->all('<div>:message</div>')) }}
    @endif

    <div class="container p-3">
        <div class="row mb-3">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-2 d-flex align-items-center">
                                <i class="fas fa-table me-1"></i>
                                <b>Activity Logs</b>
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
                        <table class="table sortable">
                            <thead>
                            <tr>
                                <th>Description</th>
                                <th>Reference</th>
                                <th>Date</th>
                                <th>User</th>
                                <th>Email</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($logs as $log)
                                <tr>
                                    <td>{{ $log->description }}</td>
                                    <td>
                                        <a target="_blank" href="/expense/request/{{$log->request->id }}"> {{ $log->request->reference }}</a>
                                    </td>
                                    <td>{{ $log->created_at->format('Y-m-d H:i A') }}</td>
                                    <td>{{ $log->user->name }}</td>
                                    <td>{{ $log->user->email }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan='4'>
                                        <p class="text-secondary">
                                            EMPTY TABLE
                                        </p>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        {{$logs->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
