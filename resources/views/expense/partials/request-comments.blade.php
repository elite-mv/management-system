@foreach($comments as $comment)
    @if(auth()->user()->id == $comment->user->id)
        <div class="ms-auto text-end card p-3 mb-2 w-75">
            <div class="small">
                <p class="text-capitalize text-primary mb-0">{{$comment->user->name}}:</p>
                <p class="mb-1" style="white-space: pre-wrap">{{$comment->message}}</p>
                <p class="mb-0 text-end text-secondary">{{$comment->created_at->format('Y-m-d H:m')}}</p>
            </div>
        </div>
    @else
        <div class="card w-75 p-3 mb-2">
            <div class="small">
                <p class="text-capitalize text-primary mb-0">{{$comment->user->name}}:</p>
                <p class="mb-1" style="white-space: pre-wrap">{{$comment->message}}</p>
                <p class="mb-0 text-end text-secondary">{{$comment->created_at->format('Y-m-d H:m')}}</p>
            </div>
        </div>
    @endif
@endforeach
