<?php

declare(strict_types=1);

namespace Sun\Epay\Service\Signature;

interface SignatureServiceInterface
{
    public function generate(SignatureInterface $signature): string;

    public function verify(string $data, string $expected): bool;
}
