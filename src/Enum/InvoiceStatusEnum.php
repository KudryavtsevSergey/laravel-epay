<?php

declare(strict_types=1);

namespace Sun\Epay\Enum;

class InvoiceStatusEnum extends AbstractEnum
{
    public const AWAITING_PAYMENT = 1;
    public const EXPIRED = 2;
    public const PAID = 3;
    public const PAID_IN_PART = 4;
    public const CANCELED = 5;
    public const PAID_WITH_BANK_CARD = 6;
    public const PAYMENT_RETURNED = 7;

    public static function getValues(): array
    {
        return [
            self::AWAITING_PAYMENT,
            self::EXPIRED,
            self::PAID,
            self::PAID_IN_PART,
            self::CANCELED,
            self::PAID_WITH_BANK_CARD,
            self::PAYMENT_RETURNED,
        ];
    }
}
