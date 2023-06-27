<?php

declare(strict_types=1);

namespace Sun\Epay;

use Sun\Epay\Service\EpayApiService;

class Epay
{
    public static bool $registersRoutes = true;

    public function apiService(): EpayApiService
    {
        return app(EpayApiService::class);
    }

    public static function ignoreRoutes(): void
    {
        static::$registersRoutes = false;
    }
}
