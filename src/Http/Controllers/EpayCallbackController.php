<?php

declare(strict_types=1);

namespace Sun\Epay\Http\Controllers;

use Illuminate\Contracts\Events\Dispatcher;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Sun\Epay\Dto\ResponseDto\NotificationDto;
use Sun\Epay\EpayConfig;
use Sun\Epay\Events\EpayNotificationReceivedEvent;
use Sun\Epay\Exceptions\Request\AbstractResponsableException;
use Sun\Epay\Exceptions\Request\InternalEpayError;
use Sun\Epay\Exceptions\Request\WrongEpaySignatureException;
use Sun\Epay\Mapper\ArrayObjectMapper;
use Sun\Epay\Responses\EpayResponse;
use Sun\Epay\Service\Signature\SignatureServiceInterface;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class EpayCallbackController extends Controller
{
    public function __construct(
        private ArrayObjectMapper $arrayObjectMapper,
        private SignatureServiceInterface $signatureService,
        private EpayConfig $config,
        private Dispatcher $dispatcher,
    ) {
    }

    public function __invoke(Request $request): Response
    {
        try {
            $data = (string)$request->string('Data');
            $this->verifyNotification($data, $request->input('Signature'));

            /** @var NotificationDto $notification */
            $notification = $this->arrayObjectMapper->deserialize(
                json_decode($data, true, flags: JSON_THROW_ON_ERROR),
                NotificationDto::class
            );

            $this->dispatcher->dispatch(new EpayNotificationReceivedEvent($notification));

            return (new EpayResponse())->toResponse($request);
        } catch (AbstractResponsableException $exception) {
            throw $exception;
        } catch (Throwable $exception) {
            throw new InternalEpayError($exception);
        }
    }

    private function verifyNotification(string $data, ?string $signature): void
    {
        if (
            $this->config->isCheckSignature()
            && ($signature === null || !$this->signatureService->verify($data, $signature))
        ) {
            throw new WrongEpaySignatureException($signature);
        }
    }
}
