<?php

namespace App\Tests\Functional\Security;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\UserRepository;

class AuthenticatedNotAuthorizedTest extends WebTestCase
{
    public function testUserCannotAccessAnotherUsersMedia(): void
    {
        $client = static::createClient();
        $user = static::getContainer()->get(UserRepository::class)->findOneByEmail('user@test.com');
        $client->loginUser($user);

        $client->request('GET', '/admin/media/edit/999');

        $this->assertResponseStatusCodeSame(403);
    }
}
