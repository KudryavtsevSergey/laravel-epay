<?php

declare(strict_types=1);

namespace Sun\Epay\Service;

use Sun\Epay\Dto\RequestDto\AddCardInvoiceRequestDto;
use Sun\Epay\Dto\RequestDto\AddInvoiceRequestDto;
use Sun\Epay\Dto\RequestDto\CardInvoiceIdRequestDto;
use Sun\Epay\Dto\RequestDto\QrCodeForAccountNumberRequestDto;
use Sun\Epay\Dto\RequestDto\QrCodeRequestDto;
use Sun\Epay\Dto\RequestDto\InvoiceIdRequestDto;
use Sun\Epay\Dto\RequestDto\GetListInvoicesRequestDto;
use Sun\Epay\Dto\RequestDto\UpdateInvoiceRequestDto;
use Sun\Epay\Dto\ResponseDto\AddInvoiceResponseDto;
use Sun\Epay\Dto\ResponseDto\CardErrorResponseDto;
use Sun\Epay\Dto\ResponseDto\CardInvoiceResponseDto;
use Sun\Epay\Dto\ResponseDto\CardInvoiceStatusResponseDto;
use Sun\Epay\Dto\ResponseDto\DetailInvoiceResponseDto;
use Sun\Epay\Dto\ResponseDto\PaymentFormResponseDto;
use Sun\Epay\Dto\ResponseDto\QrCodeResponseDto;
use Sun\Epay\Dto\ResponseDto\InvoiceResponseDto;
use Sun\Epay\Dto\ResponseDto\InvoiceStatusResponseDto;
use Sun\Epay\Constant\ApiConstant;
use Sun\Epay\Enum\HttpMethodEnum;
use Sun\Epay\Enum\LanguageEnum;

class EpayApiService
{
    public function __construct(
        private EpayHttpClientService $httpClient,
    ) {
    }

    /**
     * @param GetListInvoicesRequestDto $requestDto
     * @return InvoiceResponseDto[]
     */
    public function getListInvoices(GetListInvoicesRequestDto $requestDto): array
    {
        /** @var InvoiceResponseDto[] $invoices */
        $invoices = $this->httpClient->request(
            HttpMethodEnum::GET,
            ApiConstant::INVOICES,
            InvoiceResponseDto::class . '[]',
            $requestDto
        );
        return $invoices;
    }

    public function addInvoice(AddInvoiceRequestDto $requestDto): AddInvoiceResponseDto
    {
        /** @var AddInvoiceResponseDto $addInvoiceResponse */
        $addInvoiceResponse = $this->httpClient->request(
            HttpMethodEnum::POST,
            ApiConstant::INVOICES,
            AddInvoiceResponseDto::class,
            $requestDto
        );
        return $addInvoiceResponse;
    }

    // TODO: change response dto
    public function updateInvoice(UpdateInvoiceRequestDto $requestDto): AddInvoiceResponseDto
    {
        /** @var AddInvoiceResponseDto $addInvoiceResponse */
        $addInvoiceResponse = $this->httpClient->request(
            HttpMethodEnum::PUT,
            ApiConstant::INVOICES,
            AddInvoiceResponseDto::class,
            $requestDto
        );
        return $addInvoiceResponse;
    }

    public function getDetailsInvoice(int $invoiceId): DetailInvoiceResponseDto
    {
        /** @var DetailInvoiceResponseDto $detailInvoice */
        $detailInvoice = $this->httpClient->request(
            HttpMethodEnum::GET,
            sprintf(ApiConstant::INVOICE_STATUS, $invoiceId),
            DetailInvoiceResponseDto::class,
            new InvoiceIdRequestDto($invoiceId)
        );
        return $detailInvoice;
    }

    public function getStatusInvoice(int $invoiceId): InvoiceStatusResponseDto
    {
        /** @var InvoiceStatusResponseDto $statusInvoice */
        $statusInvoice = $this->httpClient->request(
            HttpMethodEnum::GET,
            sprintf(ApiConstant::INVOICE_STATUS, $invoiceId),
            InvoiceStatusResponseDto::class,
            new InvoiceIdRequestDto($invoiceId)
        );
        return $statusInvoice;
    }

    // TODO: check response type
    public function cancelInvoice(int $invoiceId): DetailInvoiceResponseDto
    {
        /** @var DetailInvoiceResponseDto $detailInvoice */
        $detailInvoice = $this->httpClient->request(
            HttpMethodEnum::DELETE,
            sprintf(ApiConstant::INVOICE, $invoiceId),
            DetailInvoiceResponseDto::class,
            new InvoiceIdRequestDto($invoiceId)
        );
        return $detailInvoice;
    }

    public function generateQrCode(QrCodeRequestDto $requestDto): QrCodeResponseDto
    {
        /** @var QrCodeResponseDto $qrCode */
        $qrCode = $this->httpClient->request(
            HttpMethodEnum::GET,
            ApiConstant::GENERATE_QR_CODE,
            QrCodeResponseDto::class,
            $requestDto
        );
        return $qrCode;
    }

    public function generateQrCodeByAccountNumber(QrCodeForAccountNumberRequestDto $requestDto): QrCodeResponseDto
    {
        /** @var QrCodeResponseDto $qrCode */
        $qrCode = $this->httpClient->request(
            HttpMethodEnum::GET,
            ApiConstant::GENERATE_QR_CODE_BY_ACCOUNT_NUMBER,
            QrCodeResponseDto::class,
            $requestDto
        );
        return $qrCode;
    }

    public function addCardInvoice(AddCardInvoiceRequestDto $requestDto): CardInvoiceResponseDto
    {
        /** @var CardInvoiceResponseDto $cardInvoice */
        $cardInvoice = $this->httpClient->request(
            HttpMethodEnum::POST,
            ApiConstant::CARD_INVOICES,
            CardInvoiceResponseDto::class,
            $requestDto
        );
        return $cardInvoice;
    }

    public function getPaymentForm(int $cardInvoiceId): PaymentFormResponseDto
    {
        /** @var PaymentFormResponseDto $paymentForm */
        $paymentForm = $this->httpClient->request(
            HttpMethodEnum::GET,
            sprintf(ApiConstant::CARD_INVOICE_PAYMENT, $cardInvoiceId),
            PaymentFormResponseDto::class,
            new CardInvoiceIdRequestDto($cardInvoiceId)
        );
        return $paymentForm;
    }

    public function getStatusCardInvoice(
        int $cardInvoiceId,
        string $language = LanguageEnum::RUSSIAN
    ): CardInvoiceStatusResponseDto {
        /** @var CardInvoiceStatusResponseDto $statusCardInvoice */
        $statusCardInvoice = $this->httpClient->request(
            HttpMethodEnum::GET,
            sprintf(ApiConstant::CARD_INVOICE_STATUS, $cardInvoiceId),
            CardInvoiceStatusResponseDto::class,
            new CardInvoiceIdRequestDto($cardInvoiceId, $language)
        );
        return $statusCardInvoice;
    }

    public function reverseCardInvoice(int $cardInvoiceId): CardErrorResponseDto
    {
        /** @var CardErrorResponseDto $cardError */
        $cardError = $this->httpClient->request(
            HttpMethodEnum::POST,
            sprintf(ApiConstant::CARD_INVOICE_REVERSE, $cardInvoiceId),
            CardErrorResponseDto::class,
            new CardInvoiceIdRequestDto($cardInvoiceId)
        );
        return $cardError;
    }
}
