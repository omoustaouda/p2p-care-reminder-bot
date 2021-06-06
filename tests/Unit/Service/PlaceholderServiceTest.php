<?php

namespace Tests\Unit\Service;

use P2pCareReminder\Service\AppConfigService;
use P2pCareReminder\Service\PlaceholderService;
use PHPUnit\Framework\TestCase;

class PlaceholderServiceTest extends TestCase
{
    private PlaceholderService $placeholderService;

    protected function setUp(): void
    {
        $this->placeholderService = new PlaceholderService();
    }

    public function testPlaceholderGreetings(): void
    {
        $greetingsReturned = $this->placeholderService->sayHi();
        $expected = 'Hallou from the Placeholder service';
        self::assertSame($expected, $greetingsReturned);
    }

}
