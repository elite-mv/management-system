<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<table class="table table-bordered">
    <thead>
    <tr>
        <th>REFERENCE</th>
        <th>ENTITY</th>
        <th>PAID TO</th>
        <th>REQUESTED BY</th>
        <th>BOOK KEEPER</th>
        <th>ACCOUNTANT</th>
        <th>FINANCE</th>
        <th>AUDITOR</th>
        <th>PAYMENT STATUS</th>
        <th>REQUEST STATUS</th>
        <th>AMOUNT REQUEST</th>
        <th>APPROVED AMOUNT</th>
        <th>BALANCE</th>
    </tr>
    </thead>
    <tbody>
    @foreach($requests as $request)
        <tr>
            <td class="text-nowrap">{{$request->reference}}</td>
            <td>{{$request->company->name}}</td>
            <td class="text-capitalize">{{$request->paid_to}}</td>
            <td class="text-capitalize">{{$request->request_by}}</td>
            <td>
                @if($request->bookKeeper)
                    {{$request->bookKeeper->created_at}}
                @else
                    --
                @endif
            </td>
            <td>
                @if($request->accountant)
                    {{$request->accountant->created_at}}
                @else
                    --
                @endif
            </td>
            <td>
                @if($request->finance)
                    {{$request->finance->created_at}}
                @else
                    --
                @endif
            </td>
            <td>
                @if($request->auditor)
                    {{$request->auditor->created_at}}
                @else
                    --
                @endif
            </td>
            <td>
                {{$request->status}}
            </td>
            <td>
                @if($request->approvals_count == 4)
                    CLOSE
                @else
                    OPEN
                @endif
            </td>
            <td>{!! \App\Helper\Helper::formatPeso($request->items_sum_sub_total) !!}</td>
            <td>{!! \App\Helper\Helper::formatPeso($request->items_sum_approve_total) !!}</td>
            <td>{!! \App\Helper\Helper::formatPeso($request->items_sum_sub_total -  $request->items_sum_approve_total) !!}</td>
        </tr>
    @endforeach
    <tr>
        <td colspan="10">Total</td>
        <td>{!! \App\Helper\Helper::formatPeso($total) !!}</td>
        <td>{!! \App\Helper\Helper::formatPeso($approved) !!}</td>
        <td>{!! \App\Helper\Helper::formatPeso($total - $approved) !!}</td>
    </tr>
    </tbody>
</table>
