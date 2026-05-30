<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GuestShowTest extends WebTestCase
{
    use AuthenticatedTestTrait;

    public function testGuestShowPageLoads(): void
    {
        $client = static::createClient();
        $this->loginAsUser($client);

        // ID 8 existe dans ta base de test
        $client->request('GET', '/guest/8');

        $this->assertResponseStatusCodeSame(200);
    }
}
