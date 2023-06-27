<?php

declare(strict_types=1);

namespace Sun\Epay;

use Illuminate\Support\Facades\Facade as IlluminateFacade;
use Sun\Epay\Service\EpayApiService;

/**
 * @method static EpayApiService apiService()
 * @method static void ignoreRoutes()
 */
class Facade extends IlluminateFacade
{
    public const FACADE_ACCESSOR = 'Epay';

    protected static function getFacadeAccessor(): string
    {
        return self::FACADE_ACCESSOR;
    }
}
