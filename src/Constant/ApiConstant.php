<?php

declare(strict_types=1);

namespace Sun\Epay\Constant;

class ApiConstant
{
    public const INVOICES = 'invoices';
    public const INVOICE = 'invoices/%s';
    public const INVOICE_STATUS = 'invoices/%s/status';
    public const GENERATE_QR_CODE = 'qrcode/getqrcode';
    public const GENERATE_QR_CODE_BY_ACCOUNT_NUMBER = 'qrcode/getqrcodebyaccountnumber';
    public const CARD_INVOICES = 'cardinvoices';
    public const CARD_INVOICE_PAYMENT = 'cardinvoices/%s/payment';
    public const CARD_INVOICE_STATUS = 'cardinvoices/%s/status';
    public const CARD_INVOICE_REVERSE = 'cardinvoices/%s/reverse';
    public const PAYMENTS = 'payments';
}
