<?php

namespace App\Enums;

enum RequestStatus: string {

    case PENDING = 'PENDING';
    case TO_RETURN = 'TO RETURN';
    case HOLD = 'HOLD';
    case TO_PROCESS = 'TO PROCESS';
    case PROCESSING = 'PROCESSING';
    case FOR_FUNDING = 'FOR FUNDING';
    case RELEASED = 'RELEASED';

    /**
     * @throws \Exception
     */
    public static function valueOf(string $target): RequestStatus
    {

        foreach (RequestStatus::cases() as $case) {
            if ($case->value == $target || $case->name == $target) {
                return $case;
            }
        }

        throw new \Exception("Request status not found");
    }
}
