<?php

declare(strict_types=1);

namespace Sun\Epay\Dto\ResponseDto;

use Sun\Epay\Enum\InvoiceStatusEnum;

class InvoiceStatusResponseDto implements ResponseDtoInterface
{
    public function __construct(
        private readonly int $status,
    ) {
        InvoiceStatusEnum::checkAllowedValue($status);
    }

    public function getStatus(): int
    {
        return $this->status;
    }
}
