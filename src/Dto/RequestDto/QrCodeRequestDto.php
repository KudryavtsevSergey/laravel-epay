<?php

declare(strict_types=1);

namespace Sun\Epay\Dto\RequestDto;

use Sun\Epay\Enum\QrCodeViewTypeEnum;

class QrCodeRequestDto implements RequestDtoInterface
{
    public function __construct(
        private readonly int $invoiceId,
        private readonly ?string $viewType = null,
        private readonly ?int $imageWidth = null,
        private readonly ?int $imageHeight = null,
    ) {
        QrCodeViewTypeEnum::checkAllowedValue($viewType, true);
    }

    public function getInvoiceId(): int
    {
        return $this->invoiceId;
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
            $this->invoiceId,
            $this->viewType,
            $this->imageWidth,
            $this->imageHeight,
        ];
    }
}
