<?php

declare(strict_types=1);

namespace Sun\Epay\Exceptions\Request;

class WrongEpaySignatureException extends AbstractResponsableException
{
    public function __construct(?string $signature)
    {
        $message = sprintf('Wrong Signature: %s', $signature);
        parent::__construct($message);
    }
}
