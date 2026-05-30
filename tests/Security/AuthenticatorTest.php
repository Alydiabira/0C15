<?php

namespace App\Tests\Security;

use App\Security\AppAuthenticator;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AuthenticatorTest extends WebTestCase
{
    public function testLoginPageLoads(): void
    {
        $client = static::createClient();
        $client->request('GET', '/login');

        $this->assertResponseIsSuccessful();
    }
}
