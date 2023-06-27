<?php

declare(strict_types=1);

namespace Sun\Epay\Dto\RequestDto;

use DateTimeInterface;
use Sun\Epay\Enum\CurrencyEnum;
use Sun\Epay\Enum\LanguageEnum;
use Symfony\Component\Serializer\Annotation\Context;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;

class AddCardInvoiceRequestDto implements RequestDtoInterface
{
    public function __construct(
        private string $accountNo,
        private float $amount,
        private string $info,
        private string $returnUrl,
        private string $failUrl,
        #[Context([DateTimeNormalizer::FORMAT_KEY => 'Ymd'])] private ?DateTimeInterface $expiration = null,
        private int $currency = CurrencyEnum::BYN,
        private string $language = LanguageEnum::RUSSIAN,
        private ?int $sessionTimeoutSecs = null,
        #[Context([DateTimeNormalizer::FORMAT_KEY => 'YmdHis'])] private ?DateTimeInterface $expirationDate = null,
        private ?bool $returnInvoiceUrl = null
    ) {
    }

    public function getAccountNo(): string
    {
        return $this->accountNo;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getInfo(): string
    {
        return $this->info;
    }

    public function getReturnUrl(): string
    {
        return $this->returnUrl;
    }

    public function getFailUrl(): string
    {
        return $this->failUrl;
    }

    public function getExpiration(): ?DateTimeInterface
    {
        return $this->expiration;
    }

    public function getCurrency(): int
    {
        return $this->currency;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function getSessionTimeoutSecs(): ?int
    {
        return $this->sessionTimeoutSecs;
    }

    public function getExpirationDate(): ?DateTimeInterface
    {
        return $this->expirationDate;
    }

    public function getReturnInvoiceUrl(): ?bool
    {
        return $this->returnInvoiceUrl;
    }

    public function getSigningFields(): array
    {
        return [
            $this->accountNo,
            $this->expiration?->format('Ymd'),
            number_format($this->amount, 2, ',', ''),
            $this->currency,
            $this->info,
            $this->returnUrl,
            $this->failUrl,
            $this->language,
            $this->sessionTimeoutSecs,
            $this->expirationDate?->format('YmdHis'),
            $this->returnInvoiceUrl !== null ? intval($this->returnInvoiceUrl) : null,
        ];
    }
}
