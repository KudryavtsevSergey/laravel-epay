<?php

declare(strict_types=1);

namespace Sun\Epay\Dto\ResponseDto;

class CardErrorResponseDto implements ResponseDtoInterface
{
    public function __construct(
        private ?int $errorCode,
        private ?string $errorMessage,
    ) {
    }

    public function getErrorCode(): ?int
    {
        return $this->errorCode;
    }

    public function getErrorMessage(): ?string
    {
        return $this->errorMessage;
    }
}
