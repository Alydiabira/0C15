<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use App\Entity\User;

class SecurityControllerTest extends WebTestCase
{
    public function testLoginPageLoads(): void
    {
        $client = static::createClient();
        $client->request('GET', '/admin/login');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorExists('form');
    }

    public function testLoginFailure(): void
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/admin/login');

        $form = $crawler->filter('form')->form([
            'email' => 'wrong@test.com',
            'password' => 'wrongpass',
        ]);

        $client->submit($form);

        // Toujours une redirection après POST
        $this->assertResponseRedirects('/admin/login');

        $crawler = $client->followRedirect();

        // Symfony ajoute automatiquement une erreur
        $this->assertSelectorExists('.alert-danger');
    }

    public function testLoginSuccess(): void
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/admin/login');

        $form = $crawler->filter('form')->form([
            'email' => 'ina@test.com',
            'password' => 'password',
        ]);

        $client->submit($form);

        // ✔ Correction ici
        $this->assertResponseRedirects('/admin/media');

        $crawler = $client->followRedirect();

        $this->assertSelectorExists('h1');
    }




    public function testLogoutRedirects(): void
    {
        $client = static::createClient();

        // Appelle la route de logout
        $client->request('GET', '/logout');

        // Redirection définie dans security.yaml
        $this->assertResponseRedirects('/');
    }
}
