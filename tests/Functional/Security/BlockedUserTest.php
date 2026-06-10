<?php

namespace App\Tests\Functional\Security;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\UserRepository;

class BlockedUserTest extends WebTestCase
{
    public function testBlockedUserCannotAccessProtectedRoutes(): void
    {
        $client = static::createClient();
        $blocked = static::getContainer()->get(UserRepository::class)->findOneByEmail('blocked@test.com');

        $client->loginUser($blocked);

        $client->request('GET', '/admin/media');

        $this->assertResponseStatusCodeSame(403);
    }
}
