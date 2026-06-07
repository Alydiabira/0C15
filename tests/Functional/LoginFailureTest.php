<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LoginFailureTest extends WebTestCase
{
    public function testLoginFailure(): void
    {
        $client = static::createClient();

        // Page de login
        $crawler = $client->request('GET', '/login');

        // Soumission du formulaire avec mauvais identifiants
        $form = $crawler->filter('form')->form([
            'email' => 'wrong@test.com',
            'password' => 'wrongpass',
        ]);

        $client->submit($form);

        // 1) Symfony renvoie TOUJOURS 302 après un échec
        $this->assertResponseRedirects('/login');

        // 2) On suit la redirection pour voir la page finale
        $crawler = $client->followRedirect();

        // 3) La page finale doit contenir le message d'erreur
        $this->assertSelectorExists('.alert-danger');
    }
}
