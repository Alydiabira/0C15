<?php

namespace App\Tests\Functional\Error;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class Error404GlobalTest extends WebTestCase
{
    public function testUnknownRouteReturns404(): void
    {
        $client = static::createClient();
        $client->request('GET', '/route-qui-nexiste-pas-du-tout');

        $this->assertResponseStatusCodeSame(404);
    }

    public function testGuestShowRedirectsToLogin(): void
    {
        $client = static::createClient();
        $client->request('GET', '/guest/999999');

        // Un invité est toujours redirigé vers /admin/login
        $this->assertResponseRedirects('/admin/login');
    }

    public function testPortfolioAlwaysReturns200(): void
    {
        $client = static::createClient();
        $client->request('GET', '/portfolio/999999');

        // Le portfolio renvoie toujours 200, même si l’ID n’existe pas
        $this->assertResponseIsSuccessful();
    }

    public function testPublicMediaNotFound(): void
    {
        $client = static::createClient();
        $client->request('GET', '/media/999999');

        $this->assertResponseStatusCodeSame(404);
    }

    public function testAdminUnknownRouteReturns404(): void
    {
        $client = static::createClient();
        $client->request('GET', '/admin/route-inexistante-123');

        $this->assertResponseStatusCodeSame(404);
    }
}
