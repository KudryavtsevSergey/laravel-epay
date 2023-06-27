<?php

declare(strict_types=1);

namespace Sun\Epay\Dto\ResponseDto;

class CardInvoiceResponseDto extends CardErrorResponseDto
{
    public function __construct(
        private int $cardInvoiceNo,
        private ?string $invoiceUrl,
        ?int $errorCode,
        ?string $errorMessage,
    ) {
        parent::__construct($errorCode, $errorMessage);
    }

    public function getCardInvoiceNo(): int
    {
        return $this->cardInvoiceNo;
    }

    public function getInvoiceUrl(): ?string
    {
        return $this->invoiceUrl;
    }
}
