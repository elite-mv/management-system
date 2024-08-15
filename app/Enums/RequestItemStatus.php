<?php

namespace App\Enums;

enum RequestItemStatus {
    case PENDING;
    case APPROVED;
    case DISAPPROVED;
    case HOLD;
    case PRIORITY;
}