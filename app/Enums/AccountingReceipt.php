<?php

namespace App\Enums;

enum AccountingReceipt {
    case OFFICIAL_RECEIPT_VAT;
    case DELIVERY_RECEIPT;
    case NONE;
    case  DEFAULT;

    public static function valueOf(string $target): self
    {
        foreach (AccountingReceipt::cases() as $case) {
            if ($case->name == $target) {
                return $case;
            }
        }

        return AccountingReceipt::DEFAULT;
    }
}
