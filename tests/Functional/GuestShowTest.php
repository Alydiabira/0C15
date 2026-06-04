<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Tests\Functional\AuthenticatedTestTrait;

class GuestShowTest extends WebTestCase
{
    use AuthenticatedTestTrait;

    public function testGuestShowPageLoads(): void
    {
        $client = static::createClient();

        // Seul l’admin peut accéder à /guest/{id}
        $this->loginAsAdmin($client);

        // Récupération d’un invité existant
        $guest = self::getContainer()->get('doctrine')
            ->getRepository(\App\Entity\User::class)
            ->findOneBy(['type' => 'invite']);

        $client->request('GET', '/guest/' . $guest->getId());

        $this->assertResponseIsSuccessful();
    }
}
