<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PortfolioControllerTest extends WebTestCase
{
    public function testPortfolioLoads(): void
    {
        $client = static::createClient();
        $client->request('GET', '/portfolio');

        $this->assertResponseIsSuccessful();

        // Vérifie que le titre Portfolio est présent
        $this->assertSelectorTextContains('h3', 'Portfolio');

        // Vérifie que la liste des albums est présente
        $this->assertSelectorExists('.btn');

        // Vérifie que la grille des médias existe (même vide)
        $this->assertSelectorExists('.row');
    }

    public function testPublicMediaNotFound(): void
    {
        $client = static::createClient();
        $client->request('GET', '/media/999999');

        $this->assertResponseStatusCodeSame(404);
    }
}
