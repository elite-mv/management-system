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

    public static function valueOf(string $target): RequestApprovalStatus
    {

        if(strtoupper($target) == RequestApprovalStatus::PRIORITY->name) {
            return RequestApprovalStatus::PRIORITY;
        }

        if(strtoupper($target) == RequestApprovalStatus::APPROVED->name) {
            return RequestApprovalStatus::APPROVED;
        }

        if(strtoupper($target) == RequestApprovalStatus::DISAPPROVE->name) {
            return RequestApprovalStatus::DISAPPROVE;
        }

        return RequestApprovalStatus::PENDING;
    }
}
