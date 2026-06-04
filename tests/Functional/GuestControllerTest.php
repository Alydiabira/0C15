<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Tests\Functional\AuthenticatedTestTrait;

class GuestControllerTest extends WebTestCase
{
    use AuthenticatedTestTrait;

    public function testGuestsPageLoads(): void
    {
        $client = static::createClient();

        // Seul l’admin peut accéder à /guests
        $this->loginAsAdmin($client);

        $client->request('GET', '/guests');

        $this->assertResponseIsSuccessful();
    }
}
