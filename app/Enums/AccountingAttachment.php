<?php

namespace App\Enums;

enum AccountingAttachment {
    case WITH;
    case WITHOUT;
    case  DEFAULT;

    public static function valueOf(string $target): self|null
    {
        foreach (AccountingAttachment::cases() as $case) {
            if ($case->name == $target) {
                return $case;
            }
        }

        return AccountingAttachment::DEFAULT;
    }
}
