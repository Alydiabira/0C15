<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LoginFailureTest extends WebTestCase
{
    public function testLoginFailure(): void
    {
        $client = static::createClient();

        // Page de login admin
        $crawler = $client->request('GET', '/admin/login');

        // Soumission avec mauvais identifiants
        $form = $crawler->filter('form')->form([
            'email' => 'wrong@test.com',
            'password' => 'wrongpass',
        ]);

        $client->submit($form);

        // Redirection vers /admin/login
        $this->assertResponseRedirects('/admin/login');

        // On suit la redirection
        $crawler = $client->followRedirect();

        // Le message d’erreur doit être présent
        $this->assertSelectorExists('.alert-danger');
    }
}
