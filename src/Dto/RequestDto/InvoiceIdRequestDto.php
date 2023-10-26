<?php

declare(strict_types=1);

namespace Sun\Epay\Dto\RequestDto;

class InvoiceIdRequestDto implements RequestDtoInterface
{
    public function __construct(
        private readonly int $invoiceId,
    ) {
    }

    public function getSigningFields(): array
    {
        return [
            $this->invoiceId,
        ];
    }
}
