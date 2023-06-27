<?php

declare(strict_types=1);

namespace Sun\Epay\Events;

use Sun\Epay\Dto\ResponseDto\NotificationDto;

class EpayNotificationReceivedEvent
{
    public function __construct(
        private NotificationDto $notificationDto,
    ) {
    }

    public function getNotificationDto(): NotificationDto
    {
        return $this->notificationDto;
    }
}
