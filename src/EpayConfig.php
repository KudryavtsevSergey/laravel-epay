<?php

declare(strict_types=1);

namespace Sun\Epay;

use Illuminate\Contracts\Config\Repository;

class EpayConfig
{
    public function __construct(
        private readonly Repository $config,
    ) {
    }

    public function getGateway(): string
    {
        return rtrim($this->config->get('epay.gateway'), '/');
    }

    public function getToken(): ?string
    {
        return $this->config->get('epay.token');
    }

    public function isCheckSignature(): bool
    {
        return $this->config->get('epay.check_signature', false);
    }

    public function getSecret(): string
    {
        return $this->config->get('epay.secret', '');
    }
}
