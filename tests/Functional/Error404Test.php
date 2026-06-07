<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class Error404Test extends WebTestCase
{
    public function testUnknownRouteReturns404(): void
    {
        $client = static::createClient();
        $client->request('GET', '/route-qui-nexiste-pas-123');

        $this->assertResponseStatusCodeSame(404);
    }
}
