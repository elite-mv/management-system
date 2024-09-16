<table class="table sortable" id="sortableTable">
    <thead>
    <tr>
        <th>PR Number</th>
        <th>DATE</th>
        <th>JOB ORDER</th>
        <th>COMPANY</th>
        <th>PARTICULARS</th>
        <th>CLASS</th>
        <th>BANK CODE</th>
        <th>CHECK NUMBER</th>
        <th>TOTAL</th>
    </tr>
    </thead>
    <tbody id="requestData">
    @foreach($items as $item)
        <tr>
            <td>{!! \App\Helper\Helper::padID($item->request->id) !!}</td>
            <td>{{$item->request->created_at->format('Y-m-d')}}</td>
            <td>{{$item->jobOrder->reference}}</td>
            <td class="text-capitalize">{{ strtolower($item->request->supplier)}}</td>
            <td class="text-capitalize">{{ strtolower($item->description)}}</td>
            <td class="text-uppercase">{{$item->request->company->name}}</td>
            <td>
                @if($item->request->bankDetails && $item->request->bankDetails->code)
                    {{$item->request->bankDetails->code->code}}
                @else
                    <span class="text-secondary">--</span>
                @endif
            </td>
            <td>
                @if($item->request->bankDetails && $item->request->bankDetails->check_number)
                    {{$item->request->bankDetails->check_number}}
                @else
                    <span class="text-secondary">--</span>
                @endif
            </td>
            <td>{{\App\Helper\Helper::formatPeso($item->sub_total)}}</td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr class="fw-bold">
        <td colspan="8">Total</td>
        <td>{!! \App\Helper\Helper::formatPeso($total) !!}</td>
    </tr>
    </tfoot>
</table>
