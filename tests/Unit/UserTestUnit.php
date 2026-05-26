<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserTestUnit extends WebTestCase
{
    public function testDummy(): void
    {
        self::assertSame(1, 1);
    }
}
