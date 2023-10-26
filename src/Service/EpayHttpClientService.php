<?php

declare(strict_types=1);

namespace Sun\Epay\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Sun\Epay\Dto\RequestDto\RequestDtoInterface;
use Sun\Epay\Dto\ResponseDto\ResponseDtoInterface;
use Sun\Epay\EpayConfig;
use Sun\Epay\Exceptions\InternalError;
use Sun\Epay\Mapper\ArrayObjectMapper;
use Sun\Epay\Service\Signature\SignatureServiceInterface;

class EpayHttpClientService
{
    private Client $client;

    public function __construct(
        private readonly ArrayObjectMapper $arrayObjectMapper,
        private readonly SignatureServiceInterface $signatureService,
        private readonly EpayConfig $config
    ) {
        $this->client = new Client([
            'base_uri' => $config->getGateway(),
        ]);
    }

    /**
     * @param string $method
     * @param string $path
     * @param string $responseType
     * @param RequestDtoInterface|null $requestDto
     * @return ResponseDtoInterface|ResponseDtoInterface[]
     */
    public function request(
        string $method,
        string $path,
        string $responseType,
        RequestDtoInterface $requestDto = null
    ): ResponseDtoInterface|array {
        try {
            $formParams = [
                'Token' => $this->config->getToken(),
            ];
            if ($requestDto !== null) {
                if ($this->config->isCheckSignature()) {
                    $formParams['Signature'] = $this->signatureService->generate($requestDto);
                }
                $formParams = array_merge(
                    $this->arrayObjectMapper->serialize($requestDto),
                    $formParams
                );
            }

            $response = $this->client->request($method, $path, [
                RequestOptions::FORM_PARAMS => $formParams,
            ]);

            $data = json_decode((string)$response->getBody(), true, flags: JSON_THROW_ON_ERROR);
            return $this->arrayObjectMapper->deserialize($data, $responseType);
        } catch (GuzzleException $e) {
            throw new InternalError('Error sending request', $e);
        }
    }
}
