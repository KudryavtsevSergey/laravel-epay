<?php

declare(strict_types=1);

namespace Sun\Epay\Dto\ResponseDto;

class CardErrorResponseDto implements ResponseDtoInterface
{
    public function __construct(
        private readonly ?int $errorCode,
        private readonly ?string $errorMessage,
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
