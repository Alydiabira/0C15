<?php

namespace App\Tests\Unit\Repository;

use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use PHPUnit\Framework\TestCase;

class UserRepositoryTest extends TestCase
{
    public function testRepositoryIsInstantiable(): void
    {
        $registry = $this->createMock(ManagerRegistry::class);

        $repo = new UserRepository($registry);

        $this->assertInstanceOf(UserRepository::class, $repo);
    }
}
