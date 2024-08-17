@extends('layouts.income-index')


@section('title', 'Customer Page')

@section('body')
    <div class="overflow-x-auto">
        <table class="table table-border table-hover" id="quotes">
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
                        <th scope="col">{{$customer->name}}</th>
                        <th scope="col">{{$customer->position}}</th>
                        <th scope="col">{{$customer->company}}</th>
                        <th scope="col">{{$customer->contact_number}}</th>
                        <th scope="col">{{$customer->addrses}}</th>
                        <th scope="col">{{$customer->currency}}</th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
