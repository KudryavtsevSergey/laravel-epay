<?php

declare(strict_types=1);

namespace Sun\Epay\Responses;

use Illuminate\Contracts\Support\Responsable;
use Symfony\Component\HttpFoundation\Response;

class EpayResponse implements Responsable
{
    public function toResponse($request): Response
    {
        return new Response();
    }
}
