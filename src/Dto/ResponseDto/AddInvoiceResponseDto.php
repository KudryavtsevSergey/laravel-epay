<?php

declare(strict_types=1);

namespace Sun\Epay\Dto\ResponseDto;

class AddInvoiceResponseDto implements ResponseDtoInterface
{
    public function __construct(
        private int $invoiceNo,
        private ?string $InvoiceUrl,
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
