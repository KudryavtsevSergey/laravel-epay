<?php

declare(strict_types=1);

namespace Sun\Epay\Dto\RequestDto;

use Sun\Epay\Enum\QrCodeViewTypeEnum;

class QrCodeForAccountNumberRequestDto implements RequestDtoInterface
{
    public function __construct(
        private readonly int $accountNumber,
        private readonly ?float $amount = null,
        private readonly ?string $viewType = null,
        private readonly ?int $imageWidth = null,
        private readonly ?int $imageHeight = null,
    ) {
        QrCodeViewTypeEnum::checkAllowedValue($viewType, true);
    }

    public function getAccountNumber(): int
    {
        return $this->accountNumber;
    }

    public function getAmount(): ?float
    {
        return $this->amount;
    }

    public function getViewType(): ?string
    {
        return $this->viewType;
    }

    public function getImageWidth(): ?int
    {
        return $this->imageWidth;
    }

    public function getImageHeight(): ?int
    {
        return $this->imageHeight;
    }

    public function getSigningFields(): array
    {
        return [
            $this->accountNumber,
            $this->amount !== null ? number_format($this->amount, 2, ',', '') : null,
            $this->viewType,
            $this->imageWidth,
            $this->imageHeight,
        ];
    }
}
