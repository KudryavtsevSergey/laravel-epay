<?php

declare(strict_types=1);

namespace Sun\Epay\Dto\RequestDto;

class CardInvoiceIdRequestDto implements RequestDtoInterface
{
    public function __construct(
        private readonly int $cardInvoiceId,
        private readonly ?string $language = null,
    ) {
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function getSigningFields(): array
    {
        return [
            $this->cardInvoiceId,
            $this->language,
        ];
    }
}
