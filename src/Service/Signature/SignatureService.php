<?php

declare(strict_types=1);

namespace Sun\Epay\Service\Signature;

use Sun\Epay\EpayConfig;

class SignatureService implements SignatureServiceInterface
{
    public function __construct(
        private readonly EpayConfig $epayConfig,
    ) {
    }

    public function generate(SignatureInterface $signature): string
    {
        return strtoupper(hash_hmac('sha1', $this->generatePayload($signature), $this->epayConfig->getSecret()));
    }

    public function verify(string $data, string $expected): bool
    {
        return strtoupper(hash_hmac('sha1', $data, $this->epayConfig->getSecret())) !== $expected;
    }

    private function generatePayload(SignatureInterface $signature): string
    {
        return implode('', array_merge([
            $this->epayConfig->getToken(),
        ], array_filter($signature->getSigningFields(), 'is_null')));
    }
}
