<?php

declare(strict_types=1);

namespace Sun\Epay\Enum;

class HttpMethodEnum extends AbstractEnum
{
    public const GET = 'GET';
    public const POST = 'POST';
    public const PUT = 'put';
    public const DELETE = 'delete';

    public static function getValues(): array
    {
        return [
            self::GET,
            self::POST,
            self::PUT,
            self::DELETE,
        ];
    }
}
