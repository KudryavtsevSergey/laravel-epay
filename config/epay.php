<?php

declare(strict_types=1);

return [
    'token' => env('EPAY_TOKEN'),
    /**
     * https://sandbox-api.express-pay.by/v1 for test mode
     */
    'gateway' => env('EPAY_GATEWAY', 'https://api.express-pay.by/v1'),
    'check_signature' => env('EPAY_CHECK_SIGNATURE', false),
    'check_type' => env('EPAY_CHECK_TYPE'),
    'secret' => env('EPAY_SECRET'),
];
