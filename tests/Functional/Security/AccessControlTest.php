<?php

namespace App\Tests\Functional\Security;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Repository\UserRepository;

class AccessControlTest extends WebTestCase
{
    private function loginUserByEmail($client, string $email)
    {
        $user = static::getContainer()->get(UserRepository::class)->findOneByEmail($email);
        $client->loginUser($user);
    }

    public function testGuestIsRedirectedFromAdmin(): void
    {
        $client = static::createClient();
        $client->request('GET', '/admin/album');

        $this->assertResponseRedirects('/admin/login');
    }

    public function testUserCannotAccessAdmin(): void
    {
        $client = static::createClient();
        $this->loginUserByEmail($client, 'user@test.com');

        $client->request('GET', '/admin/album');

        $this->assertResponseStatusCodeSame(403);
    }

    public function testAdminCanAccessAdmin(): void
    {
        $client = static::createClient();
        $this->loginUserByEmail($client, 'ina@test.com');

        $client->request('GET', '/admin/album');

        $this->assertResponseIsSuccessful();
    }
}
