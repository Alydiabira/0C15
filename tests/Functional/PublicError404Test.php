<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PublicError404Test extends WebTestCase
{
    public function testPublicUnknownRouteReturns404(): void
    {
        $client = static::createClient();
        $client->request('GET', '/public-page-inexistante');

        $this->assertResponseStatusCodeSame(404);
    }
}
