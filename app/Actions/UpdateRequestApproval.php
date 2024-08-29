<?php

namespace App\Actions;

use App\Enums\RequestApprovalStatus;
use App\Models\Expense\RequestApproval;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateRequestApproval
{
    use AsAction;

    public function handle(int $requestID, int $roleID, RequestApprovalStatus $status)
    {
        RequestApproval::updateOrCreate([
            'request_id' => $requestID,
            'role_id' => $roleID,
        ],
            [
                'user_id' => Auth::id(),
                'status' => $status
            ]
        );
    }
}
