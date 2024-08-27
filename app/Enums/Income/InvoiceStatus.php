<?php

namespace App\Enums\Income;

enum InvoiceStatus{
    case  PENDING;
    case  APPROVED;
    case  DISAPPROVED;
    case  HOLD;
}
