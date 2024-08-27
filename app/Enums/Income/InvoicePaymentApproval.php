<?php

namespace App\Enums\Income;

enum InvoicePaymentApproval{
    case  PENDING;
    case  APPROVED;
    case  DISAPPROVED;
    case  HOLD;
}
