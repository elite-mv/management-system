@php
    use Illuminate\Support\Facades\Storage;
@endphp

@extends('layouts.expense-index')


@section('title', 'Dashboard')

@section('body')

    <div class="container-fluid">
        <div class="row p-2">

            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted">Today's Rejected Request</h6>
                        <h3 class="card-text">{!! \App\Helper\Helper::formatPeso(50000) !!}</h3>
                        <h5 class="card-title">Request Count 10</h5>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted">Today's Rejected Request</h6>
                        <h3 class="card-text">{!! \App\Helper\Helper::formatPeso(50000) !!}</h3>
                        <h5 class="card-title">Request Count 10</h5>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-subtitle mb-2 text-muted">Today's Rejected Request</h6>
                        <h3 class="card-text">{!! \App\Helper\Helper::formatPeso(50000) !!}</h3>
                        <h5 class="card-title">Request Count 10</h5>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection

@section('script')
    <script>
    </script>
@endsection

