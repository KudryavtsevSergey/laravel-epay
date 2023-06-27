<?php

declare(strict_types=1);

namespace Sun\Epay\Enum;

class CurrencyEnum extends AbstractEnum
{
    public const BYN = 933;

    public static function getValues(): array
    {
        return [
            self::BYN,
        ];
    }
}
