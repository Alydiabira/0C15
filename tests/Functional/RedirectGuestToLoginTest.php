<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RedirectGuestToLoginTest extends WebTestCase
{
    public function testGuestIsRedirectedToLoginOnAdmin(): void
    {
        $client = static::createClient();
        $client->request('GET', '/admin/album');

        $this->assertResponseRedirects('/login');
    }
}
