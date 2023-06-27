<?php

declare(strict_types=1);

namespace Sun\Epay\Dto\ResponseDto;

class PaymentFormResponseDto extends CardErrorResponseDto
{
    public function __construct(
        private string $formUrl,
        ?int $errorCode,
        ?string $errorMessage,
    ) {
        parent::__construct($errorCode, $errorMessage);
    }

    public function getFormUrl(): string
    {
        return $this->formUrl;
    }
}
