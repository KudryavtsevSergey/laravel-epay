<?php

declare(strict_types=1);

namespace Sun\Epay\Dto\ResponseDto;

class AddInvoiceResponseDto implements ResponseDtoInterface
{
    public function __construct(
        private readonly int $invoiceNo,
        private readonly ?string $InvoiceUrl,
    ) {
    }

    public function getInvoiceNo(): int
    {
        return $this->invoiceNo;
    }

    public function getInvoiceUrl(): ?string
    {
        return $this->InvoiceUrl;
    }
}
