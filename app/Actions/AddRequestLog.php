<?php

namespace App\Actions;

use App\Models\Expense\RequestLogs;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsAction;

class AddRequestLog
{
    use AsAction;

    /**
     * @throws \Exception
     */
    public function handle($requestID, $message)
    {
        try {

            RequestLogs::create([
                'description' => strtolower($message),
                'request_id' => $requestID,
                'user_id' => Auth::id(),
            ]);

        }catch (\Exception $exception){
            throw new \Exception($exception->getMessage());
        }
    }
}
