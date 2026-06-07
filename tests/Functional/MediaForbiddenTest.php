<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\User;

class MediaForbiddenTest extends WebTestCase
{
    public function testGuestIsRedirectedWhenAccessingMedia(): void
    {
        $client = static::createClient();
        $client->request('GET', '/admin/media');
        $this->assertResponseRedirects('/login');
    }

    public function testUserCannotAccessMediaAdmin(): void
    {
        $client = static::createClient();

        $user = static::getContainer()
            ->get('doctrine')
            ->getRepository(User::class)
            ->findOneByEmail('guest@test.com');

        $client->loginUser($user);

        // Route admin réelle
        $client->request('GET', '/admin/media');

        $this->assertResponseStatusCodeSame(403);
    }
}
