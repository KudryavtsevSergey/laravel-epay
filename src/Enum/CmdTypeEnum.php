<?php

declare(strict_types=1);

namespace Sun\Epay\Enum;

class CmdTypeEnum extends AbstractEnum
{
    public const NEW_PAYMENT = 1;
    public const CANCEL_PAYMENT = 2;
    public const CHANGE_STATUS = 3;

    public static function getValues(): array
    {
        return [
            self::NEW_PAYMENT,
            self::CANCEL_PAYMENT,
            self::CHANGE_STATUS,
        ];
    }
}
