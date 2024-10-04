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

    protected $reference;
    protected $requestID;
    protected $userCommentor;
    protected $preparedBy;

    const cc = [
        'bookkeeper@gtiarmoredcars.com',
        'auditor@gtiarmoredcars.com',
        'finance@gtiarmoredcars.com',
        'jocelyn@eliteacesinc.com',
        'ariel@accountant.com',
    ];

    /**
     * Create a new job instance.
     */
    public function __construct(string $reference, string $requestID, string $userCommentor, string $preparedBy)
    {
        $this->reference = $reference;
        $this->requestID = $requestID;
        $this->userCommentor = $userCommentor;
        $this->preparedBy = $preparedBy;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        Mail::to($this->preparedBy)
            ->cc(self::cc)
            ->send(new ChatAlert(
                $this->reference,
                $this->userCommentor,
                $this->requestID,
        ));
    }
}
