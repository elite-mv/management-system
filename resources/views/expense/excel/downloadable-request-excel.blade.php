<table class="table table-bordered">
    <thead>
    <tr>
        <th>REFERENCE</th>
        <th>ENTITY</th>
        <th>PAID TO</th>
        <th>REQUESTED BY</th>
        <th>AMOUNT</th>
        <th>AMOUNT IN WORDS</th>
        <th>BANK</th>
        <th>BANK CODE</th>
        <th>CHECK NUMBER</th>
    </tr>
    </thead>
    <tbody>
    @foreach($requests as $request)
        <tr>
            <td class="text-nowrap">{{$request->reference}}</td>
            <td>{{$request->company->name}}</td>
            <td class="text-capitalize">{{$request->paid_to}}</td>
            <td class="text-capitalize">{{$request->request_by}}</td>
            <td>{!! \App\Helper\Helper::formatCurrency($request->items_sum_approve_total) !!}</td>
            <td>{!! \App\Helper\Helper::amountToWords($request->items_sum_approve_total) !!}</td>
            <td>
                @if($request->bankDetails && $request->bankDetails->bank)
                    {{ $request->bankDetails->bank->name}}
                @else
                    --
                @endif
            </td>
            <td>
                @if($request->bankDetails && $request->bankDetails->code)
                    {{ $request->bankDetails->code->code}}
                @else
                    --
                @endif
            </td>
            <td>
                @if($request->bankDetails)
                    {{ $request->bankDetails->check_number}}
                @else
                    --
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
