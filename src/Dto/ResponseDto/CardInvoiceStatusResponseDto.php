<?php

declare(strict_types=1);

namespace Sun\Epay\Dto\ResponseDto;

use Sun\Epay\Enum\CardInvoiceStatusEnum;

class CardInvoiceStatusResponseDto extends CardErrorResponseDto
{
    public function __construct(
        private readonly int $amount,
        private readonly int $cardInvoiceStatus,
        ?int $errorCode,
        ?string $errorMessage,
    ) {
        parent::__construct($errorCode, $errorMessage);
        CardInvoiceStatusEnum::checkAllowedValue($cardInvoiceStatus);
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getCardInvoiceStatus(): int
    {
        return $this->cardInvoiceStatus;
    }
}
