<?php

declare(strict_types=1);

namespace Sun\Epay\Dto\ResponseDto;

class QrCodeResponseDto implements ResponseDtoInterface
{
    public function __construct(
        private readonly string $qrCodeBody,
    ) {
    }

    public function getQrCodeBody(): string
    {
        return $this->qrCodeBody;
    }
}
