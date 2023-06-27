<?php

declare(strict_types=1);

namespace Sun\Epay\Service\Signature;

interface SignatureInterface
{
    public function getSigningFields(): array;
}
