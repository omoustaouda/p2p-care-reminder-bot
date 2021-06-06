<?php

namespace Tests\Unit\Service;

use InvalidArgumentException;
use P2pCareReminder\Service\AppConfigService;
use PHPUnit\Framework\TestCase;

class AppConfigServiceTest extends TestCase
{
    private AppConfigService $service;

    protected function setUp(): void
    {
        $this->service = new AppConfigService(__DIR__ . '/data/config/');
    }

    public function testGetConfig(): void
    {
        $expected = [
            'app' => null,
            'logger' => [
                'name' => 'my test logger name',
                'logFilePath' => APP_ROOT . '/logs/',
                'maxFilesKeepRotation' => 30,
            ],
            'telegram' => [
                'botUsername' => env('TELEGRAM_BOT_USERNAME'),
                'botApiKey' =>env('TELEGRAM_BOT_API_KEY'),
                'hookUrl' => env('TELEGRAM_HOOK_URL')
            ],

        ];

        self::assertEquals(
            $expected,
            $this->service->getConfig(),
            'full config'
        );

        self::assertEquals(
            $expected['logger'],
            $this->service->getConfig('logger'),
            'get specific config by name'
        );

        $this->expectException(InvalidArgumentException::class);
        $this->expectErrorMessage('config not found');
        $this->service->getConfig('nonexistentConfig');
    }

}
