<?php

declare(strict_types=1);

namespace Sun\Epay\Dto\ResponseDto;

use DateTimeInterface;
use Sun\Epay\Enum\CmdTypeEnum;
use Sun\Epay\Enum\InvoiceStatusEnum;
use Symfony\Component\Serializer\Annotation\Context;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;

class NotificationDto implements ResponseDtoInterface
{
    public function __construct(
        private readonly int $cmdType,
        private readonly ?int $status,
        private readonly string $accountNo,
        private readonly string $invoiceNo,
        private readonly int $paymentNo,
        private readonly float $amount,
        #[Context([DateTimeNormalizer::FORMAT_KEY => 'YmdHis'])] private readonly ?DateTimeInterface $created,
        private readonly string $service,
        private readonly string $payer,
        private readonly string $address,
        private readonly ?int $cardInvoiceNo,
    ) {
        CmdTypeEnum::checkAllowedValue($cmdType);
        InvoiceStatusEnum::checkAllowedValue($status, $cmdType !== CmdTypeEnum::CHANGE_STATUS);
    }

    public function getCmdType(): int
    {
        return $this->cmdType;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function getAccountNo(): string
    {
        return $this->accountNo;
    }

    public function getInvoiceNo(): string
    {
        return $this->invoiceNo;
    }

    public function getPaymentNo(): int
    {
        return $this->paymentNo;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getCreated(): ?DateTimeInterface
    {
        return $this->created;
    }

    public function getService(): string
    {
        return $this->service;
    }

    public function getPayer(): string
    {
        return $this->payer;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getCardInvoiceNo(): ?int
    {
        return $this->cardInvoiceNo;
    }
}
