<?php

declare(strict_types=1);

namespace Sun\Epay\Dto\ResponseDto;

use DateTimeInterface;
use Sun\Epay\Enum\CurrencyEnum;
use Sun\Epay\Enum\InvoiceStatusEnum;
use Symfony\Component\Serializer\Annotation\Context;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;

class InvoiceResponseDto implements ResponseDtoInterface
{
    public function __construct(
        private readonly int $invoiceNo,
        private readonly string $accountNo,
        private readonly int $status,
        #[Context([DateTimeNormalizer::FORMAT_KEY => 'YmdHis'])] private readonly DateTimeInterface $created,
        #[Context([DateTimeNormalizer::FORMAT_KEY => 'YmdHi'])] private readonly DateTimeInterface $expiration, // yyyyMMdd, yyyyMMddHHmm
        private readonly float $amount,
        private readonly int $currency,
        private readonly ?int $cardInvoiceNo,
    ) {
        InvoiceStatusEnum::checkAllowedValue($status);
        CurrencyEnum::checkAllowedValue($currency);
    }

    public function getInvoiceNo(): int
    {
        return $this->invoiceNo;
    }

    public function getAccountNo(): string
    {
        return $this->accountNo;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function getCreated(): DateTimeInterface
    {
        return $this->created;
    }

    public function getExpiration(): DateTimeInterface
    {
        return $this->expiration;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getCurrency(): int
    {
        return $this->currency;
    }

    public function getCardInvoiceNo(): ?int
    {
        return $this->cardInvoiceNo;
    }
}
