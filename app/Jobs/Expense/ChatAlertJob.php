<?php

namespace App\Jobs\Expense;

use App\Mail\Expense\ChatAlert;
use App\Models\Expense\Request;
use App\Models\Expense\RequestComment;
use App\Models\Expense\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ChatAlertJob implements ShouldQueue
{
    use Queueable;

    protected $comment;

    /**
     * Create a new job instance.
     */
    public function __construct(RequestComment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to('john.castillo@cvsu.edu.ph')->send(new ChatAlert(
//            $this->comment->request->reference,
//            $this->comment->user->name,
//            $this->comment->request->id,
        '123',
        '123',
        '123',
        ));
    }
}
