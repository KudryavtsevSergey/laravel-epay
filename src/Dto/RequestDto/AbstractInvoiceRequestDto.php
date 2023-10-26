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
        private readonly float $amount,
        private readonly int $currency = CurrencyEnum::BYN,
        #[Context([DateTimeNormalizer::FORMAT_KEY => 'YmdHi'])] private readonly ?DateTimeInterface $expiration = null, // yyyyMMdd, yyyyMMddHHmm
        private readonly ?string $info = null,
        private readonly ?string $surname = null,
        private readonly ?string $firstName = null,
        private readonly ?string $patronymic = null,
        private readonly ?string $city = null,
        private readonly ?string $street = null,
        private readonly ?string $house = null,
        private readonly ?string $building = null,
        private readonly ?string $apartment = null,
        private readonly ?bool $isNameEditable = null,
        private readonly ?bool $isAddressEditable = null,
        private readonly ?bool $isAmountEditable = null,
        private readonly ?string $emailNotification = null,
        private readonly ?string $smsPhone = null,
        private readonly ?bool $returnInvoiceUrl = null,
        private readonly ?int $lifeTime = null,
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
