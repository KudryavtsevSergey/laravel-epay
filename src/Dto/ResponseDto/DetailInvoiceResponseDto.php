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
        private string $accountNo,
        private int $status,
        #[Context([DateTimeNormalizer::FORMAT_KEY => 'YmdHis'])] private DateTimeInterface $created,
        #[Context([DateTimeNormalizer::FORMAT_KEY => 'YmdHi'])] private DateTimeInterface $expiration, // yyyyMMdd, yyyyMMddHHmm
        private float $amount,
        private int $currency,
        private string $info,
        private ?string $surname,
        private ?string $firstName,
        private ?string $patronymic,
        private ?string $city,
        private ?string $street,
        private ?string $house,
        private ?string $building,
        private ?string $apartment,
        private ?bool $isNameEditable,
        private ?bool $isAddressEditable,
        private ?bool $isAmountEditable,
        private ?string $invoiceUrl,
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
