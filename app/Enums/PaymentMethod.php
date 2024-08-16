<?php

namespace App\Enums;

enum PaymentMethod {
    case CASH;
    case ONLINE_TRANSFER;
    case GCASH;
    case CREDIT_CARD;
    case CHECK;
    case NONE;
}