<?php

namespace App\Enums\Income;

enum InvoicePaymentType{
    case  CASH;
    case  E_WALLET;
    case  CHECK;
}
