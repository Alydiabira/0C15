<?php

namespace App\Tests\Functional\Security;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\UserRepository;

class LoginRedirectTest extends WebTestCase
{
    public function testLoginPageIsAccessibleWhenAuthenticated(): void
    {
        $client = static::createClient();
        $user = static::getContainer()->get(UserRepository::class)->findOneByEmail('user@test.com');
        $client->loginUser($user);

        $client->request('GET', '/login');

        $this->assertResponseIsSuccessful();
    }
}
