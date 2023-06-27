<?php

declare(strict_types=1);

namespace Sun\Epay\Enum;

class CardInvoiceStatusEnum extends AbstractEnum
{
    public const ACCOUNT_REGISTERED_BUT_NOT_PAID = 0;
    public const PRE_AUTHORIZED_AMOUNT_HELD = 1;
    public const COMPLETE_AUTHORIZATION_OF_THE_INVOICE_AMOUNT = 2;
    public const AUTHORIZATION_CANCELED = 3;
    public const TRANSACTION_WAS_SUBJECT_TO_A_REFUND_OPERATION = 4;
    public const AUTHORIZATION_INITIATED_VIA_ACS_OF_THE_ISSUING_BANK = 5;
    public const AUTHORIZATION_DENIED = 6;

    public static function getValues(): array
    {
        return [
            self::ACCOUNT_REGISTERED_BUT_NOT_PAID,
            self::PRE_AUTHORIZED_AMOUNT_HELD,
            self::COMPLETE_AUTHORIZATION_OF_THE_INVOICE_AMOUNT,
            self::AUTHORIZATION_CANCELED,
            self::TRANSACTION_WAS_SUBJECT_TO_A_REFUND_OPERATION,
            self::AUTHORIZATION_INITIATED_VIA_ACS_OF_THE_ISSUING_BANK,
            self::AUTHORIZATION_DENIED,
        ];
    }
}
