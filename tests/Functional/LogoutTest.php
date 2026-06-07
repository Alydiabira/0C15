<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\User;

class LogoutTest extends WebTestCase
{
    public function testLogout(): void
    {
        $client = static::createClient();

        // Récupération d'un utilisateur existant
        $user = static::getContainer()
            ->get('doctrine')
            ->getRepository(User::class)
            ->findOneByEmail('ina@test.com');

        // Connexion de l'utilisateur
        $client->loginUser($user);

        // Appel de la route de logout
        $client->request('GET', '/logout');

        // Symfony doit rediriger après logout
        $this->assertResponseRedirects('/');

        // Suivre la redirection
        $client->followRedirect();

        // Vérifier que l'utilisateur n'est plus authentifié
        $this->assertSelectorExists('a[href="/login"]');
    }
}
