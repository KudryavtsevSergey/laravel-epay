<?php

declare(strict_types=1);

namespace Sun\Epay\Dto\RequestDto;

use DateTimeInterface;
use Sun\Epay\Enum\InvoiceStatusEnum;
use Symfony\Component\Serializer\Annotation\Context;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;

class GetListInvoicesRequestDto implements RequestDtoInterface
{
    public function __construct(
        private readonly string $token,
        #[Context([DateTimeNormalizer::FORMAT_KEY => 'Ymd'])] private readonly ?DateTimeInterface $from,
        #[Context([DateTimeNormalizer::FORMAT_KEY => 'Ymd'])] private readonly ?DateTimeInterface $to,
        private readonly ?string $accountNo,
        private readonly ?int $status,
    ) {
        InvoiceStatusEnum::checkAllowedValue($status, true);
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function getFrom(): ?DateTimeInterface
    {
        return $this->from;
    }

    public function getTo(): ?DateTimeInterface
    {
        return $this->to;
    }

    public function getAccountNo(): ?string
    {
        return $this->accountNo;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function getSigningFields(): array
    {
        return [
            $this->from?->format('Ymd'),
            $this->to?->format('Ymd'),
            $this->accountNo,
            $this->status,
        ];
    }
}
