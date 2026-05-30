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

        // Récupération du guest créé dans les fixtures
        $guest = self::getContainer()->get('doctrine')->getRepository(\App\Entity\User::class)
            ->findOneBy(['type' => 'guest']);

        $client->request('GET', '/guest/' . $guest->getId());

        $this->assertResponseStatusCodeSame(200);
    }
}
