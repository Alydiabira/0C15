<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RedirectGuestToLoginTest extends WebTestCase
{
    public function testGuestIsRedirectedToLoginOnAdmin(): void
    {
        $client = static::createClient();

        // On utilise une vraie route admin
        $client->request('GET', '/admin/album');

        // Redirection correcte dans ton projet
        $this->assertResponseRedirects('/admin/login');
    }
}
