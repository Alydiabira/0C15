<?php

namespace App\Tests\Unit\Repository;

use App\Repository\AlbumRepository;
use Doctrine\Persistence\ManagerRegistry;
use PHPUnit\Framework\TestCase;

class AlbumRepositoryTest extends TestCase
{
    public function testRepositoryIsInstantiable(): void
    {
        $registry = $this->createMock(ManagerRegistry::class);

        $repo = new AlbumRepository($registry);

        $this->assertInstanceOf(AlbumRepository::class, $repo);
    }
}
