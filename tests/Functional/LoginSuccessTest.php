<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LoginSuccessTest extends WebTestCase
{
    public function testLoginSuccess(): void
    {
        $client = static::createClient();

        // Accès à la page de login
        $crawler = $client->request('GET', '/login');

        // Sélection FIABLE du formulaire (pas de selectButton)
        $form = $crawler->filter('form')->form([
            'email' => 'ina@test.com',
            'password' => 'password',
        ]);

        // Soumission
        $client->submit($form);

        // Redirection réelle dans ton projet
        $this->assertResponseRedirects('/admin/media');
    }
}
