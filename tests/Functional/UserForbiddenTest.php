<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\User;

class UserForbiddenTest extends WebTestCase
{
    public function testUserCannotAccessAdmin(): void
    {
        $client = static::createClient();

        $user = static::getContainer()
            ->get('doctrine')
            ->getRepository(User::class)
            ->findOneByEmail('guest@test.com');

        $client->loginUser($user);

        // Route admin valide
        $client->request('GET', '/admin/album');

        $this->assertResponseStatusCodeSame(403);
    }
}
