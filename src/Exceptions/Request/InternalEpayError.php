<?php

declare(strict_types=1);

namespace Sun\Epay\Exceptions\Request;

use Throwable;

class InternalEpayError extends AbstractResponsableException
{
    public function __construct(Throwable $previous)
    {
        parent::__construct('Internal Error', $previous);
    }
}
