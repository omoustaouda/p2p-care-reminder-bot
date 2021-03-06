<?php

namespace Tests\Integration\Service;

use P2pCareReminder\Service\TelegramBotService;
use PHPUnit\Framework\TestCase;

class TelegramBotServiceTest extends TestCase
{
    private TelegramBotService $service;

    protected function setUp(): void
    {
        $this->service = get(TelegramBotService::class);
    }

    public function testUnsetWebhook(): void
    {
        self::assertTrue(
            $this->service->unsetWebhook()
        );
    }

    public function testReconnectWebhook(): void
    {
        self::assertTrue(
            $this->service->connectWebhook()
        );
    }

    public function testSendMessage(): void
    {
        $messageText = 'Hi there! - PHPUnit test - ' . __FUNCTION__ . ' - ' . gethostname();

        $chatId = config('telegram')['testChatId'];
        $this->service->setChatId($chatId);
        self::assertTrue(
            $this->service->sendMessage($messageText)
        );
    }
}
