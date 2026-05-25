<?php

namespace App\Tests\Fixtures;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AppFixtures extends WebTestCase
{
    public function testDummy(): void
    {
        self::assertSame(1, 1);
    }
}
