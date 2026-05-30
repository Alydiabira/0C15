<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GuestControllerTest extends WebTestCase
{
    use AuthenticatedTestTrait;

    public function testGuestsPageLoads(): void
    {
        $client = static::createClient();

        // Authentification dans le firewall main
        $this->loginAsUser($client);

        $client->request('GET', '/guests');

        $this->assertResponseIsSuccessful();
    }
}
