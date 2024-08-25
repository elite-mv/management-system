<?php

namespace App\Enums;

enum RequestFundStatus: string {

    case FUNDED = 'funded';
    case DECLINED = 'declined';
    case NONE = 'none';

    /**
     * @throws \Exception
     */
    public static function valueOf(string $target): RequestFundStatus
    {

        foreach (RequestFundStatus::cases() as $case) {
            if ($case->value == $target || $case->name == $target) {
                return $case;
            }
        }

        throw new \Exception("Request status not found");
    }
}
