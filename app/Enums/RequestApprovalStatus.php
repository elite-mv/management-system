<?php

namespace App\Enums;

enum RequestApprovalStatus {
    case PENDING;
    case APPROVED;
    case DISAPPROVE;
    case PRIORITY;

    public static function status(): array
    {
        return array_filter(RequestApprovalStatus::cases(), function ($method) {
            return $method !== RequestApprovalStatus::PRIORITY;
        });
    }
}
