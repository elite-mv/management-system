<?php

namespace App\Enums;

enum PaymentMethod: string
{
    case CASH = 'cash';
    case ONLINE_TRANSFER = 'online transfer';
    case GCASH = 'gcash';
    case CREDIT_CARD = 'credit card';
    case CHECK = 'check';
    case NONE = '';

    public static function modes(): array
    {
        return array_filter(PaymentMethod::cases(), function ($method) {
            return $method !== PaymentMethod::NONE;
        });
    }

    public static function valueOf(string $target): self|null
    {

        foreach (PaymentMethod::cases() as $case) {
            if ($case->name == $target || $case->value == $target) {
                return $case;
            }
        }

        return null;
    }

}
