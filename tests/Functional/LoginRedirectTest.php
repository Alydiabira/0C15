<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LoginRedirectTest extends WebTestCase
{
    public function testLoginRedirectsToHomepage(): void
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');

        $form = $crawler->filter('form')->form([
            'email' => 'ina@test.com',
            'password' => 'password',
        ]);

        $client->submit($form);

        // Redirection réelle dans ton projet
        $this->assertResponseRedirects('/admin/media');
    }
}
