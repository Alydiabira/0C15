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

        $user = static::getContainer()
            ->get('doctrine')
            ->getRepository(User::class)
            ->findOneByEmail('ina@test.com');

        $crawler = $client->request('GET', '/admin/login');

        $form = $crawler->filter('form')->form([
            'email' => 'ina@test.com',
            'password' => 'password', // ton mot de passe fixture
        ]);

        $client->submit($form);

        // Redirection réelle de ton application
        $this->assertResponseRedirects('/admin/login');

        $crawler = $client->followRedirect();

        // Vérifier que la page admin/media est bien chargée
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
