<?php

namespace App\Tests\Functional\Security;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\UserRepository;

class AccessDeniedHandlerTest extends WebTestCase
{
    public function testUserGets403OnAdmin(): void
    {
        $client = static::createClient();
        $user = static::getContainer()->get(UserRepository::class)->findOneByEmail('user@test.com');
        $client->loginUser($user);

        $client->request('GET', '/admin/media');

        $this->assertResponseStatusCodeSame(403);
    }
}
