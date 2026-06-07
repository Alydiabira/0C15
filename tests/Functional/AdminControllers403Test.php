<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminControllers403Test extends WebTestCase
{
    public function testGuestIsRedirectedFromAdminAlbum(): void
    {
        $client = static::createClient();
        $client->request('GET', '/admin/album');
        $this->assertResponseRedirects('/login');
    }

    public function testGuestIsRedirectedFromAdminMedia(): void
    {
        $client = static::createClient();
        $client->request('GET', '/admin/media');
        $this->assertResponseRedirects('/login');
    }

    public function testGuestIsRedirectedFromAdminInvite(): void
    {
        $client = static::createClient();

        // La bonne route est /admin/invites
        $client->request('GET', '/admin/invites');

        $this->assertResponseRedirects('/login');
    }
}
