<?php

declare(strict_types=1);

namespace Sun\Epay\Exceptions\Request;

use Illuminate\Contracts\Support\Responsable;
use Sun\Epay\Exceptions\InternalError;
use Sun\Epay\Responses\EpayResponse;
use Symfony\Component\HttpFoundation\Response;

abstract class AbstractResponsableException extends InternalError implements Responsable
{
    public function toResponse($request): Response
    {
        return (new EpayResponse())->toResponse($request);
    }
}
