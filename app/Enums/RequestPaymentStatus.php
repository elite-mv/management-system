<?php

namespace App\Enums;

enum RequestPaymentStatus {
    case PENDING;
    case TO_RETURN;
    case HOLD;
    case TO_PROCESS;
    case PROCESSING;
    case FOR_FUNDING;
    case RELEASED;
}