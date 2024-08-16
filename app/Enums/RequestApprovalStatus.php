<?php

namespace App\Enums;

enum RequestApprovalStatus {
    case PENDING;
    case APPROVED;
    case DISAPPROVE;
}