<?php

declare(strict_types=1);

namespace Sun\Epay\Dto\RequestDto;

use DateTimeInterface;
use Sun\Epay\Enum\CurrencyEnum;

class AddInvoiceRequestDto extends AbstractInvoiceRequestDto
{
    public function __construct(
        private string $accountNo,
        float $amount,
        int $currency = CurrencyEnum::BYN,
        ?DateTimeInterface $expiration = null,
        ?string $info = null,
        ?string $surname = null,
        ?string $firstname = null,
        ?string $patronymic = null,
        ?string $city = null,
        ?string $street = null,
        ?string $house = null,
        ?string $building = null,
        ?string $apartment = null,
        ?bool $isNameEditable = null,
        ?bool $isAddressEditable = null,
        ?bool $isAmountEditable = null,
        ?string $emailNotification = null,
        ?string $smsPhone = null,
        ?bool $returnInvoiceUrl = null,
        ?int $lifeTime = null,
    ){
        parent::__construct(
            $amount,
            $currency,
            $expiration,
            $info,
            $surname,
            $firstname,
            $patronymic,
            $city,
            $street,
            $house,
            $building,
            $apartment,
            $isNameEditable,
            $isAddressEditable,
            $isAmountEditable,
            $emailNotification,
            $smsPhone,
            $returnInvoiceUrl,
            $lifeTime
        );
    }

    public function getAccountNo(): string
    {
        return $this->accountNo;
    }

    public function getSigningFields(): array
    {
        return array_merge([
            $this->accountNo,
        ], parent::getSigningFields());
    }
}
