<?php

namespace App\Enums;

enum AccountingType {
    case OPEX;
    case NON_OPEX;
    case  DEFAULT;

    public static function valueOf(string $target): self|null
    {
        foreach (AccountingType::cases() as $case) {
            if ($case->name == $target) {
                return $case;
            }
        }

        return AccountingType::DEFAULT;
    }
}
