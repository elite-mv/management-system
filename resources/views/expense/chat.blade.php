@php
    use Illuminate\Support\Facades\Storage;
@endphp

@extends('layouts.expense-index')


@section('title', 'Group Message')

@section('body')
    <div class="container-fluid">
    <div class="row m-0 mt-3 py-4 px-2 bg-white w-100" id="comment">
        <div class="container px-4">
            <div class="row border border-dark text-start" style="display: flex; flex-direction: column; height: 600px;">
                <div class="overflow-y-auto d-flex flex-column justify-content-end bg-dark text-center text-white py-2">Group Chat</div>
                <div class="p-2" style="overflow-x:hidden; overflow-y:auto; flex: 1;" id="commentsHolder">
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
                </div>
                <div class="p-0">
                    <form id="commentForm">
                        <div class="comment-area">
                            <div class="bg-dark"
                                 style="display: flex; justify-content: center; align-items: center; flex-direction: row; margin: 0; padding: 0;">
                                <div class="w-100 p-1">
                                <textarea class="form-control rounded-pill" placeholder="Type your message here."
                                          rows="1" name="message" required=""></textarea>
                                </div>
                                <div class="w-50 p-1 d-flex align-items-center">
                                    <button type="submit" class="btn btn-sm btn-danger py-1 w-100 rounded-pill">Send</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('script')
<script>

    const commentsHolder = document.querySelector('#commentsHolder');
    const commentForm = document.querySelector('#commentForm');
    let initialLoad = true;

    function loadComments() {

        fetch('/expense/chats', {
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
            }
        }).then(response => {

            if (!response.ok) {
                throw new Error("Something went wrong!");
            }

            return response.text();

        }).then(data => {

            commentHolder.innerHTML = data;

            if (initialLoad) {
                commentHolder.scrollTop = commentHolder.scrollHeight - commentHolder.clientHeight;
                initialLoad = false;
            }

        }).catch(err => {
            console.log(err.message);
        })
    }

    window.addEventListener('load', () => {

        loadComments();

        setInterval(loadComments, 1000);
    })


    commentForm.addEventListener('submit',(e)=>{

        e.preventDefault();

        const formData = new FormData(commentForm);

        fetch('/expense/chat',{
            method: 'POST',
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
            },
            body: formData
        })

        commentForm.reset();
    })

</script>
@endsection

