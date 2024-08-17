@extends('layouts.income-index')


@section('title', 'Customer Page')

@section('body')

    {{ $data }}

    @foreach($lovers as $lover)
        <p class="text-danger">{{ $lover }}</p>
    @endforeach

    <p>Hello Customer</p>
@endsection
