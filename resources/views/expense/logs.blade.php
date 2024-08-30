@php
    use Illuminate\Support\Facades\Storage;
@endphp

@extends('layouts.expense-index')


@section('title', 'Logs')

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
                                    <input value="{{$app->request->search}}" type="search" name="search" class="form-control" placeholder="Search ...">
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
                                    <td>{{ $log->created_at->format('Y-m-d H:m A') }}</td>
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
