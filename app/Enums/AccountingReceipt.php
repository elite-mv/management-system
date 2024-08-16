<?php

namespace App\Enums;

enum AccountingReceipt {
    case OFFICAL_RECEIPT_VAT;
    case DELIVERY_RECEIPT;
    case NONE;
}