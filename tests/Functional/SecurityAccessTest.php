<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityAccessTest extends WebTestCase
{
    public function testGuestIsRedirectedToLogin(): void
    {
        $client = static::createClient();

        $client->request('GET', '/admin/album');

        // Un invité doit être redirigé vers /login
        $this->assertResponseRedirects('/login');
    }
}
