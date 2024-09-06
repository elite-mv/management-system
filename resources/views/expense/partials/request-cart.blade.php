@foreach($requestItems as $requestItem)
    <tr id="requestItem{{$requestItem->id}}" onclick="onSelectExpenseRequest('{{$requestItem->id}}');">
        <td scope="row" class="text-center"><small>{{ $requestItem->quantity}}</small></th>
        <td><small>{{ $requestItem->measurement->name}}</small></td>
        <td><small>{{ $requestItem->jobOrder->name}}</small></td>
        <td><small>{{ $requestItem->description}}</small></td>
        <td class="text-end"><small>{{ $requestItem->cost}}</small></td>
        <td class="text-end"><small>{{ $requestItem->total }}</small></td>
    </tr>
@endforeach