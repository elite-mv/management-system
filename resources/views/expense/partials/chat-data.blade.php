@foreach($messages as $message)
    @if(auth()->user()->id == $message->user->id)
        <div class="ms-auto text-end card p-3 mb-2 w-75">
            <div class="small">
                <p class="text-capitalize text-primary mb-0">{{$message->user->name}}:</p>
                <p class="mb-1">{{$message->message}}</p>
                <p class="mb-0 text-end text-secondary">{{$message->created_at->format('Y-m-d H:m')}}</p>
            </div>
        </div>
    @else
        <div class="card w-75 p-3 mb-2">
            <div class="small">
                <p class="text-capitalize text-primary mb-0">{{$message->user->name}}:</p>
                <p class="mb-1">{{$message->message}}</p>
                <p class="mb-0 text-end text-secondary">{{$message->created_at->format('Y-m-d H:m')}}</p>
            </div>
        </div>
    @endif
@endforeach
