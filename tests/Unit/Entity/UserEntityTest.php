<?php

namespace App\Tests\Unit\Entity;

use App\Entity\User;
use App\Entity\Media;
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
        $this->assertSame('Test User', (string) $user);
        $this->assertSame('hashed', $user->getPassword());
        $this->assertSame('invite', $user->getType());
        $this->assertTrue($user->isBlocked());

        // Relations
        $this->assertCount(0, $user->getMedias());

        $media = new Media();
        $user->addMedia($media);

        $this->assertCount(1, $user->getMedias());
        $this->assertSame($user, $media->getUser());

        $user->removeMedia($media);

        $this->assertCount(0, $user->getMedias());
        $this->assertNull($media->getUser());
    }
}
