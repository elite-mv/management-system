<?php

namespace App\Enums;

enum PaymentMethod
{
    case CASH;
    case ONLINE_TRANSFER;
    case GCASH;
    case CREDIT_CARD;
    case CHECK;
    case NONE;

    public static function modes(): array
    {
        return array_filter(PaymentMethod::cases(), function ($method) {
            return $method !== PaymentMethod::NONE;
        });
    }

    public static function valueOf(string $target): self|null
    {

        foreach (PaymentMethod::cases() as $case) {
            if ($case->name == $target) {
                return $case;
            }
        }

        return null;
    }

}
