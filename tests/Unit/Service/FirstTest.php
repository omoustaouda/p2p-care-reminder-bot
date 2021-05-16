<?php

namespace CaringCircles\P2pCare\Tests\Unit\Service;

use CaringCircles\P2pCare\Service\FirstService;
use PHPUnit\Framework\TestCase;

class FirstTest extends TestCase
{
    private FirstService $firstService;

    protected function setUp(): void
    {
        $this->firstService = new FirstService();
    }

    public function testPlaceholder(): void
    {
        $greetingsReturned = $this->firstService->sayHi();
        $expected = 'Hallou from the Placeholder service';
        self::assertSame($expected, $greetingsReturned);
    }

}
