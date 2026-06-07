<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\User;
use App\Tests\Functional\Traits\ForbiddenTrait;

class Error403Test extends WebTestCase
{
    use ForbiddenTrait;

    public function testGuestIsRedirectedToLogin(): void
    {
        $client = static::createClient();
        $this->client = $client;

        $client->request('GET', '/admin/album');

        $this->assertForbiddenOrRedirectToLogin();
    }

    public function testUserWithoutRoleGets403(): void
    {
        $client = static::createClient();
        $this->client = $client;

        $user = static::getContainer()
            ->get('doctrine')
            ->getRepository(User::class)
            ->findOneByEmail('guest@test.com');

        $client->loginUser($user);

        $client->request('GET', '/admin/album');

        $this->assertForbiddenOrRedirectToLogin();
    }
}
