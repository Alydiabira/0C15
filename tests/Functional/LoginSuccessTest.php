<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LoginSuccessTest extends WebTestCase
{
    public function testLoginSuccess(): void
    {
        $client = static::createClient();

        // Page de login admin
        $crawler = $client->request('GET', '/admin/login');

        // Soumission du vrai formulaire (CSRF OK)
        $form = $crawler->filter('form')->form([
            'email' => 'ina@test.com',
            'password' => 'password',
        ]);

        $client->submit($form);

        // Redirection réelle dans ton projet
        $this->assertResponseRedirects('/admin/media');
    }
}
