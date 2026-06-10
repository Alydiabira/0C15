<?php

namespace App\Tests\Functional\Security;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FirewallBehaviorTest extends WebTestCase
{
    public function testGuestIsRedirectedOnProtectedPost(): void
    {
        $client = static::createClient();
        $client->request('POST', '/admin/album/add');

        $this->assertResponseRedirects('/admin/login');
    }

    public function testGuestIsRedirectedOnProtectedGet(): void
    {
        $client = static::createClient();
        $client->request('GET', '/admin/media');

        $this->assertResponseRedirects('/admin/login');
    }
}
