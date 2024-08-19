<?php

namespace App\Enums;

enum RequestPriorityLevel {
    case NONE;
    case LOW;
    case MEDIUM;
    case HIGH;

    public static function valueOf(string $target): self|null
    {
        foreach (RequestPriorityLevel::cases() as $case) {
            if ($case->name == $target) {
                return $case;
            }
        }

        return RequestPriorityLevel::NONE;
    }
}
