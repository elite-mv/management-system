@foreach($requestItems as $requestItem)
    <div id="requestItem{{$requestItem->id}}" class="cursor-pointer row m-0 px-3 mb-1 border border-dark cart-items" onclick="onSelectExpenseRequest('{{$requestItem->id}}');">
        <div class="col-1 text-center">
            <small>{{ $requestItem->quantity}}</small>
        </div>
        <div class="col-2 text-start">
            <small>{{ $requestItem->measurement->name}}</small>
        </div>
        <div class="col-2 text-start">
            <small>{{ $requestItem->jobOrder->name}}</small>
        </div>
        <div class="col-3 text-start" style="overflow: hidden; text-overflow: ellipsis;">
            <small>{{ $requestItem->description}}</small>
        </div>
        <div class="col-2 text-end">
            <small>{{ $requestItem->cost}}</small>
        </div>
        <div class="col-2 text-end">
            <small>{{ $requestItem->total }}</small>
        </div>
    </div>
@endforeach