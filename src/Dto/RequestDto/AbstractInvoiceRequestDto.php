<?php

declare(strict_types=1);

namespace Sun\Epay\Dto\RequestDto;

use DateTimeInterface;
use Sun\Epay\Enum\CurrencyEnum;
use Symfony\Component\Serializer\Annotation\Context;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;

abstract class AbstractInvoiceRequestDto implements RequestDtoInterface
{
    public function __construct(
        private float $amount,
        private int $currency = CurrencyEnum::BYN,
        #[Context([DateTimeNormalizer::FORMAT_KEY => 'YmdHi'])] private ?DateTimeInterface $expiration = null, // yyyyMMdd, yyyyMMddHHmm
        private ?string $info = null,
        private ?string $surname = null,
        private ?string $firstName = null,
        private ?string $patronymic = null,
        private ?string $city = null,
        private ?string $street = null,
        private ?string $house = null,
        private ?string $building = null,
        private ?string $apartment = null,
        private ?bool $isNameEditable = null,
        private ?bool $isAddressEditable = null,
        private ?bool $isAmountEditable = null,
        private ?string $emailNotification = null,
        private ?string $smsPhone = null,
        private ?bool $returnInvoiceUrl = null,
        private ?int $lifeTime = null,
    ){
        CurrencyEnum::checkAllowedValue($currency);
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getCurrency(): int
    {
        return $this->currency;
    }

    public function getExpiration(): ?DateTimeInterface
    {
        return $this->expiration;
    }

    public function getInfo(): ?string
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

    public function getEmailNotification(): ?string
    {
        return $this->emailNotification;
    }

    public function getSmsPhone(): ?string
    {
        return $this->smsPhone;
    }

    public function getReturnInvoiceUrl(): ?bool
    {
        return $this->returnInvoiceUrl;
    }

    public function getLifeTime(): ?int
    {
        return $this->lifeTime;
    }

    public function getSigningFields(): array
    {
        return [
            number_format($this->amount, 2, ',', ''),
            $this->currency,
            $this->expiration?->format('YmdHi'), // yyyyMMdd, yyyyMMddHHmm
            $this->info,
            $this->surname,
            $this->firstName,
            $this->patronymic,
            $this->city,
            $this->street,
            $this->house,
            $this->building,
            $this->apartment,
            $this->isNameEditable !== null ? intval($this->isNameEditable) : null,
            $this->isAddressEditable !== null ? intval($this->isAddressEditable) : null,
            $this->isAmountEditable !== null ? intval($this->isAmountEditable) : null,
            $this->emailNotification,
            $this->smsPhone,
            $this->returnInvoiceUrl !== null ? intval($this->returnInvoiceUrl) : null,
            $this->lifeTime,
        ];
    }
}
