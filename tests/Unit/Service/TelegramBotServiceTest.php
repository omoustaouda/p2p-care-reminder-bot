<?php

namespace Tests\Unit\Service;

use InvalidArgumentException;
use Longman\TelegramBot\Telegram;
use P2pCareReminder\Service\AppConfigService;
use P2pCareReminder\Service\TelegramBotService;
use PHPUnit\Framework\TestCase;

class TelegramBotServiceTest extends TestCase
{
    private TelegramBotService $service;

    protected function setUp(): void
    {
        $this->service = get(TelegramBotService::class);
    }

    public function testSendMessage(): void
    {
        $this->service->sendMessage();
    }

}
