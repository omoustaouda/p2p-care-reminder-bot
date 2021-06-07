<?php

namespace Tests\Integration;

use P2pCareReminder\Service\AppConfigService;
use Monolog\Logger;
use PHPUnit\Framework\TestCase;

class ContainerTest extends TestCase
{
    public function testGetServiceFromContainer(): void
    {
        $service = getContainer()->get(AppConfigService::class);
        self::assertInstanceOf(AppConfigService::class, $service);
    }

    public function testGetLoggerFromContainer(): void
    {
        $logger = getLogger();
        self::assertInstanceOf(Logger::class, $logger);
    }
}
