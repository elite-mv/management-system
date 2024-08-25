<?php

namespace App\Enums;

enum RequestItemStatus {
    case PENDING;
    case APPROVED;
    case DISAPPROVED;
    case HOLD;
    case PRIORITY;

    public static function status(): array
    {
        return array_filter(RequestItemStatus::cases(), function ($method) {
            return $method !== RequestItemStatus::PRIORITY;
        });
    }

    /**
     * @throws \Exception
     */
    public static function valueOf(string $target): RequestItemStatus
    {
        foreach (RequestItemStatus::cases() as $case) {
            if ($case->name == $target) {
                return $case;
            }
        }
        throw new \Exception("Unknown request priority level");
    }
}
