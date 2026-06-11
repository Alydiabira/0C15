<?php

namespace App\Tests\Unit\Service;

use App\DataFixtures\AppFixtures;
use App\Service\FixtureLoader;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

class FixtureLoaderTest extends TestCase
{
    public function testLoadCallsFixtures(): void
    {
        $em = $this->createMock(EntityManagerInterface::class);
        $fixtures = $this->createMock(AppFixtures::class);

        $fixtures->expects($this->once())
            ->method('load')
            ->with($em);

        $loader = new FixtureLoader($em, $fixtures);
        $loader->load();

        $this->assertTrue(true);
    }
}
