<?php

declare(strict_types=1);

namespace Sun\Epay\Enum;

class QrCodeViewTypeEnum extends AbstractEnum
{
    public const BASE_64 = 'base64';
    public const TEXT = 'text';

    public static function getValues(): array
    {
        return [
            self::BASE_64,
            self::TEXT,
        ];
    }
}
