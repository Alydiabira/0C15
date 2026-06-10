<?php

namespace App\Tests\Unit\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserEntityTest extends TestCase
{
    public function testUserEntity(): void
    {
        $user = new User();

        $user->setEmail('test@test.com');
        $user->setName('Test User');
        $user->setPassword('hashed');
        $user->setType('invite');
        $user->setIsBlocked(true);

        $this->assertSame('test@test.com', $user->getEmail());
        $this->assertSame('Test User', $user->getName());
        $this->assertSame('hashed', $user->getPassword());
        $this->assertSame('invite', $user->getType());
        $this->assertTrue($user->isBlocked());
    }
}
