<?php

namespace App\Tests\Entity;

use App\Entity\Invite;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class InviteTest extends TestCase
{
    public function testInviteEntity(): void
    {
        $invite = new Invite();

        $invite->setName('John Doe');
        $invite->setEmail('john@example.com');
        $invite->setIsBlocked(true);

        $date = new \DateTimeImmutable();
        $invite->setCreatedAt($date);

        $user = new User();
        $invite->setUser($user);

        $this->assertSame('John Doe', $invite->getName());
        $this->assertSame('john@example.com', $invite->getEmail());
        $this->assertTrue($invite->isBlocked());
        $this->assertSame($date, $invite->getCreatedAt());
        $this->assertSame($user, $invite->getUser());
    }
}
