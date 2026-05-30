<?php

namespace App\Tests\Entity;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testUserEntity(): void
    {
        $user = new User();

        $user->setEmail('ina@example.com');
        $user->setPassword('hashed_password');
        $user->setRoles(['ROLE_ADMIN']);

        $this->assertSame('ina@example.com', $user->getEmail());
        $this->assertSame('hashed_password', $user->getPassword());
        $this->assertContains('ROLE_ADMIN', $user->getRoles());
    }
}
