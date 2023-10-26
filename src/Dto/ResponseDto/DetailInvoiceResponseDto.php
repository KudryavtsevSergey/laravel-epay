<?php

declare(strict_types=1);

namespace Sun\Epay\Dto\ResponseDto;

use DateTimeInterface;
use Sun\Epay\Enum\CurrencyEnum;
use Sun\Epay\Enum\InvoiceStatusEnum;
use Symfony\Component\Serializer\Annotation\Context;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;

class DetailInvoiceResponseDto implements ResponseDtoInterface
{
    public function __construct(
        private readonly string $accountNo,
        private readonly int $status,
        #[Context([DateTimeNormalizer::FORMAT_KEY => 'YmdHis'])] private readonly DateTimeInterface $created,
        #[Context([DateTimeNormalizer::FORMAT_KEY => 'YmdHi'])] private readonly DateTimeInterface $expiration, // yyyyMMdd, yyyyMMddHHmm
        private readonly float $amount,
        private readonly int $currency,
        private readonly string $info,
        private readonly ?string $surname,
        private readonly ?string $firstName,
        private readonly ?string $patronymic,
        private readonly ?string $city,
        private readonly ?string $street,
        private readonly ?string $house,
        private readonly ?string $building,
        private readonly ?string $apartment,
        private readonly ?bool $isNameEditable,
        private readonly ?bool $isAddressEditable,
        private readonly ?bool $isAmountEditable,
        private readonly ?string $invoiceUrl,
    ) {
        InvoiceStatusEnum::checkAllowedValue($status);
        CurrencyEnum::checkAllowedValue($currency);
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

    public function getInfo(): string
    {
        return $this->info;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function getPatronymic(): ?string
    {
        return $this->patronymic;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function getHouse(): ?string
    {
        return $this->house;
    }

    public function getBuilding(): ?string
    {
        return $this->building;
    }

    public function getApartment(): ?string
    {
        return $this->apartment;
    }

    public function getIsNameEditable(): ?bool
    {
        return $this->isNameEditable;
    }

    public function getIsAddressEditable(): ?bool
    {
        return $this->isAddressEditable;
    }

    public function getIsAmountEditable(): ?bool
    {
        return $this->isAmountEditable;
    }

    public function getInvoiceUrl(): ?string
    {
        return $this->invoiceUrl;
    }
}
