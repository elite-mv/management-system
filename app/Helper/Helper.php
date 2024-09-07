<?php

namespace App\Helper;

use NumberFormatter;
use NumberToWords\NumberToWords;

class Helper
{
    public static function padID($id): string
    {
        return str_pad($id,3,"0",STR_PAD_LEFT);
    }

    public static function rawID($reference, $separator = '-'): string
    {
        $parts = explode($separator, $reference);

        $value = trim($parts[1] ?? $parts[0]);

        return trim($value, "0");
    }

    public static function rawReference($reference, $separator = '-'): string
    {
        $parts = explode($separator, $reference);

        return trim($parts[0]);
    }

    private static function convertNumberToWords($number)
    {
        $words = '';

        $ones = array(
            0 => 'ZERO',
            1 => 'ONE',
            2 => 'TWO',
            3 => 'THREE',
            4 => 'FOUR',
            5 => 'FIVE',
            6 => 'SIX',
            7 => 'SEVEN',
            8 => 'EIGHT',
            9 => 'NINE'
        );

        $tens = array(
            10 => 'TEN',
            20 => 'TWENTY',
            30 => 'THIRTY',
            40 => 'FORTY',
            50 => 'FIFTY',
            60 => 'SIXTY',
            70 => 'SEVENTY',
            80 => 'EIGHTY',
            90 => 'NINETY'
        );

        $teens = array(
            10 => 'TEN',
            11 => 'ELEVEN',
            12 => 'TWELVE',
            13 => 'THIRTEEN',
            14 => 'FOURTEEN',
            15 => 'FIFTEEN',
            16 => 'SIXTEEN',
            17 => 'SEVENTEEN',
            18 => 'EIGHTEEN',
            19 => 'NINETEEN'
        );

        $hundreds = array(
            100 => 'HUNDRED',
            1000 => 'THOUSAND',
            1000000 => 'MILLION',
            1000000000 => 'BILLION',
            1000000000000 => 'TRILLION'
        );

        $parts = explode('.', $number);

        $integerPart = intval($parts[0]);

        if ($integerPart < 10) {
            $words .= $ones[$integerPart];
        } elseif ($integerPart < 20) {
            $words .= ' AND ' . $teens[$integerPart];
        } elseif ($integerPart < 100) {
            $words .= $tens[$integerPart - ($integerPart % 10)];
            if ($integerPart % 10 != 0) {
                $words .= ' ' . $ones[$integerPart % 10];
            }
        } elseif ($integerPart < 1000) {
            $words .= $ones[$integerPart / 100] . ' ' . $hundreds[100];
            if ($integerPart % 100 != 0) {
                $words .= ' ' . Helper::convertNumberToWords($integerPart % 100);
            }
        } else {
            foreach (array_reverse($hundreds, true) as $magnitude => $name) {
                if ($integerPart >= $magnitude) {
                    $div = (int)($integerPart / $magnitude);
                    $words .= Helper::convertNumberToWords($div) . ' ' . $name;
                    $integerPart %= $magnitude;
                    if ($integerPart) {
                        $words .= ' ';
                    }
                }
            }

            if ($integerPart) {
                $words .= ' ' . Helper::convertNumberToWords($integerPart);
            }
        }

        if (count($parts) == 2) {
            $decimalPart = intval($parts[1]);
            if ($decimalPart > 0) {
                $words .= ' AND ' . Helper::convertNumberToWords($decimalPart) . ' CENTAVOS';
            }
        }

        return $words;
    }
    public static function amountToWords($number)
    {
        return Helper::convertNumberToWords($number) . ' ONLY';
    }

    public static function formatPeso($amount): string
    {
        $locale = 'en_PH';

        // Create a NumberFormatter instance for currency formatting
        $formatter = new NumberFormatter($locale, NumberFormatter::CURRENCY);

        // Format the amount as currency
        return $formatter->formatCurrency($amount, 'PHP');

    }

    public static function formatCurrency($amount): string
    {
        return number_format($amount, 2);
    }

}
